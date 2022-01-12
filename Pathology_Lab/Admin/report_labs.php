<?php
$title = "Reports";
$page_title = "Laboratory Reports";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(1);
require "Include/overall/header.php";
$_title = "Laboratory ";
?>
<script src="dist/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>
<script src="dist/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="dist/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<form action="#" method="POST">

    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">All Laboratories</a></li>
        <li><a data-toggle="pill" href="#menu1">Payments</a></li>
        <!--<li><a data-toggle="pill" href="#menu2">Bills</a></li>-->
    </ul>
    <br>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title"><?php echo "All Laboratory"; ?></h2>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="tbl_ds1">
                    <?php
                    echo get_Labs();
                    ?> 
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div id="home" class="tab-pane fade in active">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title"><?php echo "Payment"; ?></h2>
                    </div>
                    <div class="row" style="margin-left:1%;">
                        <div class="col-md-3 date form-group">
                            <input class="form-control form_datetime col-md-8" data-format="yyyy-MM-dd" type="text" id="pini" name="pini" placeholder="From Date" >
                        </div>
                        <div class="col-md-3"><input class="form-control form_datetime" type="text" id="pfin" name="pfin" placeholder="To Date"></div>
                        <div class="col-md-6"><button type="button" class="btn btn-default" name="pview" id="pview">View</button>
                            <button type="button" class="btn btn-default" style="float:right; margin-right:10%;" name="pallview" id="pallview">View All</button>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="tbl_ds2">
                        <?php
                        echo get_Labs_Payment();
                        ?> 

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    <?php
    require './view_profile_modal.php';
    ?>
</form>
<script>
    jQuery(document).ready(function ()
    {
        jQuery('table').DataTable();
        
        jQuery(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd',
            autoclose: 1,
            todayHighlight: 1,
            minView: 2
        });
        

        jQuery("#dd").change(function ()
        {
            alert("dd changed");
        });

        jQuery(document).on('click', 'button.btn[dataedit]', function () {
            var id = jQuery(this).attr('data-id');

            jQuery.ajax({
                url: "adminapi.php",
                method: "post",

                data: {lab_id: id},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
//                    $("#picture").attr("src","");
                    $("#picture").attr("src", obj['Picture']);
                    jQuery("label[for='name']").html(obj['nm']);
                    jQuery("label[for='dob']").html(obj['Date_Of_Birth']);
                    jQuery("label[for='contact']").html(obj['Contact_no']);
                    jQuery("label[for='city']").html(obj['City_Name']);
                    jQuery("label[for='email']").html(obj['Email_Id']);
                    jQuery("label[for='address']").html(obj['Address']);
                    jQuery("label[for='remain_amount']").html(obj['Remaining_Amount']);
                    jQuery("#view_profile_modal").modal('show');
                }
            });
        });

        jQuery(document).on('click', 'button.btn[viewbilldetail]', function () {
            var id = jQuery(this).attr('data-id');
            alert("view Profile : " + id);
        });

        jQuery(document).on('click', 'button.btn[viewprofile]', function () {
            var id = jQuery(this).attr('data-id');
            alert("view Profile : " + id);
        });

        jQuery(document).on('click', 'button.btn[viewlab]', function () {
            var id = jQuery(this).attr('data-id');

            alert("view laboratory : " + id);
        });
        
        jQuery("#pview").click(function(){
           var ini=jQuery("#pini").val();
           var fin=jQuery("#pfin").val();
           //alert(fin);
           if(ini=="" || fin=="")
           {
               swal('Oops!','Please fillup the both dates', 'error');
           }
           else
           {
               jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'apfrom_date':ini,'apto_date':fin},
                   success:function(data){
                       jQuery("#tbl_ds2").html(data);
                       jQuery('table').DataTable();
                   }
               });
           }
        });
        jQuery("#pallview").click(function(){
           jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'apall':1},
                   success:function(data){
                       jQuery("#tbl_ds2").html(data);
                       jQuery('table').DataTable();
                   }
               });
        });
        
        
        
        /*jQuery("#bview").click(function(){
           var ini=jQuery("#bini").val();
           var fin=jQuery("#bfin").val();
           //alert(fin);
           if(ini=="" || fin=="")
           {
               swal('Oops!','Please fillup the both dates', 'error');
           }
           else
           {
               jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'abfrom_date':ini,'abto_date':fin},
                   success:function(data){
                       jQuery("#tbl_ds3").html(data);
                       jQuery('table').DataTable();
                   }
               });
           }
        });
        jQuery("#pallview").click(function(){
           jQuery.ajax({
                   url:'adminapi.php',
                   method:'post',
                   data:{'aball':1},
                   success:function(data){
                       jQuery("#tbl_ds3").html(data);
                       jQuery('table').DataTable();
                   }
               });
        });*/


    });
</script>
<?php
include "Include/overall/footer.php";
?>