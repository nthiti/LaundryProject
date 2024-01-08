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

$mpdf->SetFont('sarabun', '', 14);
ob_start();


session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location:login.php");
}
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
<a href = "pagereport_ad.php" class ="logo"><img src = "img/pic6.png"
                  width="100" height="100"></a>
    <br>
    <h2 class="text-center">แจ้งข้อมูลการซ่อม</h2>
    <form action="POST" name="select_date" action="report_date.php">
        <br>
    </form>
    <table class="table table-bordered" style="border: 1px solid #8c8b8b;">
        <tr class="text-center">
            <th class="text-center" style="border: 1px solid #8c8b8b;">ID</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >วันที่</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >ประเภท</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >เลขเครื่อง</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >รายละเอียด</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >สถานะ</th>
            <th class="text-center" style="border: 1px solid #8c8b8b;" >วันที่ซ่อม</th>
        </tr>
        <?php
        $sql = "SELECT * FROM repair";
        $result = mysqli_query($conn, $sql);
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr class="text-center" style="border: 1px solid #8c8b8b;">
            <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $counter ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["notify_date"] ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["type"] ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["number"] ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["detail"] ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["status"] ?></td>
                <td class="text-center" style="border: 1px solid #8c8b8b;" ><?= $row["repair_date"] ?></td>
            </tr>
            <?php
            $counter++;
        }
        mysqli_close($conn);
        ?>
    </table>
    <?php
    
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output('Report.pdf');
    ob_end_flush();
    ?>
    <a href="Report.pdf"><button class="btn btn-primary">Export PDF</button> </a>
    <a href="pagereport_ad.php"><button class="btn btn-primary">cancel</button> </a>
</div>
</body>
</html>

<script language="JavaScript">
    function Del(mypage) {
        var agree = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
</script>

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
        margin: auto;
    }
    
</style>
