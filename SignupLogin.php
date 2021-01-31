<?php
  require_once 'Mailing.php';
  require_once 'DBConnection.php';
  require_once 'DBConstants.php';
 
  
$conn = (new DBConnection())->getConn();
if(isset($_POST['signup']))  
{
  $uname=$_POST['uname'];
  $ueid=$_POST['uemail'];
  $pwd=$_POST['upwd'];
  $phno=$_POST['uphno'];
  $btype=$_POST['ubloodtype'];
  $address=$_POST['uaddress'];
  $age=$_POST['uage'];

  $sql="select * from ".DBConstants::$USERS_TABLE." where email_id='$ueid' and flag=0 ";
  $result = $conn->query($sql);
 if($result->num_rows>0)
 {
  session_start();
  $_SESSION['ueid']=$ueid;
  $otp=rand(1000,9000);
  $mail = new Mailing();
  $subject = 'OTP for Raksha.com';
  $body    = 'This is your otp:<b>'.$otp.'</b>';
  $ack = $mail->sendMail($ueid,$subject,$body);
  $updateotp="update ".DBConstants::$USERS_TABLE." set otp=".$otp." where email_id='$ueid'";
  $result = $conn->query($updateotp);
 header('Location:otpverification.html');
 }
 else{
 $sql="select * from ".DBConstants::$USERS_TABLE." where email_id='$ueid' and flag=1";
 $result = $conn->query($sql);
 if($result->num_rows>0)
 {
      echo "You have already signed up! Please login!";
 }
 else{
 $uid=rand(10000,50000);
 $otp=rand(1000,9000);
 $sql = "insert into ".DBConstants::$USERS_TABLE."(`uid`,`name`,`email_id`,`password`,`phone_no`,`blood_type`,`aaddress`,`age`,`flag`,`otp`) values
('$uid','$uname','$ueid','$pwd','$phno','$btype','$address','$age',0,'$otp')";
$mail = new Mailing();
$subject = 'OTP for Raksha.com';
$body    = 'This is your otp:<b>'.$otp.'</b>';
$ack = $mail->sendMail($ueid,$subject,$body);
$result = $conn->query($sql);
if($result)
{
  session_start();
  $_SESSION['ueid']=$ueid;
 header('Location:otpverification.html');
}
}
}

}
else if(isset($_POST['verify']))
{
  session_start();
  $verify_otp=$_POST['otp'];
  $ueid=$_SESSION['ueid'];
 
  $sql="select * from ".DBConstants::$USERS_TABLE." where email_id='$ueid' and otp=$verify_otp";
  $result = $conn->query($sql);
  // echo $result;
  if($result->num_rows>0)
  {
    $activate="update ".DBConstants::$USERS_TABLE." set flag=1 where email_id='$ueid'";
    $result = $conn->query($activate);
    if($result)
    {
      header('Location:welcome.html');
    }
  }
  else{

    echo "Otp not correct";
  }
}
else if(isset($_POST['login']))
{
  $email=$_POST['lemail'];
  $pwd=$_POST['lpwd'];
  $user=$_POST['systemusers'];

  if($user==="patient")
  {
  $sql="select * from ".DBConstants::$USERS_TABLE." where email_id='$email' and password='$pwd' and flag=1";
  $result = $conn->query($sql);
  if($result->num_rows>0)
  {
     echo 'Patient Logged in successfully';

  }
  else{
    echo 'Invalid login';
      }
  }
  else if($user==="admin")
  {
  $sql="select * from ".DBConstants::$ADMINS_TABLE." where email_id='$email' and password='$pwd'";
  $result = $conn->query($sql);
  if($result->num_rows>0)
  {
     echo 'Admin Logged in successfully';

  }
  else{
    echo 'Invalid login';
      }
  }
  // else{

  // }

}

 



?>