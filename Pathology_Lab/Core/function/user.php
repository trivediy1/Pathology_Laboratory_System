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

        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM tbl_user WHERE User_Id = $user_id"));

        return $data;
    }
}

function logged_in() {
    return (isset($_SESSION['User_Id']) && isset($_SESSION['Type_Id']) && !empty($_SESSION['User_Id']) && !empty($_SESSION['Type_Id'])) ? true : false;
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
    $qurey = mysql_query("SELECT COUNT(User_Id) FROM tbl_user WHERE User_Name = '$username' AND Active = 1");
    return (mysql_result($qurey, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
    $username = sanitize($username);
    return mysql_result(mysql_query("SELECT User_Id FROM tbl_user WHERE User_Name = '$username' "), 0, 'User_Id');
}

function user_id_from_email($email) {
    $email = sanitize($email);
    return mysql_result(mysql_query("SELECT User_Id FROM tbl_user WHERE email = '$email' "), 0, 'User_Id');
}

function login($username, $password) {
    $user_id = user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    return (mysql_result(mysql_query("SELECT COUNT(User_Id) FROM tbl_user WHERE User_Name = '$username' AND Password = '$password'"), 0) == 1) ? $user_id : false;
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

    $sql = "insert into tbl_user ($fields) values ($data)";

    mysql_query($sql);
    $sql1 = "select max(User_Id) from tbl_user";
    $uid = mysql_result(mysql_query($sql1), 0);

    return $uid;
}

/* function lab_register($ldata)
  {
  array_walk($ldata,'array_sanitize');
  //$register_data['password'] = md5($register_data['password']);

  $fields = implode(',', array_keys($ldata));
  $data = '\''.implode('\',\'', $ldata).'\'';

  $rtn=mysql_query("INSERT INTO tbl_laboratory ($fields) VALUES ($data)");
  //$pid=mysql_result(mysql_query("select max(User_Id) from tbl_user"),0);
  return $rtn;
  } */

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
    if (!empty($_SESSION['Doctor_data'])) {
        $Doctor_data = $_SESSION['Doctor_data'];
        $cid = $Doctor_data['City_Id'];

//echo $cid;
        if (empty($cid)) {
            $Acity = array("Pincode" => $Doctor_data['Pincode'], "City" => $Doctor_data['City'], "State" => $Doctor_data['State']);
            $cid = check_city($Acity);
        }
        $pdata = array("First_Name" => $Doctor_data['FName'], "Middle_Name" => $Doctor_data['MName'], "Last_Name" => $Doctor_data['LName'], "Gender" => $Doctor_data['Gender'], "Date_Of_Birth" => $Doctor_data['DOB'], "City_Id" => $cid, "Email_Id" => $Doctor_data['Email'], "Contact_No" => $Doctor_data['Phone'], "Address" => $Doctor_data['Address'], "Picture" => $Doctor_data['Picture']);

        $pid = profile_register($pdata);

        $udata = array("User_Name" => $Doctor_data['UserName'], "Password" => $Doctor_data['Password'], "Type_Id" => 2, "Person_Id" => $pid);

        $uid = user_registration($udata);
//                echo "<script>alert(uid : " . $sc . ")</script>";

        return (!empty($uid)) ? true : false;
//$pdata = array("$rtn" => $rtn);
//echo json_encode($pdata);
    }
}

function get_Labs() {
    $tbhtml = "";
    $i = 1;
    $sql = "select Laboratory_Id, Laboratory_Name, Email_id, Contact_No, City_Name from tbl_City, tbl_Laboratory where tbl_city.City_Id = tbl_Laboratory.City_Id";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='content' name='example1' border='2' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Laboratoty Id", "Laboratory Name", "Email Id", "Contact No", "City", "View"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }

    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];


        /* foreach ($row as $value) {
          $tbhtml .= "<td>$value</td>";
          } */
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>";
        $tbhtml .= "<td><button type='button' name='view' id='view' dataedit='1' data-id='$id' class=' btn btn-primary btn-sm' value='View Owner Information'><i class='fa fa-user-o'></button></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";
    return $tbhtml;
}

function get_Labs_Payment($from_date=0,$to_todate=0) {
    if (empty($from_date) && empty($to_date)) {
        $sql = "select a.Laboratory_Id, a.Laboratory_Name, a.Contact_No, a.Remaining_Amount,sum(b.Amount) as Paid_Amount from tbl_Laboratory as a,tbl_payment as b where a.Laboratory_Id=b.Laboratory_Id";
    } else {
        $sql = "select a.Laboratory_Id, a.Laboratory_Name, a.Contact_No, a.Remaining_Amount,sum(b.Amount) as Paid_Amount from tbl_Laboratory as a,tbl_payment as b where a.Laboratory_Id=b.Laboratory_Id and tbl_payment.Date_Of_Payment between '$from_date' and '$to_date'";
        //echo $sql;die();   
    }
    $tbhtml = "";
    $i = 1;
    //$sql = "select Laboratory_Id, Laboratory_Name, Contact_No, Remaining_Amount from tbl_Laboratory";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' name='example1' border='2' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Laboratoty Id", "Laboratory Name", "Contact No", "Remaining Amount","Paid Amount","View"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }

    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];


        /* foreach ($row as $value) {
          $tbhtml .= "<td>$value</td>";
          } */
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>";
        $tbhtml .= "<td><button type='button' name='view' id='view' dataedit='1' data-id='$id' class='btn btn-primary btn-sm' value='View Owner Information'><i class='fa fa-user-o'></button></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";
    return $tbhtml;
}

function get_diseases() {
    $tbhtml = "";
    $i = 1;
    $sql = "select ds_id,ds_name,price from tbl_disease_test";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Srno.", "Name", "Price", "Action"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];
        //$tbhtml .= "<tr>";

        /* foreach ($row as $value) {
          $tbhtml .= "<td>$value</td>";
          } */

        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td>";
        $tbhtml .= "<td><button type='button' class='btn btn-primary' dataedit='1' id='$id' data-id='$id'><i class='fa fa-pencil'></i></button><button type='button' datadelete='1' style='margin-left:5%;' class='delete btn btn-primary' id='$id' data-id='$id' name='delete'><i class='fa fa-trash-o'></i></button></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function getbills() {
    $tbhtml = "";
    $i = 1;
    $sql = "select Bill_Id,"
            . " tbl_patient.Patient_Id,"
            . " tbl_patient.Person_Id,"
            . " CONCAT(tbl_profile.First_Name , ' ' , tbl_profile.Middle_Name , ' ' , tbl_profile.Last_Name),"
            . " tbl_laboratory.Laboratory_Id,"
            . " tbl_laboratory.Laboratory_Name,"
            . " Total_Amount, "
            . " Bill_Date"
            . " from"
            . " tbl_bill,"
            . " tbl_patient,"
            . " tbl_laboratory,"
            . " tbl_profile"
            . " where tbl_bill.Patient_Id = tbl_patient.Patient_Id AND"
            . " tbl_patient.Laboratory_Id = tbl_laboratory.Laboratory_Id AND"
            . " tbl_patient.Person_Id = tbl_profile.Person_Id";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id = 'tabledata' class = 'table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Invoice No", "Patient Name", "Laboratory Name", "Total Amount", "Date"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];
        $tbhtml .= "<tr>";
        $tbhtml .= "<td>" . $i++ . "</td>";
        $tbhtml .= "<td>$row[2] | <button type='button' name='view' id='view' viewprofile='1' data-id='$row[1]' class=' btn btn-primary btn-sm' value='View Profile'><i class='fa fa-user-o'></button></td>";
        $tbhtml .= "<td>$row[4] | <button type='button' name='view' id='view' viewlab='1' data-id='$row[3]' class=' btn btn-primary btn-sm' value='View Profile'><i class='fa fa-user-o'></button></td>";
        $tbhtml .= "<td>$row[5]</td>";
        $tbhtml .= "<td>$row[6]</td>";
        $tbhtml .= "<td><button type='button' name='view' id='view' dataedit='1' data-id='$id' class=' btn btn-primary btn-sm' value='View Bill'><i class='fa fa-clone  '></button></td></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function get_labs_info() {
    $rstr = "";
    $sql = "select "
            . "tbl_laboratory.Laboratory_Id, "
            . "tbl_laboratory.Laboratory_Name, "
            . "tbl_laboratory.Email_Id, "
            . "tbl_laboratory.Contact_No, "
            . "concat(tbl_laboratory.Address, ', ', tbl_city.City_Name) as ad from "
            . "tbl_laboratory, tbl_city "
            . "WHERE tbl_laboratory.City_Id = tbl_city.City_Id";

    $rst = mysql_query($sql);


    while ($value = mysql_fetch_row($rst)) {



        $id = $value[0];
        $labs[$id][] = $id;
        $labs[$id][] = $value[1];
        $labs[$id][] = $value[2];
        $labs[$id][] = $value[3];
        $labs[$id][] = $value[4];

        $q = "select count(*) from tbl_Patient where Laboratory_Id = $id";
        $r = mysql_query($q);
        while ($v = mysql_fetch_row($r)) {
            $labs[$id][] = $v[0];
        }

        $q = "select "
                . "COUNT(*) "
                . "from "
                . "tbl_patient_checkup_details, "
                . "tbl_patient where "
                . "tbl_patient_checkup_details.Patient_Id = tbl_patient.Patient_Id "
                . "and tbl_patient.Laboratory_Id = $id";
        $r = mysql_query($q);
        while ($v = mysql_fetch_row($r)) {
            $labs[$id][] = $v[0];
        }

        $q = "select tbl_Profile.Person_id, Picture, concat(First_Name, ' ', Middle_Name, ' ', Last_Name) as nm, tbl_Profile.Date_Of_Birth , tbl_Profile.Contact_no, tbl_Profile.Email_Id, concat(tbl_Profile.Address,', ' ,tbl_City.City_Name) from tbl_Profile, tbl_Laboratory, tbl_User, tbl_City where tbl_Laboratory.User_Id = tbl_User.User_Id and tbl_User.Person_Id = tbl_Profile.Person_Id and tbl_Profile.City_Id = tbl_City.City_Id and tbl_Laboratory.Laboratory_Id = $id";
        $r = mysql_query($q);
        while ($v = mysql_fetch_row($r)) {
            foreach ($v as $value) {
                $labs[$id][] = $value;
            }
        }
    }


//    foreach ($labs as $row) {
//        foreach ($row as $key => $value) {
//            echo "$key = $value <br>";
//        }
//        echo '<br>';
//    }

    foreach ($labs as $row) {

        $rstr .= "<div class=\"col-md-4\">"
                . "<div class=\"box box-widget widget-user-2\">"
                . "<div class=\"widget-user-header bg-gray-light\">"
                . "<div class=\"widget-user-image\">"
                . "<img class=\"img-circle\" src=\"$row[8]\" alt=\"User Avatar\">"
                . "</div>"
                . "<h3 class=\"widget-user-username\">$row[1]</h3>"
                . "<h5 class=\"widget-user-desc\">"
                . "<p class=\"text-left\"><span class=\"fa fa-envelope-o\"> Email : $row[2]</span> <label for=\"ema\"></label><br><br> <span class=\"fa fa-phone\"> Contact No : $row[3]</span> <label for=\"cont\"></label></h3></p>"
                . "</h5>"
                . "</div>"
                . "<div class=\"box-footer no-padding\">"
                . "<ul class=\"nav nav-stacked\">"
                . "<li><a href=\"#\">Address <span class=\"pull-right badge bg-blue-gradient \"><label for=\"add\">$row[4]</label></span></a></li>"
                . "<li><a href = \"#\">Total Patient <span class = \"pull-right badge bg-green-gradient\"><label for = \"total\">$row[5]</label></span></a></li>"
                . "<li><a href = \"#\">Total Reports <span class = \"pull-right badge bg-red-gradient\"><label for = \"total\">$row[6]</label> </span></a></li>"
                . "<!--<li style=\"height:40px;\" class=\"text-center\"><button type=\"button\" name=\"view\" id='view' dataedit=\"1\" data-id=\"$row[0]\" class=\"btn btn-primary btn-sm\">View Owner Information</button></li>-->"
                . "</ul>"
                . "</div>"
                . "</div>"
                . "</div>";
    }
    echo $rstr;
}

function get_pathologist() {
    $tbhtml = "";
    $sql = "select concat( tbl_profile.First_Name, ' ', tbl_profile.Middle_Name, ' ', tbl_profile.Last_Name ) as name, tbl_profile.Gender, concat( tbl_profile.Email_Id, ' | ', tbl_profile.Contact_No ) as contact, concat( tbl_profile.Address, ' ', tbl_city.City_Name, ', ', tbl_state.State_Name ) as ad from tbl_profile, tbl_user, tbl_user_type, tbl_city, tbl_state where tbl_profile.Person_Id = tbl_user.Person_Id and tbl_user.Type_Id = tbl_user_type.User_Type_Id and tbl_profile.City_Id = tbl_city.City_Id and tbl_city.State_Id = tbl_state.State_Id and tbl_user_type.User_Type_Name = 'doctor'";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='content' name='example1' border='2' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Name", "Gender", "Contact", "Address",];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }

    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];
        $tbhtml .= "<tr>";

        foreach ($row as $value) {
            $tbhtml .= "<td>$value</td>";
        }
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";
    return $tbhtml;
}

function view_pathologist() {
    $rstr = "";
    $sql = "select"
            . " tbl_profile.Picture,"
            . " concat(tbl_profile.First_Name, ' ', tbl_profile.Middle_Name, ' ', tbl_profile.Last_Name	) as name,"
            . " tbl_profile.Email_Id,"
            . " tbl_profile.Contact_No,"
            . " tbl_profile.Date_Of_Birth,"
            . "	concat(tbl_profile.Address, ' ', tbl_city.City_Name, ', ', tbl_state.State_Name	) as ad"
            . " from tbl_profile,"
            . " tbl_user,"
            . "	tbl_user_type,"
            . "	tbl_city,"
            . " tbl_state "
            . " where"
            . " tbl_profile.Person_Id = tbl_user.Person_Id"
            . " and tbl_user.Type_Id = tbl_user_type.User_Type_Id"
            . " and tbl_profile.City_Id = tbl_city.City_Id"
            . " and tbl_city.State_Id = tbl_state.State_Id"
            . " and tbl_user_type.User_Type_Name = 'doctor'";

    $rst = mysql_query($sql);


    while ($value = mysql_fetch_row($rst)) {

//    foreach ($labs as $row) {
//        foreach ($row as $key => $value) {
//            echo "$key = $value <br>";
//        }
//        echo '<br>';
//    }


        $rstr .= "<div class=\"col-md-4\">"
                . "<div class=\"box box-widget widget-user-2\">"
                . "<div class=\"widget-user-header bg-gray-light\">"
                . "<div class=\"widget-user-image\">"
                . "<img class=\"img-circle\" src=\"$value[0]\" alt=\"User Avatar\">"
                . "</div>"
                . "<h4 class=\"\">&nbsp&nbsp$value[1]</h4>"
                . "<h5 class=\"widget-user-desc\">"
                . "<p class=\"text-left\"><span class=\"fa fa-envelope-o\"> Email : <br> $value[2]</span> <label for=\"ema\"></label></h3></p>"
                . "</h5>"
                . "</div>"
                . "<div class=\"box-footer no-padding\">"
                . "<ul class=\"nav nav-stacked\">"
                . "<li><a href=\"#\">Contact No <span class=\"pull-right badge bg-blue-gradient \"><label for=\"dob\">$value[3]</label></span></a></li>"
                . "<li><a href=\"#\">Date of birth <span class=\"pull-right badge bg-red-gradient \"><label for=\"dob\">$value[4]</label></span></a></li>"
                . "<li><a href = \"#\">Address <span class = \"pull-right badge bg-green-gradient\"><label for = \"add\">$value[5]</label></span></a></li>"
                . "</ul>"
                . "</div>"
                . "</div>"
                . "</div>";
    }
    echo $rstr;
}

function get_patient_checkup_list() {
    $tbhtml = "";
    $i = 1;
    $sql = "select tbl_patient_checkup_details.Patient_Id,concat(First_Name,'  ',Middle_Name,'  ',Last_Name) as Name,Email_Id from tbl_patient_checkup_details,tbl_profile,tbl_patient where tbl_patient_checkup_details.Patient_Id=tbl_patient.Patient_Id and tbl_patient.Person_Id=tbl_profile.Person_Id and tbl_patient_checkup_details.Status_Id=1 GROUP by tbl_patient_checkup_details.Patient_Id";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Checkup_Detail_Id", "Patient_Name", "Email_Id", "Action"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];


        /* foreach ($row as $value) {
          $tbhtml .= "<td>$value</td>";
          } */
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td>";
        $tbhtml .= "<td><button type='button' class='btn btn-success' datacon='1' id='$id' data-id='$id'><i class='glyphicon glyphicon-ok'></i></button><button type='button' datacancel='1' style='margin-left:5%;' class='btn btn-danger' id='$id' data-id='$id'><i class='glyphicon glyphicon-remove'></i></button></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function get_make_report_list() {
    $tbhtml = "";
    $i = 1;
    $sql = "select Checkup_Detail_Id,concat(First_Name,'  ',Middle_Name,'  ',Last_Name) as Name,Email_Id,ds_name from tbl_patient_checkup_details,tbl_disease_test,tbl_profile,tbl_patient where tbl_patient_checkup_details.Patient_Id=tbl_patient.Patient_Id and tbl_patient_checkup_details.Diseases_Id=tbl_disease_test.ds_id and tbl_patient.Person_Id=tbl_profile.Person_Id and tbl_patient_checkup_details.Status_Id=2";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Checkup_Detail_Id", "Patient_Name", "Email_Id", "Disease", "Action"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];
        //$tbhtml .= "<tr>";

        /* foreach ($row as $value) {
          $tbhtml .= "<td>$value</td>";
          } */
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
        $tbhtml .= "<td><button type='button' class='btn btn-success' datamake='1' id='$id' data-id='$id' >Make Report</button></td>";
        $tbhtml .= "</tr>";
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function get_list_for_check() {
    $tbhtml = "";
    $i = 1;
    $sql = "select Checkup_Detail_Id,concat(First_Name,'  ',Middle_Name,'  ',Last_Name) as Name,Email_Id,ds_name from tbl_patient_checkup_details,tbl_disease_test,tbl_profile,tbl_patient where tbl_patient_checkup_details.Patient_Id=tbl_patient.Patient_Id and tbl_patient_checkup_details.Diseases_Id=tbl_disease_test.ds_id and tbl_patient.Person_Id=tbl_profile.Person_Id and tbl_patient_checkup_details.Status_Id=3";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Checkup_Detail_Id", "Patient_Name", "Email_Id", "Disease", "Action"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];


        /*foreach ($row as $value) {
            $tbhtml .= "<td>$value</td>";
        }*/
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
        $tbhtml .= "<td><button type='button' class='btn btn-success' datamake='1' id='$id' data-id='$id' ><i class='fa fa-wheelchair'></i></button></td>";
        $tbhtml .= "</tr>";
        //$i++;
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function get_all_medical_report($from_date = 0,$to_date = 0) {
    if (empty($from_date) && empty($to_date)) {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, d.City_Name, a.Contact_No, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id order by e.Status_Id";
    } else {
        $sql = "select concat(a.First_Name,' ', a.Middle_Name,' ', a.Last_Name) as Name, d.City_Name, a.Contact_No, b.ds_name, c.Status_Type,e.Checkup_Detail_Id from tbl_profile as a, tbl_disease_test as b, tbl_status as c, tbl_city as d, tbl_patient_checkup_details as e, tbl_patient as f where e.Patient_Id=f.Patient_Id and f.Person_Id=a.Person_Id and e.Diseases_Id=b.ds_id and a.City_Id=d.City_Id and e.Status_Id=c.Status_Id and e.Sample_Arrival_Date between '$from_date' and '$to_date' order by e.Status_Id";
    }

    //echo $sql;die();
    $tbhtml = "";
    $i = 1;
    //$sql = "select Checkup_Detail_Id,concat(First_Name,'  ',Middle_Name,'  ',Last_Name) as Name,Email_Id,ds_name from tbl_patient_checkup_details,tbl_disease_test,tbl_profile,tbl_patient where tbl_patient_checkup_details.Patient_Id=tbl_patient.Patient_Id and tbl_patient_checkup_details.Diseases_Id=tbl_disease_test.ds_id and tbl_patient.Person_Id=tbl_profile.Person_Id and tbl_patient_checkup_details.Status_Id=3";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Sr.No", "Patient Name", "City","Contact No.","Disease", "Status"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        //$id = $row[0];
        /*foreach ($row as $value) {
            $tbhtml .= "<td>$value</td>";
        }*/
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>";
        //$tbhtml .= "<td><button type='button' class='btn btn-success' datamake='1' id='$id' data-id='$id' ><i class='fa fa-wheelchair'></i></button></td>";
        $tbhtml .= "</tr>";
        $i++;
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

function check_report_for_bill($ck_dt_id)
{
    //echo $ck_dt_id;die();
    if(isset($ck_dt_id) && !empty($ck_dt_id))
    {
        $sql="select Patient_Id,Sample_Arrival_Date from tbl_patient_checkup_details where Checkup_Detail_Id=$ck_dt_id";
        $spdata=mysql_fetch_assoc(mysql_query($sql));
        
        $sql1="select count(*) from tbl_patient_checkup_details where Sample_Arrival_Date='{$spdata['Sample_Arrival_Date']}' and Patient_Id='{$spdata['Patient_Id']}' and Status_Id=4";
        $cstatus=mysql_result(mysql_query($sql1),0,0);
        
        $sql2="select count(*) from tbl_patient_checkup_details where Patient_Id='{$spdata['Patient_Id']}' group by Sample_Arrival_Date having Sample_Arrival_Date='{$spdata['Sample_Arrival_Date']}'";
        $call=mysql_result(mysql_query($sql2),0,0);
        
        if($cstatus==$call)
        {
            $tdate=date('Y-m-d');
            $sql3="select Laboratory_Id as lbid from tbl_patient where Patient_Id={$spdata['Patient_Id']}";
            $lbid=mysql_result(mysql_query($sql3),0,'lbid');
            $sql3="insert into tbl_bill(Patient_Id,Laboratory_Id,Bill_Date) values({$spdata['Patient_Id']},'$lbid','$tdate')";
            if(mysql_query($sql3))
            {
                
                $sql4="select max(Bill_Id) as bid from tbl_bill";
                $billid=mysql_result(mysql_query($sql4),0,'bid');
                
                $sql4="select * from tbl_patient_checkup_details where Sample_Arrival_Date='{$spdata['Sample_Arrival_Date']}' and Patient_Id='{$spdata['Patient_Id']}' and Status_Id=4";
                
                $get_bill=mysql_query($sql4);
                $total=0;
                while($k=mysql_fetch_assoc($get_bill))
                {
                    
                    $sql5="select price from tbl_disease_test where ds_id={$k['Diseases_Id']}";
                    //echo $sql5;die();
                    $price=mysql_result(mysql_query($sql5),0,'price');
                    //echo $price;
                    $sql5="insert into tbl_bill_details(Bill_Id,Diseases_Id,Price) values($billid,{$k['Diseases_Id']},$price)";
                    //echo $sql5;
                    mysql_query($sql5);
                    $total+=$price;
                }
                $sql6="update tbl_bill set Total_Amount=$total where Bill_Id=$billid";
                mysql_query($sql6);
            } 
        }
    }
}

function get_bill_report($from_date = 0,$to_date = 0) {
    if (empty($from_date) && empty($to_date)) {
        $sql = "select a.Bill_Id,concat(b.First_Name,' ', b.Middle_Name,' ', b.Last_Name) as Name,c.City_Name,b.Contact_No,d.Laboratory_Name,a.Total_Amount,a.Bill_Date from tbl_bill as a,tbl_profile as b,tbl_city as c,tbl_laboratory as d,tbl_patient as e where a.Patient_Id=e.Patient_Id and e.Person_Id=b.Person_Id and b.City_Id=c.City_Id and a.Laboratory_Id=d.Laboratory_Id";
    } else {
        $sql = "select a.Bill_Id,concat(b.First_Name,' ', b.Middle_Name,' ', b.Last_Name) as Name,c.City_Name,b.Contact_No,d.Laboratory_Name,a.Total_Amount,a.Bill_Date from tbl_bill as a,tbl_profile as b,tbl_city as c,tbl_laboratory as d,tbl_patient as e where a.Patient_Id=e.Patient_Id and e.Person_Id=b.Person_Id and b.City_Id=c.City_Id and a.Laboratory_Id=d.Laboratory_Id and a.Bill_Date between '$from_date' and '$to_date'";
    }

    //echo $sql;die();
    $tbhtml = "";
    $i = 1;
    //$sql = "select Checkup_Detail_Id,concat(First_Name,'  ',Middle_Name,'  ',Last_Name) as Name,Email_Id,ds_name from tbl_patient_checkup_details,tbl_disease_test,tbl_profile,tbl_patient where tbl_patient_checkup_details.Patient_Id=tbl_patient.Patient_Id and tbl_patient_checkup_details.Diseases_Id=tbl_disease_test.ds_id and tbl_patient.Person_Id=tbl_profile.Person_Id and tbl_patient_checkup_details.Status_Id=3";
    $rst = mysql_query($sql);
    $tbhtml .= "<table id='tabledata' class='table table-bordered table-striped table-responsive text-center '><thead><tr>";
    $dt_headers = ["Sr.No","Patient Name","City","Contact No.","Laboratory", "Total Amoun","Bill Date","View"];

    foreach ($dt_headers as $value) {
        $tbhtml .= "<th>$value</th>";
    }
    $tbhtml .= "</tr></thead><tbody>";

    while ($row = mysql_fetch_row($rst)) {
        $id = $row[0];
        /*foreach ($row as $value) {
            $tbhtml .= "<td>$value</td>";
        }*/
        $tbhtml .= "<tr><td>" . $i++ . "</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td>";
        $tbhtml .= "<td><button type='button' class='btn btn-success' databill='1' id='$id' data-id='$id' ><i class='fa fa-align-justify'></i></button></td>";
        $tbhtml .= "</tr>";
        
    }
    $tbhtml .= "</tbody></table>";

    return $tbhtml;
}

?>