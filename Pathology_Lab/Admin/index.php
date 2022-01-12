<?php
$title = "Home";
$page_title = "Dashboard";
$page_sub_title = "Dashboard";
include "../Core/init.php";
protect_page();
has_permission(1);
include "Include/overall/header.php";
?>

<?php
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo count_laboratory(); ?></h3>

                <p>Laboratories</p>
            </div>
            <div class="icon">
                <i class="fa fa-flask"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo count_patient(); ?></h3>

                <p>Patient</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo count_pathologist(); ?></h3>

                <p>Pathologist</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-md"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo count_confirm_reports(); ?></h3>

                <p>Reports</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-pdf-o"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div id="welc" style='text-align:center;font-size:100px;font-family:"Comic Sans MS";margin-top:100px;'>Hello Admin! <i class='fa fa-smile-o'></i></div>
        <!--<script>
            $(document).ready(function () {
                $("#welc").effect("shake","up",5000);
            });
        </script>-->

        <?php
        include "Include/overall/footer.php";
        ?>