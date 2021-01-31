<?php
  require_once 'DBConnection.php';
  require_once 'DBConstants.php';
session_start();

$verify_otp=$_POST['otp'];
  $uid=$_SESSION['userid'];

  $conn = (new DBConnection())->getConn();
  $sql="select * from ".DBConstants::$USERS_TABLE." where uid=".$uid." and otp=".$verify_otp;
  $result = $conn->query($sql);
  if($result->num_rows>0)
  {
    $activate="update ".DBConstants::$USERS_TABLE." set flag=1 where uid=".$uid;
    $result = $conn->query($activate);
    if($result)
    {
      header('Location:welcome.html');
    }
  }
  else{

    echo "Otp not correct";
  }

?>