<?php
include 'condb.php';

$ids = $_POST['id'];
$machine_weight = $_POST['machine_weight'];
$machine_number = $_POST['machine_number'];
$price = $_POST['price'];
$status = $_POST['status'];

$sql = "UPDATE dryer set weight='$machine_weight', number = '$machine_number', price = '$price', status = '$status' WHERE id = '$ids' ";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('Edit data successfully')</script>";
    echo "<script>window.location = 'show_dryer.php';</script>";
}else{
echo "<script>alert('not successfully')</script>";
}
mysqli_close($conn);
?>
