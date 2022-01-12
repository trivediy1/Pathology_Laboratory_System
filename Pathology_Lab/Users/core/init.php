<?php
    session_start();
    error_reporting(1);
    ob_start();
    require 'database/connect.php';
    require 'function/general.php';
    require 'function/user.php';
    //$user_data="";
    if(logged_in() === true)
    {
        
        $sesstion_user_id = $_SESSION['User_Id'];
        $user_data = user_data($sesstion_user_id,'Laboratory_Id','Laboratory_Name','Address','City_Id','Email_Id','Contact_No','Remaining_Amount');
        $usrname=username_from_user_id($sesstion_user_id);
        if(user_active($usrname) === false)
        {
            session_destroy();
            header("Location:login");
        }
        //print_r($user_data);
    }
    
    $errors = array();
    //$ary=array("FName"=>"Gautam","LName"=>"Purohit");
    //echo $ary["FName"];
    //$_SESSION['arya']=$ary;
?>