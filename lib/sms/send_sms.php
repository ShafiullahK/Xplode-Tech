<?php

require_once dirname(__DIR__) . '/../classes/sms.php';

$sms = new SMS();



if (isset($_POST['messageText'])) {
    $text_message = $_POST['messageText'];
    $all = (Boolean)$_POST['all'];
    $students = @$_POST['id'];


    $numbers = $sms->sendSMS($text_message , $all , $students);


    // SELECT SMS Credentials
    $sql = "SELECT * FROM `sms_creadentials`";
    $sms_credentials = $sms->dataView($sql);

/*  @method sendSMS  
 * @desc sends the SMS finally
 * 
 */

$username = $sms_credentials['username'];///Your Username
$password = $sms_credentials['password'];///Your Password
$sender = $sms_credentials['sender'] ;
$message = $text_message;

////sending sms

$post = "sender=".urlencode($sender)."&mobile=".urlencode(implode(',', $numbers))."&message=".urlencode($message)."";
$url = "https://sendpk.com/api/sms.php?username=$username&password=$password";
$ch = curl_init();
$timeout = 30; // set to zero for no timeout
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$result = curl_exec($ch); 
/*Print Responce */

    if(substr($result , 0 , 2) === 'OK'){
        echo "success";
        return;
    }
    echo $result; 
}





?>