<?php
session_start();
		if(!isset($_SESSION['admin'])){
			header("Location: index.php");

		}
 

?>
<!DOCTYPE html>
<title>SMS Server Master Admin</title>
<?php
$page = 'Change Password';
include("header.php");

if(isset($_POST['changepw'])){
	$curpass = trim($_POST['curpass']);
	$curpasshash = base64_encode($curpass.$_SESSION['admin']);
	$check = mysqli_query($connect,"SELECT * FROM admin WHERE email = '$_SESSION[admin]' and password = '$curpasshash'");
			
			
			if(mysqli_num_rows($check)>0){
				
				if (trim($_POST['newpass'])==trim($_POST['conpass'])){
					$newpass = base64_encode(trim($_POST['newpass']).$_SESSION['admin']);
					$updatepw = mysqli_query($connect, "UPDATE admin SET password = '$newpass' WHERE email = '$_SESSION[admin]'") or die(mysqli_error($connect));
					
					echo "<script>alert('Password Has been changed successfully')</script>";
					
				}
				else echo "<script>alert('Confirm Password Doesn\'t match with new password')</script>";
	
}
else echo "<script>alert('Old Password Doesn\'t Match')</script>";
}
?>





<html>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include('menu.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Change Password</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Change Password</li>
            </ol>
        </section>

        <!--//////////////////////// Main content ///////////////////////////////-->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12">
                    <div class="box-body catTable">
                        <h3 class="box-title"><center>Change your password below</center></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_message"></div>
                                <form method="POST" action="change-pw.php">
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Password:</label>

                                                <div class="input-group col-md-12">
                                                 
                                                    <input type="text" required="" class="form-control pull-right"  autocomplete="off" name="curpass">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group ">
                                                <label>New Password:</label>

                                                <div class="input-group col-md-12">
                                                 
                                                    <input type="text" required="" class="form-control"  autocomplete="off" name="newpass" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group ">
                                                <label>Confirm Password:</label>

                                                <div class="input-group col-md-12">
                                                 
                                                    <input type="text" required="" class="form-control" autocomplete="off" name="conpass" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="col-md-12 pull-right">
                                            <button type="submit" class="btn btn-danger pull-right" name="changepw">Change Password</button>
                                        </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

               
                <!-- /.modal -->

            </div><!-- /.row -->
            <!-- Main row -->


        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="http://sparkitbd.com">Spark IT</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->

    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
</body>
</html>
