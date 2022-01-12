<?php
//$title = "Doctor";
//$page_title = "Doctor Registration";
//$page_sub_title = "";
include "../Core/init.php";
include "Include/overall/header.php";
$fm_title = "Doctor Registration";
?>
<div class="space-medium">
        <!--space-medium-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                    <div class="error-img">
                        <img src="images/error-img.png" alt="" class="img-responsive">
                    </div>
                    <div class="error-content">
                        <h1 class="error-title">Oooopsss <strong>Error Page!!!</strong> </h1>
                        <h1 class="error-no">404</h1>
                        <p class="error-text">Page doesn’t exist or some other error occured. Go to our <a href="index.php" class="btn-link">homepage</a>or go back to <a href="pricing.php" class="btn-link">previous page.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "Include/overall/footer.php";
?>