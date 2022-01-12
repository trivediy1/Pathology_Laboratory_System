<?php
    session_start();
    error_reporting(1);
    ob_start();
    require 'database/connect.php';
    require 'function/general.php';
    require 'function/user.php';

    /*if(logged_in() === true)
    {
        $sesstion_user_id = $_SESSION['user_id'];
        $user_data = user_data($sesstion_user_id,'user_id','username','password','first_name','last_name','email');

        if(user_active($user_data['username']) === false)
        {
            session_destroy();
            header("Location: index.php");
        }
    }*/
    $errors = array();
    
?>