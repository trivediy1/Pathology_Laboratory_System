
<?php
include 'core/init.php';
protect_page();
has_permission(3);
include 'includes/overall/header.php';


if(!empty($_GET) && isset($_GET['success'])){
    echo "<script>swal({
        title: 'Payment!',
        text: 'Successfully Payment!',
        icon: 'success',
    }).then(function () {
        window.location = 'PayUMoney_form.php';
    });</script>";
}
if(!empty($_GET) && isset($_GET['falied']))
{
    echo "<script>swal({
                title: 'Oops!',
                text: 'Something went wrong!',
                icon: 'error',
                }).then(function(){window.location='PayUMoney_form.php';});</script>";
}
?>
<?php

$MERCHANT_KEY = "OjZqm9XB";
$SALT = "LomCBr4pmb";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}
$requiredfld = array("key", "txnid", "amount", "productinfo", "firstname", "email", "phone", "surl", "furl");

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requiredfld) === true) {
            $errors[$key][] = 'This Fields is required';
        }
    }

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
    $payinfo=array("contact"=>$_POST['phone'],"amount"=>$_POST['amount']);
    $_SESSION['payinfo']=$payinfo;
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
  $_SESSION['contact']=$_POST['phone'];
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
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
                                <h2 class="mb20">Payment</h2>
                            </div>
                            <form class="form-horizontal" action="<?php echo $action; ?>" method="post" name="payuForm" id="payform">
                                <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                                <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                <div class="form-group amt <?php echo (isset($errors["amount"]) && !empty($errors["amount"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="amount"> </label>
                                    <div class="col-md-12">
                                        <input id="amount" name="amount" type="text" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" placeholder="Amount To Pay" class="form-control input-md" >
                                        <?php echo output_errors($errors["amount"]) ?>
                                        <div id="error_msg"></div>
                                    </div>
                                </div>
                                <div class="form-group payinfo <?php echo (isset($errors["productinfo"]) && !empty($errors["productinfo"])) ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="productinfo"> </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="productinfo" name="productinfo" rows="4" placeholder="Remark"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
                                        <?php echo output_errors($errors["productinfo"]) ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["email"]) && !empty($errors["email"])) ? 'has-error' : ''; ?>">
                                    
                                    <div class="col-md-12">
                                        <input id="email" name="email" type="hidden" value="<?php echo (empty($user_data['Email_Id'])) ? '' : $user_data['Email_Id']; ?>" placeholder="Email Id" class="form-control input-md" >
                                        <?php echo output_errors($errors["email"]) ?>
                                        
                                    </div>
                                </div>
                                <div class="form-group <?php echo (isset($errors["firstname"]) && !empty($errors["firstname"])) ? 'has-error' : ''; ?>">
                                    
                                    <div class="col-md-12">
                                        <input id="firstname" name="firstname" type="hidden" value="<?php echo (empty($user_data['Laboratory_Name'])) ? '' : $user_data['Laboratory_Name']; ?>" placeholder="Laboratory name" class="form-control input-md" >
                                        <?php echo output_errors($errors["firstname"]) ?>
                                        
                                    </div>
                                </div>
                                <div class="form-group amount <?php echo (isset($errors["phone"]) && !empty($errors["phone"])) ? 'has-error' : ''; ?>">
                                    
                                    <div class="col-md-12">
                                        <input id="phone" name="phone" type="text" value="<?php echo $_POST['phone']; /*(empty($user_data['Contact_No'])) ? '' : $user_data['Contact_No'];*/ ?>" placeholder = "Conatct_No" class="form-control input-md" >
                                        <?php echo output_errors($errors["phone"]) ?>
                                        
                                    </div>
                                </div>
                                <div class="form-group amount <?php echo (isset($errors["surl"]) && !empty($errors["surl"])) ? 'has-error' : ''; ?>">
                                    
                                    <div class="col-md-12">
                                        <input id="surl" name="surl" type="hidden" value="http://localhost/Pathology_Lab/Users/success.php" class="form-control input-md" >
                                        <?php echo output_errors($errors["surl"]) ?>
                                        
                                    </div>
                                </div>
                                <div class="form-group amount <?php echo (isset($errors["furl"]) && !empty($errors["furl"])) ? 'has-error' : ''; ?>">
                                    
                                    <div class="col-md-12">
                                        <input id="furl" name="furl" type="hidden" value="http://localhost/Pathology_Lab/Users/failure.php" class="form-control input-md" >
                                        <?php echo output_errors($errors["furl"]) ?>
                                        
                                    </div>
                                </div>
                                <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        <button id="SButton" type="submit" name="SButton" class="btn btn-default btn-block">Submit</button>
                                    </div>
                                </div>

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
  </body>
<script>
    jQuery(document).ready(function () {
        jQuery("#amount").blur(function () {
            var amount = jQuery(this).val();
            var tmp = jQuery.isNumeric(amount);
            if (tmp)
            {
                //alert("success"+tmp);
                $(".amt").removeClass("has-error");
                $("#error_msg").html("");
                jQuery.ajax({
                    url:'userapi.php',
                    method:'post',
                    data:{"amount":amount},
                    success:function(pdata){
                        if(parseInt(pdata)<parseInt(amount))
                        {
                            jQuery("#amount").val(pdata);
                        }
                        
                    }
                    
                });

            } else
            {
                $(".amt").addClass("has-error");
                $("#error_msg").html("<ul><li>Enter Valid Amount</li></ul>");
                //alert("false"+tmp);

            }
        });
        
        


    });</script>
</html>
<?php
include 'includes/overall/footer.php';?>


