<?php
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
    if (empty($buffer)) {
        echo " buffer is empty ";
    } else {
        echo $buffer;
    }
    curl_close($ch);
}

/*for($i=0;$i<=2;$i++)
{
    send_sms("9974554401","hello");
}*/
//send_sms("9974554401","hello");
//send_sms("9974554401","Gautam");
//send_sms("9974554401","How r u");

?>  