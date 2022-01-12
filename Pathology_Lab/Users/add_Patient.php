<?php
include 'core/init.php';
protect_page();
has_permission(3);
include 'includes/overall/header.php';
?>
<?php
if (isset($_POST) && !empty($_POST)) {
    //echo "hello";
    $requred_fields = array('FName', 'MName', 'LName', 'Email', 'Phone', 'Pincode', 'City', 'State','Gender','DOB2', 'Address');

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
    
    
    if(isset($errors) && empty($errors)){
        
        //echo "hello";
        $register_data = array(
            'FName' => ucwords($_POST['FName']),
            'MName' => ucwords($_POST['MName']),
            'LName' => ucwords($_POST['LName']),
            'DOB' => $_POST['DOB2'],
            'Pincode' => $_POST['Pincode'],
            'City' => ucwords($_POST['City']),
            'State' => ucwords($_POST['State']),
            'Email' => $_POST['Email'],
            'Phone' => $_POST['Phone'],
            'Address' => $_POST['Address'],
            'City_Id' =>$_POST['hidden1'],
            'Gender'=>$_POST['Gender']
        );
        //print_r($register_data);die();
        $_SESSION['Patient_insert_data'] = $register_data;
        //echo "hello";
        //echo $user_data['Laboratory_Id'];
        //$pnt=add_patient(3,$user_data['Laboratory_Id']);
        //echo $pnt;
        //$sc=patient_register();
        //echo "<script>alert($pnt);</script>";
        header("Location:add_patient_disease.php") or die("not save");
        //echo "hello";
        exit();
    }
}
?>
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
                                <h2 class="mb20">Add Patient</h2>
                            </div>
                            <form class="form-horizontal" method="post">
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["FName"]) && !empty($errors["FName"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Name"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="FName" type="text" placeholder="Patient First Name" class="form-control input-md">
                                        <?php echo output_errors($errors["FName"])?>
                                    </div>
                                    
                                </div>
                                <div class="form-group <?php echo (isset($errors["MName"]) && !empty($errors["MName"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="MName"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="MName" type="text" placeholder="Patient Middle Name" class="form-control input-md">
                                        <?php echo output_errors($errors["MName"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["LName"]) && !empty($errors["LName"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LName"> </label>
                                    <div class="col-md-12">
                                        <input id="Name" name="LName" type="text" placeholder="Patient Last Name" class="form-control input-md">
                                        <?php echo output_errors($errors["LName"])?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["Email"]) && !empty($errors["Email"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Email"> </label>
                                    <div class="col-md-12">
                                        <input id="Email" name="Email" type="email" placeholder="Patient Email Address" class="form-control input-md">
                                        <?php echo output_errors($errors["Email"])?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["Phone"]) && !empty($errors["Phone"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Phone"> </label>
                                    <div class="col-md-12">
                                        <input id="Phone" name="Phone" type="text" maxlength="10"  placeholder="Patient Contact No" class="form-control input-md">
                                        <?php echo output_errors($errors["Phone"])?>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group <?php echo (isset($errors["Pincode"]) && !empty($errors["Pincode"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Pincode"> </label>
                                    <div class="col-md-12">
                                        <input id="Pincode" name="Pincode" type="text" placeholder="Pincode" class="form-control input-md">
                                        <?php echo output_errors($errors["Pincode"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["City"]) && !empty($errors["City"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="City"> </label>
                                    <div class="col-md-12">
                                        <input id="City" name="City" type="text" placeholder="City" class="form-control input-md">
                                        <?php echo output_errors($errors["City"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["State"]) && !empty($errors["State"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="State"> </label>
                                    <div class="col-md-12">
                                        <input id="State" name="State" type="text" placeholder="State" class="form-control input-md" >
                                        <?php echo output_errors($errors["State"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["Gender"]) && !empty($errors["Gender"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Gender"> </label>
                                    <div class="col-md-12">
                                        <select id="Gender" name="Gender" class="form-control" required>
                                            
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            
                                        </select>
                                        <?php echo output_errors($errors["Gender"])?>
                                    </div>  
                                        
                                    
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["DOB2"]) && !empty($errors["DOB2"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="datepicker"> </label>
                                    <div class="col-md-12" style="margin-bottom:2%;">
                                        <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" type="text" id="dob" name="DOB1" value="" readonly placeholder="Patient Date Of Birth">
                                            <span class="input-group-addon" style="border-top-right-radius:4px; border-bottom-right-radius:4px;"><i class="fa fa-calendar"></i></span>
                                            <input type="hidden" id="dtp_input2" name="DOB2" value="" />
                                            
                                        </div>
                                        <?php echo output_errors($errors["DOB2"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["Address"]) && !empty($errors["Address"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="address"> </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="address" name="Address" rows="4" placeholder="Address"></textarea>
                                        <?php echo output_errors($errors["Address"])?>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="singlebutton" name="SButton" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>
                                <input type="hidden" id="hidden1" name="hidden1" value="">
                            </form>
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
        /*jQuery("#singlebutton").click(function(){
              var dob=jQuery("#dtp_input2").val();
              dofb = new Date(dob);
              var today= new Date();
              var age = Math.floor((today-dofb) / (365.25 * 24 * 60 * 60 * 1000));
              $('#age').val(age);
              alert(age);
          });*/
          
    });
</Script>
<?php
include 'includes/overall/footer.php';
?>

