<?php

function email($to,$subject,$body){
    mail($to, $subject, $body,'From: hardik@hardikmail.cc.cc');
}

function logged_in_redirect()
{
    if(logged_in() === true){
        header("Location:index");
        exit();
    }
}

function protect_page()
{
    if(logged_in() === false){
        header("Location:login");
        exit();
    }
}

function has_permission()
{
    $func_get_args = func_get_args();
    
    if(!in_array($_SESSION['Type_Id'],$func_get_args))
    {
        header("Location: protect");
    }
}


function get_password()
{
    $sql="select Password from tbl_user where User_Id = " . $_SESSION['User_Id'];
    //$count=mysql_result(mysql_query($sql),0,0);
    
    return mysql_result(mysql_query($sql),0,0);
}

function sanitize($data)
{
    return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function array_sanitize(&$item)
{
    $item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function output_errors($errors)
{
    return (isset($errors) && !empty($errors)) ? '<ul><li>'.  implode('</li><li>', $errors) .'</li></ul>' : '';
}
function send_sms($mobileno = "9408282696", $sms_text = "test sms") {
    $ch = curl_init();
    $user = "ytrivedi1@hotmail.com:sms123";
    $receipientno = $mobileno;
    $senderID = "TEST SMS";
    $msgtxt = $sms_text;
//    http://api.mvaayoo.com/mvaayooapi/MessageCompose?user=ytrivedi1@hotmail.com:sms123&senderID=TEST SMS&receipientno=" + mb + "&dcs=0&msgtxt="+msg+"&state=4
    curl_setopt($ch, CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=+91$receipientno&dcs=0&msgtxt=$msgtxt&state=4");
    $buffer = curl_exec($ch);
    
    curl_close($ch);
}
?>
