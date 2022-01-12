<?php

function recover($mode, $email) {
    $mode = sanitize($mode);
    $email = sanitize($email);

    $user_data = user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');

    if (mode == 'username') {
        email($email, "Your Username", "Hello {$user_data['first_name']}.\n\nYour username is: {$user_data['username']}.\n\n-hardik shah");
    } else if (mode == 'password') {
        $gendrated_password = substr(md5(rand(999, 999999)), 0, 8);
        change_password($user_data['user_id'], $gendrated_password);
        email($email, "Your Password Recover:", "Hello {$user_data['first_name']}.\n\nYour New Password is: $gendrated_password\n\n-hardik shah");
    }
}

function update_user($update_data) {

    global $sesstion_user_id;

    $update = array();
    array_walk($update_data, 'array_sanitize');

    foreach ($update_data as $field => $data) {
        $update[] = "`$field` = '$data'";
    }

    mysql_query("UPDATE tbl_user SET " . implode(",", $update) . " WHERE user_id = $sesstion_user_id");
}

function activate($email, $email_code) {
    $email = mysql_real_escape_string($email);
    $email_code = mysql_real_escape_string($email_code);

    if (mysql_result(mysql_query("SELECT COUNT(User_Id) FROM tbl_user WHERE email = '$email' AND email_code = '$email_code' AND Active = 0"), 0) == 1) {
        //update user to active status
        mysql_query("UPDATE tbl_user SET Active = 1 WHERE email='$email'");
        return true;
    } else {
        return false;
    }
}

function change_password($password) {
    $user_id = $_SESSION['User_Id'];
    $password = md5($password);

    return mysql_query("UPDATE tbl_user SET Password = '$password' WHERE user_id = $user_id");
}

/* function register_user($register_data)
  {
  array_walk($register_data, 'array_sanitize');
  $register_data['password'] = md5($register_data['password']);

  $fields = implode(',', array_keys($register_data));
  $data = '\''.implode('\',\'', $register_data).'\'';

  mysql_query("INSERT INTO tbl_user ($fields) VALUES ($data)");

  email($register_data['email'], 'Activate your account', "Hello {$register_data['first_name']}".",\n\nyou need to activate your account,so use link below:\n\nhttp://localhost/Login/activate.php?email={$register_data['email']}&email_code={$register_data['email_code']}\n\n-hardik shah");
  } */

function user_count() {
    return mysql_result(mysql_query("SELECT COUNT(user_id) FROM tbl_user WHERE Active = 1"), 0);
}

function user_data($user_id) {
    $data = array();
    $user_id = (int) $user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 0) {
        unset($func_get_args[0]);

        $fields = implode(',', $func_get_args);

        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM tbl_laboratory WHERE User_Id = $user_id"));

        return $data;
    }
}

function logged_in() {
    //echo "<script>alert({$_SESSION['User_Id']});</script>";
    //echo "<script>alert({$_SESSION['Type_Id']});</script>";
    //echo $_SESSION['User_Id']."  ".$_SESSION['Type_Id'];
    return ((isset($_SESSION['Type_Id']) && !empty($_SESSION['Type_Id'])) && (isset($_SESSION['User_Id']) && !empty($_SESSION['User_Id']))) ? true : false;
}

function user_exists($username) {
    $username = sanitize($username);
    $myquery = "SELECT COUNT(User_Id) FROM tbl_user WHERE User_Name = '$username'";
    $qurey = mysql_query($myquery);
    return (mysql_result($qurey, 0) == 1) ? true : false;
}

function email_exists($email) {
    $email = sanitize($email);
    $qurey = mysql_query("SELECT COUNT(Person_Id) FROM tbl_profile WHERE Email_Id = '$email'");
    return (mysql_result($qurey, 0) == 1) ? true : false;
}

function email_exists_lab($email) {
    $email = sanitize($email);
    $qurey = mysql_query("SELECT COUNT(Laboratory_Id) FROM tbl_laboratory WHERE Email_Id = '$email'");
    return (mysql_result($qurey, 0) == 1) ? true : false;
}

function user_active($username) {
    $username = sanitize($username);
    //$uid=user_id_from_username($username);
    //echo $username."   ".$uid;
    $qurey = mysql_query("SELECT COUNT(*) FROM tbl_user WHERE User_Name = '$username' AND Active = 1");
    return (mysql_result($qurey, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
    $username = sanitize($username);
    return mysql_result(mysql_query("SELECT User_Id FROM tbl_user WHERE User_Name = '$username' "), 0);
}

function username_from_user_id($uid) {
    $username = sanitize($username);
    return mysql_result(mysql_query("SELECT User_Name FROM tbl_user WHERE User_Id = '$uid' "), 0);
}

function user_id_from_email($email) {
    $email = sanitize($email);
    return mysql_result(mysql_query("SELECT User_Id FROM tbl_user WHERE email = '$email' "), 0, 'User_Id');
}

function login($username, $password) {
    $user_id = user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    $uid = (mysql_result(mysql_query("SELECT COUNT(User_Id) FROM tbl_user WHERE User_Name = '$username' AND Password = '$password'"), 0) == 1) ? $user_id : false;

    $sql = "select Type_Id from tbl_user where User_Id=$uid";
    $utype = mysql_result(mysql_query($sql), 0, 'Type_Id');

    $uarray = array("uid" => $uid, "utype" => $utype);

    return $uarray;
}

function profile_register($pdata) {
    array_walk($pdata, 'array_sanitize');
    //$register_data['password'] = md5($register_data['password']);

    $fields = implode(',', array_keys($pdata));
    $data = '\'' . implode('\',\'', $pdata) . '\'';

    mysql_query("INSERT INTO tbl_profile ($fields) VALUES ($data)");
    $pid = mysql_result(mysql_query("select max(Person_Id) from tbl_profile"), 0);

    return $pid;
}

function user_registration($udata) {
    array_walk($udata, 'array_sanitize');
    $udata['Password'] = md5($udata['Password']);

    $fields = implode(',', array_keys($udata));
    $data = '\'' . implode('\',\'', $udata) . '\'';

    $rtn = mysql_query("INSERT INTO tbl_user ($fields) VALUES ($data)");
    $uid = mysql_result(mysql_query("select max(User_Id) from tbl_user"), 0);
    return $uid;
}

function lab_register($ldata) {
    array_walk($ldata, 'array_sanitize');
    //$register_data['password'] = md5($register_data['password']);

    $fields = implode(',', array_keys($ldata));
    $data = '\'' . implode('\',\'', $ldata) . '\'';

    $rtn = mysql_query("INSERT INTO tbl_laboratory ($fields) VALUES ($data)");
    //$pid=mysql_result(mysql_query("select max(User_Id) from tbl_user"),0);
    return $rtn;
}

function check_city($Acity) {
    $cid = "";
    $cname = sanitize($Acity['City']);
    $sname = sanitize($Acity['State']);
    $pin = sanitize($Acity['Pincode']);

    $sql5 = "select City_Id from tbl_city where Pincode=$pin";
    $cid = mysql_result(mysql_query($sql5), 0, 'City_Id');
    //echo "City id =$cid";
    if (empty($cid)) {

        $sql = "select State_Id from tbl_state where State_Name='{$Acity['State']}'";

        $st = mysql_result(mysql_query($sql), 0, 'State_Id');

        if (!empty($st)) {
            $sql1 = "insert into tbl_city values('','{$Acity['City']}',$st,{$Acity['Pincode']})";
            $x = mysql_query($sql1);
        } else {
            $sql1 = "insert into tbl_State values('','{$Acity['State']}')";
            //echo "$sql1";
            //die();
            mysql_query($sql1);
            $sql2 = "select State_Id from tbl_State where State_Name='{$Acity['State']}'";
            $sid = mysql_result(mysql_query($sql), 0, 'State_id');

            $sql3 = "insert into tbl_city values('','{$Acity['City']}',$sid,{$Acity['Pincode']})";
            if (mysql_query($sql3)) {
                echo "<script>alert(State,City Inserterd)</scirpt>";
            }
        }
        $sql4 = "select City_Id from tbl_city where Pincode={$Acity['Pincode']}";
        $cid = mysql_result(mysql_query($sql4), 0, 'City_Id');
    }

    return $cid;
}

function register() {
    if (!empty($_SESSION['Personal_data']) && !empty($_SESSION['Lab_data'])) {
        $personal_data = $_SESSION['Personal_data'];
        $lab_data = $_SESSION['Lab_data'];

        $cid = $personal_data['City_Id'];
        //echo $cid;
        if (empty($cid)) {
            $Acity = array("Pincode" => $personal_data['Pincode'], "City" => $personal_data['City'], "State" => $personal_data['State']);
            $cid = check_city($Acity);
        }

        $pdata = array("First_Name" => $personal_data['FName'], "Middle_Name" => $personal_data['MName'], "Last_Name" => $personal_data['LName'], "Gender" => $personal_data['Gender'], "Date_Of_Birth" => $personal_data['DOB'], "City_Id" => $cid, "Email_Id" => $personal_data['Email'], "Contact_No" => $personal_data['Phone'], "Address" => $personal_data['Address'], "Picture" => $personal_data["Picture"]);
        $pid = profile_register($pdata);


        $cid = $lab_data['City_Id'];
        if (empty($cid)) {
            $Acity = array("Pincode" => $lab_data['Pincode'], "City" => $lab_data['City'], "State" => $lab_data['State']);
            $cid = check_city($Acity);
        }

        //echo "City id= $cid";

        $udata = array("User_Name" => $lab_data['UserName'], "Password" => $lab_data['Password'], "Type_Id" => 3, "Person_Id" => $pid);
        $uid = user_registration($udata);

        //echo "User Id = ".$uid;die();
        $ldata = array("Laboratory_Name" => $lab_data['Name'], "Address" => $lab_data['Address'], "City_Id" => $cid, "Email_id" => $lab_data['Email'], "Contact_No" => $lab_data['Phone'], "User_id" => $uid);
        $rtn = lab_register($ldata);

        return ($rtn) ? true : false;
        //$pdata = array("$rtn" => $rtn);
        //echo json_encode($pdata);
    }
}

function check_person($Email, $FName, $MName, $LName) {
    $sql = "select count(Person_Id) from tbl_profile where Email_Id='$Email' and First_Name='$Email' and Middle_Name='$MName' and Last_Name='$LName'";
    $rl = (mysql_result(mysql_query($sql), 0) == 1) ? true : false;

    if ($rl) {
        $sql = "select Person_Id from tbl_profile where Email_Id='$Email' and First_Name='$Email' and Middle_Name='$MName' and Last_Name='$LName'";
        $rl = mysql_result(mysql_query($sql), 0, 'Person_id');
    }
    return $rl;
}

function patient_register() {

    $personal_data = $_SESSION['Patient_insert_data'];
    send_sms($personal_data['Phone'], "Your application of medical test is applied successfull. From Pathology.Lab");
    $pid = check_person($personal_data['Email'], $personal_data['FName'], $personal_data['MName'], $personal_data['LName']);

    if (isset($pid) && empty($pid)) {
        $cid = $personal_data['City_Id'];
        //echo $cid;
        if (empty($cid)) {
            $Acity = array("Pincode" => $personal_data['Pincode'], "City" => $personal_data['City'], "State" => $personal_data['State']);
            $cid = check_city($Acity);
        }

        $pdata = array("First_Name" => $personal_data['FName'], "Middle_Name" => $personal_data['MName'], "Last_Name" => $personal_data['LName'], "Gender" => $personal_data['Gender'], "Date_Of_Birth" => $personal_data['DOB'], "City_Id" => $cid, "Email_Id" => $personal_data['Email'], "Contact_No" => $personal_data['Phone'], "Address" => $personal_data['Address']);
        array_walk($pdata, 'array_sanitize');
        //$register_data['password'] = md5($register_data['password']);

        $fields = implode(',', array_keys($pdata));
        $data = '\'' . implode('\',\'', $pdata) . '\'';

        mysql_query("INSERT INTO tbl_profile ($fields) VALUES ($data)");
        $sql = "select max(Person_Id) from tbl_profile";
        $pid = mysql_result(mysql_query($sql), 0);
    }
    return $pid;
}

function add_patient($sc, $lid) {
    //echo $sc,$lid;
    $sql = "select count(Patient_Id) from tbl_patient where Person_id=$sc and Laboratory_Id=$lid";
    $rl = (mysql_result(mysql_query($sql), 0) == 1) ? true : false;

    if ($rl) {
        $sql = "select Patient_Id from tbl_patient where Person_id=$sc and Laboratory_Id=$lid";
        $rl = mysql_result(mysql_query($sql), 0, patient_Id);
    } else {
        $fdate = date('Y-m-d');

        $sql = "insert into tbl_patient (Person_Id,First_Arrival_Date,Laboratory_Id) values($sc,'$fdate',$lid)";
        //echo $sql;die();
        if (mysql_query($sql)) {
            $sql = "select max(Patient_Id) from tbl_patient";
            $rl = mysql_result(mysql_query($sql), 0);
        } else {
            $rl = false;
        }
    }
    return $rl;
}

function get_payment($lid, $from_date = 0, $to_date = 0) {

    if (empty($from_date) && empty($to_date)) {
        $sql = "select * from tbl_payment where Laboratory_Id=$lid";
    } else {
        $sql = "select * from tbl_payment where Laboratory_Id=$lid and Date_Of_Payment between '$from_date' and '$to_date'";
    }

    $rs = mysql_query($sql);
    $i = 1;
    $thbody = "<table id='example1' class='table table-bordered table-striped'>
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Paid Amount</th>
                            <th>Date Of Payment</th>
                        </tr>
                        </thead>
                        <tbody>";
    while ($k = mysql_fetch_assoc($rs)) {
        $thbody .= "<tr><td>" . $i++ . "</td><td>{$k['Amount']}</td><td>{$k['Date_Of_Payment']}</td></tr>";
    }
    $thbody .= "</tbody></table>";


    return $thbody;
}

function get_confirm_madical_report($lid, $from_date = 0, $to_date = 0) {

    if (empty($from_date) && empty($to_date)) {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, a.Contact_No, d.City_Name, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id and e.Status_Id=4 and f.Laboratory_Id=$lid";
    } else {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, a.Contact_No, d.City_Name, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id and f.Laboratory_Id=$lid and e.Status_Id=4 and e.Sample_Arrival_Date between '$from_date' and '$to_date'";
    }

    $rs = mysql_query($sql);
    $i = 1;
    $thbody = "<table id='example1' class='table table-bordered table-striped'>
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Patient Name</th>
                            <th>City</th>
                            <th>Contact No.</th>
                            <th>Disease</th>
                            <th>Status</th>
                            <th>Print</th>
                        </tr>
                        </thead>
                        <tbody>";
    while ($k = mysql_fetch_assoc($rs)) {
        $thbody .= "<tr><td>" . $i++ . "</td><td>{$k['Name']}</td><td>{$k['City_Name']}</td><td>{$k['Contact_No']}</td><td>{$k['ds_name']}</td><td>{$k['Status_Type']}</td>";
        $thbody .= "<td><button type='button' name='print_report' id='print_report' dataprint='1' data-id='{$k['Checkup_Detail_Id']}' class='btn btn-primary btn-sm'><i class='fa fa-print'></button></td></tr>";
    }
    $thbody .= "</tbody></table>";


    return $thbody;
}

function get_all_madical_report($lid, $from_date = 0, $to_date = 0) {

    if (empty($from_date) && empty($to_date)) {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, a.Contact_No, d.City_Name, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id and f.Laboratory_Id=$lid order by c.Status_Id";
    } else {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, a.Contact_No, d.City_Name, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id and f.Laboratory_Id=$lid and e.Sample_Arrival_Date between '$from_date' and '$to_date' order by c.Status_Id";
        //echo $sql;die();
    }



    $rs = mysql_query($sql);
    $i = 1;
    $thbody = "<table id='example1' class='table table-bordered table-striped'>
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Patient Name</th>
                            <th>City</th>
                            <th>Contact No.</th>
                            <th>Disease</th>
                            <th>Status</th>
                            
                        </tr>
                        </thead>
                        <tbody>";
    while ($k = mysql_fetch_assoc($rs)) {
        $thbody .= "<tr><td>" . $i++ . "</td><td>{$k['Name']}</td><td>{$k['City_Name']}</td><td>{$k['Contact_No']}</td><td>{$k['ds_name']}</td><td>{$k['Status_Type']}</td></tr>";
        //$thbody.="<td><button type='button' name='print_report' id='print_report' dataprint='1' data-id='{$k['Checkup_Detail_Id']}' class='btn btn-primary btn-sm'><i class='fa fa-print'></button></td></tr>";   
    }
    $thbody .= "</tbody></table>";


    return $thbody;
}

?>