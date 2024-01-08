<?php

session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location:login.php");
}
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
    <br><br>
    <h2 class="text-center">ข้อมูลของลูกค้า</h2>
    <br>
    <table class="table table-bordered" style="border: 1px solid #8c8b8b;">
        <tr class="text-center" style="border: 1px solid #8c8b8b; width: 100px;">
        <th class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" >ลำดับที่</th>
        <th class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" >ชื่อ</th>
        <th class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" >นามสกุล</th>
        <th class="text-center" style="border: 1px solid #8c8b8b; width: 50px;">email</th>
        </tr>
        <?php
       $sql = "SELECT * FROM db_user
       WHERE db_user.status = '0'";
        $result = mysqli_query($conn, $sql);
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
           <tr class="text-center" style="border: 1px solid #8c8b8b;">
                    <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;"><?= $counter ?></td>
                    <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;" ><?= $row['firstname'] ?></td>
                    <td class="text-center" style="border: 1px solid #8c8b8b; width: 100px;"><?= $row['lastname'] ?></td>
                    <td class="text-start" style="border: 1px solid #8c8b8b; width: 50px;"><?= $row['email'] ?></td>
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
    <a href="pagereport_ad.php"><button class="btn btn-primary">cancel</button> </a>

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
