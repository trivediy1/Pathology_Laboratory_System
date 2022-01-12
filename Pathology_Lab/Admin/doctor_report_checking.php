<?php
$title = "Medical Test";
$page_title = "Verify Reports";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(2);
require "Include/overall/header.php";

$dt_title = "";
?>
<link href="build/css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="build/js/sweetalert.min.js" type="text/javascript"></script>
<div class="box">
    <div class="box-header">
        <h2 class="box-title"><?php echo "$dt_title"; ?></h2>
    </div>
    <div class="box-body" id="tbl_rpck">
        <?php
        echo get_list_for_check();
        ?> 
    </div>
</div>
<!--Edit Desies-->
<div class="container">

    <div class="modal fade" id="report_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-dialog">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="box-title"><?php echo " Edit Medical Test "; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-footer">
                        <h4><label>Description</label></h4>
                        <textarea cols="70" rows="5" id="dscr" readonly="true"></textarea>
                    </div>
                    <div class="box-footer">
                        <h4><label>Tests</label></h4>
                    
                    <div class="box-body" id='make_report_div'>
                        
                    </div>
                        </div>


                    <!-- /.box-body -->

                    
                    <div class="box-footer">
                        <div class="box-footer">
                            <button type="button" class="btn btn-success pull-left" id="report_save" name="report_confirm" style="margin-right: 5px;">
                                <i class="fa fa-save"></i> Confirm   
                            </button>
                            <button type="button" class="btn btn-danger pull-left" id="report_cancel" name="report_cancel" style="margin-right: 5px;">
                                <i class="fa fa-remove"></i> Reject   
                            </button>
                            <input type="hidden" name="hid" id="hid" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--End Edit Desies-->
<script>
    jQuery(document).ready(function () {
        var i = 0;
        jQuery('#tabledata').DataTable();
        /*welcome();
        function welcome()
        {
            
            jQuery.ajax({
                url:'adminapi.php',
                method:'post',
                data:{'profile':1},
                success:function(data){
                    var obj=JSON.parse(data);
                    jQuery("#profile_img").html(obj['Name']);
                    jQuery("#profile_type").html("Lab Pathologist");
                    jQuery("#member_type").html("Pathologist");
                }
            });
            
        }*/
        function dttable()
        {

            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {rpckbody: 1},
                success: function (tbdata) {
                    var obj = JSON.parse(tbdata);
                    jQuery("#tbl_rpck").html(obj['tbhtml']);
                    jQuery('#tabledata').DataTable();
                }
            });
            //jQuery('#tabledata').DataTable();
        }
        jQuery(document).on("click", "button.btn[datamake]", function () {
            
            var id = jQuery(this).attr('data-id');
            jQuery("#hid").val(id);
            jQuery("#make_report_div").html("");
            jQuery("#report_modal").modal('show');
            //alert(id);
            var drck = [];
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {drck: id},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    jQuery("#dscr").val(obj['description']);
                    pdemo=obj['tmpds'];
                    for (var p = 0; p < pdemo.length; p++)
                    {
                        jQuery.each(pdemo[p], function (index, value) {
                            drck[index] = value;
                            //alert(index +"  "+value);
                        });
                        jQuery('#make_report_div').append("<div class='row form-group report' data-id=" + i + "><div class='col-sm-5'><input type='text' readonly='true' class='form-control' style='background-color: white;' name='test[]' id='test_" + i + "' placeholder='Test Name' value='" + drck["test"] + "'></div>\n\
                     <div class='col-sm-7'><input type='text' class='form-control' style='background-color: white;' name='result[]' id='result_" + i + "' placeholder='Result' readonly='true' value='"+drck["result"]+"'></div></div>");
                        i++;
                    }
                      i=0;
                }
            });

            
        });
        jQuery("#report_save").click(function () {
            var id=jQuery("#hid").val();
            
            jQuery.ajax({
                url:'adminapi.php',
                method:'post',
                data:{"rpck":id},
                success:function(pdata){
                    var obj=JSON.parse(pdata);
                    
                    if(obj['rtn'])
                    {
                        dttable();
                        jQuery("#report_modal").modal('hide');
                        swal("Good job!","Checked!", "success");
                    }
                    else
                    {
                        swal('Oops!', 'Something went wrong!', 'error');
                    }
                    
                }
            });
            
            
            
        });
        jQuery("#report_cancel").click(function () {
            var id=jQuery("#hid").val();
            jQuery.ajax({
                url:'adminapi.php',
                method:'post',
                data:{"rprj":id},
                success:function(pdata){
                    var obj=JSON.parse(pdata);
                    
                    if(obj['rtn'])
                    {
                        dttable();
                        jQuery("#report_modal").modal('hide');
                        swal("Good job!","Report has rejected succrssfuly", "success");
                    }
                    else
                    {
                        swal('Oops!', 'Something went wrong!', 'error');
                    }
                    
                }
            });
        });


    });
</script>

<?php
include "Include/overall/footer.php";
?>