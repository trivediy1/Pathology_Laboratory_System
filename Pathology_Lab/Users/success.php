<?php

include "core/init.php";
protect_page();
has_permission(3);
include 'includes/overall/header.php';
?>

<?php

if (isset($_POST['status']) && !empty($_POST['status'])) {
    if (isset($_SESSION['payinfo']) && !empty($_SESSION['payinfo'])) {
        $payinfo = $_SESSION['payinfo'];
        $amount = $payinfo['amount'];
        $mobile = $payinfo['contact'];
        $paydate=date('Y-m-d');
        $sql = "insert into tbl_payment (Laboratory_Id,Amount,Date_Of_Payment) value({$user_data['Laboratory_Id']},$amount,'$paydate')";
        $rs=mysql_query($sql);
        if($rs)
        {
            $sql="update tbl_laboratory set Remaining_Amount=Remaining_Amount-$amount where Laboratory_Id={$user_data['Laboratory_Id']}";
            $rs1=mysql_query($sql);
        }
        if($rs1)
        {
            echo "<script>window.location.replace('PayUMoney_form?success')</script>";
        }
        else
        {
            echo "<script>window.location.replace('PayUMoney_form?falied')</script>";
        }
        
    }
 else {
        
    }
    //echo "<script>window.location.replace('PayUMoney_form.php?success')</script>";
}

$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$salt = "LomCBr4pmb";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);
if ($hash != $posted_hash) {
    echo "Invalid Transaction. Please try again";
} else {
    echo "<h3>Thank You. Your order status is " . $status . ".</h3>";
    echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
    echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
}
?>	
<?php include 'includes/overall/footer.php'; ?>