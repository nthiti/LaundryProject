<?Php

session_start();
include 'condb.php';
$bookingId = 'id_booking';

// สร้าง SQL query เพื่อดึงข้อมูลราคาจากตาราง "booking"
$sql = "SELECT Total FROM booking WHERE id_booking = '$bookingId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // มีข้อมูลการจองที่ตรงกับรหัสการจองที่คุณกำหนด
    $row = $result->fetch_assoc();
    $bookingPrice = $row["Total"];

require_once("lib/PromptPayQR.php");

$PromptPayQR = new PromptPayQR(); // new object
$PromptPayQR->size = 8; // Set QR code size to 8
$PromptPayQR->id = '0281148907'; // PromptPay ID
$PromptPayQR->amount = $bookingPrice; // Set amount (not necessary)
echo '<img src="' . $PromptPayQR->generate() . '" />';
}
else {
    echo "ไม่พบข้อมูลการจองที่ตรงกับรหัสการจองที่คุณกำหนด";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>