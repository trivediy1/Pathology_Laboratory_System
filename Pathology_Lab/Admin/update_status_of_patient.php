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
        echo get_patient_checkup_list();
        ?> 
    </div>
</div>
<script>
    jQuery(document).ready(function () {
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
                    jQuery("#profile_type").html("Laboratory Assistance");
                    jQuery("#member_type").html("Assistance");
                }
            });
            
        }*/
        function dttable()
        {
            
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {ckupbodyp: 1},
                success: function (tbdata) {
                    var obj = JSON.parse(tbdata);
                    jQuery("#tbl_ckup").html(obj['tbhtml']);
                    jQuery('#tabledata').DataTable();
                }
            });
            //jQuery('#tabledata').DataTable();
        }
        jQuery(document).on("click", "button.btn[datacon]", function () {
            var id = jQuery(this).attr('data-id');
            //alert(id);
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
        });
    });
</script>

<?php
include "Include/overall/footer.php";
?>