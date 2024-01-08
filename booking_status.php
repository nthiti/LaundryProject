<?php
session_start();
include 'condb.php';
include_once 'dbConfig.php';

if (!isset($_SESSION["firstname"])) {
    header("location:login.php");
    exit();
} elseif ($_SESSION["status"] != 0) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}

$firstname = $_SESSION["firstname"];
$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 day"));

$sql_today = "SELECT booking.*, db_user.firstname, db_user.lastname, payment.*
        FROM booking
        LEFT JOIN db_user ON booking.user_id = db_user.id_user
        LEFT JOIN payment ON booking.id_booking = payment.id_booking
        WHERE db_user.firstname = '$firstname' AND booking.dob = '$today'
        ORDER BY booking.dob DESC, booking.time DESC";

$sql_yesterday = "SELECT booking.*, db_user.firstname, db_user.lastname, payment.*
FROM booking
LEFT JOIN db_user ON booking.user_id = db_user.id_user
LEFT JOIN payment ON booking.id_booking = payment.id_booking
WHERE db_user.firstname = '$firstname' AND booking.dob < CURDATE() AND status_payment = '1'  AND status_work = '1'
ORDER BY booking.dob DESC, booking.time DESC";

$result_today = mysqli_query($conn, $sql_today);
$result_yesterday = mysqli_query($conn, $sql_yesterday);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
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
        <a href="home_user.php" class="logo"><img src="img/pic6.png" width="70" height="70"></a>
        <ul>
            <li><a href="home_user.php">HOME</a></li>
            <li><a href="service.php">SERVICE</a></li>
            <li><a href="booking_status.php">MY BOOKING STATUS</a></li>
            <li>
                <div class="action">
                    <a class="profile" onclick="menuToggle();">
                        <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" title="LOGIN"
                             class="login" width="20" height="20">
                    </a>
                    <div class="menu">
                        <ul>
                            <li><img src="https://cdn-icons-png.flaticon.com/128/900/900797.png" width="30" height="30">
                                <a href="setting.php">Setting</a></li>
                        </ul>
                        <ul>
                            <li><img src="https://cdn-icons-png.flaticon.com/128/1828/1828427.png" width="30"
                                     height="30">
                                <a href="index.php?logout=1">Logout</a>
                            </li>
                        </ul>
                        <h3><h3>
                    </div>
                    <script>
                        function menuToggle() {
                            const toggleMenu = document.querySelector('.menu');
                            toggleMenu.classList.toggle('active')
                        }
                    </script>
                </div>
            </li>
        </ul>
    </header>
</section>
<div class="container">
    <h2>
        <?php
        if (isset($_SESSION["firstname"])) {
            echo "<div class='text-success'>";
            echo "Welcome , " . $_SESSION["firstname"] . " 🎉";
            echo "</div>";
        }
        ?>
    </h2>
    <br>
    <h4>ข้อมูลการจองวันนี้</h4>
    
    <table class="table table-bordered">
        <tr>
            <th>วันที่จอง</th>
            <th>เวลาที่จอง</th>
            <th>เครื่องที่จอง</th>
            <th>รายละเอียด</th>
            <th>ชื่อหอพัก</th>
            <th>ราคา</th>
            <th>สถานะการจ่ายเงิน</th>
            <th>สถานะการจอง</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result_today)) {
            $status = $row["status_payment"];
            $status1 = $row["status_work"];
            ?>
              <tr>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['wash_num'] ?></td>
                    <td>อุณหภูมิ : <?= $row['temperature'] ?> , เครื่องอบ : <?= $row['dryer'] ?>,
                        บริการส่ง : <?= $row['delivery'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['Total'] ?></td>
                    <td>
                        <?php
                        if ($status == 1) {
                            echo "<b style='color: green'> ชำระเงินเรียบร้อยแล้ว </b> ";
                        } else {
                            echo " <b style='color: red'> รอการตรวจสอบ </b>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                         if ($status1 == 1) {
                            echo " <b style='color: green'> ดำเนินการเสร็จสิ้น </b>";
                        }  else {
                            echo " <b style='color: red'> รอดำเนินการ </b>";
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <h4>ข้อมูลการจองที่ผ่านมา</h4>
    <table class="table table-bordered">
        <tr>
            <th>วันที่จอง</th>
            <th>เวลาที่จอง</th>
            <th>เครื่องที่จอง</th>
            <th>รายละเอียด</th>
            <th>ชื่อหอพัก</th>
            <th>ราคา</th>
            <th>สถานะการจ่ายเงิน</th>
            <th>สถานะการจอง</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result_yesterday)) {
            $status = $row["status_payment"];
            $status1 = $row["status_work"];
            ?>
              <tr>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['wash_num'] ?></td>
                    <td>อุณหภูมิ : <?= $row['temperature'] ?> , เครื่องอบ : <?= $row['dryer'] ?>,
                        บริการส่ง : <?= $row['delivery'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['Total'] ?></td>
                    <td>
                        <?php
                        if ($status == 1) {
                            echo "<b style='color: green'> ชำระเงินเรียบร้อยแล้ว </b> ";
                        } else {
                            echo " <b style='color: red'> รอการตรวจสอบ </b>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                         if ($status1 == 1) {
                            echo " <b style='color: green'> ดำเนินการเสร็จสิ้น </b>";
                        }  else {
                            echo " <b style='color: red'> รอดำเนินการ </b>";
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>


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
    min-height: 120px;
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
    /* bottom: 200px; */
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
    margin-top: 5px;
    margin-left: 180px;
  }
  h3{
    margin-top  : 10px;
  }
</style>