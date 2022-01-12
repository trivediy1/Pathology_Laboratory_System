<?php include 'core/init.php';
include 'includes/overall/header.php';  ?>
    <div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="page-title">shortcodes-alerts</h3>
                    <h1 class="page-description">Know More About Pathalogy.Lab </h1>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-header-->
    <div class="page-breadcrumb">
        <!--page-breadcrumb-->
        <!-- page-breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">shortcodes-alerts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-breadcrumb-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <!-- section title start-->
                        <h1>Alerts</h1>
                        <p>Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.</p>
                    </div>
                    <!-- /.section title start-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully read this important alert message. </div>
                    <div class="alert alert-info" role="alert"> <strong>Heads up!</strong> This alert needs your attention, but it's not super important. </div>
                    <div class="alert alert-warning" role="alert"> <strong>Warning!</strong> Better check yourself, you're not looking too good. </div>
                    <div class="alert alert-danger" role="alert"> <strong>Oh snap!</strong> Change a few things up and try submitting again. </div>
                </div>
            </div>
        </div>
        <div class="space-medium">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title">
                            <!-- section title start-->
                            <h1>Dismissible alerts</h1>
                            <p>Build on any alert by adding an optional <strong>.alert-dismissible</strong> and close button.</p>
                        </div>
                        <!-- /.section title start-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Well done!</strong> You successfully read this important alert message. </div>
                        <div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Heads up!</strong> This alert needs your attention, but it's not super important. </div>
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Better check yourself, you're not looking too good. </div>
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Oh snap!</strong> Change a few things up and try submitting again. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/overall/footer.php'; ?>