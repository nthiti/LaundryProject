<?php
session_start();
include 'condb.php';
include_once 'dbConfig.php';

if (!isset($_SESSION["firstname"])) { // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
    header("location:login.php");
    exit();
}elseif ($_SESSION["status"] != 2) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}
// ดึงข้อมูลการจองของผู้ใช้งานปัจจุบัน
// $user_id = $_SESSION["user_id"];
$sql = "SELECT booking.*, db_user.firstname, db_user.lastname, payment.*
FROM booking
LEFT JOIN db_user ON booking.user_id = db_user.id_user
LEFT JOIN payment ON booking.id_booking = payment.id_booking
ORDER BY booking.dob DESC, booking.time DESC, booking.id_booking DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
        <header>
        <a href = "Homeowner.php" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
                <ul>
                  <li>
                    <div class="action">
                        <a class = "profile" onclick ="menuToggle();"> 
                            <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" 
                            title="LOGIN" class="login" width =  20 height = 20>
                        </a>
                        <div class ="menu">
                        <!-- <ul>
                            <li><img src = "https://cdn-icons-png.flaticon.com/128/900/900797.png" 
                            width = 30 height = 30> 
                            <a href = "setting.php" >Setting</a></li>
                            
                        </ul> -->
                        <ul>
                            <li><img src = "https://cdn-icons-png.flaticon.com/128/1828/1828427.png" 
                            width = 30 height = 30> 
                            <a href = "index.php" >Logout</a></li>
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
                    <div class="container">
                      <h2 class="text-center" >สถานะการจอง</h2>
                      <br>
                      <div>
                      <a href = "booking_sta_owner.php"><button type="button" class="btn btn-outline-info">รายการทั้งหมด</button></a>
                      <a href = "booking_sta_fin.php"><button type="button" class="btn btn-outline-success">ทำรายการเสร็จสิ้น</button></a>
                      <a href = "booking_sta_wait.php"><button type="button" class="btn btn-outline-primary">รอดำเนินการ</button></a>
                      <a href = "booking_sta_sta.php"><button type="button" class="btn btn-outline-warning">รอการตรวจสอบ</button></a>
                      </div>
                            <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>วันที่จอง</th>
                        <th>เวลาที่จอง</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ชื่อหอพัก</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ราคา</th>
                        <th>สถานะการจ่ายเงิน</th>
                        <th>สถานะการจอง</th>
                        <th>รายละเอียด</th>
                        <th>ปรับสถานะการจ่ายเงิน</th>
                        <th>ปรับสถานะการจอง</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>วันที่จอง</th>
                        <th>เวลาที่จอง</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ชื่อหอพัก</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ราคา</th>
                        <th>สถานะการจ่ายเงิน</th>
                        <th>สถานะการจอง</th>
                        <th>รายละเอียด</th>
                        <th>ปรับสถานะการจ่ายเงิน</th>
                        <th>ปรับสถานะการจอง</th>
                    </tr>
                </tfoot>
                <?php
while ($row = mysqli_fetch_array($result)) {
    $bookingId = $row['id_booking'];
    $firstname = $_SESSION["firstname"];
    $tem = $row['temperature'];
    $dryer = $row['dryer'];
    $delivery = $row['delivery'];
    $image_pay = $row['image_pay'];
    $imageURL = 'uploads/' . $row['image_pay'];
    $status = $row["status_payment"];
    $status1 = $row["status_work"];
?>
<tr>
    <td><?= $row['dob'] ?></td>
    <td><?= $row['time'] ?></td>
    <td><?= $row['firstname'] ?>&nbsp;<?= $row['lastname'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $row['phone'] ?></td>
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
    <td><!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $bookingId ?>">
        รายละเอียด
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop<?= $bookingId ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?= $bookingId ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel<?= $bookingId ?>">รายละเอียดอื่นๆ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                เครื่องที่จอง : <?= $row['wash_num'] ?>
                                    <br> อุณหภูมิน้ำ :
                                    <?php
                                    if ($tem == 'Cool') {
                                        echo "น้ำเย็น";
                                    } elseif ($tem == 'Warm') {
                                        echo "น้ำอุ่น";
                                    } else {
                                        echo "น้ำร้อน";
                                    }
                                    ?> <br>
                                    เครื่องอบผ้า : <?php
                                    if ($dryer == 'Yes') {
                                        echo "ใช้บริการ";
                                    } else {
                                        echo "ไม่ใช้บริการ";
                                    }
                                    ?><br>
                                    บริการรับ - ส่ง : <?php
                                    if ($delivery == 'Receive') {
                                        echo "รับ";
                                    } else if ($delivery == 'Receive - Deliver') {
                                        echo "รับและส่ง";
                                    } else if ($delivery == 'Deliver') {
                                        echo "ส่ง";
                                    } else {
                                        echo "ไม่ใช้บริการ";
                                    }
                                    ?> <br>
                                    วันที่จ่ายเงิน : <?= $row['date_pay'] ?> <br>
                                    เวลาที่จ่าย : <?= $row['time_pay'] ?>
                                    <br><br>
                                    <img src="<?php echo $imageURL ?>" class="card-img"> 
                                    <!-- ถ้ารูปไม่ขึ้นมันจะปรับสถานะไม่ได้??? -->
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    </td>
    <td><a href="pay_ment.php?id=<?=$row['id_pay']?>" class="btn btn-outline-success" onclick="updateStatus(this.href); return false;">ปรับสถานะ</a></td>

    <td><a href="work_sta.php?id=<?=$row['id_pay']?>" class="btn btn-outline-success" onclick="updateStatus1(this.href); return false;">ปรับสถานะ</a></td>
</tr>
<?php
}
mysqli_close($conn);
?>

<script>
function updateStatus(url) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // หลังจากอัปเดตข้อมูลเสร็จสิ้น ให้รีเฟรชหน้าเพื่อแสดงข้อมูลใหม่
            location.reload();
        }
    };

    xhr.send();
    var agree = confirm('คุณต้องการปรับสถานะการชำระเงินใช่หรือไม่');
    if (agree) {
        window.location = url; // เพิ่มค่า url ที่ได้รับเข้าไปใน window.location
    }
}
function updateStatus1(url) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // หลังจากอัปเดตข้อมูลเสร็จสิ้น ให้รีเฟรชหน้าเพื่อแสดงข้อมูลใหม่
            location.reload();
        }
    };

    xhr.send();
    var agree = confirm('คุณต้องการปรับสถานะการทำงานใช่หรือไม่');
    if (agree) {
        window.location = url; // เพิ่มค่า url ที่ได้รับเข้าไปใน window.location
    }
}
</script>
</body>
</html>


            </table>
    </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
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
  /* สไตล์ของ popup */
.popup {
    display: none; /* เริ่มต้นแสดง popup ซ่อนไว้ */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* พื้นหลังสีดำโปร่งๆ */
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 100px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 35px;
    cursor: pointer;
}
.card-img {
    width: 200px;
    height: 200px;
    display: block; /* ตั้งให้รูปภาพเป็น block element */
    margin: 0 auto; /* จัดให้รูปอยู่ตรงกลางแนวนอน */
    vertical-align: middle; /* จัดให้รูปอยู่ตรงกลางแนวตั้ง */
}
</style>