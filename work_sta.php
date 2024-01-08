<?php
session_start();
include 'condb.php';

$ids=$_GET['id'];

$sql = "UPDATE payment set status_work = 1 where id_pay = '$ids' ";

if(mysqli_query($conn,$sql)){
    header("Location: booking_sta_ad.php");
    exit();
    // echo "<script>window.location = 'booking_sta_ad.php';</script>";
    header("Location: booking_status.php");
    exit();
}else{
   
    echo "<script>alert('not successfully')</script>";
}
mysqli_close($conn);


?>

