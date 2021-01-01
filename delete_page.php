<?php
session_start();
		if(!isset($_SESSION['admin'])){
			header("Location: index.php");

		}
 

?>
<!DOCTYPE html>
<title>SMS Server Master Admin</title>
<?php
$page = 'Delete Page';
include("header.php");
require_once("functions.php");
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
                <small>Delete Records</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Delete Records</li>
            </ol>
        </section>

        <!--//////////////////////// Main content ///////////////////////////////-->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12">
                    <div class="box-body catTable">
                        <h3 class="box-title"><center>Delete Records By Date Range</center></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_message"></div>
                                <form method="POST" action="delete.php" id="delete-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Date range:</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="reservation" autocomplete="off" name="daterange" value="" readonly>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-md-12 pull-right">
                                            <button type="submit" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-default" id="delete-button">Delete Records</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete record from <span id="start"></span> to <span id="end"></span>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No, keep it</button>
                                <button type="button" class="btn btn-danger" id="delete-confirm">Yes, delete it</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
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
<script>
    //Date range picker
    $('#reservation').daterangepicker()




    $('#delete-button').on('click', function(e){
        e.preventDefault();
        var date = $("#reservation").val();
        if(date == ''){
            alert('Date field is required.');
            return false;
        }else{
            var startDate =  $("#reservation").data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDate =  $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
            $('#start').text(startDate);
            $('#end').text(endDate);
            if(startDate !== null && endDate !== null){
                $('#delete-confirm').on('click', function(){
                    $.ajax({
                        url:"delete.php",
                        method:"POST",
                        data:{startDate:startDate, endDate:endDate},
                        success:function(data)
                        {
                            $('#modal-default').on('hidden.bs.modal', function () {
                                $("#delete-form").find('form').trigger('reset');
                            });
                            $('#modal-default').modal('toggle');
                            $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        }
                    });
                })
            }
        }
    })

</script>
</body>
</html>
