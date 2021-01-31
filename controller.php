<?php
require_once "DriversDaoImpl.php";
require_once "DBConstants.php";
$action=$_REQUEST["action"];

if($action=="addDriver")
{
 $arr=$_REQUEST["details"];
 $details=explode(",",$arr);
 header("Content-Type: application/json");
 echo json_encode((new DriversDaoImpl())->addDrivers($details));
}
else if($action=="getDrivers")
{
 header("Content-Type: application/json");
 echo json_encode((new DriversDaoImpl())->getDrivers());
}
else if($action=="removeDriver")
{
 $did=$_REQUEST["did"];
 header("Content-Type: application/json");
 echo json_encode((new DriversDaoImpl())->removeDriver($did));
}
else if($action=="getDetail")
{
 $did=$_REQUEST["did"];
 header("Content-Type: application/json");
 echo json_encode((new DriversDaoImpl())->getDetails($did));
}
if($action=="updateDriver")
{
 $arr=$_REQUEST["details"];
 $did=$_REQUEST["did"];
 $details=explode(",",$arr);
 header("Content-Type: application/json");
 echo json_encode((new DriversDaoImpl())->updateDriver($details,$did));
}


?>