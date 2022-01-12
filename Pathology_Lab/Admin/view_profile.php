<?php
$title = "Medical Test";
$page_title = "Add Medical Tests";
$page_sub_title = "";
require '../Core/init.php';

require "Include/overall/header.php";

$dt_title = "Test Available";
?>
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 id="myModalLabel" class="text-center">Bootply</h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"><br><hr></div>
                        <div class="col-xs-4"><img src="https://pbs.twimg.com/profile_images/3663020003/d09fae59ab68605a7973043e0267b905_400x400.jpeg" class="img-thumbnail img-responsive img-circle"></div>
                        <div class="col-md-4"><br><hr></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">

                            <h3 class="text-center">The Bootstrap Playground</h3>

                            <p class="text-center">Bootply is a Bootstrap playground, editor and community with a large collection of useful snippets and templates.
                                Find examples, share code, prototype and rapidly build interfaces on top of Bootstrap. 
                            </p>
                            <h3 class="text-center"><a href="#">http://bootply.com</a></h3>
                            <hr>
                            <p class="text-center">
                                <a href="#"><i class="fa fa-twitter-square fa-fw fa-3x"></i></a> &nbsp;
                                <a href="#"><i class="fa fa-facebook-square fa-fw  fa-3x"></i></a> &nbsp;
                                <a href="#"><i class="fa fa-google-plus-square fa-fw  fa-3x"></i></a>
                            </p>

                        </div>
                        <div class="col-md-1"></div>
                    </div><!--/row-->
                </div><!--/container-->
            </div>
            <div class="modal-footer bg-info">
                <button class="btn btn-lg btn-default center-block" data-dismiss="modal" aria-hidden="true"> OK </button>
            </div>
        </div>
    </div>
</div><!--/modal-->

<button id="show_modal" name="show_modal">Show Modal</button>
<script>
    jQuery(document).ready(function () {
        jQuery("#myModal").modal('show');
    });
</script>
<?php
include "Include/overall/footer.php";
?>
