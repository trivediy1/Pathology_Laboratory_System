<?php
include 'core/init.php';
include 'includes/overall/header.php';
logged_in_redirect();

if (isset($_POST) && !empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    /*$requred_fields = array('username', 'password');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }*/
    //echo $username."<br>". $password;

    if (empty($username) === true) {
        $errors["username"][] = "This Fields is required";
    }
    if (empty($password) === true) {
        $errors["password"][] = "This Fields is required";
    }

    if (isset($errors) && empty($errors)) {
        /* if (strlen($password) > 32) {
          $errors[] = "Password to long";
          } */
        /*if (user_active($username) === false) {

            echo "<script>swal('Oops!','Your account is deactivate!', 'error');</script>";
            //$errors["after"] = "You Haven't activated your account!";
        } else {*/
            //echo "<script>alert('inlogin');</script>";
            $login = login($username, $password);
            //echo "<script>alert({$login['uid']});</script>";
            //echo "<script>alert({$login['utype']});</script>";

            if ($login['uid'] === false) {
                echo "<script>swal('Oops!', 'UserName/Password Incorrect!', 'error')</script>";
                //$errors[] = "UserName/Password Incorrect!";
            } else {
                //echo "<script>swal('Login','Successfully Login','success')</script>";
                $_SESSION['User_Id'] = $login['uid'];
                $_SESSION['Type_Id'] = $login['utype'];

                if ($login['utype'] == 1) {
                    header("Location:../Admin/index");
                } else if ($login['utype'] == 2) {
                    header("Location:../Admin/doctor_report_checking");
                } else if ($login['utype'] == 3) {
                    header("Location:index");
                } else if ($login['utype'] == 4) {
                    header("Location:../Admin/update_status_of_patient");
                }

                exit();
            }
        //}
    }
}


?>
<?php ?>
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
                                <h2 class="mb20">Login</h2>
                            </div>
                            <form class="form-horizontal" method="post" >
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["username"]) && !empty($errors["username"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="username"> </label>
                                    <div class="col-md-12">
                                        <input id="username" name="username" type="text" placeholder="User Name" class="form-control input-md">
<?php echo output_errors($errors["username"]) ?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["password"]) && !empty($errors["password"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="password"> </label>
                                    <div class="col-md-12">
                                        <input id="password" name="password" type="password" placeholder="password" class="form-control input-md">
<?php echo output_errors($errors["password"]) ?>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top:5%;">
                                        <button id="singlebutton" name="singlebutton" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>

                            <br>Not Yet Member? <a href="registration_laboratory" style="text-decoration:none;">Sign Up</a>
                            <a class="text-right" style="float:right;" href="forgotpassword">Forget Passwod?</a>
                        </div>
                        <!--/.widget-appointments-->
                    </div>
                    <!--/.appointment-block-->
                </div>
                <!--/.sidebar-->
            </div>

        </div>
    </div>
</div>

<?php
include 'includes/overall/footer.php'
?>