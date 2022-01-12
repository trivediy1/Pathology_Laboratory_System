<?php
$page_title = "Forgot Password";
$title = "Forgot Password";
include 'core/init.php';
include 'includes/overall/header.php'
?>
<?php
include 'includes/slider.php';
//send_sms();
?>

<style>
    #register .strong
    { 
        color:#006400; 
    }
</style>

<?php
if (isset($_POST) && !empty($_POST['rp'])) {
    $requred_fields = array('email', 'phone');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }
    if ($_SESSION['email'] != $_POST['email']) {
        $errors['email'][] = 'Email address is wrong!';
    }
    if ($_SESSION['phone'] != $_POST['phone']) {
        $errors['phone'][] = 'Contact no is wrong';
    }
//    echo "fdfd<br>";
//    print_r($errors);
    if (empty($errors)) {
        $pass = rand(999, 9999);
        $pass = md5($pass);
        $pass = substr($pass, 0, 8);
        $sql = "update tbl_user set Password = '" . md5($pass) . "' where User_Name = '" . $_GET['unm'] . "'";
        $r = mysql_query($sql);
//        while ($row = mysql_fetch_array($r)) {
//            print_r($row);
//        }
//        echo ";bgcdgffg q";
        session_destroy();
//        echo "bhai " . $r . " bhai";
        if ($r == 1) {
                                    send_sms($_POST['phone'], "Dear user! you password has been reset. New password is $pass. Thank you!");

            ?>

            <script>
//                swal(,, "success", );
              swal({
                title: "Done",
                text:  "Your password has beeen reset and sent to mobile number ",
                icon: 'success',
                }).then(function(){window.location='login.php';});</script>  
            </script>

            <?php
//            send_sms($_POST['phone'], "Dear User! Your password has been reset for you account on pathologylaboratory.com. you new password is $pass. Thank you!");
        } else {
            ?>
            <script>
                swal("Ooops !", "Some error occured", "error");
            </script>

            <?php
        }
    }
}

if (isset($_GET) && isset($_GET['unm'])) {
    $unm = $_GET['unm'];

    if (!user_exists($unm)) {
        echo "<script>window.location.replace('error-page.php')</script>";
    } else {
        $sql = "select Contact_No, Email_Id from tbl_profile, tbl_user where tbl_profile.Person_Id = tbl_user.Person_Id and tbl_user.User_Name = '$unm'";
        $r = mysql_query($sql);

        while ($row = mysql_fetch_array($r)) {
            $phone = $row[0];
            $email = $row[1];
            $e = explode("@", $email);
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
        }

        $sc = strlen($e[0]) - 4;
        $eml = "";
        for ($i = 0; $i < $sc; $i++) {
            $eml = $eml . "*";
        }
        $eml = $eml . substr($e[0], -4) . "@" . $e[1];
    }
} else {
    if (!isset($_POST['rp'])) {
        echo "<script>window.location.replace('error-page.php')</script>";
    }
}
?>
<form method="post" action="#">
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
                                    <h3 class="mb20">Please fill the details to reset password</h3>
                                </div>
                                <div class="form-group" style="padding-bottom:15px;">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group username <?php echo (isset($errors["phone"]) && !empty($errors["UserName"])) ? 'has-error' : ''; ?>">
                                                <div class="col-md-12">
                                                    <label class="control-label" for="phone"><?php echo "Please Enter complete phone no " . "******" . substr($phone, 6, 1) . "*" . substr($phone, 8) ?> </label>

                                                    <input id="phone" name="phone" type="number" placeholder="Enter complete phone no" class="form-control input-md" >
                                                    <?php echo output_errors($errors["phone"]) ?>
                                                    <div id="error_msg"></div>
                                                </div>
                                            </div>
                                            <div class="form-group <?php echo (isset($errors["email"]) && !empty($errors["Password"])) ? 'has-error' : ''; ?>">
                                                <div class="col-md-12">
                                                    <label class="control-label" for="email"><?php echo "Please Enter complete email " . $eml ?></label>
                                                    <input id="email" name="email" type="email" placeholder="Enter complete email" class="form-control input-md" >
                                                    <?php echo output_errors($errors["email"]) ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
    <!--                                        <input type="submit" name="submit" class="btn btn-primary form-control" id="next" value="Next">-->
                                                    <input type="submit" class="btn btn-primary form-control btn-block " id="rp" name="rp" style="margin-right: 5px;" value="Submit">

                                                </div>
                                            </div>
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
</form>
<script>
    $(document).ready(function ()
    {

    });
</script>


<?php include 'includes/overall/footer.php'; ?>
        