<?php
include_once 'php/config.php';
require 'admin/Admin-GG-estb2019/vendor/autoload.php';


session_start();

// function checkEmail($Cemail)
// {
//   	$result = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Email` = '$Cemail'");
//
//     if ($row = mysqli_num_rows($result) > 0) {
//       // code...
//       ?>
//       <script type="text/javascript">
//         alert('Email Already Exist');
//         return false;
//       </script>
//       <?php
//         //echo json_encode(array("statusCode"=>201));
//         //return true;
//     }
//     else
//     {
//       echo json_encode(array("statusCode"=>200));
//       //return false;
//     }
// }
//
// function checkMobile($mobile)
// {
//   	$result = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Mobile_Number` = '$mobile'");
//
//     if ($row = mysqli_num_rows($result) > 0) {
//       // code...
//       ?>
//       <script type="text/javascript">
//         alert('Mobile Number Already Exist');
//         return false;
//       </script>
//       <?php
//       //  echo json_encode(array("statusCode"=>202));
//         //return true;
//     }
//     else
//     {
//       echo json_encode(array("statusCode"=>200));
//     //  return false;
//     }
// }
//
// function checkPassword($pass)
// {
//     $EncPass = md5($pass);
//
//   	$result = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Password` = '$EncPass'");
//
//     if ($row = mysqli_num_rows($result) > 0) {
//       // code...
//       ?>
//       <script type="text/javascript">
//         alert('Password is Already Taken');
//         return false;
//       </script>
//       <?php
//         //echo json_encode(array("statusCode"=>203));
//         //return true;
//     }
//     else
//     {
//       echo json_encode(array("statusCode"=>200));
//       //return false;
//     }
// }

function sendEmail($otpEmail)
{

    // code...
    $otp = rand(1000, 9999);

    $_SESSION['OTPEmail'] = $otp;

    $apiKey = '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';
    $sendgrid = new \SendGrid($apiKey);
    $url = 'https://api.sendgrid.com/';
    $pass = $apiKey;


$params = array(
    'to'        => $otpEmail,
    'toname'    => "Customer",
    'from'      => "mohitkamat99@gmail.com",
    'fromname'  => "Gricee Grocery",
    'subject'   => "Forgot Password",
    'html'      => '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="full">
      <div class="row" style="background-color:#86c5da;padding-left:15%;">
        <h1 style="color:white;font-family:Adobe Gothic Std;">OTP Confimation</h1>
      </div>

        <div class="col" style="padding-left:10%;background-color:#82ae46;">

            <img src="https://i.ibb.co/3vpXJzq/Gricee-Groceryfinal.png" alt="Gricee-Groceryfinal" border="0">

        </div>

      <hr>
      <div class="col">
        <h4>Your One Time Password for Forgot Password is '.$otp.'.</h4>
      </div>
    </div>',
    //'x-smtpapi' => json_encode($js),
  );

  $request =  $url.'api/mail.send.json';

  // Generate curl request
$session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $apiKey));
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);
}



function OtpMsg($mobile, $rndno)
{
    # code...

    $_SESSION['OTP'] = $rndno;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://2factor.in/API/V1/2301df96-337a-11ea-9fa5-0200cd936042/VOICE/$mobile/$rndno/GoodHeart",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => "POST"

    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
      echo "sent";
    }

    //return true;
}



if ($_POST['type'] == 1) {

  //$Cemail = $_POST['email'];
//  $pass = $_POST['password'];
  //$mobile = $_POST['phone'];

    /*     $First_Name  = $_POST['fname'];
    $Last_Name = $_POST['lname'];
    $_SESSION['Landmark'] = $_POST['landmark'];
    $_SESSION['House_No_Name'] = $_POST['houseno'];
    $_SESSION['Place'] = $_POST['place'];
    $_SESSION['Taluka'] = $_POST['taluka'];
    $_SESSION['District'] = $_POST['district'];
    $_SESSION['State'] = $_POST['state'];
    $_SESSION['Pin_Code'] = $_POST['pin'];
    $_SESSION['Mobile_Number'] = $_POST['phone'];
    $_SESSION['Email'] = $_POST['email'];
    $_SESSION['Password'] = $_POST['pass'];
     */
       // code...
      
       $rndno = rand(1000, 9999);
       $_SESSION['rndno'] = $rndno;
       $mobile = $_POST['phone'];
       OtpMsg($mobile, $rndno);
       echo json_encode(array("statusCode" => 200));
    //echo  $_SESSION['First_Name'];
}

if ($_POST['type'] == 2) {
  // code...
  $otpEmail = $_POST['email'];
  sendEmail($otpEmail);
  echo json_encode(array("statusCode" => 200));
}



?>
