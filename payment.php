<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location: login.php");
} elseif ($_SESSION["status"] != 0) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}

if (isset($_POST['btn-submit'])) {
    $filename = $_FILES['file1']['name'];
    echo $filename;
}

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // ดึงข้อมูลการจองทั้งหมดของลูกค้า
    $sql = "SELECT point FROM booking WHERE user_id = '$user_id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $totalPoints = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            // รวมคะแนนจากการจองแต่ละรายการ
            $totalPoints += $row['point'];
        }
    } else {
        // echo "ไม่สามารถดึงข้อมูลการจองได้";
    }
}
// ดึง id_booking ล่าสุด
$sqlLatestIdBooking = "SELECT id_booking FROM booking ORDER BY id_booking DESC LIMIT 1";
$resultLatestIdBooking = mysqli_query($conn, $sqlLatestIdBooking);

if ($resultLatestIdBooking) {
    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (mysqli_num_rows($resultLatestIdBooking) > 0) {
        $rowLatestIdBooking = mysqli_fetch_assoc($resultLatestIdBooking);
        $latestIdBooking = $rowLatestIdBooking['id_booking'];

        // ดึงข้อมูล Total โดยใช้ id_booking ล่าสุด
        $sqlTotal = "SELECT Total FROM booking WHERE id_booking = '$latestIdBooking'";
        $resultTotal = mysqli_query($conn, $sqlTotal);

        if ($resultTotal) {
            if (mysqli_num_rows($resultTotal) > 0) {
                $rowTotal = mysqli_fetch_assoc($resultTotal);
                $latestTotal = $rowTotal['Total'];

                // แสดงค่า Total ล่าสุด
                // echo "Total ล่าสุด: " . $latestTotal;
            } else {
                echo "ไม่พบข้อมูล Total สำหรับ id_booking ล่าสุด";
            }
        } else {
            echo "เกิดข้อผิดพลาดในการดึงข้อมูล Total";
        }
    } else {
        echo "ไม่พบข้อมูล id_booking ล่าสุด";
    }
} else {
    echo "เกิดข้อผิดพลาดในการดึงข้อมูล id_booking ล่าสุด";
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
<section>
          <div class="circle"></div>
            <header>
                <a href = "home_user.php" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
                <ul>
                  <li><a href="home_user.php">HOME</a></li>
                  <li><a href="service.php">SERVICE</a></li>
                  <li><a href="booking_status.php">MY BOOKING STATUS</a></li>
                  <li>
                    <div class="action">
                        <a class = "profile" onclick ="menuToggle();"> 
                            <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" 
                            title="LOGIN" class="login" width =  20 height = 20>
                        </a>
                        <div class ="menu">
                        <ul>
                            <li><img src = "https://cdn-icons-png.flaticon.com/128/900/900797.png" 
                            width = 30 height = 30> 
                            <a href = "setting.php" >Setting</a></li>
                            
                        </ul>
                        <ul>
                        <li><img src="https://cdn-icons-png.flaticon.com/128/1828/1828427.png" 
                        width="30" height="30"> 
                          <a href="index.php?logout=1">Logout</a>
                      </li>
                        </ul>
                            <h3><h3>
                        </div>
                        <script>
                        function menuToggle(){
                            const toggleMenu = document.querySelector('.menu');
                            toggleMenu.classList.toggle('active')
                        }
                        </script>
                    </div>
                  </li>
                </ul>
              </header>
              </section>
             
              <div class="content">
                  <div class="imgb">
                  <?Php

                  require_once("lib/PromptPayQR.php");

                  $PromptPayQR = new PromptPayQR(); // new object
                  $PromptPayQR->size = 8; // Set QR code size to 8
                  $PromptPayQR->id = '0954632732'; // PromptPay ID
                  $PromptPayQR->amount = $latestTotal; // Set amount (not necessary)
                  echo '<img src="' . $PromptPayQR->generate() . '" />';

                  ?>
                 
                    </div>
                    
                  <div class="textbox">
                  <div class="alert alert-success text-center" role="alert">
                  <h5>ยืนยันการชำระเงิน</h5>
                 </div>
                  <h2> <?php
                        if(isset($_SESSION["firstname"])){
                        echo "<div class = 'text-success'>";
                        echo "Welcome , " . $_SESSION["firstname"] . " 🎉";
                        echo "</div>";
                        
                        }?></h2>
                        

                  <form action="insert_payment.php" method="post" enctype="multipart/form-data">
                  <label>วันที่จ่ายเงิน</label>
                  <input type="date" name="date_pay" id="selected_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>" 
                  max="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"><br>
                <label>เวลาที่จ่ายเงิน</label>
                    <input type="time"  name="time_pay" class="form-control" required ><br>
                <label>อัปโหลดสลิป</label><br>
                <img id="previewImage" src="#" alt="รูปภาพที่เลือก" width="200" padding = "10px" 
                 style="display: none;">
                <br>
                    <input type="file" name="file1"class="form-control" id="fileInput" required ><br>
                    <input type="submit" value="ยืนยันการแจ้งโอน"  class="btn btn-success mt-2" >
                    <input type = "reset" class="btn btn-danger mt-2" value = "ยกเลิก">

            </form>
                  </div>
                  

              </div>
                    </div>
        
</body>
</html>

<script>
    // ฟังก์ชันที่ถูกเรียกเมื่อมีการเลือกรูปภาพในฟอร์ม
    function previewImage() {
        var fileInput = document.getElementById('fileInput');
        var previewImage = document.getElementById('previewImage');

        // ตรวจสอบว่ามีไฟล์ถูกเลือกหรือไม่
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            // เมื่อไฟล์ถูกโหลดเสร็จสิ้น
            reader.onload = function (e) {
                // แสดงรูปภาพที่เลือกในองค์ประกอบ <img>
                previewImage.src = e.target.result;
                previewImage.style.display = 'block'; // แสดงรูปภาพ
            };

            // อ่านไฟล์รูปภาพและแสดง
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    // ใช้ addEventListener เพื่อตรวจสอบการเลือกรูปภาพ
    document.getElementById('fileInput').addEventListener('change', previewImage);
</script>


<style>
  *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Itim', cursive;
  }
  section{
    position: relative;
    width: 100%;
    min-height: 30vh;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #FFFDFA;
  }
  header{
    position: absolute;
    top: 0;
    left:0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  header .logo{
    position: relative;
    max-width: 50px;
  }
  header ul{
    position: relative;
    display: flex;
  }
  header ul li {
    list-style: none;
  }
  header ul li a {
    display: inline-block;
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    text-decoration: none;
    margin-top: 20px;
  }
  header ul li img {
    display: inline-block;
    text-decoration: none;
    align-items: center;
  }

  .action{
    position : relative;
    top : -5px;
    left : -20px;
    z-index: 2;
}
.action .profile {
    position : relative;
    width : 60px;
    height: 60px;
    overflow: hidden;
    cursor: pointer; 
}
.action .profile img{ 
    position: absolute;
    top:0;
    width : 50%;
    height : 50%;
    object-fit : cover;
    /* ขนาด icon profile */
}
.action .menu{
    position: absolute;
    top : 70px;
    right : -10px;
    /* padding : 10px 20px; */
    background : #ADD495;
    width : 130px;
    box-sizing : 0 5px rgba(0,0,0,0,1) ;
    border-radius  : 15px;
    transition : 0.5s;
    visibility: hidden;
    opacity: 0;
}
.action .menu.active{
    visibility: visible;
    opacity: 1;
    /* เด้งออกมา */
}
.action .menu ::before{
    content : '';
    position : absolute;
    top: -5px;
    right : 45px;
    width : 20px;
    height: 20px;
    background:#ADD495;
    transform : rotate(45deg);
}
.action .menu ul li {
    list-style: none; 
    padding : 12px 0;
    border-top: 1px solid rgba(0,0,0,0.05);
    display : flex;
    align-items: center;
}
.action .menu ul li img {
    max-width: 30px;
    margin-right: 5px;
    margin-left: -5px;
    opacity: 0.5;
    /* สีเข้ม อ่อน */
    transition : 0.5s;
}
.action .menu ul li:hover img{
    opacity: 1;  
}
.action .menu ul li a {
    display : inline-block;
    text-decoration: none;
    color : #000;
    font-weight : 500;
    transition : 0.5s;
    margin: auto;
}
.action .menu ul li:hover a{
    font-weight: bold;
    color : #fff;
}
  .content{
    position:relative;
    top:10px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .content .textbox{
    position: relative;
    right: 300px;
    bottom: 100px;
    /* max-width: 500px;
    left: 50px; */
  }
  .content .textbox h2{
    color: #333;
    font-size: 3em;
    line-height: 1.4em;
    font-weight: 500;
    
  }
.imgb{
    width: 500px;
    display: flex;
    justify-content: flex-end;
    padding-right: 50px;
    margin-top: 60px;
  }
 .imgb img{
    max-width: 650px; /*ขนาดรูป*/ 
    position: fixed;
    left: 230px;
    bottom: 230px;
  }
  
</style>