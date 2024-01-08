<?php
session_start();
include 'condb.php';

$machine_weight = $_POST['machine_weight'];
$machine_number = $_POST['machine_number'];
$machine_price_cool = $_POST['machine_price_cool'];
$machine_price_warm = $_POST['machine_price_warm'];
$machine_price_hot = $_POST['machine_price_hot'];
$status = $_POST['status'];


$sql = "INSERT INTO wash(weight,number,price_cool,price_warm,price_hot,status)
        VALUES ('$machine_weight','$machine_number','$machine_price_cool','$machine_price_warm','$machine_price_hot','$status')";
$result = mysqli_query($conn,$sql);


if($result){
    echo "<script> alert('save data successfully'); </script>";
    echo "<script>window.location = 'show_wash.php';</script>";
}else{
echo "<script> alert('not successfully');</script>";
}
mysqli_close($conn);
?>
