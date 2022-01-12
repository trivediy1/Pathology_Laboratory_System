<?php
$page_title = "Forgot Password";
$title = "Forgot Password";
include 'core/init.php';
include 'includes/overall/header.php'
?>
<?php include 'includes/slider.php';
?>
<style>
    #register .strong
    { 
        color:#006400; 
    }
</style>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left:25%;">
                <div class="sidebar">
                    <!--sidebar-->
                    <div class="appointment-block">
                        <!--appointment-block-->
                        <div class="bg-default widget-appointments">
                            <!--widget-appointments-->
                            <div class=" ">
                                <h3 class="mb20">Enter you username to reset you password</h3>
                            </div>
                            <div class="form-group" style="padding-bottom:15px;">

                                <div class="row">
                                    <div class="col-md-8">
                                        <input id="unm" name="unm" type="text" placeholder="Enter username" class="form-control input-md">
                                        <span id="eunm"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <!--<input type="submit" name="submit" class="btn btn-primary form-control" id="next" value="Next">-->
                                        <button type="button" class="btn btn-primary form-control pull-right" id="next" name="next" style="margin-right: 5px;">
                                            Next   
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--/.widget-appointments-->
                </div>
                <!--/.appointment-block-->
            </div>
            <!--/.sidebar-->
        </div>

    </div>
</div>
<script>
    $(document).ready(function ()
    {
        $("#next").click(function () {
            var unm = $("#unm").val();
            if (unm != "") {

                jQuery.ajax({
                    url: "userapi.php",
                    method: "post",
                    data: {u: unm},
                    success: function (pdata)
                    {
                        obj = JSON.parse(pdata);
                        if (obj['chk'] == false)
                        {
                            $('#eunm').removeClass();
                            $('#eunm').addClass('strong');
                            $('#eunm').html("user does'nt exist");
                        } else
                        {
                            $('#eunm').removeClass();
                            $('#eunm').html("user exist");
                            window.location.replace('forgotpassword1.php?unm=' + unm)
                        }
                    }
                });
            }
        });
    });
</script>

<?php include 'includes/overall/footer.php'; ?>
        