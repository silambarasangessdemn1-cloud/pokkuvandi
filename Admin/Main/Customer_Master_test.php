<?php include('../config/setup.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <!-- Include CSS for DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include Bootstrap (optional for styling) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0tMliWOMaxB7vFq5tDr67/jvvnVksdXl2iLg9G44P2Ewz4b8" crossorigin="anonymous">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyG94J6RbKfdbFv+9eOUh7OW7Xg6h8hI2BwKC1kJ" crossorigin="anonymous"></script>

<!-- Popper.js (required for Bootstrap modals) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9gVhPPLpmDLbws1hA5C7z3Vj2OXpPnn3hM0Q9D1LpaZtCrZn2qD6GfzggbFh5a7b" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0tMliWOMaxB7vFq5tDr67/jvvnVksdXl2iLg9G44P2Ewz4b8" crossorigin="anonymous"></script>

</head>

<body>
        <h2 class="mb-4">Customer List</h2>
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer Name</th>
                        <th>Father Name</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Area</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Register Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be filled by DataTables via AJAX -->
                </tbody>
            </table>
        </div>

    <div class="modal fade" id="editModal_<?php echo $row['Customer_Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="Function/customer_edit.php" method="post">
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="hidden" class="form-control" name="custom_id" value="<?php echo $row['Customer_Id']; ?>">
                        <input type="text" class="form-control" name="customer_name" value="<?php echo $row['Customer_Name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_name">Customer Father's Name</label>
                        <input type="text" class="form-control" name="father_name" value="<?php echo $row['Customer_Fathername']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" class="form-control" name="dob" value="<?php echo $row['Customer_DOB']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $row['Customer_Address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Phone No</label>
                        <input type="text" class="form-control" name="phone_no" value="<?php echo $row['Customer_Phone_No']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $row['Customer_Mail_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Customer Status</label>
                        <select class="form-control" name="status">
                            <option value="1" <?php if ($row['Status'] == 1) echo 'selected'; ?>>Active</option>
                            <option value="0" <?php if ($row['Status'] == 0) echo 'selected'; ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="customer_alter">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Include jQuery (required for DataTables and AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Include Bootstrap JS (optional for styling) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with server-side processing
            $('#basic-datatables').DataTable({
                "processing": true,   // Show processing indicator
                "serverSide": true,   // Enable server-side processing
                "ajax": {
                    "url": "data-fetch.php", // The PHP file that processes the request (not same page)
                    // Current page URL (same page for processing)
                    "type": "GET",       // Using GET method
                    "data": function(d) {
                        // Send necessary parameters to the server (pagination, search, sorting)
                        return $.extend({}, d, {
                            "search[value]": $('#basic-datatables_filter input').val(),
                            "draw": d.draw
                        });
                    }
                },
                "pageLength": 10,     // Default number of records per page
                "lengthChange": false, // Disable change length option
                "ordering": true,     // Enable column ordering
                "order": [[1, 'asc']], // Default sort by first column (Customer Name)
                "columns": [
                    { "data": "Customer_Id" },
                    { "data": "Customer_Name" },
                    { "data": "Customer_Fathername" },
                    { "data": "Customer_DOB" },
                    { "data": "Customer_Address" },
                    { "data": "City" },
                    { "data": "Area" },
                    { "data": "Phone_No" },
                    { "data": "Email" },
                    { "data": "Password" },
                    { "data": "Register_Date" },
                    { "data": "Status" },
                    { "data": "Action" }  // Action column
                ]
            });
        });
    </script>
</body>
</html>

