<?php
include('core/init.php');

if(isset($_POST) && isset($_POST['logout']) && !empty($_POST['logout']))
{
    $rtn=session_destroy();
    
    echo $rtn;
}
if(!empty($_POST['pincode']))
{
$pincode=$_POST['pincode'];
$sql = "SELECT City_Id,City_Name,State_Name FROM tbl_city,tbl_state WHERE tbl_city.State_Id=tbl_state.State_Id and Pincode = {$pincode}";
//echo $sql;
//echo "<script>alert($pincode)</script>";
$query = mysql_query($sql) or die(print_r(mysql_error()));
$pdata = mysql_fetch_assoc($query);
echo json_encode($pdata);

}

if(!empty($_POST['username']))
{
    $uname=$_POST['username'];
    if(user_exists($uname)){$pdata=array("exist"=>1);}
    else{$pdata=array("exist"=>0);}
    echo json_encode($pdata);
}
if(isset($_POST) && !empty($_POST['diseas']))
{
    $sql="select ds_id,ds_name from tbl_disease_test";
    $rl=mysql_query($sql);
    $optn="";
    while($k = mysql_fetch_row($rl))
    {
        $optn.="<Option value={$k[0]} ds-name={$k[1]}>{$k[1]}</option>";
    }
    //$optn.="</select>";
    
    echo $optn;
}

if(isset($_POST) && isset($_POST['patientdata']) && !empty($_POST['patientdata']))
{
    
    $sc=patient_register();
    //echo $sc;
    $pnt=add_patient($sc,$user_data['Laboratory_Id']);
    //echo $pnt;
    //$tmp=array();
    $pdemo= (isset($_POST['pdemo']) && !empty($_POST['pdemo'])) ? $_POST['pdemo'] : false;
    foreach ($pdemo as $value)
    {
        $tmp[]=$value['id'];
        $sql="insert into tbl_patient_checkup_details (Patient_Id,Diseases_Id,Status_Id) values($pnt,{$value['id']},'1')";
        $rtn=mysql_query($sql);
    }
    
    //$sc=patient_register();
    //echo $sc;
    //$pnt=add_patient($sc,$user_data['Laboratory_Id']);
    echo $rtn;
}

if(isset($_POST) && isset($_POST['amount']) && !empty($_POST['amount']))
{
    $sql="select Remaining_Amount from tbl_laboratory where Laboratory_Id={$user_data['Laboratory_Id']}";
    $rl=mysql_result(mysql_query($sql),0,Remaining_Amount);
    
    echo $rl;
}

if(isset($_POST) && isset($_POST['afrom_date']) && isset($_POST['ato_date']) && !empty($_POST['afrom_date']) && !empty($_POST['ato_date']))
{
    $tbody=get_all_madical_report($_POST['afrom_date'],$_POST['ato_date'],$user_data['Laboratory_Id']);
    echo $tbody;
}

if(isset($_POST) && isset($_POST['from_date']) && isset($_POST['to_date']) && !empty($_POST['from_date']) && !empty($_POST['to_date']))
{
    $tbody=get_payment($_POST['from_date'],$_POST['to_date'],$user_data['Laboratory_Id']);
    echo $tbody;
}

if(isset($_POST) && isset($_POST['rfrom_date']) && isset($_POST['rto_date']) && !empty($_POST['rfrom_date']) && !empty($_POST['rto_date']))
{
    $tbody=get_confirm_madical_report($_POST['rfrom_date'],$_POST['rto_date'],$user_data['Laboratory_Id']);
    echo $tbody;
}
if(isset($_POST) && isset($_POST['agetall']) && !empty($_POST['agetall']))
{
    $tbody=get_all_madical_report($user_data['Laboratory_Id']);
    echo $tbody;
}

if(isset($_POST) && isset($_POST['pgetall']) && !empty($_POST['pgetall']))
{
    $tbody=get_payment($user_data['Laboratory_Id']);
    echo $tbody;
}

if(isset($_POST) && isset($_POST['rgetall']) && !empty($_POST['rgetall']))
{
    $tbody=get_confirm_madical_report($user_data['Laboratory_Id']);
    echo $tbody;
}
if (isset($_POST) && !empty($_POST['u'])) {
    $unm = $_POST['u'];
    $pdata = array("chk" => user_exists($unm));
    echo json_encode($pdata);
}

/*if (isset($_POST) && !empty($_POST['cd'])) {
    $lab_name = $user_data['Laboratory_Name'];
    $lab_contact = $user_data['Contact_No'];
    $sql = "select "
            . "concat(a.First_Name, ' ', a.Middle_Name, ' ', a.Last_Name) as name, "
            . "a.Contact_No, "
            . "a.Gender, "
            . "a.Date_Of_Birth, "
            . "b.City_Name from tbl_profile as a, "
            . "tbl_city as b, "
            . "tbl_patient_checkup_details as c, "
            . "tbl_patient as d "
            . "where "
            . "a.City_Id = b.City_Id "
            . "and c.Patient_Id = d.Patient_Id "
            . "and d.Person_id = a.Person_Id "
            . "and c.Checkup_Detail_Id = " . $_POST['cd'];
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $pname = $row[0];
        $pcont = $row[1];
        $gf = $row[2];
        if ($gf == "1") {
            $gen = "Male";
        } else {
            $gen = "Famale";
        }

        $from = new DateTime($row[3]);
        $to = new DateTime('today');
        $age = $from->diff($to)->y;
        $city = $row[4];
    }

    $sql = "select "
            . "a.ds_name, "
            . "a.description, "
            . "b.Sample_Arrival_Date "
            . "from "
            . "tbl_disease_test as a, "
            . "tbl_patient_checkup_details as b "
            . "where "
            . "a.ds_id = b.Diseases_Id "
            . "and b.Checkup_Detail_Id = " . $_POST['cd'];

    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $dname = $row[0];
        $ddesc = $row[1];
        $sadate = $row[2];
        $cdate = date('Y-m-d');
    }

    $sql = "select "
            . "a.test, "
            . "a.unit, "
            . "concat(a.range_from, ' - ', a.range_to), "
            . "b.result "
            . "from "
            . "tbl_disease_test_details as a, "
            . "tbl_disease_test_details_summary as b, "
            . "tbl_patient_checkup_details as c "
            . "where "
            . "c.Diseases_Id = a.ds_id "
            . "and a.dsd_id = b.dsd_Id "
            . "and a.gender = " . $gf
            . "and a.age_from <= " . $age
            . "and a.age_to > " . $age
            . "and c.Checkup_Detail_Id = " . $_POST['cd'];
    
    $result = mysql_query($sql);
    $str = "";
    
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
            $str = "<tr>"
                    . "<td style='padding-top:20px'>$row[0]</td>"
                    . "<td style='padding-top:20px'>$row[3]</td>"
                    . "<td style='padding-top:20px'>$row[1]</td>"
                    . "<td style='padding-top:20px'>$row[1]</td>"
                    . "</tr>";
        }
    } else {
        $sql = "select "
                . "a.result, "
                . "b.Test_Disease_Dscription "
                . "from "
                . "tbl_disease_test_details_summary as a, "
                . "tbl_patient_checkup_details as b "
                . "where "
                . "a.Checkup_Detail_Id = b.Checkup_Detail_Id "
                . "and b.Checkup_Detail_Id = " . $_POST['cd'];
        $result = mysql_query($sql);
        if (true) {
            while ($row = mysql_fetch_array($result)) {
                $str = "<tr>"
                        . "<td style='padding-top:20px'>-</td>"
                        . "<td style='padding-top:20px'>$row[0]</td>"
                        . "<td style='padding-top:20px'>-</td>"
                        . "<td style='padding-top:20px'>$row[1]</td>"
                        . "</tr>";
            }
        }

        $pdata = Array("labname" => $lab_name, "labcont" => $lab_contact, "pname" => $pname, "pcont" => $pcont, "gen" => $gen, "age" => $age, "city" => $city, "dname" => $dname, "ddesc" => $ddesc, "sadate" => $sadate, "cdate" => $cdate, "diseases" => $str);
        echo json_encode($pdata);
    }
}*/
if (isset($_POST) && !empty($_POST['cd'])) {
    $lab_name = $user_data['Laboratory_Name'];
    $lab_contact = $user_data['Contact_No'];
    $sql = "select "
            . "concat(a.First_Name, ' ', a.Middle_Name, ' ', a.Last_Name) as name, "
            . "a.Contact_No, "
            . "a.Gender, "
            . "a.Date_Of_Birth, "
            . "b.City_Name from tbl_profile as a, "
            . "tbl_city as b, "
            . "tbl_patient_checkup_details as c, "
            . "tbl_patient as d "
            . "where "
            . "a.City_Id = b.City_Id "
            . "and c.Patient_Id = d.Patient_Id "
            . "and d.Person_id = a.Person_Id "
            . "and c.Checkup_Detail_Id = " . $_POST['cd'];
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $pname = $row[0];
        $pcont = $row[1];
        $gf = $row[2];
        if ($gf == "1") {
            $gen = "Male";
        } else {
            $gen = "Famale";
        }

        $from = new DateTime($row[3]);
        $to = new DateTime('today');
        $age = $from->diff($to)->y;
        $city = $row[4];
    }

    $sql = "select "
            . "a.ds_name, "
            . "a.description, "
            . "b.Sample_Arrival_Date "
            . "from "
            . "tbl_disease_test as a, "
            . "tbl_patient_checkup_details as b "
            . "where "
            . "a.ds_id = b.Diseases_Id "
            . "and b.Checkup_Detail_Id = " . $_POST['cd'];

    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $dname = $row[0];
        $ddesc = $row[1];
        $sadate = $row[2];
        $cdate = date('Y-m-d');
    }
//select a.test, a.unit, concat(a.range_from, ' - ', a.range_to), b.result from tbl_disease_test_details as a, tbl_disease_test_details_summary as b, tbl_patient_checkup_details as c where c.Diseases_Id = a.ds_id and a.dsd_id = b.dsd_Id and a.gender = 1 and a.age_from <= 21 and a.age_to > 21 and c.Checkup_Detail_Id = 2
    //echo $gf."  ".$age;
    $sql = "select "
            . "a.test, "
            . "a.unit, "
            . "concat(a.range_from, '-', a.range_to), "
            . "b.result from tbl_disease_test_details as a, "
            . "tbl_disease_test_details_summary as b, "
            . "tbl_patient_checkup_details as c "
            . "where "
            . "c.Diseases_Id = a.ds_id "
            . "and a.dsd_id = b.dsd_Id and a.gender = ".$gf
            . " and a.age_from <= " . $age
            . " and a.age_to > " . $age . " and c.Checkup_Detail_Id = " . $_POST['cd'];
    
    $result = mysql_query($sql);
    $str = "";
    $num = mysql_num_rows($result);
    if ($num > 0) {
        while ($row = mysql_fetch_array($result)) {
            $str = "<tr>"
                    . "<td style='padding-top:20px'>$row[0]</td>"
                    . "<td style='padding-top:20px'>$row[3]</td>"
                    . "<td style='padding-top:20px'>$row[1]</td>"
                    . "<td style='padding-top:20px'>$row[2] $row[1]</td>"
                    . "</tr>";
        }
    } else {
        $sql = "select "
                . "a.result, "
                . "b.Test_Disease_Dscription "
                . "from "
                . "tbl_disease_test_details_summary as a, "
                . "tbl_patient_checkup_details as b "
                . "where "
                . "a.Checkup_Detail_Id = b.Checkup_Detail_Id "
                . "and b.Checkup_Detail_Id = " . $_POST['cd'];
        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result)) {
                $str = "<tr>"
                        . "<td style='padding-top:20px'>-</td>"
                        . "<td style='padding-top:20px'>$row[0]</td>"
                        . "<td style='padding-top:20px'>-</td>"
                        . "<td style='padding-top:20px'>$row[1]</td>"
                        . "</tr>";
            }
        }

        
    }
    $pdata = Array("labname" => $lab_name, "labcont" => $lab_contact, "pname" => $pname, "pcont" => $pcont, "gen" => $gen, "age" => $age, "city" => $city, "dname" => $dname, "ddesc" => $ddesc, "sadate" => $sadate, "cdate" => $cdate, "diseases" => $str, "num" => $num);
    echo json_encode($pdata);
}
?>