<?php
$title = "Account";
$page_title = "Change Password";
$page_sub_title = "Enter details to change password";
require '../Core/init.php';
protect_page();
has_permission(1,2);
require "Include/overall/header.php";
?>
<link href="dist/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="dist/sweetalert.js" type="text/javascript"></script>
<style>

    #register label
    { 
        margin-right:5px; 
    } 

    #register input 
    { 
        padding:5px 7px; 
        border:1px solid #d5d9da; 
        box-shadow: 0 0 5px #e8e9eb inset;   
        font-size:1em; 
        outline:0; 
    } 

    #result
    { 
        margin-left:5px; 
    }

    #cp
    {
        margin-right:5px; 
    }

    #curp
    {
        margin-right:5px; 
    }

    #register .short
    { 
        color:#FF0000; 
    }

    #register .weak
    { 
        color:#E66C2C; 
    } 

    #register .good
    { 
        color:#2D98F3; 
    } 

    #register .strong
    { 
        color:#006400; 
    }


</style>

<?php
if (isset($_POST) && !empty($_POST)) {
    //echo "hello";

    $requred_fields = array('cur_pass', 'new_pass', 'con_pass');

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }

    if (md5($_POST['cur_pass']) != get_password()) {
        $errors['cur_pass'][] = "please enter correct current password";
    }

    if ($_POST['new_pass'] != $_POST['con_pass']) {
        $errors['con_pass'][] = "Both password must be same";
    }


    if (isset($errors) && empty($errors)) {
        $pass = $_POST['new_pass'];
        //echo "<script>alert('hello');</script>";
        //print_r($register_data);die();
        //$_SESSION['password_data'] = $password_data;
        $sc = change_password($pass);
        if ($sc) {
            echo "<script>swal({
                title: 'Good job!',
                text: 'Password Changed Successfully',
                icon: 'success',
                }).then(function(){window.location='../Users/login.php';});</script>";
            //swal("Thank You", "Register Successfully", "success");
            //header("Location:test.php");
        } else {

            echo "<script>swal({
                title: 'Oops!',
                text: 'Something went wrong!Please try agian!',
                icon: 'error',
                }).then(function(){window.location='Doctor_Registration.php';});</script>";
        }
        //echo "hello";
        //header("Location:Test_Medical.php") or die("not save");
        //echo "hello";
    }
}
?>
<form method="POST" action="#" id="register" enctype="multipart/form-data">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $fm_title; ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (isset($errors["cur_pass"]) && !empty($errors["cur_pass"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="cur_pass">Current Password</label>
                        <input id="cur_pass" name="cur_pass" type="password" placeholder="Current Password" class="form-control input-md"><span id="curp"></span>
                        <?php echo output_errors($errors["cur_pass"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["new_pass"]) && !empty($errors["new_pass"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="new_pass">New Password</label>
                        <input id="new_pass" name="new_pass" type="password" placeholder="New Password" class="form-control input-md"><span id="result"></span>
                        <?php echo output_errors($errors["new_pass"]); ?>
                    </div>

                    <div class="form-group <?php echo (isset($errors["con_pass"]) && !empty($errors["con_pass"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="con_pass">Confirm Password</label>
                        <input id="con_pass" name="con_pass" type="password" placeholder="Confirm Password" class="form-control input-md"><span id="cp"></span>
                        <?php echo output_errors($errors["con_pass"]); ?>
                    </div>

                    <div class="box-footer">
                        <div class="text-right">
                            <button type="submit" style="" name="submit" id="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" style="" name="reset" id="reset" class="btn btn-primary">Cancel</button>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->

    </div>
</form>
<script>
    $(document).ready(function () {

        jQuery("#cur_pass").blur(function () {
            var pass = jQuery("#cur_pass").val();
            //swal("Here's the title!",testname);
            if (pass != "")
            {

                jQuery.ajax({
                    url: "adminapi.php",
                    method: "post",
                    data: {pass: pass},
                    success: function (pdata) {
                        var obj = JSON.parse(pdata);

                        if (obj['rtn'])
                        {
                            dttable();
                            jQuery("#add_modal").modal('hide');
                        } else
                        {
                            swal("Oops!", "Something goes wrong", "error");
                        }
                    }
                });
            }

        });

        $('#new_pass').keyup(function () {
            $('#result').html(checkStrength($('#new_pass').val()))
        })

        $('#con_pass').keyup(function () {
            if ($('#new_pass').val() == $('#con_pass').val())
            {
                $('#cp').removeClass()
                $('#cp').addClass('good')
                $('#cp').html('Password match')
            } else
            {
                $('#cp').removeClass()
                $('#cp').addClass('short')
                $('#cp').html('Password does\'nt match')
            }
        })

        function checkStrength(password) {

            var strength = 0

            if (password.length < 6) {
                $('#result').removeClass()
                $('#result').addClass('short')
                return 'Too short'
            }

            if (password.length > 7)
                strength += 1

            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
                strength += 1

            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
                strength += 1

            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
                strength += 1

            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/))
                strength += 1

            if (strength < 2) {
                $('#result').removeClass()
                $('#result').addClass('weak')
                return 'Weak'
            } else if (strength == 2) {
                $('#result').removeClass()
                $('#result').addClass('good')
                return 'Good'
            } else {
                $('#result').removeClass()
                $('#result').addClass('strong')
                return 'Strong'
            }
        }
    });

</script>

<?php
include "Include/overall/footer.php";
?>