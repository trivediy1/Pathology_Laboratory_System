<?php
$title = "Laboratories";
$page_title = "Laboratories";
$page_sub_title = "";
require '../Core/init.php';
protect_page();
has_permission(1);
require "Include/overall/header.php";
?>

<form action="#" method="POST">
    <h2 class="page-header"></h2>
    <div class="row" id="content">
        <?php echo get_labs_info(); ?>
    </div>

    <?php
    require './view_profile_modal.php';
    ?>
</form>
<script>
    /*jQuery(document).ready(function ()
    {      
        jQuery(document).on('click', 'button.btn[dataedit]', function () {
            var id = jQuery(this).attr('data-id');

            jQuery.ajax({
                url: "adminapi.php",
                method: "post",

                data: {lid: id},
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
    });*/
    
    
</script>
<?php
include "Include/overall/footer.php";
?>