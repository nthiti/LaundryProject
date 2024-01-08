<?php
include 'condb.php';

$ids = $_POST['id'];
$machine_weight = $_POST['machine_weight'];
$machine_number = $_POST['machine_number'];
$machine_price_cool = $_POST['machine_price_cool'];
$machine_price_warm = $_POST['machine_price_warm'];
$machine_price_hot = $_POST['machine_price_hot'];
$status = $_POST['status'];

$sql = "UPDATE wash SET price_warm = '$machine_price_warm' WHERE weight = 10.5";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('การปรับราคาเสร็จสิ้น')</script>";
    echo "<script>window.location = 'pagepromotion.php';</script>";
} else {
    echo "<script>alert('not successfully')</script>";
}
mysqli_close($conn);
?>
