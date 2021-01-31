<?php
require_once "DBConnection.php";
require_once "DBConstants.php";
class DriversDaoImpl
{
    public function addDrivers($details):bool
    {
     $did=rand(60000,90000);
     $conn = (new DBConnection())->getConn();
     $sql="insert into ".DBConstants::$DRIVERS_TABLE." (`did`,`driver_name`,`password`,`email_id`,`phone_no`,`img_driver`,`no_plate`,`type`,`ambulance_name`,`amb_pic`,`bill`)
     values($did,'$details[0]','$details[1]','$details[2]',$details[3],'$details[4]','$details[5]','$details[6]','$details[7]','$details[8]',$details[9])";
     
     $result = $conn->query($sql);
   
     return $result;
     $conn->close();
     
    }
    public function getDrivers():array
    {
        $conn = (new DBConnection())->getConn();
        $sql="select * from ".DBConstants::$DRIVERS_TABLE;
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            return $result->fetch_all(MYSQLI_ASSOC); //would return an array of rows 
        }
        else
        {
            return [];
        }
        $conn->close();
    }
    public function removeDriver($did):array
    {
        $conn = (new DBConnection())->getConn();
        $sql="delete from ".DBConstants::$DRIVERS_TABLE." where did=$did";
        $p = $conn->query($sql);
        $sql="select * from ".DBConstants::$DRIVERS_TABLE;
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            return $result->fetch_all(MYSQLI_ASSOC); //would return an array of rows 
        }
        else
        {
            return [];
        }
        $conn->close();
    }
    public function getDetails($did):array
    {
        $conn = (new DBConnection())->getConn();
        $sql="select * from ".DBConstants::$DRIVERS_TABLE." where did=$did";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            return $result->fetch_all(MYSQLI_ASSOC); //would return an array of rows 
        }
        else
        {
            return [];
        }
        $conn->close();
    }
    public function updateDriver($details,$did):bool
    {
     $conn = (new DBConnection())->getConn();

     $sql="update ".DBConstants::$DRIVERS_TABLE." set driver_name='$details[0]',email_id='$details[1]',phone_no=$details[2],no_plate='$details[3]',type='$details[4]',ambulance_name='$details[5]' where did=$did";
     
     $result = $conn->query($sql);
   
     return $result;
     
     $conn->close();
    }
}

?>