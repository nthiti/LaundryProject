<?php
include 'condb.php';

$ids = $_POST['id'];
$machine_weight = $_POST['machine_weight'];
$machine_number = $_POST['machine_number'];
$machine_price_cool = $_POST['machine_price_cool'];
$machine_price_warm = $_POST['machine_price_warm'];
$machine_price_hot = $_POST['machine_price_hot'];
$status = $_POST['status'];

$sql = "UPDATE wash set weight='$machine_weight', number = '$machine_number', price_cool = '$machine_price_cool',price_warm = '$machine_price_warm' , price_hot = '$machine_price_hot', status = '$status' WHERE id = '$ids' ";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('Edit data successfully')</script>";
    echo "<script>window.location = 'show_wash.php';</script>";
}else{
echo "<script>alert('not successfully')</script>";
}
mysqli_close($conn);
?>