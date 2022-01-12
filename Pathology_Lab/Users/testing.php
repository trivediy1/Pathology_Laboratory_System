<!DOCTYPE html>
<?php
include 'core/init.php';
//protect_page();
//has_permission(3);
include 'includes/overall/header.php';
?>
<link href="css/bootstrap1.min.css" rel="stylesheet" type="text/css"/>
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
<link href="css/_all-skins.min.css" rel="stylesheet" type="text/css"/>

<form>
    <section class="content">
        <div class="box" >
            <div class="box-header">
                <h3 class="box-title">Confirm Medical Report</h3>
            </div>
            <div class="row">
                <div class="col-md-3 date form-group">
                    <input class="form-control form_datetime col-md-8" data-format="yyyy-MM-dd" type="text" id="ini" name="ini" placeholder="From Date" >
                </div>
                <div class="col-md-3"><input class="form-control form_datetime" type="text" id="fin" name="fin" placeholder="To Date"></div>
                <div class="col-md-6"><button type="button" class="btn btn-default" name="dview" id="dview">View</button>
                    <button type="button" class="btn btn-default" style="float:right; margin-right:10%;" name="allview" id="allview">View All</button>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body" id="table_body">
                <?php echo get_confirm_madical_report($user_data['Laboratory_Id']); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <div id="pnt" class="modal fade">
        <div class="modal-dialog" style="width: 1200px;">
            <div class="modal-content ">

                <div class="modal-body">
                    <!--<button type="button" class="close" data-dismiss="modal"><h>&times;</h5></button>
                    <br>-->
                    <button type="button" id="print_doc" name="print_doc"  class="btn btn-default print pull-right">Print</button>
                    <button type="button" class="btn btn-default pull-right" style="margin-right:5px;" data-dismiss="modal">Close</button>

                    <div class="container-fluid" id="print_area">
                        <div class="row">

                            <div  style="width:1000px; border: 1px solid black">
                                <div style="width:1000px; text-align:center;">
                                    <h2><b>PATHOLOGY LABORATORY REPORT</b></h2>
                                </div>
                                <hr style="height:2px; background-color: black">
                                <div>
                                    <table style="width:100%">
                                        <tr>
                                            <td style="width:20%">
                                                <b>Laboratory Name</b>
                                            </td>
                                            <td style="width:30%">
                                                <b>:</b> <label for="labname" id="labname"></label>
                                            </td>
                                            <td style="width:20%">
                                                <b>Lab Contact</b>
                                            </td>
                                            <td style="width:30%">
                                                <b>:</b> <label for="labcont" id="labcont"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Patient Name</b>
                                            </td>
                                            <td>
                                                <b>:</b> <label for="name" id="pname"></label>
                                            </td>
                                            <td>
                                                <b>City</b>
                                            </td>
                                            <td>
                                                <b>:</b> <label for="city" id="city"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Gender / Age:</b>
                                            </td>
                                            <td>
                                                <b>:</b> <label for="gen" id="gen"></label> / <label for="age" id="age"></label>

                                            </td>
                                            <td>
                                                <b>Contact</b>
                                            </td>
                                            <td>
                                                <b>:</b> <label for="pcont" id="pcont"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%">
                                                <b>Report Date</b>
                                            </td>
                                            <td style="width:30%">
                                                <b>:</b> <label for="cdate" id="cdate"></label>
                                            </td>
                                            <td>
                                                <b>Sample Arrival Date</b>
                                            </td>
                                            <td>
                                                <b>:</b> <label for="sadate" id="sadate"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%">
                                                <b>Test Name</b>
                                            </td>
                                            <td style="width:30%">
                                                <b>:</b> <label for="dname" id="dname"></label>
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <b></b> 
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <hr style="height:1px; background-color: black">
                                <hr style="height:2px; background-color: black">
                                <div>
                                    <table style="width:100%">
                                        <thead>
                                            <tr style="padding-bottom: 20px; margin-bottom: 20px">
                                                <td style="width:30%">
                                                    <b>Test Name</b>
                                                </td>
                                                <td style="width:20%">
                                                    <b>Observed result</b> 
                                                </td>
                                                <td style="width:20%">
                                                    <b>Unit</b>
                                                </td>
                                                <td style="width:30%">
                                                    <b>Biological Ref. Range</b> 
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody style="" id="tbody">
                                            <tr>
                                                <td colspan="4" style="padding-bottom: 20px">
                                                    <hr style="height:1px; background-color: black">
                                                </td> 
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div style="width:1000px; text-align:left; padding-top: 30px">
                                    <!--<hr style="height:1px; background-color: black">-->
                                    <hr style="height:1px; background-color: lightgrey">
                                    <b>Description: </b><label for="ddesc" id="ddesc"></label><br><br>
                                    <b><u>Remarks :-</u></b><br>
                                    <textarea style="margin-left: 80px; font-style: oblique; text-align: end    " name="" rows="7" cols="85"  placeholder="Remarks given by Laboratory assistant"></textarea>

                                    <div style="text-align: right"><h6><i>The reports is computer generated and does not require signature.</i></h6></div>
                                    <hr style="height:1px; background-color: black">
                                    <div style="font-size: 10px; text-align: center; padding-bottom: 10px">End of Report</div>
                                    <div style="text-align: left"><h5><b>The reports generated by JALARAM PATHOLOGY LABORATORIES and verified by specialized pathologist.</b></h6></div>

                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div><!--/row-->
                    </div><!--/container-->
                    
                </div>

            </div>
        </div>
    </div><!--/modal-->
    <!-- /.content -->
</form>
<!-- /.content-wrapper -->
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script>

    jQuery(document).ready(function () {


        jQuery(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1,
            minView: 2
        });



        jQuery(function () {
            jQuery('#example1').DataTable();
        });

        jQuery("#dview").click(function () {
            var ini = jQuery("#ini").val();
            var fin = jQuery("#fin").val();

            if (ini == "" || fin == "")
            {
                swal('Oops!', 'Please fillup the both dates', 'error');
            } else
            {
                jQuery.ajax({
                    url: 'userapi.php',
                    method: 'post',
                    data: {'rfrom_date': ini, 'rto_date': fin},
                    success: function (data) {
                        jQuery("#table_body").html(data);
                        jQuery('#example1').DataTable();
                    }
                });
            }
        });
        jQuery("#allview").click(function () {
            jQuery.ajax({
                url: 'userapi.php',
                method: 'post',
                data: {'rgetall': 1},
                success: function (data) {
                    jQuery("#table_body").html(data);
                    jQuery('#example1').DataTable();
                }
            });
        });


        jQuery(document).on('click', 'button.btn[dataprint]', function () {
            var id = jQuery(this).attr('data-id');
            //jQuery("#edit_modal").modal('show');
            //alert(id);
            $.ajax({
                url: "userapi.php",
                method: "post",
                data: {cd: id},
                success: function (pdata)
                {
                    var obj = JSON.parse(pdata)
                    $("#labname").html(obj['labname']);
                    $("#labcont").html(obj['labcont']);
                    $("#pname").html(obj['pname']);
                    $("#city").html(obj['city']);
                    $("#age").html(obj['age']);
                    $("#gen").html(obj['gen']);
                    $("#pcont").html(obj['pcont']);
                    $("#dname").html(obj['dname']);
                    $("#ddesc").html(obj['ddesc']);
                    $("#cdate").html(obj['cdate']);
                    $("#sadate").html(obj['sadate']);
                    $("#tbody").html('');
                    $("#tbody").append(obj['diseases']);
                    //alert(obj['num']);
                }
            })

            jQuery("#pnt").modal('show');
        });

        jQuery("#print_doc").click(function () {
            
            var printme = document.getElementById("print_area");
            var htmlToPrint = '<style type="text/css"> table th, table td {} </style>';
            htmlToPrint += printme.innerHTML;
            var winprint = window.open();
            winprint.document.write(printme.innerHTML);
            winprint.document.close();
            winprint.focus();
            winprint.print();
            winprint.close();
        });


    });
</script>
<?php include 'includes/overall/footer.php'; ?>
