<?php include('../config/setup.php'); ?>

<?php

if (isset($_POST['edit'])) {

    $sql = "UPDATE biding_vender SET status='" . $_POST['status'] . "',topupamount=topupamount+'" . $_POST['topupamount'] . "' WHERE vender_id='" . $_POST['id'] . "'";
    mysqli_query($config, $sql);
} 
if (isset($_GET['did'])) {

    $sql="delete from biding_vender where vender_id='".$_GET['did']."'";
    mysqli_query($config, $sql);
}?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?php



            $leename = mysqli_query($config, "select Name,Name_status from lee_master");

            while ($lee = mysqli_fetch_array($leename)) {

                $namestatus = $lee[1];

                if ($namestatus == 1) {

                    echo  $lee[0];
                } else {

                    echo "Need Name";
                }
            }



            ?> </title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="icon" href="<?php



                            $inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");

                            while ($logo = mysqli_fetch_array($inro_logo)) {

                                $logstatus = $logo[1];

                                if ($logstatus == 1) {



                                    $ms = substr($logo[0], 3);

                                    echo  $ms;
                                } else {

                                    echo "../../photos/logo/no_logo.png";
                                }
                            }



                            ?>" type="image/x-icon" />



    <!-- Fonts and icons -->

    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>

    <script>
    WebFont.load({

        google: {
            "families": ["Lato:300,400,700,900"]
        },

        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['../assets/css/fonts.min.css']
        },

        active: function() {

            sessionStorage.fonts = true;

        }

    });
    </script>



    <!-- CSS Files -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->

    <link rel="stylesheet" href="../assets/css/demo.css">

</head>

<body>

    <div class="wrapper">

        <div class="main-header">

            <!-- Logo Header -->

            <?php include('logo.php'); ?>

            <!-- End Logo Header -->



            <!-- Navbar Header -->

            <?php include('topbar.php'); ?>

            <!-- End Navbar -->

        </div>

        <!-- Sidebar -->

        <?php include('sidebar.php'); ?>





        <div class="main-panel">

            <div class="content">

                <div class="page-inner">

                    <div class="page-header">

                        <h4 class="page-title"><?php echo $_GET['vname'] ?> </h4>



                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-header">
                                <center> <a href="bid_ref_ex.php?did=<?php echo $_GET['did'] ?>&vname=<?php echo $_GET['vname'] ?>" type="button" class="btn btn-primary" >
                                            Export csv
</a></center>
                                </div>

                                <div class="card-body">



                                    <div class="table-responsive">

                                        <table id="basic-datatables" class="display table table-striped table-hover">

                                            <thead>

                                                <tr>

                                                    <th>S.No</th>
                                                    <th>Date</th>

                                                    <th>Name</th>
                                                    <th>Top-up</th>



                                                    <th>Email</th>

                                                    <th>Phone</th>
                                                    <th>Company Name</th>
                                                    <th>GST</th>


                                                    <th>Ex Date</th>
                                                    




                                                    <th>Status</th>

                                                 


                                                </tr>

                                            </thead>



                                            <tbody>

                                                <?php

                                                $mc = 1;

                                                $main_cate = mysqli_query($config, "SELECT * FROM `biding_vender`INNER JOIN customer_master ON biding_vender.cust_id=customer_master.Customer_Id INNER JOIN biding_share_earn ON biding_share_earn.bid_vid=biding_vender.vender_id where cust_earn_id='".$_GET['did']."'");

                                                while ($macate = mysqli_fetch_object($main_cate)) {

                                                ?>





                                                <tr>

                                                    <td><?php echo $mc; ?></td>
                                                    <td><?php $macate->created_at;
                                                            $date = date_create($macate->created_at);
                                                            echo  date_format($date, "d/m/Y"); ?>
                                                    </td>
                                                    <td><?php echo $macate->Customer_Name; ?></td>
                                                    <td><?php echo $macate->topupamount; ?></td>
                                                    <td><?php echo $macate->Customer_Mail_id; ?></td>

                                                    <td><?php echo $macate->Customer_Phone_No; ?></td>

                                                    <td><?php echo $macate->c_name; ?></td>
                                                    <td><?php echo $macate->GST; ?></td>
                                                    <td><?php echo $macate->ex_date; ?></td>



                                                    <td><?php if ($macate->status == '1') { ?>

                                                        <label class="btn btn-success">Active</label>

                                                        <?php

                                                            } else {

                                                            ?>

                                                        <label class="btn btn-danger">In-Active</label>

                                                        <?php

                                                            }





                                                            ?>
                                                    </td>



                                        



                                                    <!-- Modal -->

                                                    





                                </tr>



                                <?php $mc++;
                                                } ?>



                                </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="modal fade" id="exampleModal0001" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Vender </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="ven_reg.php" method="GET">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Reg Customer Phone Number</label>
                            <input name="c_phone" required type="text" onkeyup="check_vender(this.value);"
                                class="form-control" id="exampleInputPassword1">
                            <small style="color: red;" id="error_c"></small>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Package</label>
                            <select name="pid" class="form-control" id="exampleFormControlSelect1">
                            <?php 
$main_cate=mysqli_query($config,"select * from biding_package");
while($macate=mysqli_fetch_object($main_cate))
{
?>
      <option value="<?php echo $macate->packid ?>"><?php echo $macate->title ?></option>
<?php } ?>
    </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form action="Function/p_cate.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">

                            <label for="email2">Notes</label>
                            <textarea class="form-control" id="email2" name="notes"></textarea>

                        </div>



                        <div class="form-group">

                            <label for="email2">Category Name</label>

                            <input type="text" class="form-control" id="email2" name="c_name"
                                placeholder="Enter Category Name">

                        </div>





                        <div class="form-group">

                            <button class="btn btn-success" type="submit" name="submit">Add New</button>

                        </div>





                    </form>



                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                </div>

            </div>

        </div>

    </div>



























    <?php include('footer.php'); ?>

    </div>





    <!-- End Custom template -->

    </div>

    <!--   Core JS Files   -->

    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>

    <script src="../assets/js/core/popper.min.js"></script>

    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->

    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>



    <!-- jQuery Scrollbar -->

    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->

    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Atlantis JS -->

    <script src="../assets/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->

    <script src="../assets/js/setting-demo2.js"></script>

    <script>
    $(document).ready(function() {

        $('#basic-datatables').DataTable({

        });









    });
    </script>

</body>

</html>

<script>
function check_vender(ph) {
    $.ajax({
        type: "POST",
        url: 'check_vender.php',
        data: {
            ph: ph
        }, // serializes the form's elements.
        success: function(data) {
            console.log(data);
            if (data == 1) {
                $('#error_c').html('Already exists Vender Acc');
            } else {
                $('#error_c').html('');
            }
        }
    });
}
</script>


<style>
.keys {
    border: 1px solid rgb(4, 170, 109);
    padding: 2%;
    margin: 1%;
    background: rgb(4, 170, 109);
    border-radius: 23px;
    color: white;
    font-weight: 700;
}
</style>