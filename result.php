<!-- result.php -->
<?php
session_start();
include 'condb.php';

if (!isset($_SESSION["firstname"])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION["status"] != 2) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}

// ตรวจสอบว่ามีการส่งค้นหาวันที่เริ่มต้นและวันสิ้นสุดมาหรือไม่
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // ปรับปรุงคำสั่ง SQL เพื่อค้นหาข้อมูลตามช่วงวันที่
    $sql = "SELECT * FROM booking WHERE dob BETWEEN '$startDate' AND '$endDate'";
} else {
    // ถ้าไม่มีการค้นหาด้วยช่วงวันที่ ให้ดึงข้อมูลทั้งหมด
    $sql = "SELECT * FROM booking";
}

$result = mysqli_query($conn, $sql);
?>
<?php
    // เริ่มคำสั่ง Export ไฟล์ PDF
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
        'default_font' => 'sarabun'
    ]);
    // สิ้นสุดคำสั่ง Export ไฟล์ PDF ในส่วนบน เริ่มกำหนดตำแหน่งเริ่มต้นในการนำเนื้อหามาแสดงผลผ่าน
    $mpdf->SetFont('sarabun','',14);
    ob_start();  //ฟังก์ชัน ob_start()
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
<a href = "pagereport.php" class ="logo"><img src = "img/pic6.png"
                  width="100" height="100"></a>
    <br><br>
    <h2 class="text-center">รายรับ</h2>
    <br>
        <!-- ตารางแสดงผลข้อมูล -->
        <table class="table table-bordered" style="border: 1px solid #8c8b8b;">
            <thead>
            <tr class="text-center" style="border: 1px solid #8c8b8b; width: 100px;">
                <th class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" >วันที่</th>
                <th class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" > เวลาที่</th>
                <th class="text-center" style="border: 1px solid #8c8b8b; width: 50px;" >รายรับ</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalRevenue = 0;

            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" >
                    <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;"><?= $row["dob"] ?></td>
                    <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" ><?= $row["time"] ?></td>
                    <td class="text-end" style="border: 1px solid #8c8b8b; width: 50px;" ><?= $row["Total"] ?></td>
                </tr>
                <?php

                // เพิ่มรายรับของแถวนี้เข้ากับรวมรายรับทั้งหมด
                $totalRevenue += $row["Total"];
            }

            // แสดงรวมรายรับทั้งหมดที่คำนวณได้
            ?>
            <tr class="table table-bordered" style="border: 1px solid #8c8b8b;">
                <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" colspan="2" taet-align="right"><strong>รวมรายรับทั้งหมด:</strong></td>
                <td class="text-end" style="border: 1px solid #8c8b8b; width: 50px;"  ><strong><?= $totalRevenue ?></strong></td>
            </tr>
            </tbody>
        </table>
        <?php
            // คำสั่งการ Export ไฟล์เป็น PDF
            $html = ob_get_contents();      // เรียกใช้ฟังก์ชัน รับข้อมูลที่จะมาแสดงผล
            $mpdf->WriteHTML($html);        // รับข้อมูลเนื้อหาที่จะแสดงผลผ่านตัวแปร $html
            $mpdf->Output('Report.pdf');  //สร้างไฟล์ PDF ชื่อว่า myReport.pdf
            ob_end_flush();                 // ปิดการแสดงผลข้อมูลของไฟล์ HTML ณ จุดนี้
        ?>
        <!--การสร้างลิงค์ เรียกไฟล์ myReport.pdf แสดงผลไฟล์ PDF -->
        <a href="Report.pdf"><button class="btn btn-primary">Export PDF</button> </a>
        <a href="information_sala.php"><button class="btn btn-primary">cancel</button> </a>
    </div>
</section>
</body>
</html>
<script labguage = "JavaScript">
    function Del(mypage) {
        var agree = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่");
        if(agree) {
            window.location = mypage;
        }
    }
</script>

<style>
   *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Itim', cursive;
  }
  </style>