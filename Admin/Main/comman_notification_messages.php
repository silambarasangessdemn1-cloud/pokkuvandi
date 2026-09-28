<?php include('../config/setup.php'); ?>

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
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.min.css']},
            active: function() { sessionStorage.fonts = true; }
        });
    </script>
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
                <div class="page-header">
                    <h4 class="page-title">Common Notification Messages</h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                                        <i class="fas fa-plus"></i> Add New Notification
                                    </button>
                                </center>
                                <div class="table-responsive mt-3">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Message Type</th>
                                                <th>Message</th>
                                                <th>Customer</th>
                                                <th>Replies</th>
                                                <th>Customer Read</th>
                                                <th>Admin Read</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            $query = mysqli_query($config, "SELECT * FROM comman_notification_messages ORDER BY notification_id DESC");
                                            while($row = mysqli_fetch_object($query)) {
                                            ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= ucfirst($row->message_type); ?></td>
                                                <td><?= htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= ($row->message_type == 'particular') ? $row->customer_name . ' (' . $row->customer_phone . ')' : 'All Customers'; ?></td>
                                                <td>
                                                    <?php
                                                    // Count replies for this notification
                                                    $reply_count_query = mysqli_query($config, "SELECT COUNT(*) as count FROM notification_replies WHERE notification_id = '{$row->notification_id}'");
                                                    $reply_count = mysqli_fetch_object($reply_count_query)->count;
                                                    
                                                    if ($reply_count > 0) {
                                                        echo '<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#repliesModal' . $row->notification_id . '">';
                                                        echo '<i class="fas fa-comments"></i> ' . $reply_count . ' Reply';
                                                        echo ($reply_count > 1) ? 'ies' : '';
                                                        echo '</button>';
                                                    } else {
                                                        echo '<span class="text-muted">No replies</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Check if notification is read by customer
                                                    if (isset($row->is_read) && $row->is_read == 1) {
                                                        echo '<span class="badge badge-success"><i class="fas fa-check"></i> Read</span>';
                                                    } else {
                                                        echo '<span class="badge badge-warning"><i class="fas fa-envelope"></i> Unread</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td id="admin_read_badge_<?= $row->notification_id; ?>">
                                                    <?php
                                                    // Check if notification is read by admin
                                                    $admin_read = isset($row->admin_read) ? $row->admin_read : 0;
                                                    if ($admin_read == 1) {
                                                        echo '<span class="badge badge-success"><i class="fas fa-check"></i> Read</span>';
                                                    } else {
                                                        echo '<span class="badge badge-warning"><i class="fas fa-envelope"></i> Unread</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= ($row->status == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                                <td>
                                                   
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $row->notification_id; ?>"><i class="fas fa-pencil-alt"></i></button>
                                                    <a href="Function/delete_notification.php?id=<?= $row->notification_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?');"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                              <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?= $row->notification_id; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="Function/edit_notification.php" method="POST" accept-charset="UTF-8">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Notification</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="notification_id" value="<?= $row->notification_id; ?>">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Message Type</label>
                                                                <select class="form-control" name="message_type" onchange="toggleEditFields(<?= $row->notification_id; ?>)">
                                                                    <option value="common" <?= ($row->message_type == 'common')?'selected':''; ?>>Common (All)</option>
                                                                    <option value="particular" <?= ($row->message_type == 'particular')?'selected':''; ?>>Particular (Single Customer)</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Message Content</label>
                                                                <textarea class="form-control" name="message_text" rows="3" required><?= htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                                            </div>

                                                            <div id="editCustomerFields<?= $row->notification_id; ?>" style="display:<?= ($row->message_type == 'particular')?'flex':'none'; ?>;" class="row col-12">
                                                                <div class="form-group col-md-6">
                                                                    <label>Customer Name</label>
                                                                    <input type="text" class="form-control" name="customer_name" value="<?= $row->customer_name; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Customer Phone No</label>
                                                                    <input type="text" class="form-control" name="customer_phone" value="<?= $row->customer_phone; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label>Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="1" <?= ($row->status == 1)?'selected':''; ?>>Active</option>
                                                                    <option value="0" <?= ($row->status == 0)?'selected':''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit" name="update_notification">Update</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Replies Modal -->
                                    <div class="modal fade" id="repliesModal<?= $row->notification_id; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Replies for Notification #<?= $row->notification_id; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body" data-notification-id="<?= $row->notification_id; ?>">
                                                    <div class="mb-3">
                                                        <strong>Original Message:</strong><br>
                                                        <div class="border p-2 bg-light">
                                                            <?= htmlspecialchars($row->message_text, ENT_QUOTES, 'UTF-8'); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <h6>Customer Replies:</h6>
                                                    <?php
                                                    $replies_query = mysqli_query($config, "
                                                        SELECT nr.*, cp.driver_name, cp.phone_no 
                                                        FROM notification_replies nr
                                                        LEFT JOIN create_post cp ON nr.customer_id = cp.customer_id
                                                        WHERE nr.notification_id = '{$row->notification_id}'
                                                        ORDER BY nr.created_at DESC
                                                    ");
                                                    
                                                    if (mysqli_num_rows($replies_query) > 0) {
                                                        while ($reply = mysqli_fetch_object($replies_query)) {
                                                    ?>
                                                        <div class="border rounded p-3 mb-2 bg-white">
                                                            <div class="d-flex justify-content-between">
                                                                <strong><?= $reply->driver_name ? $reply->driver_name : 'Customer'; ?></strong>
                                                                <small class="text-muted"><?= date('d-M-Y h:i A', strtotime($reply->created_at)); ?></small>
                                                            </div>
                                                            <p class="mt-2 mb-0"><?= htmlspecialchars($reply->reply_message, ENT_QUOTES, 'UTF-8'); ?></p>
                                                            <?php if ($reply->phone_no) { ?>
                                                                <small class="text-muted">Phone: <?= $reply->phone_no; ?></small>
                                                            <?php } ?>
                                                        </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo '<p class="text-muted">No replies yet.</p>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="Function/add_notification.php" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add New Notification</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Message Type -->
                                <div class="form-group col-md-6">
                                    <label>Message Type</label>
                                    <select class="form-control" name="message_type" id="message_type" onchange="toggleCustomerFields()">
                                        <option value="common" selected>Common (All)</option>
                                        <option value="particular">Particular (Single Customer)</option>
                                    </select>
                                </div>

                                <!-- Tamil-supported Message -->
                                <div class="form-group col-md-12">
                                    <label>Message Content (Supports Tamil)</label>
                                    <textarea class="form-control" name="message_text" rows="3" required></textarea>
                                </div>

                                <!-- Customer fields (hidden by default) -->
                                <div id="customerFields" style="display:none;" class="row col-12">
                                    <div class="form-group col-md-6">
                                        <label>Customer Name</label>
                                        <input type="text" class="form-control" id="Add_driver_name" name="customer_name" onkeyup="cum(this.value)">
                                        <div id="serach_result">
                                            <ul class="subnav sug-list-color" id="serach_result1"></ul>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Customer Phone No</label>
                                        <input type="hidden" id="customerid" name="customerid">
                                        <input type="number" class="form-control" id="phone_no" name="customer_phone" onkeypress="if(this.value.length==10) return false;">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="add_notification">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $('#basic-datatables').DataTable();
});

function toggleCustomerFields() {
    var type = document.getElementById('message_type').value;
    document.getElementById('customerFields').style.display = (type === 'particular') ? 'flex' : 'none';
}
function cum(customerid)
                 {
              
                    if (customerid != '') {
                        $.ajax({
                            type: "POST",
                            url: 'customer_search.php',
                            dataType: 'html',
                            data: {
                            customerid: customerid
                            },
                            success: function(data) {      
                                //alert();                    
                                $('#serach_result1').html(data);

                            }
                        });
                    } else {
                        $('#serach_result1').html('');
                    }
                 }
                 function serach_result(customerid, name, phone_no)
                 {
                    //alert(name);
                    $('#Add_driver_name').val(name);
                    $('#customerid').val(customerid);
                    $('#serach_result1').html('');
                    $('#phone_no').val(phone_no);
                    // $('#address').val(address);  
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
                // This handles all reply modals dynamically
                $(document).on('shown.bs.modal', '[id^="repliesModal"]', function () {
                    var modal = $(this);
                    var notificationId = modal.find('.modal-body').data('notification-id');
                    
                    if (notificationId) {
                        // Mark notification as admin read
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
                                        // Update the admin read badge in the table
                                        $('#admin_read_badge_' + notificationId).html('<span class="badge badge-success"><i class="fas fa-check"></i> Read</span>');
                                    }
                                } catch(e) {
                                    // If response is not JSON, still update the badge
                                    $('#admin_read_badge_' + notificationId).html('<span class="badge badge-success"><i class="fas fa-check"></i> Read</span>');
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
