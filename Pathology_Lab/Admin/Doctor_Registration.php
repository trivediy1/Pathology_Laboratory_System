<?php
$title = "Doctor";
$page_title = "Doctor Registration";
$page_sub_title = "";
include "../Core/init.php";
protect_page();
has_permission(1);
include "Include/overall/header.php";
$fm_title = "Doctor Registration";
?>

<link href="dist/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="dist/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="dist/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>
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

    $requred_fields = array('username', 'pass', 'con_pass', 'FName', 'MName', 'LName', 'Email', 'Phone', 'Pincode', 'City', 'State', 'Gender', 'DOB2', 'Address');

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }

    if (preg_match('/\\s/', $_POST['username']) == true) {
        $errors["username"][] = "Your Name must not contain any spaces";
    }
    if ($_POST['pass'] != $_POST['con_pass']) {
        $errors[con_pass][] = "Both password must be same";
    }
    if (preg_match('/\\s/', $_POST['FName']) == true) {
        $errors["FName"][] = "Your Name must not contain any spaces";
    }

    if (preg_match('/\\s/', $_POST['MName']) == true) {
        $errors["MName"][] = "Your Name must not contain any spaces";
    }

    if (preg_match('/\\s/', $_POST['LName']) == true) {
        $errors["LName"][] = "Your Name must not contain any spaces";
    }

    if (email_exists($_POST['Email']) === true) {
        $errors["Email"][] = "Sorry,the email'{$_POST['Email']}' is alredy in use";
    }

    if (preg_match('/[0-9]{10}/', $_POST['Phone']) == false) {
        $errors["Phone"][] = "Please enter valid phone number";
    }
    if (preg_match('/[0-9]{6}$/', $_POST['Pincode']) == false) {
        $errors["Pincode"][] = "Please enter valid pincode ";
    }
    if (preg_match('/\\s/', $_POST['City']) == true) {
        $errors["City"][] = "Please enter valid city ";
    }
    if (preg_match('/\\s/', $_POST['State']) == true) {
        $errors["State"][] = "Please enter valid state ";
    }
    if (empty($_POST['DOB2']) === true) {
        $errors["DOB2"][] = "Please select the date of birth";
    }
    if (empty($_POST['Address']) === true) {
        $errors['Address'][] = 'Please enter the address';
    }
    $tmpdob = date("Y/m/d");
    if ($_POST['DOB2'] >= $tmpdob) {
        $errors["DOB2"][] = 'Date of birth must be less than today';
    }
    if (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors["Email"][] = 'A valid email address is requred';
    }

    $target_dir = "../images/";
    $target_file = $target_dir . substr(md5(time()), 0, 8) . "-" . basename($_FILES["Picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["Picture"])) {
        $check = getimagesize($_FILES["Picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $errors['Picture'][] = 'please upload a image file type JPEG/PNG/JPG';
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["Picture"]["size"] > 500000) {
        $errors['Picture'][] = 'File Size too big';

        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $errors['Picture'][] = 'please upload a image file type JPEG/PNG/JPG';
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors['Picture'][] = 'File Cannot be uploaded';
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["Picture"]["tmp_name"], $target_file)) {

//            echo "The file " . basename($_FILES["Picture"]["name"]) . " has been uploaded.";
            $fnm = $target_file;
        } else {
            $errors['Picture'][] = 'File Cannot be uploaded';
        }
    }

    if (isset($errors) && empty($errors)) {
        $register_data = array(
            'UserName' => $_POST['username'],
            'Password' => $_POST['pass'],
            'FName' => ucwords($_POST['FName']),
            'MName' => ucwords($_POST['MName']),
            'LName' => ucwords($_POST['LName']),
            'Gender' => $_POST['Gender'],
            'DOB' => $_POST['DOB2'],
            'Pincode' => $_POST['Pincode'],
            'City' => ucwords($_POST['City']),
            'State' => ucwords($_POST['State']),
            'Email' => $_POST['Email'],
            'Phone' => $_POST['Phone'],
            'Address' => $_POST['Address'],
            'City_Id' => $_POST['hidden1'],
            'Picture' => $fnm
        );
        //echo "<script>alert('hello');</script>";
        //print_r($register_data);die();
        $_SESSION['Doctor_data'] = $register_data;
        $sc = register();
        if ($sc) {
            send_sms($register_data['Phone'], "Dear Mr./Miss. " . $register_data['FName'] . " " . $register_data['LName'] . ", Your Registration as Pathologist is successfull at Pathology.Lab. Username : " . $register_data['UserName'] . ", Password : " . $register_data['Password'] . ". Thank You!");
            unset($_SESSION['Doctor_data']);
            echo "<script>swal({
                title: 'Good job!',
                text: 'Doctor Registration is Success',
                icon: 'success',
                }).then(function(){window.location='Test_Medical.php';});</script>";
            //swal("Thank You", "Register Successfully", "success");
            //header("Location:test.php");
        } else {
            unset($_SESSION['Doctor_data']);
            echo "<script>swal({
                title: 'Oops!',
                text: 'Doctor Registration Failed!',
                icon: 'error',
                }).then(function(){window.location='Doctor_Registration.php';});</script>";
        }
        //echo "hello";
        //header("Location:Test_Medical.php") or die("not save");
        //echo "hello";
    }
}
?>
<form method="POST" action="#" enctype="multipart/form-data">
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
                    <div class="form-group <?php echo (isset($errors["username"]) && !empty($errors["username"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="username">UserName</label>
                        <input id="username" name="username" type="text" placeholder="User Name" class="form-control input-md">
                        <?php echo output_errors($errors["FName"]); ?>
                        <div id="error_msg"></div>
                    </div>
                    <div class="form-group <?php echo (isset($errors["pass"]) && !empty($errors["pass"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="pass">Password</label>
                        <input id="pass" name="pass" type="password" placeholder="Password" class="form-control input-md"><div id="cpass"></div>
                        <?php echo output_errors($errors["pass"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["con_pass"]) && !empty($errors["con_pass"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="con_pass">Confirm Password</label>
                        <input id="con_pass" name="con_pass" type="password" placeholder="Confirm Password" class="form-control input-md"><div id="cconpass"></div>
                        <?php echo output_errors($errors["con_pass"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["FName"]) && !empty($errors["FName"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="FName">First Name</label>
                        <input id="FName" name="FName" type="text" placeholder="Your First Name" class="form-control input-md">
                        <?php echo output_errors($errors["FName"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["MName"]) && !empty($errors["MName"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="MName">Middle Name</label>
                        <input id="MName" name="MName" type="text" placeholder="Your Middle Name" class="form-control input-md">  
                        <?php echo output_errors($errors["MName"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["LName"]) && !empty($errors["LName"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="LName">Last Name</label>
                        <input id="LName" name="LName" type="text" placeholder="Your Last Name" class="form-control input-md">
                        <?php echo output_errors($errors["LName"]); ?>
                    </div>
                    <div class="form-group <?php echo (isset($errors["Address"]) && !empty($errors["Address"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="address">Address</label>

                        <textarea class="form-control" id="Address" name="Address" rows="4" placeholder="Address"></textarea>
                        <?php echo output_errors($errors["address"]); ?>


                    </div>

                    <div class="form-group <?php echo (isset($errors["Gender"]) && !empty($errors["Gender"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="Gender"> Gender </label>
                        <div class="col-md-12">
                            <select id="Gender" name="Gender" class="form-control" required="true">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <?php echo output_errors($errors["Gender"]) ?>
                        </div>
                    </div>


                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group <?php echo (isset($errors["DOB2"]) && !empty($errors["DOB2"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="datepicker">Birth Date</label>

                        <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" type="text" name="DOB1" value="" readonly>
                            <span class="input-group-addon" style="border-top-right-radius:4px; border-bottom-right-radius:4px;"><i class="fa fa-calendar"></i></span>
                            <input type="hidden" id="dtp_input2" name="DOB2" value="" />
                        </div>
                        <?php echo output_errors($errors["DOB2"]); ?>


                    </div>

                    <div class="form-group<?php echo (isset($errors["Email"]) && !empty($errors["Email"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="Email">Email-Id</label>

                        <input id="Email" name="Email" type="email" placeholder="Email Address" class="form-control input-md">
                        <?php echo output_errors($errors["Email"]); ?>
                        <div id="email_error_msg"></div>

                    </div>
                    <!-- Text input-->
                    <div class="form-group <?php echo (isset($errors["Phone"]) && !empty($errors["Phone"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="Phone">Contact No.</label>

                        <input id="Phone" name="Phone" type="text" placeholder="Contact No" class="form-control input-md">
                        <?php echo output_errors($errors["Phone"]); ?>


                    </div>
                    <!-- Select Basic -->
                    <div class="form-group <?php echo (isset($errors["Pincode"]) && !empty($errors["Pincode"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="Pincode">Pincode</label>

                        <input id="Pincode" name="Pincode" type="text" placeholder="Pincode" class="form-control input-md">
                        <?php echo output_errors($errors["Pincode"]); ?>


                    </div>
                    <div class="form-group <?php echo (isset($errors["City"]) && !empty($errors["City"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="City">City</label>

                        <input id="City" name="City" type="text" placeholder="City" class="form-control input-md">
                        <?php echo output_errors($errors["City"]); ?>


                    </div>
                    <div class="form-group <?php echo (isset($errors["State"]) && !empty($errors["State"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="State">State</label>

                        <input id="State" name="State" type="text" placeholder="State" class="form-control input-md" >
                        <?php echo output_errors($errors["State"]); ?>

                    </div>


                    <!-- Text input-->
                    <div style="margin-right:60%;" class="form-group <?php echo (isset($errors["Picture"]) && !empty($errors["Picture"])) ? 'has-error' : ''; ?>">
                        <label class="control-label" for="picture">Profile Picture</label>
                        <input name="Picture" id="Picture" type="file" placeholder="Upload Picture" class="form-control filename input-md">
                        <?php echo output_errors($errors["Picture"]); ?>
                        <div id="picture_error_msg"></div>

                    </div>

                    <!-- Button -->

                    <div class="box-footer">
                        <div>
                            <button type="submit" style="margin-right:5%;font-size:160%;" name="submit" id="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" style="font-size:160%;" name="reset" id="reset" class="btn btn-primary">Cancel</button>
                        </div>
                    </div>
                    <input type="hidden" id="hidden1" name="hidden1" value="">
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</form>

<Script>
    jQuery(document).ready(function () {
        jQuery(document).on('keypress','#pass',function(){
           jQuery("#cpass").append("<span id='result'></span>"); 
        });
        jQuery(document).on('keypress','#con_pass',function(){
           jQuery("#cconpass").append("<span id='cp'></span>"); 
        });
        jQuery("#Pincode").blur(function () {

            var pcode = $(this).val();
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {pincode: pcode},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    //alert("hello");
                    jQuery("#City").val(obj['City_Name']);
                    jQuery("#State").val(obj['State_Name']);
                    jQuery("#hidden1").val(obj['City_Id']);
                    //alert(pdata);
                }

            });
        });

        jQuery("#username").blur(function () {
            var uname = jQuery(this).val();
            //alert(uname);
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {username: uname},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    var exist = obj['exist'];
                    if (exist == 1)
                    {
                        //alert(exist);
                        $(".username").addClass("has-error");
                        $("#error_msg").html("<ul><li>Username is alredy exist</li></ul>");
                    } else
                    {
                        $(".username").removeClass("has-error");
                        $("#error_msg").html("");
                    }
                }
            });
        });
        jQuery("#Email").blur(function () {
            var email = jQuery(this).val();
            //alert(uname);
            jQuery.ajax({
                url: "adminapi.php",
                method: "post",
                data: {emailid: email},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    var exist = obj['exist'];
                    if (exist == 1)
                    {
                        //alert(exist);
                        $(".email").addClass("has-error");
                        $("#email_error_msg").html("<ul><li>This Email-Id is alredy exist</li></ul>");
                    } else
                    {
                        $(".email").removeClass("has-error");
                        $("#email_error_msg").html("");
                    }
                }
            });
        });


        jQuery("#Picture").blur(function ()
        {

            var image_name = $('#Picture').val();
            if (image_name == '')
            {
            } else
            {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'JPG', 'jpeg']) === -1)
                {
                    $(".Picture").addClass("has-error");
                    $("#picture_error_msg").html("<ul><li>Please upload a picture in proper format</li></ul>");
                }
            }
        });
        
        $('#pass').keyup(function () {
            $('#result').html(checkStrength($('#pass').val()))
        })

        $('#con_pass').keyup(function () {
            if ($('#pass').val() == $('#con_pass').val())
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
</Script>


<?php
include "Include/overall/footer.php";
?>