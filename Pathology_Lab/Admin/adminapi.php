<?php

require '../Core/init.php';

if (isset($_POST) && isset($_POST['singout']) && !empty($_POST['singout'])) {
    $rtn = session_destroy();

    echo $rtn;
}
if (!empty($_POST['pincode'])) {
    $pincode = $_POST['pincode'];
    $sql = "SELECT City_Id,City_Name,State_Name FROM tbl_city,tbl_state WHERE tbl_city.State_Id=tbl_state.State_Id and Pincode = {$pincode}";
//echo $sql;
//echo "<script>alert($pincode)</script>";
    $query = mysql_query($sql) or die(print_r(mysql_error()));
    $pdata = mysql_fetch_assoc($query);
    echo json_encode($pdata);
}
if (!empty($_POST['username'])) {
    $uname = $_POST['username'];
    if (user_exists($uname)) {
        $pdata = array("exist" => 1);
    } else {
        $pdata = array("exist" => 0);
    }
    echo json_encode($pdata);
}

if (!empty($_POST['emailid'])) {
    $email = $_POST['emailid'];
    if (email_exists($email)) {
        $pdata = array("exist" => 1);
    } else {
        $pdata = array("exist" => 0);
    }
    echo json_encode($pdata);
}

if (isset($_POST) && !empty($_POST['add']) && !empty($_POST['testname']) && !empty($_POST['price']) && !empty($_POST['decs'])) {

    $testname = sanitize($_POST['testname']);
    $price = sanitize($_POST['price']);
    $decs = sanitize($_POST['decs']);
    $mdemo = (isset($_POST['mdemo']) && !empty($_POST['mdemo'])) ? $_POST['mdemo'] : false;
    $fdemo = (isset($_POST['fdemo']) && !empty($_POST['fdemo'])) ? $_POST['fdemo'] : false;

    $sql = "insert into tbl_disease_test (ds_id,ds_name,price,description) values('','$testname','$price','$decs')";
    $rtn = mysql_query($sql);
    $sql1 = "select max(ds_id) from tbl_disease_test";
    $did = mysql_result(mysql_query($sql1), 0);
    if ($mdemo) {
        foreach ($mdemo as $value) {
            $sql = "insert into tbl_disease_test_details (dsd_id,test,age_from,age_to,range_from,range_to,unit,gender,ds_id) values ('','{$value['test']}','{$value['age_from']}','{$value['age_to']}','{$value['range_from']}','{$value['range_to']}','{$value['unit']}','1','$did')";
            mysql_query($sql);
        }
    }
    if ($fdemo) {
        foreach ($fdemo as $value) {
            $sql = "insert into tbl_disease_test_details (dsd_id,test,age_from,age_to,range_from,range_to,unit,gender,ds_id) values ('','{$value['test']}','{$value['age_from']}','{$value['age_to']}','{$value['range_from']}','{$value['range_to']}','{$value['unit']}','2','$did')";
            mysql_query($sql);
        }
    }


    //echo "";
    //$rtn=$sql;
    $pdata = array("rtn" => $rtn);
    echo json_encode($pdata);
}

if (isset($_POST) && !empty($_POST['edit']) && !empty($_POST['editid']) && !empty($_POST['testname']) && !empty($_POST['price']) && !empty($_POST['decs'])) {

    $testname = sanitize($_POST['testname']);
    $price = sanitize($_POST['price']);
    $decs = sanitize($_POST['decs']);
    $id = $_POST['editid'];
    $mdemo = (isset($_POST['mdemo']) && !empty($_POST['mdemo'])) ? $_POST['mdemo'] : false;
    $fdemo = (isset($_POST['fdemo']) && !empty($_POST['fdemo'])) ? $_POST['fdemo'] : false;

    //echo $testname." ".$price." ".$decs." ".$id;die();
    $sql = "update tbl_disease_test set ds_name='$testname',description='$decs',price='$price' where ds_id='$id'";
    $rtn = mysql_query($sql);
    $sql = "delete from tbl_disease_test_details where ds_id=$id";
    mysql_query($sql);
    if ($mdemo) {
        foreach ($mdemo as $value) {
            $sql = "insert into tbl_disease_test_details (dsd_id,test,age_from,age_to,range_from,range_to,unit,gender,ds_id) values ('','{$value['test']}','{$value['age_from']}','{$value['age_to']}','{$value['range_from']}','{$value['range_to']}','{$value['unit']}','1','$id')";
            mysql_query($sql);
        }
    }
    if ($fdemo) {
        foreach ($fdemo as $value) {
            $sql = "insert into tbl_disease_test_details (dsd_id,test,age_from,age_to,range_from,range_to,unit,gender,ds_id) values ('','{$value['test']}','{$value['age_from']}','{$value['age_to']}','{$value['range_from']}','{$value['range_to']}','{$value['unit']}','2','$id')";
            mysql_query($sql);
        }
    }

    //$rtn="";*/
    $pdata = array("rtn" => $rtn);
    echo json_encode($pdata);
}

if (isset($_POST) && !empty($_POST['tbody'])) {
    $rtn = get_diseases();
    $tbdata = array("tbhtml" => $rtn);
    echo json_encode($tbdata);
}

if (isset($_POST) && !empty($_POST['eid'])) {
    $id = $_POST['eid'];
    $sql = "select * from tbl_disease_test where ds_id=$id";
    $rtn = mysql_fetch_assoc(mysql_query($sql));
    //$drange= explode("-",$rtn['Result_range']); 
    //$drange= explode("-",$rtn["Result_range"]);

    $sql1 = "select * from tbl_disease_test_details where ds_id=$id and gender='1'";
    $mrl = mysql_query($sql1);
    $msubdata = array();
    while ($k = mysql_fetch_assoc($mrl)) {
        $arry = array("dsd_id" => $k['dsd_id'], "test" => $k['test'], "age_from" => $k['age_from'], "age_to" => $k['age_to'], "range_from" => $k['range_from'], "range_to" => $k['range_to'], "unit" => $k['unit'], "gender" => $k['gender']);
        $msubdata[] = $arry;
    }

    $sql2 = "select * from tbl_disease_test_details where ds_id=$id and gender='2'";
    $frl = mysql_query($sql2);
    $fsubdata = array();
    while ($k = mysql_fetch_assoc($frl)) {
        $arry = array("dsd_id" => $k['dsd_id'], "test" => $k['test'], "age_from" => $k['age_from'], "age_to" => $k['age_to'], "range_from" => $k['range_from'], "range_to" => $k['range_to'], "unit" => $k['unit'], "gender" => $k['gender']);
        $fsubdata[] = $arry;
    }

    //$pdata=array("testname"=>$rtn['ds_name'],"price"=>$rtn['price'],"description"=>$rtn['description']);
    $pdata = array($rtn, $msubdata, $fsubdata);
    echo json_encode($pdata);
}

if (isset($_POST) && !empty($_POST['dlid'])) {
    $id = $_POST['dlid'];

    $sql = "delete from tbl_disease_test where ds_id=$id";
    $rtn = mysql_query($sql);
    if ($rtn) {
        $sql = "delete from tbl_disease_test_details where ds_id=$id";
        $rtn = mysql_query($sql);
    }
    $pdata = array("ok" => $rtn);
    echo json_encode($pdata);
}

if (isset($_POST) && isset($_POST['ckupid']) && !empty($_POST['ckupid'])) {
    $tdt = date('Y-m-d');
    //echo $tdt." ".$_POST['ckupid'];die();
    $sql = "update tbl_patient_checkup_details set Sample_Arrival_Date='$tdt',Status_Id=2 where Patient_Id={$_POST['ckupid']}";
    $rtn = mysql_query($sql);
    $pdata = array("rtn" => $rtn);
    echo json_encode($pdata);
}

if (isset($_POST) && !empty($_POST['ckupbody'])) {
    $rtn = get_make_report_list();
    $tbdata = array("tbhtml" => $rtn);
    echo json_encode($tbdata);
}
if (isset($_POST) && !empty($_POST['ckupbodyp'])) {
    $rtn = get_patient_checkup_list();
    $tbdata = array("tbhtml" => $rtn);
    echo json_encode($tbdata);
}
if (isset($_POST) && !empty($_POST['ckds'])) {
    //echo $_POST['ckds'];
    $sql = "select Diseases_Id from tbl_patient_checkup_details where Checkup_Detail_Id={$_POST['ckds']}";
    $rs = mysql_result(mysql_query($sql), 0, 'Diseases_Id');
    $sql = "select test,dsd_id from tbl_disease_test_details where ds_id=$rs";
    //echo $sql;
    $rt = mysql_query($sql);
    $tmpds = array();
    while ($k = mysql_fetch_assoc($rt)) {
        $array = array("test" => $k['test'], "dsd_id" => $k['dsd_id']);
        $tmpds[] = $array;
    }
    //$pdata=array($tmpds);

    echo json_encode($tmpds);
}
if (isset($_POST) && isset($_POST['pdiseas']) && !empty($_POST['pdiseas']) && !empty($_POST['ckid']) && !empty($_POST['dscr'])) {
    //echo "hello";die();
    $sql = "update tbl_patient_checkup_details set Test_Disease_Dscription='{$_POST['dscr']}' where Checkup_Detail_Id={$_POST['ckid']}";
    //echo $sql;
    mysql_query($sql);

    $pdemo = (isset($_POST['pdemo']) && !empty($_POST['pdemo'])) ? $_POST['pdemo'] : false;

    if ($pdemo) {
        foreach ($pdemo as $value) {
            $sql = "insert into tbl_disease_test_details_summary (dsd_id,result,Checkup_Detail_Id) values({$value['test_id']},{$value['result']},{$_POST['ckid']})";
            //echo $sql;die();
            mysql_query($sql);
        }
        $sql = "update tbl_patient_checkup_details set Status_Id=3 where Checkup_Detail_Id={$_POST['ckid']}";
        $rtn = mysql_query($sql);
    } else {
        $sql = "update tbl_patient_checkup_details set Status_Id=3 where Checkup_Detail_Id={$_POST['ckid']}";
        $rtn = mysql_query($sql);
    }
    $pdata = array("rtn" => $rtn);

    echo json_encode($pdata);
}
if (isset($_POST) && !empty($_POST['drck'])) {
    $sql = "select Test_Disease_Dscription from tbl_patient_checkup_details where Checkup_Detail_Id={$_POST['drck']}";
    $dscr = mysql_result(mysql_query($sql), 0, 'Test_Disease_Dscription');
    //echo $_POST['ckds'];
    //$sql="select dsd_id from tbl_patient_checkup_details_summaray where Checkup_Detail_Id={$_POST['drck']}";
    //$rs=mysql_result(mysql_query($sql),0,'Diseases_Id');
    $sql = "select dsd_id,result from tbl_disease_test_details_summary where Checkup_Detail_Id={$_POST['drck']}";
    //$rs=mysql_result(mysql_query($sql),0,'Diseases_Id');
    //$sql="select test,dsd_id from tbl_disease_test_details where ds_id=$rs";
    //echo $sql;
    $rt = mysql_query($sql);
    $tmpds = array();
    while ($k = mysql_fetch_assoc($rt)) {
        $sql1 = "select test from tbl_disease_test_details where dsd_id={$k['dsd_id']}";
        //echo $sql1;
        $test = mysql_result(mysql_query($sql1), 0, 'test');
        $array = array("test" => $test, "result" => $k['result']);
        $tmpds[] = $array;
    }
    $pdata = array("tmpds" => $tmpds, "description" => $dscr);

    echo json_encode($pdata);
}

if (isset($_POST) && isset($_POST['rpck']) && !empty($_POST['rpck'])) {

    $drid = $_SESSION['User_Id'];
    $sql = "update tbl_patient_checkup_details set Status_Id='4',Doctor_Ref_Id={$drid} where Checkup_Detail_Id={$_POST['rpck']}";
    $rtn = mysql_query($sql);
    check_report_for_bill($_POST['rpck']);
    $pdata = array("rtn" => $rtn);
    $sql = "select Contact_No from tbl_profile, tbl_patient_checkup_details, tbl_patient WHERE tbl_patient_checkup_details.Patient_Id = tbl_patient.Patient_Id and tbl_patient.Person_Id = tbl_profile.Person_Id and tbl_patient_checkup_details.Checkup_Detail_Id = " . $_POST['rpck'];
    $res = mysql_result(mysql_query($sql),0,'Contact_No');
    send_sms($res,"Dear Patient,  Your Medical test has been conpleted. Please get you report from laboratory.");
    echo json_encode($pdata);
}
if (isset($_POST) && isset($_POST['rprj']) && !empty($_POST['rprj'])) {
    //$drid=$_SESSION['User_Id'];
    $sql = "delete from tbl_disease_test_details_summary where Checkup_Detail_Id={$_POST['rprj']}";
    $rtn = mysql_query($sql);
    $sql = "update tbl_patient_checkup_details set Status_Id=2,Test_Disease_Dscription=NULL where Checkup_Detail_Id={$_POST['rprj']}";
    $rtn = mysql_query($sql);

    $pdata = array("rtn" => $rtn);
    echo json_encode($pdata);
}
if (isset($_POST) && !empty($_POST['rpckbody'])) {
    $rtn = get_list_for_check();
    $tbdata = array("tbhtml" => $rtn);
    echo json_encode($tbdata);
}

if (isset($_POST) && !empty($_POST['lab_id'])) {
    $id = $_POST['lab_id'];
    $sql = "select Picture, concat(First_Name, ' ', Middle_Name, ' ', Last_Name) as nm, tbl_Profile.Date_Of_Birth , tbl_Profile.Contact_no, tbl_Profile.Email_Id, tbl_Profile.Address, tbl_City.City_Name,tbl_laboratory.Remaining_Amount from tbl_Profile, tbl_Laboratory, tbl_User, tbl_City where tbl_Laboratory.User_Id = tbl_User.User_Id and tbl_User.Person_Id = tbl_Profile.Person_Id and tbl_Profile.City_Id = tbl_City.City_Id and tbl_Laboratory.Laboratory_Id = $id";
    $q = mysql_query($sql);
    $pdata = mysql_fetch_assoc($q);
    echo json_encode($pdata);
}
if (isset($_POST) && isset($_POST['from_date']) && isset($_POST['to_date']) && !empty($_POST['from_date']) && !empty($_POST['to_date'])) {
    $tbody = get_all_medical_report($_POST['from_date'], $_POST['to_date']);
    echo $tbody;
}
if (isset($_POST) && isset($_POST['getall']) && !empty($_POST['getall'])) {
    $tbody = get_all_medical_report();
    echo $tbody;
}
if (isset($_POST) && isset($_POST['apfrom_date']) && isset($_POST['apto_date']) && !empty($_POST['apfrom_date']) && !empty($_POST['apto_date'])) {
    $tbody = get_Labs_Payment($_POST['apfrom_date'], $_POST['apto_date']);
    echo $tbody;
}

if (isset($_POST) && isset($_POST['apall']) && !empty($_POST['apall'])) {
    $tbody = get_Labs_Payment();
    echo $tbody;
}

if (isset($_POST) && isset($_POST['bfrom_date']) && isset($_POST['bto_date']) && !empty($_POST['bfrom_date']) && !empty($_POST['bto_date'])) {
    $tbody = get_bill_report($_POST['bfrom_date'], $_POST['bto_date']);
    echo $tbody;
}
if (isset($_POST) && isset($_POST['ball']) && !empty($_POST['ball'])) {
    $tbody = get_bill_report();
    echo $tbody;
}



if (isset($_POST) && isset($_POST['profile']) && !empty($_POST['profile'])) {
    $uid = $_SESSION['User_Id'];

    $sql = "select concat(b.First_Name,'  ',b.Last_Name) as Name from tbl_user as a,tbl_profile as b where a.Person_Id=b.Person_Id and  a.User_Id=$uid";
    //echo $sql;
    $rslt = mysql_result(mysql_query($sql), 0, 'Name');
    $person = "";
    if ($_SESSION['Type_Id'] == 1) {
        $person = "Admin";
    } else if ($_SESSION['Type_Id'] == 2) {
        $person = "Pathologist";
    } else if ($_SESSION['Type_Id'] == 4) {
        $person = "Laboratory Assistant";
    }
    $pdata = array("person" => $person, "name" => $rslt);
    echo json_encode($pdata, JSON_UNESCAPED_SLASHES), "\n";
}

if (isset($_POST) && isset($_POST['bllid']) && !empty($_POST['bllid'])) {
    //isset($_POST) && isset($_POST['bllid']) && !empty($_POST['bllid']);
    //echo "hello";
    $blid = $_POST['bllid'];
    $i = 1;
    $sql = "select b.ds_name,a.Price from tbl_bill_details as a,tbl_disease_test as b where a.Diseases_Id=b.ds_id and Bill_Id=$blid";
    //echo $sql;
    $rst = mysql_query($sql);

    if ($rst) {
        $tbbody = "";
        while ($k = mysql_fetch_assoc($rst)) {
            $tbbody .= "<tr><td>" . $i++ . "</td><td>{$k['ds_name']}</td><td class='text-right'>{$k['Price']}</td></tr>";
        }
    }

    echo $tbbody;
}
?>