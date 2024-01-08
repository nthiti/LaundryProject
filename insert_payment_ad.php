<?php
session_start();
include 'condb.php';

$firstname = $_SESSION["firstname"];
$date = $_POST['date_pay'];
$time = $_POST['time_pay'];
$user_id = $_SESSION["user_id"];

// ดึง id_booking ล่าสุดของผู้ใช้จากตาราง booking
$sql_user = "SELECT id_booking FROM booking WHERE user_id = '$user_id' ORDER BY id_booking DESC LIMIT 1";
$query_user = mysqli_query($conn, $sql_user);

if ($query_user) {
    $user_data = mysqli_fetch_assoc($query_user);
    $id_booking = $user_data['id_booking'];
    $_SESSION["id_booking"] = $id_booking;
    
}
    

    

// ตรวจสอบการอัพโหลดรูปภาพและบันทึกไฟล์
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $file_name = $_FILES['file1']['name'];
    $new_image_name = 'pay_' . uniqid() . "." . pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./uploads/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}

// เพิ่มข้อมูลการชำระเงินลงในตาราง payment
$sql = "INSERT INTO payment(date_pay, time_pay, image_pay, id_booking,user_id) 
        VALUES('$date', '$time', '$new_image_name', '$id_booking','$user_id')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย , รอตรวจสอบการโอนเงิน'); </script>";
    echo "<script> window.location='booking_sta_ad.php'; </script>";
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
    echo "<script> window.location='payment.php'; </script>";
}
?>
