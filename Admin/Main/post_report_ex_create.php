<?php
// Increase PHP limits for large exports
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

include('../config/setup.php');

// Disable query timeout
mysqli_query($config, "SET SESSION wait_timeout = 600");
mysqli_query($config, "SET SESSION interactive_timeout = 600");

// Base URL for online images / hyperlinks
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

// Build WHERE clause - matching create_post.php
$expiredFilter = isset($_GET['expired']) && $_GET['expired'] == 1 ? "AND create_post.expiry_date < NOW()" : "";

$paymentFilter = "";
if (isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
    $paymentStatusFilter = mysqli_real_escape_string($config, $_GET['payment_status']);
    if ($paymentStatusFilter == 'pending') {
        $paymentFilter = "AND (
            (create_post.status = 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND (create_post.utr_number IS NULL OR create_post.utr_number = '')
             AND NOT EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0))
            OR (create_post.net_amount > 0 
             AND (create_post.payment_type IS NULL OR create_post.payment_type = '')
             AND create_post.status = 0)
        )";
    } elseif ($paymentStatusFilter == 'completed') {
        $paymentFilter = "AND (
            (create_post.payment_type = '0' AND (EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0) OR create_post.payment_confirmed_at IS NOT NULL))
            OR EXISTS (SELECT 1 FROM online_payment_transcation WHERE Order_id = create_post.post_id AND Paid_Amout > 0)
            OR (create_post.utr_number IS NOT NULL AND create_post.utr_number != '' AND create_post.status = 1)
            OR create_post.payment_type IN ('1', '2')
        )";
    } elseif ($paymentStatusFilter == 'free') {
        $paymentFilter = "AND (create_post.package_amount = 0 OR create_post.package_amount IS NULL OR create_post.net_amount = 0 OR create_post.net_amount IS NULL)";
    }
}

$dateFilter = "";
$dateFilterType = isset($_GET['date_filter_type']) ? mysqli_real_escape_string($config, $_GET['date_filter_type']) : '';
if (!empty($dateFilterType) && $dateFilterType != 'all') {
    if ($dateFilterType == 'single' && isset($_GET['single_date']) && !empty($_GET['single_date'])) {
        $singleDate = mysqli_real_escape_string($config, $_GET['single_date']);
        $dateFilter = "AND DATE(create_post.post_addon) = '$singleDate'";
    } elseif ($dateFilterType == 'range' && isset($_GET['date_from']) && !empty($_GET['date_from']) && isset($_GET['date_to']) && !empty($_GET['date_to'])) {
        $dateFrom = mysqli_real_escape_string($config, $_GET['date_from']);
        $dateTo = mysqli_real_escape_string($config, $_GET['date_to']);
        $dateFilter = "AND DATE(create_post.post_addon) BETWEEN '$dateFrom' AND '$dateTo'";
    }
}

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';
$searchQuery = "";
if (!empty($searchTerm)) {
    $searchQuery = "AND (
        create_post.driver_name LIKE '%$searchTerm%' 
        OR create_post.vehicle_no LIKE '%$searchTerm%' 
        OR create_post.phone_no LIKE '%$searchTerm%' 
        OR create_post.whatsapp_no LIKE '%$searchTerm%' 
        OR EXISTS (SELECT 1 FROM dir_city_master WHERE dir_city_id = create_post.city_id AND dir_city_name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_state_master WHERE state_id = create_post.state_id AND name LIKE '%$searchTerm%')
        OR EXISTS (SELECT 1 FROM dir_area_master WHERE dir_area_id = create_post.area_id AND dir_area_name LIKE '%$searchTerm%')
    )";
}

// Query records
$query = "SELECT * FROM create_post
     WHERE create_post.delete_id = '0' 
     $expiredFilter
     $paymentFilter
     $dateFilter
     $searchQuery
     ORDER BY create_post.post_id DESC";

mysqli_query($config, "SET SESSION query_cache_type = OFF");
$result = mysqli_query($config, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($config));
}

// Preload lookup maps
$stateMap = [];
$res = @mysqli_query($config, "SELECT state_id, name FROM dir_state_master");
if ($res) {
    while ($s = mysqli_fetch_assoc($res)) {
        $stateMap[$s['state_id']] = $s['name'];
    }
    mysqli_free_result($res);
}

$cityMap = [];
$res = @mysqli_query($config, "SELECT dir_city_id, dir_city_name FROM dir_city_master");
if ($res) {
    while ($c = mysqli_fetch_assoc($res)) {
        $cityMap[$c['dir_city_id']] = $c['dir_city_name'];
    }
    mysqli_free_result($res);
}

$areaMap = [];
$res = @mysqli_query($config, "SELECT dir_area_id, dir_area_name FROM dir_area_master");
if ($res) {
    while ($a = mysqli_fetch_assoc($res)) {
        $areaMap[$a['dir_area_id']] = $a['dir_area_name'];
    }
    mysqli_free_result($res);
}

$paymentMap = [];
$res = @mysqli_query($config, "SELECT Order_id, transactionId, Paid_Amout, Paid_on FROM online_payment_transcation WHERE Paid_Amout > 0 ORDER BY IFNULL(Paid_on, '1970-01-01') ASC, transactionId ASC");
if ($res) {
    while ($p = mysqli_fetch_object($res)) {
        if (!empty($p->Order_id)) {
            $paymentMap[$p->Order_id] = $p;
        }
    }
    mysqli_free_result($res);
}

// Helper: Fast thumbnail resolver without slow network requests
function resolveThumbnail($photo, $thumbDir, $vehDir) {
    if (empty($photo)) return false;
    $tf = $thumbDir . '/thumb_' . md5($photo) . '.jpg';
    if (file_exists($tf) && filesize($tf) > 100) {
        return $tf;
    }
    $src = $vehDir . '/' . $photo;
    if (!file_exists($src) || filesize($src) < 100) {
        return false;
    }
    // Check if file is zero-filled / sparse
    $fp = @fopen($src, 'rb');
    if (!$fp) return false;
    $header = fread($fp, 16);
    fclose($fp);
    if (trim($header, "\0") === '') {
        return false;
    }
    // Read and convert using GD
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

// Helper to escape XML
function xmlEsc($str) {
    return htmlspecialchars((string)($str ?? ''), ENT_XML1, 'UTF-8');
}

// Create temporary file for zip
$tempXlsx = tempnam(sys_get_temp_dir(), 'veh_xlsx_');
$zip = new ZipArchive();
if ($zip->open($tempXlsx, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    die("Cannot create temporary Excel file.");
}

$sheetRows = [];
$sheetRows[] = '<row r="1" ht="28" customHeight="1">
  <c r="A1" s="1" t="inlineStr"><is><t>S.No</t></is></c>
  <c r="B1" s="1" t="inlineStr"><is><t>Driver Name</t></is></c>
  <c r="C1" s="1" t="inlineStr"><is><t>Vehicle No</t></is></c>
  <c r="D1" s="1" t="inlineStr"><is><t>Vehicle Photo</t></is></c>
  <c r="E1" s="1" t="inlineStr"><is><t>Phone No</t></is></c>
  <c r="F1" s="1" t="inlineStr"><is><t>Whatsapp No</t></is></c>
  <c r="G1" s="1" t="inlineStr"><is><t>State</t></is></c>
  <c r="H1" s="1" t="inlineStr"><is><t>District</t></is></c>
  <c r="I1" s="1" t="inlineStr"><is><t>City</t></is></c>
  <c r="J1" s="1" t="inlineStr"><is><t>Status</t></is></c>
  <c r="K1" s="1" t="inlineStr"><is><t>Paid Status</t></is></c>
  <c r="L1" s="1" t="inlineStr"><is><t>Amount</t></is></c>
  <c r="M1" s="1" t="inlineStr"><is><t>Paid Date</t></is></c>
  <c r="N1" s="1" t="inlineStr"><is><t>Registration Date</t></is></c>
</row>';

$drawingXml = "";
$drawingRels = [];
$imgCounter = 1;
$rowIdx = 2;

while ($row = mysqli_fetch_assoc($result)) {
    $mc = $rowIdx - 1;
    $dName = xmlEsc($row['driver_name'] ?? '');
    $vNo = xmlEsc($row['vehicle_no'] ?? '');
    $phone = xmlEsc($row['phone_no'] ?? '');
    $wa = xmlEsc($row['whatsapp_no'] ?? '');
    $st = xmlEsc($stateMap[$row['state_id']] ?? '');
    $ct = xmlEsc($cityMap[$row['city_id']] ?? '');
    $ar = xmlEsc($areaMap[$row['area_id']] ?? '');
    $status = ($row['status'] == 1 ? 'Active' : 'In-Active');
    $statStyle = ($row['status'] == 1 ? '4' : '5');

    // Payment Status Logic
    $payment_data = isset($paymentMap[$row['post_id']]) ? $paymentMap[$row['post_id']] : null;
    $paidTransactionID = (isset($payment_data) && isset($payment_data->transactionId)) ? $payment_data->transactionId : '';
    $paidAmount = (isset($payment_data) && isset($payment_data->Paid_Amout)) ? $payment_data->Paid_Amout : '';
    $paidOn = (isset($payment_data) && isset($payment_data->Paid_on)) ? $payment_data->Paid_on : '';
    $paymentType = $row['payment_type'];
    $refNo = $row['ref_no'];
    $packageAmount = $row['package_amount'];
    $netAmount = $row['net_amount'];
    $utrNumber = $row['utr_number'];
    $utrDate = $row['utr_date'];
    $postStatus = $row['status'];
    $paymentConfirmedAt = $row['payment_confirmed_at'];

    $calculatedNetAmount = (!empty($netAmount) && $netAmount != '') ? $netAmount : $packageAmount;
    $packageAmountFloat = ($packageAmount !== null && $packageAmount !== '' && is_numeric($packageAmount)) ? floatval($packageAmount) : null;
    $netAmountFloat = ($netAmount !== null && $netAmount !== '' && is_numeric($netAmount)) ? floatval($netAmount) : null;
    $calculatedNetAmountFloat = ($calculatedNetAmount !== null && $calculatedNetAmount !== '' && is_numeric($calculatedNetAmount)) ? floatval($calculatedNetAmount) : null;
    $paidAmountFloat = ($paidAmount !== null && $paidAmount !== '' && is_numeric($paidAmount)) ? floatval($paidAmount) : 0.0;

    $isFreeRegistration = false;
    if (($packageAmountFloat !== null && $packageAmountFloat == 0) ||
        ($netAmountFloat !== null && $netAmountFloat == 0) ||
        ($calculatedNetAmountFloat !== null && $calculatedNetAmountFloat == 0)) {
        $isFreeRegistration = true;
    }

    $hasOnlineTransaction = ($paidAmountFloat > 0) || (!empty($paidTransactionID)) || (!empty($paidOn) && ($paymentType === '0' || $paymentType === 0));
    $isOnlinePaid = (!$isFreeRegistration) && (
        $hasOnlineTransaction ||
        ($postStatus == 1 && ($paymentType === '0' || $paymentType === 0) && (!empty($paymentConfirmedAt) || !empty($row['razorpay_order_id']) || (!empty($refNo) && stripos($refNo, 'pay_') === 0)))
    );

    if ($isFreeRegistration) {
        $paymentStatus = "Free Registration";
        $amount = "Free";
    } elseif ($isOnlinePaid) {
        $paymentStatus = !empty($paidTransactionID) ? "Online Payment (Transaction ID: $paidTransactionID)" : "Online Payment";
        $amount = ($paidAmountFloat > 0) ? "₹" . number_format($paidAmountFloat, 2) : ($packageAmountFloat !== null ? "₹" . number_format($packageAmountFloat, 2) : "-");
    } elseif ($paymentType == '1') {
        $paymentStatus = "Admin Cash";
        $amount = ($packageAmountFloat !== null) ? "₹" . number_format($packageAmountFloat, 2) : "-";
    } elseif ($paymentType == '2') {
        $paymentStatus = !empty($refNo) ? "Admin Bank (Ref No: $refNo)" : "Admin Bank";
        $amount = ($packageAmountFloat !== null) ? "₹" . number_format($packageAmountFloat, 2) : "-";
    } elseif ($paymentType == '3' || !empty($utrNumber)) {
        $paymentStatus = (!empty($utrNumber)) ? ("Scan QR Payment (UTR: $utrNumber - " . ($postStatus == 1 ? "Confirmed" : "Pending") . ")") : "Scan QR Payment";
        $amount = ($packageAmountFloat !== null) ? "₹" . number_format($packageAmountFloat, 2) : "-";
    } else {
        $paymentStatus = "Payment Pending";
        $amount = ($packageAmountFloat !== null && $packageAmountFloat > 0) ? "₹" . number_format($packageAmountFloat, 2) : "-";
    }

    // Paid Date
    $paidDate = '-';
    if ($isFreeRegistration) {
        $paidDate = '-';
    } elseif ($isOnlinePaid) {
        $onlineTs = (!empty($paidOn) && $paidOn !== '0000-00-00' && $paidOn !== '0000-00-00 00:00:00') ? strtotime($paidOn) : false;
        $dbTs = (!empty($paymentConfirmedAt) && $paymentConfirmedAt !== '0000-00-00 00:00:00') ? strtotime($paymentConfirmedAt) : false;
        if ($onlineTs !== false && $onlineTs > 0) $paidDate = date('d-M-Y', $onlineTs);
        elseif ($dbTs !== false && $dbTs > 0) $paidDate = date('d-M-Y', $dbTs);
    } else {
        $dbTs = (!empty($paymentConfirmedAt) && $paymentConfirmedAt !== '0000-00-00 00:00:00') ? strtotime($paymentConfirmedAt) : false;
        if ($dbTs !== false && $dbTs > 0) $paidDate = date('d-M-Y', $dbTs);
        elseif (!empty($utrDate) && $utrDate !== '0000-00-00' && $postStatus == 1) $paidDate = date('d-M-Y', strtotime($utrDate));
    }

    // Registration Date
    $registrationDate = !empty($row['post_addon']) ? date('d-m-Y', strtotime($row['post_addon'])) : (!empty($row['create_on']) ? date('d-m-Y', strtotime($row['create_on'])) : '');

    // Process Vehicle Photo (Attachment in Excel)
    $photo = trim($row['vehicle_photo'] ?? '');
    $tf = resolveThumbnail($photo, $thumbDir, $vehDir);
    $hasPhoto = false;

    if ($tf) {
        $imgName = "image" . $imgCounter . ".jpeg";
        $zip->addFile($tf, "xl/media/" . $imgName);
        $rId = "rId" . $imgCounter;
        $hlkId = "hlk" . $imgCounter;
        $fullUrl = $photoBaseUrl . rawurlencode($photo);

        $drawingRels[] = '<Relationship Id="' . $rId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="../media/' . $imgName . '"/>';
        $drawingRels[] = '<Relationship Id="' . $hlkId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . xmlEsc($fullUrl) . '" TargetMode="External"/>';

        $drawRow = $rowIdx - 1; // 0-indexed row for drawing anchor
        // Standard oneCellAnchor with positive offsets (centers 100x75 px image within cell)
        $drawingXml .= '<xdr:oneCellAnchor>
  <xdr:from>
    <xdr:col>3</xdr:col>
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

    $photoCell = $hasPhoto ? '<c r="D' . $rowIdx . '" s="3"/>' : '<c r="D' . $rowIdx . '" s="3" t="inlineStr"><is><t>No Photo</t></is></c>';

    $sheetRows[] = '<row r="' . $rowIdx . '" ht="65" customHeight="1">
  <c r="A' . $rowIdx . '" s="3"><v>' . $mc . '</v></c>
  <c r="B' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . $dName . '</t></is></c>
  <c r="C' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . $vNo . '</t></is></c>
  ' . $photoCell . '
  <c r="E' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . $phone . '</t></is></c>
  <c r="F' . $rowIdx . '" s="2" t="inlineStr"><is><t>' . $wa . '</t></is></c>
  <c r="G' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . $st . '</t></is></c>
  <c r="H' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . $ct . '</t></is></c>
  <c r="I' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . $ar . '</t></is></c>
  <c r="J' . $rowIdx . '" s="' . $statStyle . '" t="inlineStr"><is><t>' . $status . '</t></is></c>
  <c r="K' . $rowIdx . '" s="0" t="inlineStr"><is><t>' . xmlEsc($paymentStatus) . '</t></is></c>
  <c r="L' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEsc($amount) . '</t></is></c>
  <c r="M' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEsc($paidDate) . '</t></is></c>
  <c r="N' . $rowIdx . '" s="3" t="inlineStr"><is><t>' . xmlEsc($registrationDate) . '</t></is></c>
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
  <sheets><sheet name="Registered Vehicles" sheetId="1" r:id="rId1"/></sheets>
</workbook>');

$zip->addFromString("xl/styles.xml", '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <numFmts count="1"><numFmt numFmtId="164" formatCode="@"/></numFmts>
  <fonts count="4">
    <font><sz val="11"/><name val="Calibri"/></font>
    <font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>
    <font><b/><sz val="11"/><color rgb="FF155724"/><name val="Calibri"/></font>
    <font><b/><sz val="11"/><color rgb="FF721C24"/><name val="Calibri"/></font>
  </fonts>
  <fills count="5">
    <fill><patternFill patternType="none"/></fill>
    <fill><patternFill patternType="gray125"/></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF28A745"/><bgColor indexed="64"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFD4EDDA"/><bgColor indexed="64"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFF8D7DA"/><bgColor indexed="64"/></patternFill></fill>
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
  <cellXfs count="6">
    <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>
    <xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="164" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center"/></xf>
    <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="2" fillId="3" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="3" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
  </cellXfs>
</styleSheet>');

$sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <cols>
    <col min="1" max="1" width="8" customWidth="1"/>
    <col min="2" max="2" width="24" customWidth="1"/>
    <col min="3" max="3" width="18" customWidth="1"/>
    <col min="4" max="4" width="20" customWidth="1"/>
    <col min="5" max="5" width="16" customWidth="1"/>
    <col min="6" max="6" width="16" customWidth="1"/>
    <col min="7" max="7" width="18" customWidth="1"/>
    <col min="8" max="8" width="18" customWidth="1"/>
    <col min="9" max="9" width="18" customWidth="1"/>
    <col min="10" max="10" width="14" customWidth="1"/>
    <col min="11" max="11" width="34" customWidth="1"/>
    <col min="12" max="12" width="14" customWidth="1"/>
    <col min="13" max="13" width="20" customWidth="1"/>
    <col min="14" max="14" width="18" customWidth="1"/>
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
header("Content-Disposition: attachment; filename=registration_data_" . date('Ymd') . ".xlsx");
header("Content-Length: " . filesize($tempXlsx));
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

readfile($tempXlsx);
@unlink($tempXlsx);
exit;
?>
