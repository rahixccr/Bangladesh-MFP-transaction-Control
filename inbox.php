<?php
session_start();
$session_rec_nos = array();
if(array_key_exists("rec_number", $_SESSION))
{
    if($_SESSION["rec_number"] != null)
    {
        $session_rec_nos = $_SESSION["rec_number"];
    }
}
session_start();
		if(!isset($_SESSION['admin'])){
			header("Location: index.php");
			
		}


?>
<!DOCTYPE html>
<title>SMS Server Master Admin</title>
<?php
    $page = 'Sms bKash Page';
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
                <small>Inbox</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Inbox</li>
            </ol>
        </section>

        <!--//////////////////////// Main content ///////////////////////////////-->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="clear"></div>
                <div class="col-md-8">
                    <div class="box-body catTable">
                        <h3 class="box-title"><center>Inbox</center></h3>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 5px;">
                                <!-- Button trigger modal -->
                                <!--button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Add
                                </button>
                                <!-- Modal >
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Add Record</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="insert.php">
                                                    <div class="form-group">
                                                        <label class="control-label">Receiving Number</label>
                                                        <input type="text" id="data1" class="form-control" name="rec_number" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Sender Number</label>
                                                        <input type="text" id="data2" class="form-control" name="sender_number" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">SMS Text</label>
                                                        <textarea class="form-control" id="data3" name="sms_text" required></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="insert">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div-->
                                <div id="alert_message"></div>
                            </div>
                            <!-- Custom Filter -->
                            <div class="col-md-12" style="margin-bottom: 5px;">
                                <table>
                                    <tr>
                                        <td style="padding-right: 5px;"><label>Filter By Date:</label></td>
                                        <td >
                                            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Enter Date"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 5px;">
                                <div class="table-responsive">
                                    <table>

                                        <tr>
                                            <td  style="padding-right: 5px;"><label>Filter By Receiving Number:</label></td>
                                            <?php

                                            $result = rec_info($connect);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <td  style="padding-right: 5px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="rec_num" name="rec_number" value="<?php echo $row["tag"]; ?>" <?php if(in_array($row["tag"], $session_rec_nos)) echo "checked='checked'"; ?>> <?php echo $row["tag"]; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 5px;padding-left: 0px;">
                                    <table>
                                        <td>
                                            <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                                        </td>
                                        <td>
                                            <input style="margin-left: 10px;" type="button" name="refresh" id="refresh" value="Refresh" class="btn btn-info" />
                                        </td>
                                    </table>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="sms_table" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Sender Number</th>
                                            <th>Amount</th>
                                            <th>Transaction ID</th>
                                            <th>Receiving Number</th>
                                            <th>Approval</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

                <div class="col-md-4">
                    <div class="box-body catTable">
                        <h3 class="box-title"><center>SMS Details</center></h3>
                        <table id="details_sms" class="table table-bordered table-striped">

                            <tbody>
                            <tr><td>From: </td><td id="from"></td></tr>
                            <tr><td>Amount: </td><td id="t_id"></td></tr>
                            <tr><td>Transaction ID:</td><td id="amount"></td></tr>
                            <tr><td>Rec Number: </td><td id="rec_no"></td></tr>
                            <tr><td>Full SMS text: </td><td id="full_sms"></td></tr>
                            <tr><td>Approval: </td><td id="approval"></td></td></tr>
                            <tr><td><button class="btn btn-general" id="prev">Previous</button> </td><td><button id="next" class="btn btn-general">Next</button></td></tr>

                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div>

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
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
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
    $('#datepick input').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked"
    });

    $(function() {
        $('.toggle-two').bootstrapToggle({
            on: 'Approved',
            off: 'Pending'
        });
    });

    var rec_num = [];
    $.each($("input[name='rec_number']:checked"), function(){
        rec_num.push($(this).val());
    });
    var start_date = $('#start_date').val();
    if(start_date != '' || rec_num != '')
    {
        $('#sms_table').DataTable().destroy();
        fetch_data('yes', start_date, rec_num);
    }else{
        fetch_data('no');
    }

    var dataTable;
    function fetch_data(is_date_search, start_date='', rec_num='')
    {
        dataTable = $("#sms_table").DataTable({
            "processing" : true,
            "serverSide" : true,
            "responsive" : true,
            "lengthMenu": [ 10, 25, 50,100,'All' ],
            "pageLength":100,
            "order" :   [],
            "ajax"  :   {
                "url"   :   "fetch.php",
                "type"  :   "POST",
                data:{
                    is_date_search:is_date_search, start_date:start_date, rec_num: rec_num
                }
            },
            "columns": [
                { data: 0, "visible": true },
                { data: 1, "visible": true },
                { data: 2, "visible": true },
                { data: 3, "visible": true },
                { data: 4, "visible": true },
                { data: 6, "visible": true },
                { data: 7, "visible": true },
            ],
            "drawCallback": function () {
                $(".toggle-two").bootstrapToggle();
            }
        });

    }

    $('#sms_table tbody').on( 'click', '.detail', function () {
        var all_tr = $('tr');
        var data = dataTable.row( $(this).parents('tr') ).data();

        all_tr.removeClass('selected');
        $(this).closest('tr').addClass('selected');
        $("#from").text(data[0]);
        $("#amount").text(data[1]);
        $("#t_id").text(data[2]);
        $("#rec_no").text(data[3]);
        $("#full_sms").text(data[5]);
        $("#approval").html(data[6]);
        $("[data-toggle='toggle']").bootstrapToggle('destroy')
        $("[data-toggle='toggle']").bootstrapToggle();
    } );

    $('#sms_table tbody').on( 'change', '.stat', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var row = dataTable.rows('.selected').data().length;
        if($(this).prop("checked") == true){
            var status = 1;
            if(row > 0){
                $('#details_sms .stat').bootstrapToggle('on');
            }else{
                $("#from").text("");
                $("#amount").text("");
                $("#t_id").text("");
                $("#rec_no").text("");
                $("#full_sms").text("");
                $("#approval").html("");
            }
        }else{
            var status = 0;
            if(row > 0){
                $('#details_sms .stat').bootstrapToggle('off');
            }else{
                $("#from").text("");
                $("#amount").text("");
                $("#t_id").text("");
                $("#rec_no").text("");
                $("#full_sms").text("");
                $("#approval").html("");
            }
        }
        if(id){
            $.ajax({
                url:"approve_inbox.php?id=" + id + "&active="+ status +"",
                method:"POST",
                success:function(data)
                {
                    $('#sms_table').DataTable().destroy();
                    var rec_num = [];
                    $.each($("input[name='rec_number']:checked"), function(){
                        rec_num.push($(this).val());
                    });
                    var start_date = $('#start_date').val();
                    if(start_date != '' || rec_num != '')
                    {
                        $('#sms_table').DataTable().destroy();
                        fetch_data('yes', start_date, rec_num);
                    }else{
                        $('#sms_table').DataTable().destroy();
                        fetch_data('no');
                    }


                }
            });
        }
    });

    $('#details_sms tbody').on( 'change', '.stat', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        if($(this).prop("checked") == true){
            var status = 1;
        }else{
            var status = 0;
        }
        if(id){
            $.ajax({
                url:"approve_inbox.php?id=" + id + "&active="+ status +"",
                method:"POST",
                success:function(data)
                {
                    var rec_num = [];
                    $.each($("input[name='rec_number']:checked"), function(){
                        rec_num.push($(this).val());
                    });
                    var start_date = $('#start_date').val();
                    if(start_date != '' || rec_num != '')
                    {
                        $('#sms_table').DataTable().destroy();
                        fetch_data('yes', start_date, rec_num);
                    }else{
                        $('#sms_table').DataTable().destroy();
                        fetch_data('no');
                    }
                }
            });
        }
    });


    $('#prev').click(function(e) {
        var rows = getHighlightRow();
        if (rows != undefined) {
            var all_tr = $('tr');
            all_tr.removeClass('selected');
            $(rows).prev().closest('tr').addClass('selected');
            var data = dataTable.row( $("#sms_table tbody tr.selected")).data();
            $("#from").text(data[0]);
            $("#amount").text(data[1]);
            $("#t_id").text(data[2]);
            $("#rec_no").text(data[3]);
            $("#full_sms").text(data[5]);
            $("#approval").html(data[6]);
            $("[data-toggle='toggle']").bootstrapToggle('destroy')
            $("[data-toggle='toggle']").bootstrapToggle();
        }
    });

    $('#next').click(function(e) {
        var rows = getHighlightRow();
        if (rows != undefined) {
            var all_tr = $('tr');
            all_tr.removeClass('selected');
            $(rows).next().closest('tr').addClass('selected');
            var data = dataTable.row( $("#sms_table tbody tr.selected")).data();
            $("#from").text(data[0]);
            $("#amount").text(data[1]);
            $("#t_id").text(data[2]);
            $("#rec_no").text(data[3]);
            $("#full_sms").text(data[5]);
            $("#approval").html(data[6]);
            $("[data-toggle='toggle']").bootstrapToggle('destroy')
            $("[data-toggle='toggle']").bootstrapToggle();
        }
    });

    var getHighlightRow = function() {
        return $('table > tbody > tr.selected');
    }

    $("#refresh").click(function(){
        $('#sms_table').DataTable().destroy();
        var rec_num = [];
        $.each($("input[name='rec_number']:checked"), function(){
            rec_num.push($(this).val());
        });
        var start_date = $('#start_date').val();
        if(start_date != '' || rec_num != '')
        {
            $('#sms_table').DataTable().destroy();
            fetch_data('yes', start_date, rec_num);
        }else{
            fetch_data('no');
        }
        $("#from").text("");
        $("#amount").text("");
        $("#t_id").text("");
        $("#rec_no").text("");
        $("#full_sms").text("");
        $("#approval").html("");
    });

    $('#search').click(function(){
        var rec_num = [];
        $.each($("input[name='rec_number']:checked"), function(){
            rec_num.push($(this).val());
        });
        var start_date = $('#start_date').val();
        if(start_date != '' || rec_num != '')
        {
            $('#sms_table').DataTable().destroy();
            fetch_data('yes', start_date, rec_num);
        }
        else
        {
            alert("At least one field is required");
        }
    });

    $(document).on('click', '#insert', function(e){
        e.preventDefault();
        var rec_number = $('#data1').val();
        var sender_number = $('#data2').val();
        var sms_text = $('#data3').val();
        if(rec_number != '' && sender_number != '' && sms_text != '')
        {
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:{rec_number:rec_number, sender_number:sender_number, sms_text:sms_text},
                success:function(data)
                {
                    $('#myModal').on('hidden.bs.modal', function () {
                        $(this).find('form').trigger('reset');
                    });
                    $('#myModal').modal('toggle');
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                    $('#sms_table').DataTable().destroy();
                    var rec_num = [];
                    $.each($("input[name='rec_number']:checked"), function(){
                        rec_num.push($(this).val());
                    });
                    var start_date = $('#start_date').val();
                    if(start_date != '' || rec_num != '')
                    {
                        $('#sms_table').DataTable().destroy();
                        fetch_data('yes', start_date, rec_num);
                    }else{
                        fetch_data('no');
                    }
                }
            });
            setInterval(function(){
                $('#alert_message').html('');
            }, 5000);
        }
        else
        {
            alert("Both Fields is required");
        }
    });

    setInterval(function(){
        dataTable.draw();
    }, 60000);
</script>
</body>
</html>
