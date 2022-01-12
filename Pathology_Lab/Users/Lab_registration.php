<?php 
    
    include 'core/init.php';
    //protect_page();
    //has_permission(3);
    include 'includes/overall/header.php'; ?>
    
?>
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
    $requred_fields = array('UserName','Password','Con_Password','LabName','LabEmail', 'LabPhone', 'LabPincode', 'LabCity', 'LabState', 'LabAddress');

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requred_fields) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }
    
    if (preg_match('/\\s/', $_POST['UserName']) == true) {
        $errors["UserName"][] = "UserName must not contain any spaces";
    }
    if ($_POST['Password']!=$_POST['Con_Password']) {
        $errors["Con_Password"][] = "Both password must be same";
    }
    if (preg_match('/\\s/', $_POST['LabName']) == true) {
        $errors["LabName"][] = "Laboratory name must not contain any spaces";
    }
    if (email_exists_lab($_POST['LabEmail']) === true) {
        $errors["LabEmail"][] = "Sorry,the email'{$_POST['Email']}' is alredy in use";
    }
    
    if (preg_match('/[0-9]{10}/', $_POST['LabPhone']) == false) {
        $errors["LabPhone"][] = "Please enter valid phone number";
    }
    if (preg_match('/[0-9]{6}$/', $_POST['LabPincode']) == false) {
        $errors["LabPincode"][] = "Please enter valid pincode ";
    }
    if (preg_match('/\\s/', $_POST['LabCity']) == true) {
        $errors["LabCity"][] = "Please enter valid city ";
    }
    if (preg_match('/\\s/', $_POST['LabState']) == true) {
        $errors["LabState"][] = "Please enter valid state ";
    }
    if (empty($_POST['LabAddress']) === true) {
        $errors['Address'][] = 'Please enter the address';
    }
    if (filter_var($_POST['LabEmail'], FILTER_VALIDATE_EMAIL) === false) {
        $errors["LabEmail"][] = 'A valid email address is requred';
    }

    //print_r($errors);die();
    if (empty($errors)) {
        //echo "hello";
        $register_data = array(
            'UserName'=>$_POST['UserName'],
            'Password'=> $_POST['Password'],
            'Name' => ucwords($_POST['LabName']),
            'Email' => $_POST['LabEmail'],
            'Phone' => $_POST['LabPhone'],
            'Pincode' => $_POST['LabPincode'],
            'City' => ucwords($_POST['LabCity']),
            'State' => ucwords($_POST['LabState']),
            'Address' => $_POST['LabAddress'],
            'City_Id' =>$_POST['hidden1']
        );
        //print_r($register_data);
        /*print_r($register_data);
        echo "<br/><br/>";
        $aryr=$_SESSION['Personal_data'];
        print_r($aryr);
        die();*/
        $_SESSION['Lab_data'] = $register_data;
        $sc=register();
        if($sc)
        {
            send_sms($register_data['Phone'],"Dear User,  You registration of Pathology Laboratory '" . $register_data['Name'] . "' is successfull at Pathology.Lab. Thank You!");
            echo "<script>swal({
                title: 'Good job!',
                text: 'Lab Registration Successfull!!',
                icon: 'success',
                }).then(function(){window.location='index';});</script>";
            //swal("Thank You", "Register Successfully", "success");
            //header("Location:test.php");
        }
        else
        {
            echo "<script>swal({
                title: 'Oops!',
                text: 'Something went wrong!',
                icon: 'error',
                }).then(function(){window.location='redistration_laboratory';});</script>";
        }
        
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
                                <h2 class="mb20">Laboratory Details</h2>
                            </div>
                            <form class="form-horizontal" method="post">
                                <div class="form-group username <?php echo (isset($errors["UserName"]) && !empty($errors["UserName"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="UserName"> </label>
                                    <div class="col-md-12">
                                        <input id="UserName" name="UserName" type="text" placeholder="User Name" class="form-control input-md" >
                                        <?php echo output_errors($errors["UserName"])?>
                                        <div id="error_msg"></div>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["Password"]) && !empty($errors["Password"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Password"> </label>
                                    <div class="col-md-12">
                                        <input id="Password" name="Password" type="password" onkeypress="" placeholder="Password" class="form-control input-md" >
                                        <div id="cpass"><div>
                                        <?php echo output_errors($errors["Password"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["Con_Password"]) && !empty($errors["Con_Password"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="Con_Password"> </label>
                                    <div class="col-md-12">
                                        <input id="Con_password" name="Con_Password" type="password" onkeypress="" placeholder="Confirm Password" class="form-control input-md" >
                                        <div id="cconpass"></div>
                                        <?php echo output_errors($errors["Con_Password"])?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["LabName"]) && !empty($errors["LabName"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabName"> </label>
                                    <div class="col-md-12">
                                        <input id="LabName" name="LabName" type="text" placeholder="Laboratory Name" class="form-control input-md" >
                                        <?php echo output_errors($errors["LabName"])?>
                                    </div>
                                </div>
                                
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["LabEmail"]) && !empty($errors["LabEmail"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabEmail"> </label>
                                    <div class="col-md-12">
                                        <input id="LabEmail" name="LabEmail" type="email" placeholder="Email Address" class="form-control input-md" >
                                        <?php echo output_errors($errors["LabEmail"])?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group <?php echo (isset($errors["LabPhone"]) && !empty($errors["LabPhone"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabPhone"> </label>
                                    <div class="col-md-12">
                                        <input id="LabPhone" name="LabPhone" type="text" placeholder="Contact No" class="form-control input-md" >
                                        <?php echo output_errors($errors["LabPhone"])?>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group <?php echo (isset($errors["LabPincode"]) && !empty($errors["LabPincode"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabPincode"> </label>
                                    <div class="col-md-12">
                                        <input id="LabPincode" name="LabPincode" type="text" placeholder="Pincode" class="form-control input-md">
                                        <?php echo output_errors($errors["LabPincode"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["LabCity"]) && !empty($errors["LabCity"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabCity"> </label>
                                    <div class="col-md-12">
                                        <input id="LabCity" name="LabCity" type="text" placeholder="City" class="form-control input-md">
                                        <?php echo output_errors($errors["LabCity"])?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["LabState"]) && !empty($errors["LabState"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabState"> </label>
                                    <div class="col-md-12">
                                        <input id="LabState" name="LabState" type="text" placeholder="State" class="form-control input-md" >
                                        <?php echo output_errors($errors["LabState"])?>
                                    </div>
                                </div>
                                
                                <div class="form-group <?php echo (isset($errors["LabAddress"]) && !empty($errors["LabAddress"])) ? 'has-error' : '';?>">
                                    <label class="control-label" for="LabAddress"> </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="LabAddress" name="LabAddress" rows="4" placeholder="Address"></textarea>
                                        <?php echo output_errors($errors["LabAddress"])?>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        <button id="SButton" name="SButton" class="btn btn-default btn-block">Submit</button>
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
        jQuery(document).on('keypress','#Password',function(){
           jQuery("#cpass").append("<span id='result'></span>"); 
        });
        jQuery(document).on('keypress','#Con_password',function(){
           jQuery("#cconpass").append("<span id='cp'></span>"); 
        });
        
        
        jQuery("#LabPincode").focusout(function () {
            var pcode = jQuery(this).val();
            jQuery.ajax({
                url: "userapi.php",
                method: "post",
                data: {pincode: pcode},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    jQuery("#LabCity").val(obj['City_Name']);
                    jQuery("#LabState").val(obj['State_Name']);
                    jQuery("#hidden1").val(obj['City_Id']);
                    //alert(pdata);
                   
                }
            });
        });
        
        jQuery("#UserName").blur(function(){
            var uname = jQuery(this).val();
            //alert(uname);
            jQuery.ajax({
                url: "userapi.php",
                method: "post",
                data: {username:uname},
                success: function (pdata) {
                    var obj = JSON.parse(pdata);
                    var exist=obj['exist'];
                    if(exist==1)
                    {
                        //alert(exist);
                        $(".username").addClass("has-error");
                        $("#error_msg").html("<ul><li>Username is alredy exist</li></ul>");
                    }else
                    {
                        $(".username").removeClass("has-error");
                        $("#error_msg").html("");
                    }
                }
            });
        });
        
        
        
        $('#Password').keyup(function () {
            $('#result').html(checkStrength($('#Password').val()))
        })

        $('#Con_password').keyup(function () {
            if ($('#Password').val() == $('#Con_password').val())
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

<?php include 'includes/overall/footer.php'; ?>