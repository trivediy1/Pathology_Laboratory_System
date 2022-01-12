<?php
include 'core/init.php';
//protect_page();
//has_permission(3);
include 'includes/overall/header.php';
?>
<?php
if (isset($_POST) && !empty($_POST)) {
    
    $requred_fields = array('FName', 'MName', 'LName', 'Email', 'Phone', 'Pincode', 'City', 'State', 'Gender', 'DOB2', 'Address');

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
            
        }
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
    $from = new DateTime($_POST["DOB2"]);
    $to = new DateTime('today');
    $age = $from->diff($to)->y;
    if ($age <= 18) {
        $errors["DOB2"][] = 'Owner must be 18 years old';
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
        echo "<br> " . $_POST['Picture'];
        $check = getimagesize($_FILES["Picture"]["tmp_name"]);
        $errors['Picture'][] = getimagesize($_FILES["Picture"]["tmp_name"]);

        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $errors['Picture'][] = 'please upload a image file type JPEG/PNG/JPGl..';
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["Picture"]["size"] > 500000) {
        $errors['Picture'][] = 'File Size too big';
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JPG") {
        $errors['Picture'][] = 'please upload a image file type JPEG/PNG/JPG';
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors['Picture'][] = 'File Cannot be uploadedd';
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
        //echo "hello";
        $register_data = array(
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
        //print_r($register_data);die();
        $_SESSION['Personal_data'] = $register_data;
        echo "<br><br><br><br><br>fdsfd<br><br><br><br>";
        //echo "hello";
        header("Location: Lab_registration") or die("not save");
        //echo "hello";
        exit();
    }
}
?>
<form method="POST" action="#" enctype="multipart/form-data" class="form-horizontal" >
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
                                    <h2 class="mb20">Registration</h2>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["FName"]) && !empty($errors["FName"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="Name"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="FName" type="text" placeholder="Your First Name" class="form-control input-md">
<?php echo output_errors($errors["FName"]) ?>
                                    </div>

                                </div>
                                <div class="form-group <?php echo (isset($errors["MName"]) && !empty($errors["MName"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="MName"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="MName" type="text" placeholder="Your Middle Name" class="form-control input-md">
<?php echo output_errors($errors["MName"]) ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["LName"]) && !empty($errors["LName"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="LName"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="LName" type="text" placeholder="Your Last Name" class="form-control input-md">
<?php echo output_errors($errors["LName"]) ?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["Email"]) && !empty($errors["Email"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="Email"> </label>
                                    <div class="col-md-12">
                                        <input id="Email" name="Email" type="email" placeholder="Email Address" class="form-control input-md">
<?php echo output_errors($errors["Email"]) ?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["Phone"]) && !empty($errors["Phone"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="Phone"> </label>
                                    <div class="col-md-12">
                                        <input id="Phone" name="Phone" type="text" placeholder="Contact No" class="form-control input-md">
<?php echo output_errors($errors["Phone"]) ?>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group <?php echo (isset($errors["Pincode"]) && !empty($errors["Pincode"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="Pincode"> </label>
                                    <div class="col-md-12">
                                        <input id="Pincode" name="Pincode" type="text" placeholder="Pincode" class="form-control input-md">
<?php echo output_errors($errors["Pincode"]) ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["City"]) && !empty($errors["City"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="City"> </label>
                                    <div class="col-md-12">
                                        <input id="City" name="City" type="text" placeholder="City" class="form-control input-md">
<?php echo output_errors($errors["City"]) ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["State"]) && !empty($errors["State"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="State"> </label>
                                    <div class="col-md-12">
                                        <input id="State" name="State" type="text" placeholder="State" class="form-control input-md" >
<?php echo output_errors($errors["State"]) ?>
                                    </div>
                                </div>

                                <div class="form-group <?php echo (isset($errors["Gender"]) && !empty($errors["Gender"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="Gender"> </label>
                                    <div class="col-md-12">
                                        <select id="Gender" name="Gender" class="form-control" required="true">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
<?php echo output_errors($errors["Gender"]) ?>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["DOB2"]) && !empty($errors["DOB2"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="datepicker"> </label>
                                    <div class="col-md-12" style="margin-bottom:2%;">
                                        <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" type="text" name="DOB1" value="" readonly>
                                            <span class="input-group-addon" style="border-top-right-radius:4px; border-bottom-right-radius:4px;"><i class="fa fa-calendar"></i></span>
                                            <input type="hidden" id="dtp_input2" name="DOB2" value="" />
                                        </div>
<?php echo output_errors($errors["DOB2"]) ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["Address"]) && !empty($errors["Address"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="address"> </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="address" name="Address" rows="4" placeholder="Address"></textarea>
<?php echo output_errors($errors["Address"]) ?>
                                    </div>
                                </div>
                                <div  class="form-group <?php echo (isset($errors["Picture"]) && !empty($errors["Picture"])) ? 'has-error' : ''; ?>">
                                    <div class="col-md-12">

                                        <input name="Picture" id="Picture" type="file" placeholder="Upload Picture" class="form-control">
<?php echo output_errors($errors["Picture"]); ?>
                                        <div id="picture_error_msg"></div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="singlebutton" name="SButton" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>
                                <input type="hidden" id="hidden1" name="hidden1" value="">

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
</form>
<Script>
    jQuery(document).ready(function () {
        jQuery("#Pincode").change(function () {

            var pcode = $(this).val();
            jQuery.ajax({
                url: "userapi.php",
                method: "post",
                data: {pincode: pcode},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    jQuery("#City").val(obj['City_Name']);
                    jQuery("#State").val(obj['State_Name']);
                    jQuery("#hidden1").val(obj['City_Id']);
                    //alert(pdata);
                }

            });
        });
    });
</Script>
<?php
include 'includes/overall/footer.php';
?>

