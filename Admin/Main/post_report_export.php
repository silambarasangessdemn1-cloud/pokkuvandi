<?php
// Increase PHP limits for large exports
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

include('../config/setup.php');

// Disable query timeout
mysqli_query($config, "SET SESSION wait_timeout = 600");
mysqli_query($config, "SET SESSION interactive_timeout = 600");

// Determine photo base URL
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$protocol = $isHttps ? "https://" : "http://";
$host = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'pokkuvandi.com';
$photoBaseUrl = $protocol . $host . '/photos/vehicle/';

// Directories
$vehDir = realpath(__DIR__ . '/../../photos/vehicle');
$thumbDir = $vehDir . '/thumbs';
if (!is_dir($thumbDir)) {
    @mkdir($thumbDir, 0777, true);
}

// Retrieve filter parameters from URL
$where = " WHERE delete_id = '0' "; 

if (!empty($_GET['from_date']) && !empty($_GET['to_date'])) {
    $from_date = mysqli_real_escape_string($config, $_GET['from_date']);
    $to_date = mysqli_real_escape_string($config, $_GET['to_date']);
    $where .= " AND create_on BETWEEN '$from_date' AND '$to_date' ";
}
if (!empty($_GET['main_cate_Name']) && $_GET['main_cate_Name'] != '0') {
    $main_category = mysqli_real_escape_string($config, $_GET['main_cate_Name']);
    $where .= " AND category_id = '$main_category' ";
}
if (!empty($_GET['district']) && $_GET['district'] != '0') {
    $district = mysqli_real_escape_string($config, $_GET['district']);
    $where .= " AND city_id = '$district' ";
}
if (!empty($_GET['Add_area']) && $_GET['Add_area'] != '0') {
    $city = mysqli_real_escape_string($config, $_GET['Add_area']);
    $where .= " AND area_id = '$city' ";
}
if (!empty($_GET['state']) && $_GET['state'] != '0') {
    $state = mysqli_real_escape_string($config, $_GET['state']);
    $where .= " AND state_id = '$state' ";
}
if (!empty($_GET['search_input'])) {
    $search_value = mysqli_real_escape_string($config, $_GET['search_input']);
    $where .= " AND (create_post.driver_name LIKE '%$search_value%' 
                      OR create_post.vehicle_no LIKE '%$search_value%'
                      OR create_post.phone_no LIKE '%$search_value%'
                      OR create_post.whatsapp_no LIKE '%$search_value%')";
}

// Fetch data
$query = "SELECT * FROM create_post $where ORDER BY post_id DESC";
mysqli_query($config, "SET SESSION query_cache_type = OFF");
$result = mysqli_query($config, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($config));
}

// Preload lookup tables for fast execution
$categoryMap = [];
$res = @mysqli_query($config, "SELECT Main_Category_id, Main_Category_Name FROM main_category");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $categoryMap[$r['Main_Category_id']] = $r['Main_Category_Name'];
    }
    mysqli_free_result($res);
}

$subCategoryMap = [];
$res = @mysqli_query($config, "SELECT Sub_Category_id, Sub_Category_Name FROM sub_category");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $subCategoryMap[$r['Sub_Category_id']] = $r['Sub_Category_Name'];
    }
    mysqli_free_result($res);
}

$cityMap = [];
$res = @mysqli_query($config, "SELECT dir_city_id, dir_city_name FROM dir_city_master");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $cityMap[$r['dir_city_id']] = $r['dir_city_name'];
    }
    mysqli_free_result($res);
}

$stateMap = [];
$res = @mysqli_query($config, "SELECT state_id, name FROM dir_state_master");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $stateMap[$r['state_id']] = $r['name'];
    }
    mysqli_free_result($res);
}

$areaMap = [];
$res = @mysqli_query($config, "SELECT dir_area_id, dir_area_name FROM dir_area_master");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $areaMap[$r['dir_area_id']] = $r['dir_area_name'];
    }
    mysqli_free_result($res);
}

$packageMap = [];
$res = @mysqli_query($config, "SELECT package_id, package_title FROM category_package");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $packageMap[$r['package_id']] = $r['package_title'];
    }
    mysqli_free_result($res);
}

$vehicleTypeMap = [];
$res = @mysqli_query($config, "SELECT Vehicle_type_id, Vehicle_type_name FROM vehicle_type");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $vehicleTypeMap[$r['Vehicle_type_id']] = $r['Vehicle_type_name'];
    }
    mysqli_free_result($res);
}

$paymentMap = [];
$res = @mysqli_query($config, "SELECT Order_id, Customer_id, transactionId, Paid_Amout, Paid_on FROM online_payment_transcation WHERE Paid_Amout > 0 ORDER BY IFNULL(Paid_on, '1970-01-01') ASC, transactionId ASC");
if ($res) {
    while ($r = mysqli_fetch_object($res)) {
        if (!empty($r->Customer_id)) {
            $paymentMap['cust_' . $r->Customer_id] = $r;
        }
        if (!empty($r->Order_id)) {
            $paymentMap['order_' . $r->Order_id] = $r;
        }
    }
    mysqli_free_result($res);
}

// Fast local thumbnail resolver
function resolveThumbnailExport($photo, $thumbDir, $vehDir) {
    if (empty($photo)) return false;
    $tf = $thumbDir . '/thumb_' . md5($photo) . '.jpg';
    if (file_exists($tf) && filesize($tf) > 100) {
        return $tf;
    }
    $src = $vehDir . '/' . $photo;
    if (!file_exists($src) || filesize($src) < 100) {
        return false;
    }
    $fp = @fopen($src, 'rb');
    if (!$fp) return false;
    $header = fread($fp, 16);
    fclose($fp);
    if (trim($header, "\0") === '') {
        return false;
    }
    $data = @file_get_contents($src);
    if (!$data) return false;
    $im = @imagecreatefromstring($data);
    if (!$im) return false;
    $w = imagesx($im);
    $h = imagesy($im);
    if ($w <= 0 || $h <= 0) {
        imagedestroy($im);
        return false;
    }
    $nw = 100;
    $nh = max(1, intval($h * ($nw / max(1, $w))));
    if ($nh > 75) {
        $nh = 75;
        $nw = max(1, intval($w * ($nh / max(1, $h))));
    }
    $t = imagecreatetruecolor($nw, $nh);
    $bg = imagecolorallocate($t, 255, 255, 255);
    imagefill($t, 0, 0, $bg);
    imagecopyresampled($t, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagejpeg($t, $tf, 75);
    imagedestroy($t);
    imagedestroy($im);
    return (file_exists($tf) && filesize($tf) > 100) ? $tf : false;
}

function xmlEscExport($str) {
    return htmlspecialchars((string)($str ?? ''), ENT_XML1, 'UTF-8');
}

// Create temporary file for zip
$tempXlsx = tempnam(sys_get_temp_dir(), 'rep_xlsx_');
$zip = new ZipArchive();
if ($zip->open($tempXlsx, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    die("Cannot create temporary Excel file.");
}

$sheetRows = [];
$sheetRows[] = '<row r="1" ht="28" customHeight="1">
  <c r="A1" s="1" t="inlineStr"><is><t>S No</t></is></c>
  <c r="B1" s="1" t="inlineStr"><is><t>Customer</t></is></c>
  <c r="C1" s="1" t="inlineStr"><is><t>Phone No</t></is></c>
  <c r="D1" s="1" t="inlineStr"><is><t>Category</t></is></c>
  <c r="E1" s="1" t="inlineStr"><is><t>Sub category</t></is></c>
  <c r="F1" s="1" t="inlineStr"><is><t>Vehicle Type</t></is></c>
  <c r="G1" s="1" t="inlineStr"><is><t>Vehicle Name</t></is></c>
  <c r="H1" s="1" t="inlineStr"><is><t>Vehicle RC No</t></is></c>
  <c r="I1" s="1" t="inlineStr"><is><t>Vehicle Photo</t></is></c>
  <c r="J1" s="1" t="inlineStr"><is><t>RC Name</t></is></c>
  <c r="K1" s="1" t="inlineStr"><is><t>Tonage</t></is></c>
  <c r="L1" s="1" t="inlineStr"><is><t>Seating</t></is></c>
  <c r="M1" s="1" t="inlineStr"><is><t>Facilities</t></is></c>
  <c r="N1" s="1" t="inlineStr"><is><t>Specification</t></is></c>
  <c r="O1" s="1" t="inlineStr"><is><t>Active Location</t></is></c>
  <c r="P1" s="1" t="inlineStr"><is><t>Insurance Expiry</t></is></c>
  <c r="Q1" s="1" t="inlineStr"><is><t>Stand Name</t></is></c>
  <c r="R1" s="1" t="inlineStr"><is><t>Shop Name</t></is></c>
  <c r="S1" s="1" t="inlineStr"><is><t>Shop Address</t></is></c>
  <c r="T1" s="1" t="inlineStr"><is><t>Work Nature</t></is></c>
  <c r="U1" s="1" t="inlineStr"><is><t>Whatsapp No</t></is></c>
  <c r="V1" s="1" t="inlineStr"><is><t>State</t></is></c>
  <c r="W1" s="1" t="inlineStr"><is><t>District</t></is></c>
  <c r="X1" s="1" t="inlineStr"><is><t>City</t></is></c>
  <c r="Y1" s="1" t="inlineStr"><is><t>Create On</t></is></c>
  <c r="Z1" s="1" t="inlineStr"><is><t>Expiry Date</t></is></c>
  <c r="AA1" s="1" t="inlineStr"><is><t>Referred By Mobile No</t></is></c>
  <c r="AB1" s="1" t="inlineStr"><is><t>Referred By Name</t></is></c>
  <c r="AC1" s="1" t="inlineStr"><is><t>Package Name</t></is></c>
  <c r="AD1" s="1" t="inlineStr"><is><t>Package Valid Days</t></is></c>
  <c r="AE1" s="1" t="inlineStr"><is><t>Coupon Type</t></is></c>
  <c r="AF1" s="1" t="inlineStr"><is><t>Coupon Name</t></is></c>
  <c r="AG1" s="1" t="inlineStr"><is><t>Discount Amount</t></is></c>
  <c r="AH1" s="1" t="inlineStr"><is><t>Payment Type</t></is></c>
  <c r="AI1" s="1" t="inlineStr"><is><t>Amount</t></is></c>
</row>';

$drawingXml = "";
$drawingRels = [];
$imgCounter = 1;
$rowIdx = 2;

while ($recent_cust = mysqli_fetch_object($result)) {
    $mc = $rowIdx - 1;
    $categoryName = isset($categoryMap[$recent_cust->category_id]) ? $categoryMap[$recent_cust->category_id] : '';
    $subCategoryName = isset($subCategoryMap[$recent_cust->subcategory_id]) ? $subCategoryMap[$recent_cust->subcategory_id] : '';
    $cityName = isset($cityMap[$recent_cust->city_id]) ? $cityMap[$recent_cust->city_id] : '';
    $stateName = isset($stateMap[$recent_cust->state_id]) ? $stateMap[$recent_cust->state_id] : '';
    $areaName = isset($areaMap[$recent_cust->area_id]) ? $areaMap[$recent_cust->area_id] : '';
    $packageName = isset($packageMap[$recent_cust->package_id]) ? $packageMap[$recent_cust->package_id] : '';
    $vehicleTypeName = isset($vehicleTypeMap[$recent_cust->vehicle_type_id]) ? $vehicleTypeMap[$recent_cust->vehicle_type_id] : '';

    $online_payment_transcation_1 = isset($paymentMap['order_' . $recent_cust->post_id]) 
        ? $paymentMap['order_' . $recent_cust->post_id] 
        : (isset($paymentMap['cust_' . $recent_cust->customer_id]) ? $paymentMap['cust_' . $recent_cust->customer_id] : null);

    $paidTransactionID = $online_payment_transcation_1 ? $online_payment_transcation_1->transactionId : '';
    $paidAmount = $online_payment_transcation_1 ? $online_payment_transcation_1->Paid_Amout : '';
    $paymentType = $recent_cust->payment_type;
    $refNo = $recent_cust->ref_no;
    $packageAmount = $recent_cust->package_amount;

    if (!empty($paidAmount)) {
        $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
        $amount = "₹$paidAmount";
    } elseif ($paymentType == '1') {
        $paymentStatus = "Admin Cash";
        $amount = "₹$packageAmount";
    } elseif ($paymentType == '2') {
        $paymentStatus = "Admin Cash + Transaction (Ref No: $refNo)";
        $amount = "₹$packageAmount";
    } elseif ($paymentType == '0' && $packageAmount == '0') {
        $paymentStatus = "Free";
        $amount = "₹$packageAmount";
    } elseif ($paymentType == '0' && $packageAmount != '0') {
        $paymentStatus = "Paid (Transaction ID: $paidTransactionID)";
        $amount = "₹$packageAmount";
    } else {
        $paymentStatus = "Not Paid";
        $amount = "-";
    }

    $Add_insurance_exp_date = !empty($recent_cust->Add_insurance_exp_date) ? date('d-m-Y', strtotime($recent_cust->Add_insurance_exp_date)) : '';
    $create_on = !empty($recent_cust->create_on) ? date('d-m-Y', strtotime($recent_cust->create_on)) : '';
    $expiry_date = !empty($recent_cust->expiry_date) ? date('d-m-Y', strtotime($recent_cust->expiry_date)) : '';

    // Process Vehicle Photo (Column I = index 8)
    $photo = trim($recent_cust->vehicle_photo ?? '');
    $tf = resolveThumbnailExport($photo, $thumbDir, $vehDir);
    $hasPhoto = false;

    if ($tf) {
        $imgName = "image" . $imgCounter . ".jpeg";
        $zip->addFile($tf, "xl/media/" . $imgName);
        $rId = "rId" . $imgCounter;
        $hlkId = "hlk" . $imgCounter;
        $fullUrl = $photoBaseUrl . rawurlencode($photo);

        $drawingRels[] = '<Relationship Id="' . $rId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="../media/' . $imgName . '"/>';
        $drawingRels[] = '<Relationship Id="' . $hlkId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . xmlEscExport($fullUrl) . '" TargetMode="External"/>';

        $drawRow = $rowIdx - 1; // 0-indexed row for drawing anchor (Col 8 = Column I)
        $drawingXml .= '<xdr:oneCellAnchor>
  <xdr:from>
    <xdr:col>8</xdr:col>
    <xdr:colOff>171450</xdr:colOff>
    <xdr:row>' . $drawRow . '</xdr:row>
    <xdr:rowOff>57150</xdr:rowOff>
  </xdr:from>
  <xdr:ext cx="952500" cy="714375"/>
  <xdr:pic>
    <xdr:nvPicPr>
      <xdr:cNvPr id="' . ($imgCounter + 1) . '" name="Photo ' . $imgCounter . '" descr="Vehicle Photo">
        <a:hlinkClick xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" r:id="' . $hlkId . '"/>
      </xdr:cNvPr>
      <xdr:cNvPicPr><a:picLocks noChangeAspect="1"/></xdr:cNvPicPr>
    </xdr:nvPicPr>
    <xdr:blipFill>
      <a:blip xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" r:embed="' . $rId . '"/>
      <a:stretch><a:fillRect/></a:stretch>
    </xdr:blipFill>
    <xdr:spPr>
      <a:xfrm><a:off x="0" y="0"/><a:ext cx="952500" cy="714375"/></a:xfrm>
      <a:prstGeom prst="rect"><a:avLst/></a:prstGeom>
    </xdr:spPr>
  </xdr:pic>
  <xdr:clientData/>
</xdr:oneCellAnchor>';

        $imgCounter++;
        $hasPhoto = true;
    }

    $photoCell = $hasPhoto ? '<c r="I' . $rowIdx . '" s="3"/>' : '<c r="I' . $rowIdx . '" s="3" t="inlineStr"><is><t>No Photo</t></is></c>';

    $sheetRows[] = '<row r="' . $rowIdx . '" ht="65" customHeight="1">
  <c r="A' . $rowIdx . '" s="3"><v>' . $mc . '</v></c>
  <c r="B' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->driver_name ?? '') . '</t></is></c>
  <c r="C' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->phone_no ?? '') . '</t></is></c>
  <c r="D' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($categoryName) . '</t></is></c>
  <c r="E' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($subCategoryName) . '</t></is></c>
  <c r="F' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($vehicleTypeName) . '</t></is></c>
  <c r="G' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->vehicle_name ?? '') . '</t></is></c>
  <c r="H' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->vehicle_no ?? '') . '</t></is></c>
  ' . $photoCell . '
  <c r="J' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->Add_RC_owner_name ?? '') . '</t></is></c>
  <c r="K' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->tonnage ?? '') . '</t></is></c>
  <c r="L' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->seating_capacity ?? '') . '</t></is></c>
  <c r="M' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->facilities ?? '') . '</t></is></c>
  <c r="N' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->space ?? '') . '</t></is></c>
  <c r="O' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->Add_location ?? '') . '</t></is></c>
  <c r="P' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($Add_insurance_exp_date) . '</t></is></c>
  <c r="Q' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->stand_name ?? '') . '</t></is></c>
  <c r="R' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->shop_name ?? '') . '</t></is></c>
  <c r="S' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->shop_address ?? '') . '</t></is></c>
  <c r="T' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->work_nature ?? '') . '</t></is></c>
  <c r="U' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->whatsapp_no ?? '') . '</t></is></c>
  <c r="V' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($stateName) . '</t></is></c>
  <c r="W' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($cityName) . '</t></is></c>
  <c r="X' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($areaName) . '</t></is></c>
  <c r="Y' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($create_on) . '</t></is></c>
  <c r="Z' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($expiry_date) . '</t></is></c>
  <c r="AA' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->reffered_by_phone_no ?? '') . '</t></is></c>
  <c r="AB' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->reffered_by_name ?? '') . '</t></is></c>
  <c r="AC' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($packageName) . '</t></is></c>
  <c r="AD' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->package_days ?? '') . '</t></is></c>
  <c r="AE' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->coupon_type ?? '') . '</t></is></c>
  <c r="AF' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->discount_name ?? '') . '</t></is></c>
  <c r="AG' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($recent_cust->discount_amount ?? '') . '</t></is></c>
  <c r="AH' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEscExport($paymentStatus) . '</t></is></c>
  <c r="AI' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEscExport($amount) . '</t></is></c>
</row>';

    $rowIdx++;
}

mysqli_free_result($result);

$hasDrawings = ($imgCounter > 1);

// Add OpenXML static files
$contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Default Extension="jpeg" ContentType="image/jpeg"/>
  <Default Extension="jpg" ContentType="image/jpeg"/>
  <Default Extension="png" ContentType="image/png"/>
  <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
  <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
  <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
  . ($hasDrawings ? "\n  " . '<Override PartName="/xl/drawings/drawing1.xml" ContentType="application/vnd.openxmlformats-officedocument.drawing+xml"/>' : '') . '
</Types>';
$zip->addFromString("[Content_Types].xml", $contentTypes);

$zip->addFromString("_rels/.rels", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
</Relationships>');

$zip->addFromString("xl/_rels/workbook.xml.rels", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
  <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
</Relationships>');

$zip->addFromString("xl/workbook.xml", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <sheets><sheet name="Registration Report" sheetId="1" r:id="rId1"/></sheets>
</workbook>');

$zip->addFromString("xl/styles.xml", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <numFmts count="1"><numFmt numFmtId="164" formatCode="@"/></numFmts>
  <fonts count="2">
    <font><sz val="11"/><name val="Calibri"/></font>
    <font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>
  </fonts>
  <fills count="3">
    <fill><patternFill patternType="none"/></fill>
    <fill><patternFill patternType="gray125"/></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF28A745"/><bgColor indexed="64"/></patternFill></fill>
  </fills>
  <borders count="2">
    <border><left/><right/><top/><bottom/><diagonal/></border>
    <border>
      <left style="thin"><color rgb="FFD4D4D4"/></left>
      <right style="thin"><color rgb="FFD4D4D4"/></right>
      <top style="thin"><color rgb="FFD4D4D4"/></top>
      <bottom style="thin"><color rgb="FFD4D4D4"/></bottom>
    </border>
  </borders>
  <cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>
  <cellXfs count="4">
    <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>
    <xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="164" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>
    <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
  </cellXfs>
</styleSheet>');

$sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <cols>
    <col min="1" max="1" width="8" customWidth="1"/>
    <col min="2" max="2" width="22" customWidth="1"/>
    <col min="3" max="3" width="16" customWidth="1"/>
    <col min="4" max="4" width="18" customWidth="1"/>
    <col min="5" max="5" width="18" customWidth="1"/>
    <col min="6" max="6" width="18" customWidth="1"/>
    <col min="7" max="7" width="20" customWidth="1"/>
    <col min="8" max="8" width="18" customWidth="1"/>
    <col min="9" max="9" width="20" customWidth="1"/>
    <col min="10" max="10" width="20" customWidth="1"/>
    <col min="11" max="11" width="12" customWidth="1"/>
    <col min="12" max="12" width="12" customWidth="1"/>
    <col min="13" max="13" width="18" customWidth="1"/>
    <col min="14" max="14" width="18" customWidth="1"/>
    <col min="15" max="15" width="20" customWidth="1"/>
    <col min="16" max="16" width="16" customWidth="1"/>
    <col min="17" max="17" width="18" customWidth="1"/>
    <col min="18" max="18" width="18" customWidth="1"/>
    <col min="19" max="19" width="24" customWidth="1"/>
    <col min="20" max="20" width="18" customWidth="1"/>
    <col min="21" max="21" width="16" customWidth="1"/>
    <col min="22" max="22" width="18" customWidth="1"/>
    <col min="23" max="23" width="18" customWidth="1"/>
    <col min="24" max="24" width="18" customWidth="1"/>
    <col min="25" max="25" width="16" customWidth="1"/>
    <col min="26" max="26" width="16" customWidth="1"/>
    <col min="27" max="27" width="22" customWidth="1"/>
    <col min="28" max="28" width="20" customWidth="1"/>
    <col min="29" max="29" width="18" customWidth="1"/>
    <col min="30" max="30" width="18" customWidth="1"/>
    <col min="31" max="31" width="16" customWidth="1"/>
    <col min="32" max="32" width="16" customWidth="1"/>
    <col min="33" max="33" width="16" customWidth="1"/>
    <col min="34" max="34" width="28" customWidth="1"/>
    <col min="35" max="35" width="16" customWidth="1"/>
  </cols>
  <sheetData>' . implode("\n", $sheetRows) . '</sheetData>'
  . ($hasDrawings ? "\n  " . '<drawing r:id="rId1"/>' : '') . '
</worksheet>';
$zip->addFromString("xl/worksheets/sheet1.xml", $sheetXml);

if ($hasDrawings) {
    $zip->addFromString("xl/worksheets/_rels/sheet1.xml.rels", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/drawing" Target="../drawings/drawing1.xml"/>
</Relationships>');

    $zip->addFromString("xl/drawings/drawing1.xml", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<xdr:wsDr xmlns:xdr="http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
' . $drawingXml . '
</xdr:wsDr>');

    $zip->addFromString("xl/drawings/_rels/drawing1.xml.rels", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
' . implode("\n", $drawingRels) . '
</Relationships>');
}

$zip->close();

// Clear any buffered output
while (ob_get_level()) {
    ob_end_clean();
}

// Send standard Excel XLSX download headers
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=filtered_data_" . date('Ymd') . ".xlsx");
header("Content-Length: " . filesize($tempXlsx));
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

readfile($tempXlsx);
@unlink($tempXlsx);
exit;
?>
