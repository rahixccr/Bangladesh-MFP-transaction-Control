<?php
 session_start();
		if(!isset($_SESSION['admin'])){
			header("Location: index.php");

		}
 

?>
<!DOCTYPE html>
<title>SMS Server Master Admin</title>
<?php
$page = 'Search Page';
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
                <small>Search Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Search Page</li>
            </ol>
        </section>

        <!--//////////////////////// Main content ///////////////////////////////-->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12">
                    <div class="box-body catTable">
                        <h3 class="box-title"><center>Search Records</center></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_message"></div>
                                <form method="POST" action="search_page.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Search:</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" name="term" id="term">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-md-12 pull-right">
                                            <input type="submit" class="btn btn-primary pull-right" id="submit" name="submit"  value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

            </div><!-- /.row -->
            <!-- Main row -->


        </section><!-- /.content -->
        <?php
        if (!empty($_REQUEST['term'])) {
        ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body catTable">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="search_result" class="table table-responsive table-striped table-bordered">
                                        <?php
                                        $term = mysqli_real_escape_string($connect, $_REQUEST['term']);
                                        $sql = "SELECT * FROM sms_in WHERE tag LIKE '%".$term."%' OR sms_text LIKE '%".$term."%' OR sender_number LIKE '%".$term."%' OR sent_dt LIKE '%".$term."%'";
                                        $r_query = mysqli_query($connect, $sql);
                                        if(mysqli_affected_rows($connect) > 0){
                                            while ($row = mysqli_fetch_array($r_query)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['tag']; ?></td>
                                                    <td><?php echo $row['sms_text']; ?></td>
                                                    <td><?php echo $row['sender_number']; ?></td>
                                                    <td><?php echo $row['sent_dt']; ?></td>
                                                    <?php if($row['approved'] == 0) { ?>
                                                        <td id="act-<?php echo $row['id']; ?>"><input type="checkbox" class="toggle-two" data-on="Approved" data-off="Pending" data-toggle="toggle" data-onstyle="info" data-offstyle="warning" data-id="<?php echo $row['id']; ?>" data-status="1" value="Active"></td>
                                                    <?php }else{ ?>
                                                        <td id="act-<?php echo $row['id']; ?>"><input type="checkbox" class="toggle-two" data-on="Approved" data-off="Pending" checked data-toggle="toggle" data-onstyle="info" data-offstyle="warning" data-id="<?php echo $row['id']; ?>" data-status="0" value="Inctive"></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php }}else{
                                            ?>
                                            <tr>
                                                <td>No Record Found.</td>
                                            </tr>
                                            <?php
                                        } ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>

        </section>
        <?php } ?>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('#submit').click(function(){
        var term = $('#term').val();
        if($.trim(term) == ""){
            alert('Please fill Search field.');
            return false;
        }
    });
    $(function() {
        $('.toggle-two').bootstrapToggle({
            on: 'Approved',
            off: 'Pending'
        });
    });

$("#search_result").DataTable({
            "processing" : true,
            "serverSide" : true,
            "responsive" : true,

});

    $('.toggle-two').on( 'change', function () {
        var id = $(this).data("id");
        if($(this).prop("checked") == true){
            var status = 1;
        }else{
            var status = 0;
        }
        if(id){
            $.ajax({
                url:"approve_search.php?id=" + id + "&active="+ status +"",
                method:"POST",
                success:function(data)
                {
                    console.log("success");
                }
            });
        }
    });

</script>
</body>
</html>
