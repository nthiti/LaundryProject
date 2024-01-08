<?php
session_start();
include 'condb.php';

$fn = $_POST['fn'];
$ln = $_POST['ln'];
$firstname = $_SESSION["firstname"];

$sql = "UPDATE db_user SET firstname='$fn', lastname='$ln' WHERE firstname='$firstname'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION["firstname"] = $fn; // อัปเดตค่าในตัวแปรเซสชัน
    echo "<script>alert('Edit data successfully')</script>";
    echo "<script>window.location = 'setting.php';</script>";
} else {
    echo "<script>alert('Edit data not successful')</script>";
}

mysqli_close($conn);
?>

