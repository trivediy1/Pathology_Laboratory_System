<?php
$title = "Medical Test";
$page_title = "Add Medical Tests";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(4);
require "Include/overall/header.php";

$dt_title = "Test Available";
?>
<link href="build/css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="build/js/sweetalert.min.js" type="text/javascript"></script>
<div class="box">
    <div class="box-header">
        <h2 class="box-title"><?php echo "$dt_title"; ?></h2>
    </div>
    <div class="box-body" id="tbl_ckup">
        <?php
        echo get_make_report_list();
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
                        <input type="hidden" id="ds">
                        <h4><label>Description</label></h4>
                        <textarea cols="70" rows="5" id="dscr"></textarea>
                    </div>
                    <div class="box-footer">
                        <h4><label>Tests</label></h4>

                        <div class="box-body" id='make_report_div'>

                        </div>
                    </div>


                    <!-- /.box-body -->


                    <div class="box-footer">
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary pull-left" id="report_save" name="report_save" style="margin-right: 5px;">
                                <i class="fa fa-save"></i> Make   
                            </button>
                            <input type="hidden" id="hid" name="hid">
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
        function dttable()
        {

            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {ckupbody: 1},
                success: function (tbdata) {
                    var obj = JSON.parse(tbdata);
                    jQuery("#tbl_ckup").html(obj['tbhtml']);
                    jQuery('#tabledata').DataTable();
                }
            });
            //jQuery('#tabledata').DataTable();
        }
        jQuery(document).on("click", "button.btn[datamake]", function () {
            jQuery("#make_report_div").html("");
            jQuery("#report_modal").modal('show');
            var id = jQuery(this).attr('data-id');
            jQuery("#ds").val(id);
            //alert(id);
            var ckds = [];
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {ckds: id},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    for (var p = 0; p < obj.length; p++)
                    {
                        jQuery.each(obj[p], function (index, value) {
                            ckds[index] = value;
                            //alert(index +"  "+value);
                        });
                        jQuery('#make_report_div').append("<div class='row form-group report' data-id=" + i + "><div class='col-sm-5'><input type='text' readonly='true' class='form-control' name='test[]' id='test_" + i + "' placeholder='Test Name' value='" + ckds["test"] + "'></div>\n\
                     <div class='col-sm-7'><input type='text' class='form-control' name='result[]' id='result_" + i + "' placeholder='Result' data-id='" + ckds['dsd_id'] + "' value=''></div></div>");

                        i++;
                    }
                    i = 0;

                }
            });
        });
        jQuery("#report_save").click(function () {
            var cid=jQuery("#ds").val();
            var j = '{"pdiseases":[]}';
            var error = 1;
            var pdemo = JSON.parse(j);
            var dscr = jQuery("#dscr").val();

            jQuery(".report").each(function () {
                var id = jQuery(this).attr("data-id");
                var test_id = jQuery("#result_" + id + "").attr("data-id");
                var result = jQuery("#result_" + id + "").val();

                if (test_id == "" || result == "")
                {
                    //alert('wrong');
                    error = 0;
                }
                //alert(test_id);
                //alert(result);
                pdemo['pdiseases'].push({"test_id": test_id, "result": result});
            });

            if (error && dscr !== "")
            {
                //alert(dscr);
                jQuery.ajax({
                    url: 'adminapi.php',
                    method: 'post',
                    data: {"pdiseas": 1, "pdemo": pdemo['pdiseases'], "ckid": cid, "dscr": dscr},
                    success: function (pdata) {
                        var obj = JSON.parse(pdata);
                        if (obj['rtn'])
                        {
                            
                            jQuery("#report_modal").modal('hide');
                            swal("Good job!", "Successfully Done!", "success");
                            dttable();
                            //jQuery('#tabledata').DataTable();
                        } else
                        {
                            swal("Oops!", "Something goes wrong!!", "error");
                        }
                    }
                });
                //alert(JSON.stringify(pdemo['pdiseases']))
                //swal("Good job!", "Report Crete Successfully!", "success");
            } else
            {
                swal("Oops!", "All fields are required", "error");
            }
        });


    });
</script>

<?php
include "Include/overall/footer.php";
?>