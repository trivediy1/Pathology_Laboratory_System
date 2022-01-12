<?php
$title = "Reports";
$page_title = "Pathologist";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(1);
require "Include/overall/header.php";
$_title = "Laboratory ";
?>
<form action="#" method="POST">

<!--    <div class="col-md-12">
         Custom Tabs 
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div id="home" class="tab-pane fade in active">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title"><?php echo "All Laboratory"; ?></h2>
                            </div>
                             /.box-header 
                            <div class="box-body" id="tbl_ds">
                                <?php
                                echo get_Labs();
                                ?> 
                            </div>
                             /.box-body 
                        </div>
                    </div>
                </div>
                 /.tab-pane 
                <div class="tab-pane" id="tab_2">
                    <div id="home" class="tab-pane fade in active">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title"><?php echo "Payment"; ?></h2>
                            </div>
                             /.box-header 
                            <div class="box-body" id="tbl_ds">
                                <?php
                                echo get_Labs_Payment();
                                ?> 

                            </div>
                             /.box-body 
                        </div>
                    </div>
                </div>
                 /.tab-pane 
                <div class="tab-pane" id="tab_3">
                    <div id="home" class="tab-pane fade in active">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title"><?php echo "Payment"; ?></h2>
                            </div>
                             /.box-header 
                            <div class="box-body" id="tbl_ds">
                                <?php
                                echo getbills();
                                ?> 

                            </div>
                             /.box-body 
                        </div>
                    </div>
                </div>
                 /.tab-pane 
            </div>
             /.tab-content 
        </div>
         nav-tabs-custom 
    </div>-->

    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home"> All Pathologist</a></li>
<!--        <li><a data-toggle="pill" href="#menu1">Payments</a></li>
        <li><a data-toggle="pill" href="#menu2">Bills</a></li>-->
    </ul>
    <br>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title"><?php echo "Pathologist"; ?></h2>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="tbl_ds1">
                    <?php
                    echo get_pathologist();
                    ?> 
                </div>
                <!-- /.box-body -->
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
        
         
    });
</script>
<?php
include "Include/overall/footer.php";
?>