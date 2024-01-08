<?php
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ], 
    'default_font' => 'sarabun',
    'dpi' => 150, // ปรับค่า DPI ตามความต้องการของคุณ
]);

$mpdf->SetFont('sarabun', '', 12);
ob_start();


session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location:login.php");
}
// ตรวจสอบว่ามีการส่งค้นหาวันที่เริ่มต้นและวันสิ้นสุดมาหรือไม่
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // ปรับปรุงคำสั่ง SQL เพื่อค้นหาข้อมูลตามช่วงวันที่
    $sql = "SELECT booking.*, db_user.firstname, db_user.lastname, payment.* 
        FROM booking 
        LEFT JOIN db_user ON booking.user_id = db_user.id_user
        LEFT JOIN payment ON booking.id_booking = payment.id_booking
        WHERE dob BETWEEN '$startDate' AND '$endDate'
        ORDER BY dob ASC";

} else {
    // ถ้าไม่มีการค้นหาด้วยช่วงวันที่ ให้ดึงข้อมูลทั้งหมด
    $sql = "SELECT * FROM booking";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
    </style>
    <title>R Laundry</title>
</head>
<body>
    
<div class="container mt-5">
<a href = "information_usersh.php" class ="logo"><img src = "img/pic6.png"
                  width="100" height="100"></a>
    <br><br>
    <h2 class="text-center">ข้อมูลการจองของลูกค้า</h2>
    <form action="POST" name="select_date" action="report_date.php">
        <br>
    </form>
    <table class="table table-bordered">
        <tr class="text-center" style="border: 1px solid #8c8b8b;">
        <th class="text-center"  style="border: 1px solid #8c8b8b;">ลำดับที่</th>
        <th class="text-center"  style="border: 1px solid #8c8b8b;" >วันที่จอง</th>
            <th class="text-center"  style="border: 1px solid #8c8b8b;" >เวลาที่จอง</th>
            <th class="text-center"  style="border: 1px solid #8c8b8b;">ชื่อลูกค้า</th>
            <th class="text-center"  style="border: 1px solid #8c8b8b;" >เครื่องที่จอง</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >รายละเอียด</th>
            <th class="text-center"  style="border: 1px solid #8c8b8b;" >ชื่อหอพัก</th>
            <th class="text-center"  style="border: 1px solid #8c8b8b;" >ราคา</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;">สถานะการจอง</th>
        </tr>
        <?php
       
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
          $status = $row["status_payment"];
    $status1 = $row["status_work"];
            ?>
           <tr class="text-center" style="border: 1px solid #8c8b8b;">
                    <td style="border: 1px solid #8c8b8b;" class="text-center"><?= $counter ?></td>
                    <td style="border: 1px solid #8c8b8b;"><?= $row['dob'] ?></td>
                    <td style="border: 1px solid #8c8b8b;"><?= $row['time'] ?></td>
                    <td class="text-start" style="border: 1px solid #8c8b8b;"><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>
                    <td style="border: 1px solid #8c8b8b;" ><?= $row['wash_num'] ?></td>
                    <td style="border: 1px solid #8c8b8b;" class="text-start">อุณหภูมิ : <?= $row['temperature'] ?> 
                    <br>เครื่องอบ : <?= $row['dryer'] ?>
                    <br> บริการส่ง : <?= $row['delivery'] ?></td>
                    <td style="border: 1px solid #8c8b8b;"><?= $row['address'] ?></td>
                    <td style="border: 1px solid #8c8b8b;"><?= $row['Total'] ?></td>
                    <td style="border: 1px solid #8c8b8b;">
                        <?php
                         if ($status1 == 1) {
                            echo " ดำเนินการเสร็จสิ้น";
                        }  else {
                            echo " รอดำเนินการ";
                        }
                        ?>
                    </td>
                </tr>
                <?php

$counter++;
            }
        ?>
    </table>
    <?php
    
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output('Report.pdf');
    ob_end_flush();
    ?>
    <a href="Report.pdf"><button class="btn btn-primary">Export PDF</button> </a>
    <a href="information_usersh.php"><button class="btn btn-primary">cancel</button> </a>
    <br><br>
</div>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Itim', cursive;
    }

    .img {
        width: 100px;
        height: 100px;
        display: block;
        margin-left: 600px;
    }
    
</style>
