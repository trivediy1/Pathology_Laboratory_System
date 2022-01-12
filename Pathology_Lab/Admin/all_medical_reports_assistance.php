<?php
$title = "Medical Test";
$page_title = "Patient Medical Tests";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(1,4);
require "Include/overall/header.php";

$dt_title = "";
?>
<link href="build/css/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="build/js/sweetalert.min.js" type="text/javascript"></script>
<script src="dist/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>
<script src="dist/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="dist/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<div class="box">
    <div class="box-header">
        <h2 class="box-title"><?php echo "$dt_title"; ?></h2>
    </div>
    <div class="row" style="margin-left:1%;">
            <div class="col-md-3 date form-group">
               <input class="form-control form_datetime col-md-8" data-format="yyyy-MM-dd" type="text" id="ini" name="ini" placeholder="From Date" >
            </div>
            <div class="col-md-3"><input class="form-control form_datetime" type="text" id="fin" name="fin" placeholder="To Date"></div>
            <div class="col-md-6"><button type="button" class="btn btn-default" name="dview" id="dview">View</button>
                <button type="button" class="btn btn-default" style="float:right; margin-right:10%;" name="allview" id="allview">View All</button>
            </div>

        </div>
    <div class="box-body" id="table_body">
        <?php
        echo get_all_medical_report();
        ?> 
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery('#tabledata').DataTable();
        
        jQuery(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1,
            minView: 2
        });
        
        jQuery("#dview").click(function(){
           var ini=jQuery("#ini").val();
           var fin=jQuery("#fin").val();
           //alert(ini);
           if(ini=="" || fin=="")
           {
               swal('Oops!','Please fillup the both dates', 'error');
           }
           else
           {
               jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'from_date':ini,'to_date':fin},
                   success:function(data){
                       jQuery("#table_body").html(data);
                       jQuery('#tabledata').DataTable();
                   }
               });
           }
        });
        jQuery("#allview").click(function(){
           
               //alert("hello");
               jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'getall':1},
                   success:function(data){
                       jQuery("#table_body").html(data);
                       jQuery('#tabledata').DataTable();
                   }
               });
           
        });
        /*function dttable()
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
        }*/
        /*jQuery(document).on("click", "button.btn[datacon]", function () {
            var id = jQuery(this).attr('data-id');
            alert(id);
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {ckupid: id},
                success: function (pdata) {
                    var obj=JSON.parse(pdata)
                    if (obj['rtn'])
                    {
                        //alert('kk');
                        dttable();
                        swal("Arrived!", "Sample of Patient Arrived!", "success");
                    }
                }
            });
        });*/
    });
</script>

<?php
include "Include/overall/footer.php";
?>