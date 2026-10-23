<?php 
include('../config/setup.php');

// Collect filter parameters
$replyFilter = isset($_GET['reply_status']) ? trim($_GET['reply_status']) : '';
$adminReadFilter = isset($_GET['admin_read']) ? trim($_GET['admin_read']) : '';
$messageTypeFilter = isset($_GET['message_type']) ? trim($_GET['message_type']) : '';
$customerReadFilter = isset($_GET['customer_read']) ? trim($_GET['customer_read']) : '';
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : '';
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

$whereConditions = [];
$activeFilterLabels = [];

if ($replyFilter === 'replied') {
    $whereConditions[] = "COALESCE(nr_agg.reply_count, 0) > 0";
    $activeFilterLabels[] = "💬 Replied Only";
} elseif ($replyFilter === 'unreplied') {
    $whereConditions[] = "COALESCE(nr_agg.reply_count, 0) = 0";
    $activeFilterLabels[] = "No Replies";
}

if ($adminReadFilter === 'unread') {
    $whereConditions[] = "(cnm.admin_read IS NULL OR cnm.admin_read = 0)";
    $activeFilterLabels[] = "✉️ Unread by Admin";
} elseif ($adminReadFilter === 'read') {
    $whereConditions[] = "cnm.admin_read = 1";
    $activeFilterLabels[] = "✓ Read by Admin";
}

if ($messageTypeFilter === 'common') {
    $whereConditions[] = "cnm.message_type = 'common'";
    $activeFilterLabels[] = "Common Messages";
} elseif ($messageTypeFilter === 'particular') {
    $whereConditions[] = "cnm.message_type = 'particular'";
    $activeFilterLabels[] = "Particular Messages";
}

if ($customerReadFilter === 'read') {
    $whereConditions[] = "cnm.is_read = 1";
    $activeFilterLabels[] = "Read by Customer";
} elseif ($customerReadFilter === 'unread') {
    $whereConditions[] = "(cnm.is_read IS NULL OR cnm.is_read = 0)";
    $activeFilterLabels[] = "Unread by Customer";
}

if ($statusFilter === '1') {
    $whereConditions[] = "cnm.status = 1";
    $activeFilterLabels[] = "Active Status";
} elseif ($statusFilter === '0') {
    $whereConditions[] = "cnm.status = 0";
    $activeFilterLabels[] = "Inactive Status";
}

if (!empty($searchTerm)) {
    $searchEscaped = mysqli_real_escape_string($config, $searchTerm);
    $whereConditions[] = "(
        cnm.message_text LIKE '%$searchEscaped%' OR 
        cnm.customer_name LIKE '%$searchEscaped%' OR 
        cnm.customer_phone LIKE '%$searchEscaped%' OR
        EXISTS (
            SELECT 1 FROM notification_replies nr_s 
            WHERE nr_s.notification_id = cnm.notification_id 
              AND nr_s.reply_message LIKE '%$searchEscaped%'
        )
    )";
    $activeFilterLabels[] = "Search: " . htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8');
}

$whereSql = "";
if (!empty($whereConditions)) {
    $whereSql = "WHERE " . implode(" AND ", $whereConditions);
}

// Summary statistics for top badges
$statsQuery = mysqli_query($config, "
    SELECT 
        COUNT(*) AS total_all,
        SUM(CASE WHEN COALESCE(nr_agg.reply_count, 0) > 0 THEN 1 ELSE 0 END) AS total_replied,
        SUM(CASE WHEN (cnm.admin_read IS NULL OR cnm.admin_read = 0) THEN 1 ELSE 0 END) AS total_unread_admin
    FROM comman_notification_messages cnm
    LEFT JOIN (
        SELECT notification_id, COUNT(*) AS reply_count
        FROM notification_replies
        GROUP BY notification_id
    ) nr_agg ON cnm.notification_id = nr_agg.notification_id
");
$stats = ($statsQuery) ? mysqli_fetch_assoc($statsQuery) : [];
$totalAllInDb = (int)($stats['total_all'] ?? 0);
$totalRepliedInDb = (int)($stats['total_replied'] ?? 0);
$totalUnreadAdminInDb = (int)($stats['total_unread_admin'] ?? 0);

// Main Query: Always list replied messages AT THE TOP, ordered by newest reply timestamp, followed by unreplied messages
$querySql = "
    SELECT cnm.*,
           COALESCE(nr_agg.reply_count, 0) AS reply_count,
           nr_agg.latest_reply_at
    FROM comman_notification_messages cnm
    LEFT JOIN (
        SELECT notification_id,
               COUNT(*) AS reply_count,
               MAX(created_at) AS latest_reply_at
        FROM notification_replies
        GROUP BY notification_id
    ) nr_agg ON cnm.notification_id = nr_agg.notification_id
    $whereSql
    ORDER BY 
        CASE WHEN COALESCE(nr_agg.reply_count, 0) > 0 THEN 1 ELSE 0 END DESC,
        nr_agg.latest_reply_at DESC,
        cnm.notification_id DESC
";
$query = mysqli_query($config, $querySql);

$rows = [];
$repliedInViewCount = 0;
$unreadInViewCount = 0;
if ($query) {
    while ($r = mysqli_fetch_object($query)) {
        if ($r->reply_count > 0) $repliedInViewCount++;
        if (empty($r->admin_read)) $unreadInViewCount++;
        $rows[] = $r;
    }
}
$totalFiltered = count($rows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Common Notification Messages</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../../photos/logo/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,600,700,900"]},
            custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.min.css']},
            active: function() { sessionStorage.fonts = true; }
        });
    </script>
    <style>
        /* Modern Professional Table & Dashboard UI */
        body {
            background-color: #f4f6f9;
        }
        .page-inner {
            padding-top: 25px !important;
            padding-bottom: 40px !important;
        }
        .main-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            background: #ffffff;
            overflow: hidden;
        }
        .filter-card-modern {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
        }

        /* Clean Table Styling */
        #basic-datatables {
            border-collapse: separate !important;
            border-spacing: 0;
            width: 100% !important;
            border: none !important;
        }
        #basic-datatables thead th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-size: 0.72rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            padding: 13px 12px !important;
            border-top: none !important;
            border-bottom: 2px solid #e2e8f0 !important;
            border-left: none !important;
            border-right: none !important;
            white-space: nowrap;
        }
        #basic-datatables tbody td {
            padding: 14px 12px !important;
            vertical-align: top !important;
            border-top: none !important;
            border-bottom: 1px solid #f1f5f9 !important;
            border-left: none !important;
            border-right: none !important;
            color: #334155;
            font-size: 0.88rem;
        }
        #basic-datatables tbody tr {
            transition: background-color 0.15s ease;
        }
        #basic-datatables tbody tr:hover {
            background-color: #f8fafc !important;
        }

        /* Replied Highlight */
        .tr-replied {
            background-color: #f7fbff !important;
            border-left: 3.5px solid #0284c7 !important;
        }
        .tr-replied:hover {
            background-color: #eff6ff !important;
        }

        /* Column Controls */
        .col-sno {
            width: 50px;
            text-align: center;
            color: #94a3b8;
            font-weight: 600;
        }
        .col-type {
            width: 110px;
        }
        .col-msg {
            min-width: 280px;
            max-width: 440px;
        }
        .col-customer {
            width: 140px;
        }
        .col-replies {
            width: 125px;
            text-align: center;
        }
        .col-read {
            width: 95px;
            text-align: center;
        }
        .col-status {
            width: 80px;
            text-align: center;
        }
        .col-action {
            width: 85px;
            text-align: center;
        }

        /* Message Display */
        .msg-text-display {
            color: #1e293b;
            font-size: 13.5px;
            line-height: 1.55;
            white-space: normal;
            word-break: normal;
            overflow-wrap: anywhere;
            font-weight: 500;
        }
        .msg-timestamp {
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
        }

        /* Type Badges */
        .badge-type {
            display: inline-flex;
            align-items: center;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 9px;
            border-radius: 6px;
            line-height: 1.2;
        }
        .badge-type-particular {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .badge-type-common {
            background-color: #ede9fe;
            color: #5b21b6;
            border: 1px solid #ddd6fe;
        }
        .badge-replied-tag {
            display: inline-flex;
            align-items: center;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: #ffffff;
            margin-top: 4px;
            box-shadow: 0 2px 5px rgba(2, 132, 199, 0.2);
        }

        /* Modern Status Pills */
        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 4px 9px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            line-height: 1;
            white-space: nowrap;
        }
        .status-pill .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .status-pill-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .status-pill-success .dot {
            background-color: #10b981;
        }
        .status-pill-warning {
            background-color: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .status-pill-warning .dot {
            background-color: #f59e0b;
        }
        .status-pill-active {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .status-pill-active .dot {
            background-color: #22c55e;
        }
        .status-pill-inactive {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .status-pill-inactive .dot {
            background-color: #ef4444;
        }

        /* Reply Button Card */
        .btn-reply-card {
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: #0369a1;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            line-height: 1.2;
            text-decoration: none !important;
            width: 100%;
            max-width: 115px;
        }
        .btn-reply-card:hover {
            background: #0284c7;
            color: #ffffff !important;
            border-color: #0284c7;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
            transform: translateY(-1px);
        }
        .btn-reply-card .reply-time {
            font-size: 10px;
            font-weight: 500;
            opacity: 0.85;
        }

        /* Actions */
        .table-action-btn {
            width: 31px;
            height: 31px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 12.5px;
            transition: all 0.15s ease;
            cursor: pointer;
            text-decoration: none !important;
        }
        .table-action-edit {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }
        .table-action-edit:hover {
            background-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);
        }
        .table-action-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .table-action-delete:hover {
            background-color: #dc2626;
            color: #ffffff;
            box-shadow: 0 3px 8px rgba(220, 38, 38, 0.25);
        }

        /* DataTables Custom Controls */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 13px;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 13px;
            margin-left: 6px;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 15px !important;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="main-header">
        <?php include('logo.php'); ?>
        <?php include('topbar.php'); ?>
    </div>

    <?php include('sidebar.php'); ?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <!-- Page Title -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <div>
                        <h4 class="page-title font-weight-bold mb-1" style="color: #1e293b;">
                            <i class="fas fa-bell text-primary mr-2"></i> Common Notification Messages
                        </h4>
                        <div class="text-muted small">Manage broadcasts, particular driver notices, and customer replies</div>
                    </div>
                    <div class="mt-2 mt-sm-0">
                        <button type="button" class="btn btn-success shadow-sm font-weight-bold" data-toggle="modal" data-target="#addModal" style="border-radius: 8px;">
                            <i class="fas fa-plus mr-1"></i> Add New Notification
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card main-card">
                            <div class="card-body p-4">
                                
                                <!-- Quick Filter Stat Pills -->
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 pb-3 border-bottom" style="gap: 10px;">
                                    <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                        <span class="text-muted small font-weight-bold mr-1">QUICK VIEWS:</span>
                                        <a href="comman_notification_messages.php?reply_status=replied" class="btn btn-sm <?= ($replyFilter === 'replied') ? 'btn-info' : 'btn-outline-info'; ?>" style="border-radius: 20px; font-weight: 600;">
                                            <i class="fas fa-comments mr-1"></i> Replied Messages <span class="badge badge-light text-dark ml-1"><?= $totalRepliedInDb; ?></span>
                                        </a>
                                        <a href="comman_notification_messages.php?admin_read=unread" class="btn btn-sm <?= ($adminReadFilter === 'unread') ? 'btn-warning text-dark font-weight-bold' : 'btn-outline-warning text-dark'; ?>" style="border-radius: 20px; font-weight: 600;">
                                            <i class="fas fa-envelope mr-1"></i> Unread by Admin <span class="badge badge-light text-dark ml-1"><?= $totalUnreadAdminInDb; ?></span>
                                        </a>
                                        <a href="comman_notification_messages.php" class="btn btn-sm btn-outline-secondary" style="border-radius: 20px; font-weight: 600;">
                                            <i class="fas fa-list mr-1"></i> View All <span class="badge badge-light text-dark ml-1"><?= $totalAllInDb; ?></span>
                                        </a>
                                    </div>
                                    <div class="small text-muted font-weight-bold">
                                        Showing <strong class="text-dark"><?= $totalFiltered; ?></strong> of <?= $totalAllInDb; ?> messages
                                    </div>
                                </div>

                                <!-- Filter Section Toolbar -->
                                <div class="filter-card-modern mb-4">
                                    <form method="GET" action="" id="filterForm">
                                        <div class="row align-items-end">
                                            <!-- Reply Status Filter -->
                                            <div class="col-md-3 col-sm-6 mb-2">
                                                <label class="font-weight-bold text-muted small mb-1">Reply Status</label>
                                                <select name="reply_status" id="filter_reply_status" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    <option value="">All (Replied & Unreplied)</option>
                                                    <option value="replied" <?= ($replyFilter === 'replied') ? 'selected' : ''; ?>>💬 Replied Only (Has Replies)</option>
                                                    <option value="unreplied" <?= ($replyFilter === 'unreplied') ? 'selected' : ''; ?>>No Replies</option>
                                                </select>
                                            </div>

                                            <!-- Admin Read Filter -->
                                            <div class="col-md-2 col-sm-6 mb-2">
                                                <label class="font-weight-bold text-muted small mb-1">Admin Read</label>
                                                <select name="admin_read" id="filter_admin_read" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    <option value="">All (Read & Unread)</option>
                                                    <option value="unread" <?= ($adminReadFilter === 'unread') ? 'selected' : ''; ?>>✉️ Unread by Admin</option>
                                                    <option value="read" <?= ($adminReadFilter === 'read') ? 'selected' : ''; ?>>✓ Read by Admin</option>
                                                </select>
                                            </div>

                                            <!-- Message Type Filter -->
                                            <div class="col-md-2 col-sm-6 mb-2">
                                                <label class="font-weight-bold text-muted small mb-1">Message Type</label>
                                                <select name="message_type" id="filter_message_type" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    <option value="">All Types</option>
                                                    <option value="common" <?= ($messageTypeFilter === 'common') ? 'selected' : ''; ?>>Common (All)</option>
                                                    <option value="particular" <?= ($messageTypeFilter === 'particular') ? 'selected' : ''; ?>>Particular (Single)</option>
                                                </select>
                                            </div>

                                            <!-- Status Filter -->
                                            <div class="col-md-2 col-sm-6 mb-2">
                                                <label class="font-weight-bold text-muted small mb-1">Status</label>
                                                <select name="status" id="filter_status" class="form-control form-control-sm" style="border-radius: 6px;">
                                                    <option value="">All Status</option>
                                                    <option value="1" <?= ($statusFilter === '1') ? 'selected' : ''; ?>>Active</option>
                                                    <option value="0" <?= ($statusFilter === '0') ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
                                            </div>

                                            <!-- Search Input -->
                                            <div class="col-md-3 col-sm-12 mb-2">
                                                <label class="font-weight-bold text-muted small mb-1">Search</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="search" id="filter_search" class="form-control" placeholder="Search message, customer..." value="<?= htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>" style="border-radius: 6px 0 0 6px;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary btn-sm" type="submit" title="Search" style="border-radius: 0 6px 6px 0;">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Action Buttons & Badges -->
                                            <div class="col-12 mt-2 d-flex align-items-center justify-content-between flex-wrap" style="gap: 8px;">
                                                <div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
                                                    <button type="submit" class="btn btn-primary btn-sm px-3 font-weight-bold" style="border-radius: 6px;">
                                                        <i class="fas fa-filter mr-1"></i> Apply Filters
                                                    </button>
                                                    <a href="comman_notification_messages.php" class="btn btn-outline-secondary btn-sm px-3" style="border-radius: 6px;">
                                                        <i class="fas fa-undo mr-1"></i> Reset
                                                    </a>
                                                    <?php if (!empty($activeFilterLabels)): ?>
                                                        <span class="badge badge-info ml-2 py-1 px-2 font-weight-normal" style="font-size: 12px; border-radius: 6px;">
                                                            Active: <?= implode(' &bull; ', $activeFilterLabels); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="small text-muted font-weight-bold">
                                                    <?php if ($repliedInViewCount > 0): ?>
                                                        <span class="text-info mr-2"><i class="fas fa-comments"></i> <?= $repliedInViewCount; ?> Replied</span>
                                                    <?php endif; ?>
                                                    <?php if ($unreadInViewCount > 0): ?>
                                                        <span class="text-danger"><i class="fas fa-envelope"></i> <?= $unreadInViewCount; ?> Unread</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Main DataTable -->
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="table">
                                        <thead>
                                            <tr>
                                                <th class="col-sno">S.No</th>
                                                <th class="col-type">Type</th>
                                                <th class="col-msg">Message Content</th>
                                                <th class="col-customer">Customer</th>
                                                <th class="col-replies">Replies</th>
                                                <th class="col-read">Customer Read</th>
                                                <th class="col-read">Admin Read</th>
                                                <th class="col-status">Status</th>
                                                <th class="col-action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $modalsHtml = '';
                                            foreach ($rows as $row) {
                                                $hasReplies = ($row->reply_count > 0);
                                                $admin_read = isset($row->admin_read) ? (int)$row->admin_read : 0;
                                            ?>
                                            <tr class="<?= $hasReplies ? 'tr-replied' : ''; ?>">
                                                <td class="col-sno"><?= $i++; ?></td>
                                                <td class="col-type">
                                                    <span class="badge-type badge-type-<?= $row->message_type; ?>">
                                                        <i class="<?= ($row->message_type == 'particular') ? 'fas fa-user' : 'fas fa-bullhorn'; ?> mr-1" style="font-size: 10px;"></i>
                                                        <?= ucfirst($row->message_type); ?>
                                                    </span>
                                                    <?php if ($hasReplies): ?>
                                                        <br><span class="badge-replied-tag" title="Customer has replied">
                                                            <i class="fas fa-reply mr-1"></i>Replied
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-msg">
                                                    <div class="msg-content-wrapper">
                                                        <div class="msg-text-display">
                                                            <?= nl2br(htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8')); ?>
                                                        </div>
                                                        <div class="msg-timestamp">
                                                            <i class="far fa-clock mr-1 text-muted"></i><?= date('d-M-Y, h:i A', strtotime($row->created_at)); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-customer">
                                                    <?php if ($row->message_type == 'particular'): ?>
                                                        <div class="customer-name font-weight-bold text-dark" style="font-size: 13px;">
                                                            <?= htmlspecialchars($row->customer_name ? $row->customer_name : 'Customer', ENT_QUOTES, 'UTF-8'); ?>
                                                        </div>
                                                        <?php if (!empty($row->customer_phone)): ?>
                                                            <div class="customer-phone text-muted mt-1" style="font-size: 11.5px;">
                                                                <i class="fas fa-phone-alt text-primary mr-1" style="font-size: 10px;"></i><?= htmlspecialchars($row->customer_phone, ENT_QUOTES, 'UTF-8'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="badge-type badge-type-common"><i class="fas fa-users mr-1"></i>All Customers</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-replies" data-order="<?= (int)$row->reply_count; ?>">
                                                    <?php if ($row->reply_count > 0): ?>
                                                        <button type="button" class="btn-reply-card shadow-sm" data-toggle="modal" data-target="#repliesModal<?= $row->notification_id; ?>">
                                                            <span><i class="fas fa-comments mr-1"></i><strong><?= $row->reply_count; ?> <?= ($row->reply_count > 1) ? 'Replies' : 'Reply'; ?></strong></span>
                                                            <?php if (!empty($row->latest_reply_at)): ?>
                                                                <span class="reply-time"><i class="far fa-clock"></i> <?= date('d-M h:i A', strtotime($row->latest_reply_at)); ?></span>
                                                            <?php endif; ?>
                                                        </button>
                                                    <?php else: ?>
                                                        <span class="text-muted small" style="opacity: 0.65;"><i class="fas fa-minus mr-1"></i>None</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-read" data-order="<?= (int)$row->is_read; ?>">
                                                    <?php if (isset($row->is_read) && $row->is_read == 1): ?>
                                                        <span class="status-pill status-pill-success"><span class="dot"></span> Read</span>
                                                    <?php else: ?>
                                                        <span class="status-pill status-pill-warning"><span class="dot"></span> Unread</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-read" id="admin_read_badge_<?= $row->notification_id; ?>" data-order="<?= $admin_read; ?>">
                                                    <?php if ($admin_read == 1): ?>
                                                        <span class="status-pill status-pill-success"><span class="dot"></span> Read</span>
                                                    <?php else: ?>
                                                        <span class="status-pill status-pill-warning"><span class="dot"></span> Unread</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-status" data-order="<?= (int)$row->status; ?>">
                                                    <?php if ($row->status == 1): ?>
                                                        <span class="status-pill status-pill-active"><span class="dot"></span> Active</span>
                                                    <?php else: ?>
                                                        <span class="status-pill status-pill-inactive"><span class="dot"></span> Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="col-action">
                                                    <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                                                        <button class="table-action-btn table-action-edit" data-toggle="modal" data-target="#editModal<?= $row->notification_id; ?>" title="Edit Notification">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <a href="Function/delete_notification.php?id=<?= $row->notification_id; ?>" class="table-action-btn table-action-delete" onclick="return confirm('Are you sure you want to delete this notification?');" title="Delete Notification">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                // Prepare Modals HTML outside table
                                                ob_start();
                                            ?>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?= $row->notification_id; ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
                                                        <form action="Function/edit_notification.php" method="POST" accept-charset="UTF-8">
                                                            <div class="modal-header text-white" style="background: linear-gradient(135deg, #1572e8, #0056b3);">
                                                                <h5 class="modal-title font-weight-bold">
                                                                    <i class="fas fa-pen mr-2"></i> Edit Notification #<?= $row->notification_id; ?>
                                                                </h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 0.9;"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body p-4" style="background-color: #fcfcfc;">
                                                                <input type="hidden" name="notification_id" value="<?= $row->notification_id; ?>">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label class="font-weight-bold text-dark">Message Type</label>
                                                                        <select class="form-control" name="message_type" onchange="toggleEditFields(<?= $row->notification_id; ?>)" style="border-radius: 8px;">
                                                                            <option value="common" <?= ($row->message_type == 'common')?'selected':''; ?>>Common (All Customers)</option>
                                                                            <option value="particular" <?= ($row->message_type == 'particular')?'selected':''; ?>>Particular (Single Customer)</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group col-md-6">
                                                                        <label class="font-weight-bold text-dark">Status</label>
                                                                        <select class="form-control" name="status" style="border-radius: 8px;">
                                                                            <option value="1" <?= ($row->status == 1)?'selected':''; ?>>Active</option>
                                                                            <option value="0" <?= ($row->status == 0)?'selected':''; ?>>Inactive</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <label class="font-weight-bold text-dark">Message Content</label>
                                                                        <textarea class="form-control" name="message_text" rows="4" style="border-radius: 8px; font-size: 14.5px; line-height: 1.5;" required><?= htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                                                    </div>

                                                                    <div id="editCustomerFields<?= $row->notification_id; ?>" style="display:<?= ($row->message_type == 'particular')?'flex':'none'; ?>;" class="row col-12">
                                                                        <div class="form-group col-md-6">
                                                                            <label class="font-weight-bold text-dark">Customer Name</label>
                                                                            <input type="text" class="form-control" name="customer_name" value="<?= htmlspecialchars($row->customer_name ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="border-radius: 8px;">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label class="font-weight-bold text-dark">Customer Phone No</label>
                                                                            <input type="text" class="form-control" name="customer_phone" value="<?= htmlspecialchars($row->customer_phone ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="border-radius: 8px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light border-top">
                                                                <button type="button" class="btn btn-secondary px-3" data-dismiss="modal" style="border-radius: 6px;">Close</button>
                                                                <button class="btn btn-success px-4 font-weight-bold" type="submit" name="update_notification" style="border-radius: 6px;">Update Notification</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Replies Modal -->
                                            <div class="modal fade" id="repliesModal<?= $row->notification_id; ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
                                                        <div class="modal-header text-white" style="background: linear-gradient(135deg, #0284c7, #0369a1);">
                                                            <h5 class="modal-title font-weight-bold">
                                                                <i class="fas fa-comments mr-2"></i> Replies for Notification #<?= $row->notification_id; ?>
                                                            </h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 0.9;"><span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body p-4" data-notification-id="<?= $row->notification_id; ?>" style="background-color: #f8fafc;">
                                                            <div class="mb-3">
                                                                <label class="font-weight-bold text-muted small mb-1">ORIGINAL NOTIFICATION</label>
                                                                <div class="border rounded p-3 bg-white shadow-sm" style="border-left: 4px solid #0284c7 !important; border-radius: 8px;">
                                                                    <div class="d-flex justify-content-between text-muted small mb-1">
                                                                        <span><i class="fas fa-tag mr-1 text-primary"></i> <?= ucfirst($row->message_type); ?></span>
                                                                        <span><i class="far fa-clock mr-1"></i> <?= date('d-M-Y, h:i A', strtotime($row->created_at)); ?></span>
                                                                    </div>
                                                                    <div style="font-size: 14px; white-space: pre-wrap; color: #1e293b;"><?= htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8'); ?></div>
                                                                </div>
                                                            </div>
                                                            
                                                            <label class="font-weight-bold text-muted small mb-1">
                                                                CUSTOMER REPLIES (<?= $row->reply_count; ?>)
                                                            </label>
                                                            <?php
                                                            $replies_query = mysqli_query($config, "
                                                                SELECT nr.*, 
                                                                       COALESCE(NULLIF(TRIM(cm.Customer_Name), ''), NULLIF(TRIM(cp.driver_name), ''), 'Customer') AS driver_name, 
                                                                       COALESCE(NULLIF(TRIM(cm.Customer_Phone_No), ''), NULLIF(TRIM(cp.phone_no), '')) AS phone_no 
                                                                FROM notification_replies nr
                                                                LEFT JOIN customer_master cm ON nr.customer_id = cm.Customer_Id
                                                                LEFT JOIN (SELECT customer_id, MAX(driver_name) AS driver_name, MAX(phone_no) AS phone_no FROM create_post GROUP BY customer_id) cp ON nr.customer_id = cp.customer_id
                                                                WHERE nr.notification_id = '{$row->notification_id}'
                                                                ORDER BY nr.created_at DESC
                                                            ");
                                                            
                                                            if ($replies_query && mysqli_num_rows($replies_query) > 0) {
                                                                while ($reply = mysqli_fetch_object($replies_query)) {
                                                            ?>
                                                                <div class="border rounded p-3 mb-2 bg-white shadow-sm" style="border-left: 4px solid #10b981 !important; border-radius: 8px;">
                                                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                                        <div>
                                                                            <strong class="text-dark"><i class="fas fa-user-circle mr-1 text-primary"></i> <?= htmlspecialchars($reply->driver_name ? $reply->driver_name : 'Customer', ENT_QUOTES, 'UTF-8'); ?></strong>
                                                                            <?php if (!empty($reply->phone_no)) { ?>
                                                                                <span class="badge badge-light border ml-1 font-weight-normal"><i class="fas fa-phone mr-1 text-success"></i> <?= htmlspecialchars($reply->phone_no, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <small class="text-muted"><i class="far fa-clock mr-1"></i> <?= date('d-M-Y, h:i A', strtotime($reply->created_at)); ?></small>
                                                                    </div>
                                                                    <p class="mt-2 mb-0" style="font-size: 14px; white-space: pre-wrap; color: #334155; line-height: 1.5;"><?= htmlspecialchars($reply->reply_message, ENT_QUOTES, 'UTF-8'); ?></p>
                                                                </div>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo '<p class="text-muted small">No replies yet.</p>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer bg-light border-top">
                                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal" style="border-radius: 6px;">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                                $modalsHtml .= ob_get_clean();
                                            } // end foreach
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Render Modals outside table for clean DOM -->
                                <?= $modalsHtml; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
                    <form action="Function/add_notification.php" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="modal-header text-white" style="background: linear-gradient(135deg, #28a745, #1e7e34);">
                            <h5 class="modal-title font-weight-bold" id="addModalLabel">
                                <i class="fas fa-plus-circle mr-2"></i> Add New Notification
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 0.9;"><span>&times;</span></button>
                        </div>
                        <div class="modal-body p-4" style="background-color: #fcfcfc;">
                            <div class="row">
                                <!-- Message Type -->
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold text-dark">Message Type</label>
                                    <select class="form-control" name="message_type" id="message_type" onchange="toggleCustomerFields()" style="border-radius: 8px;">
                                        <option value="common" selected>Common (All Customers)</option>
                                        <option value="particular">Particular (Single Customer)</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold text-dark">Status</label>
                                    <select class="form-control" name="status" style="border-radius: 8px;">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <!-- Message Text -->
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold text-dark">Message Content (Supports Tamil & English)</label>
                                    <textarea class="form-control" name="message_text" rows="4" placeholder="Type notification message here..." style="border-radius: 8px; font-size: 14.5px; line-height: 1.5;" required></textarea>
                                </div>

                                <!-- Customer fields (hidden by default) -->
                                <div id="customerFields" style="display:none;" class="row col-12">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold text-dark">Customer Name</label>
                                        <input type="text" class="form-control" id="Add_driver_name" name="customer_name" onkeyup="cum(this.value)" placeholder="Search customer name..." style="border-radius: 8px;">
                                        <div id="serach_result">
                                            <ul class="subnav sug-list-color" id="serach_result1"></ul>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold text-dark">Customer Phone No</label>
                                        <input type="hidden" id="customerid" name="customerid">
                                        <input type="number" class="form-control" id="phone_no" name="customer_phone" onkeypress="if(this.value.length==10) return false;" placeholder="10 digit phone number" style="border-radius: 8px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light border-top">
                            <button type="button" class="btn btn-secondary px-3" data-dismiss="modal" style="border-radius: 6px;">Close</button>
                            <button class="btn btn-success px-4 font-weight-bold" type="submit" name="add_notification" style="border-radius: 6px;">Create Notification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
</div>

<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script src="../assets/js/atlantis.min.js"></script>
<script>
$(document).ready(function() {
    $('#basic-datatables').DataTable({
        "order": [], // Preserves server-side query ordering (Replied messages at top)
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "autoWidth": false,
        "language": {
            "search": "Quick search in table:"
        }
    });

    // Auto-submit filter form on dropdown change
    $('#filter_reply_status, #filter_admin_read, #filter_message_type, #filter_status').on('change', function() {
        $('#filterForm').submit();
    });
});

function toggleCustomerFields() {
    var type = document.getElementById('message_type').value;
    document.getElementById('customerFields').style.display = (type === 'particular') ? 'flex' : 'none';
}

function toggleEditFields(id) {
    var type = $('select[name="message_type"]', '#editModal' + id).val();
    $('#editCustomerFields' + id).css('display', (type === 'particular') ? 'flex' : 'none');
}

function cum(customerid) {
    if (customerid != '') {
        $.ajax({
            type: "POST",
            url: 'customer_search.php',
            dataType: 'html',
            data: { customerid: customerid },
            success: function(data) {      
                $('#serach_result1').html(data);
            }
        });
    } else {
        $('#serach_result1').html('');
    }
}

function serach_result(customerid, name, phone_no) {
    $('#Add_driver_name').val(name);
    $('#customerid').val(customerid);
    $('#serach_result1').html('');
    $('#phone_no').val(phone_no);
}

// Function to mark notification as read
function markAsRead(notification_id) {
    $.ajax({
        type: "POST",
        url: 'Function/update_read_status.php',
        data: { 
            notification_id: notification_id,
            is_read: 1
        },
        success: function(data) {
            location.reload();
        },
        error: function() {
            alert('Error updating read status');
        }
    });
}

// Function to mark notification as unread
function markAsUnread(notification_id) {
    $.ajax({
        type: "POST",
        url: 'Function/update_read_status.php',
        data: { 
            notification_id: notification_id,
            is_read: 0
        },
        success: function(data) {
            location.reload();
        },
        error: function() {
            alert('Error updating read status');
        }
    });
}

// Mark as admin read when replies modal is opened
$(document).on('shown.bs.modal', '[id^="repliesModal"]', function () {
    var modal = $(this);
    var notificationId = modal.find('.modal-body').data('notification-id');
    
    if (notificationId) {
        $.ajax({
            url: 'Function/mark_admin_read.php',
            type: 'POST',
            data: {
                notification_id: notificationId,
                admin_read: 1
            },
            success: function(response) {
                try {
                    var result = typeof response === 'string' ? JSON.parse(response) : response;
                    if (result && result.success) {
                        $('#admin_read_badge_' + notificationId).html('<span class="status-pill status-pill-success"><span class="dot"></span> Read</span>');
                    }
                } catch(e) {
                    $('#admin_read_badge_' + notificationId).html('<span class="status-pill status-pill-success"><span class="dot"></span> Read</span>');
                }
            },
            error: function() {
                console.error('Error marking notification as admin read');
            }
        });
    }
});
</script>
</body>
</html>
