<?php
   session_start(); 
   include 'condb.php';

   if(!isset($_SESSION["firstname"])){ //check ค่าว่าง
    header("location:login.php");
 }elseif ($_SESSION["status"] != 1) {
  echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
  exit();
}
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
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
<meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
</style>
    <title>R Laundry</title>
  </head>
  <body>
                    <section>
            <header>
                <a href = "Homead.php" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
                <ul>
                  <!-- <li><a href="#">HOME</a></li>
                  <li><a href="service.php">SERVICE</a></li>
                  <li><a href="#">BOOKING STATUS</a></li>
                  <li><a href="#">MY BOOKING STATUS</a></li> -->
                  <li>
                    <div class="action">
                        <a class = "profile" onclick ="menuToggle();"> 
                            <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" 
                            title="LOGIN" class="login" width =  20 height = 20>
                        </a>
                        <div class ="menu">
                        <ul>
                            <li><img src = "https://cdn-icons-png.flaticon.com/128/1828/1828427.png" 
                            width = 30 height = 30> 
                            <a href = "index.php" 
                            >Logout</a></li>
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
          <!-- Main Content -->
    <div id="main">
      <!-- Welcome Section -->
      <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card custom-card1 text-white mb-4">
                                    <div class="card-body">
                                    <a href = "booking_sta_ad.php " class="text-white" >
                                        <?php
                                            $sql = "SELECT COUNT(*) as total FROM booking";
                                            // ทำการส่งคำสั่ง SQL ไปยังฐานข้อมูล
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                // แปลงผลลัพธ์เป็นอาร์เรย์และเข้าถึงค่าจำนวนที่นับได้
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                
                                                // แสดงค่าจำนวนที่นับได้
                                                echo "<h3>$total</h3>";
                                            }
                                        ?>
                                        <p>จำนวนรายการจองทั้งหมด</p>
                                        </a>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card custom-card text-white mb-4">
                                    <div class="card-body">
                                    <a href = "booking_sta_staad.php " class="text-white" >
                                    <?php
                                        // คำสั่ง SQL เพื่อรวมยอดเงิน
                                        $sql = "SELECT COUNT(*) as total FROM payment WHERE payment.status_payment = '0'";


                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            // ดึงผลลัพธ์รวมเงิน
                                            $row = mysqli_fetch_assoc($result);
                                            $totalAmount = $row['total'];

                                            // แสดงผลลัพธ์รวมเงิน
                                            echo "<h3>" . number_format($totalAmount) . "</h3>";
                                        }
                                    ?>
                                    <p>จำนวนการจองที่ยังไม่ได้ตรวจสอบ</p>
                                    </a>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card custom-card3 text-white mb-4">
                                    <div class="card-body">
                                    <a href = "information_user_ad.php" class="text-white" >
                                        <?php
                                           // คำสั่ง SQL สำหรับการนับจำนวนแถวที่มีค่า "user" ในคอลัมน์ "role"
                                            $sql = "SELECT COUNT(*) as total FROM db_user WHERE status = '0'";

                                            // ทำการส่งคำสั่ง SQL ไปยังฐานข้อมูล
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                // แปลงผลลัพธ์เป็นอาร์เรย์และเข้าถึงค่าจำนวนที่นับได้
                                                $row = mysqli_fetch_assoc($result);
                                                $totalUsers = $row['total'];
                                                
                                                // แสดงค่าจำนวนสมาชิกที่เป็น "user"
                                                echo "<h3>$totalUsers</h3>";
                                            }
                                        ?>
                                        <p>จำนวนสมาชิก(User)</p></a>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card custom-card2 text-white mb-4">
                                    <div class="card-body">
                                    <a href = "repair_ad_wait.php" class="text-white" >
                                    <?php
                                           // คำสั่ง SQL สำหรับการนับจำนวนแถวที่มีค่า "user" ในคอลัมน์ "role"
                                            $sql = "SELECT COUNT(*) as total FROM repair WHERE status = '' or status = 'WAITING'";

                                            // ทำการส่งคำสั่ง SQL ไปยังฐานข้อมูล
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                // แปลงผลลัพธ์เป็นอาร์เรย์และเข้าถึงค่าจำนวนที่นับได้
                                                $row = mysqli_fetch_assoc($result);
                                                $totalrepair = $row['total'];
                                                
                                                // แสดงค่าจำนวนสมาชิกที่เป็น "user"
                                                echo "<h3>$totalrepair</h3>";
                                            }
                                        ?>
                                        <p>รายการแจ้งซ่อม</p></a>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                        </div>
      <div id="welcome" >
      <h2 class = "mt-10"> <?php
                        if(isset($_SESSION["firstname"])){
                        echo "<div class = 'text-success'>";
                        echo "Welcome , Admin  🎉";
                        echo "</div>";
                        }?></h2>
        <div id = "booking" class = "book">
        <a href = "servicead.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/7050/7050939.png" 
        width =  50 height = 50> <br>
        จองบริการ</button></a>
        <a href = "pagepost_ad.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/2333/2333043.png" 
        width =  50 height = 50> <br>
        โพสต์ข่าวสาร</button></a>
        <a href = "booking_sta_ad.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/2907/2907150.png" 
        width =  50 height = 50> <br>
        สถานะการจอง</button></a>
        <a href = "information_user_ad.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/1256/1256650.png" 
        width =  50 height = 50> <br>
        รายชื่อลูกค้า</button></a>
        <a href = "pagereport_ad.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/3534/3534066.png" 
        width =  50 height = 50> <br>
        รายงาน</button></a>
        <a href = "admin_show_repair.php"><button class="btn1">
        <img src="https://cdn-icons-png.flaticon.com/128/1850/1850687.png" 
        width =  50 height = 50> <br>
        แจ้งซ่อม</button></a>
 
      </div>
    </div>
    <!-- Footer -->
    <!-- <div id="footer">
      <p class="text-center">R Laundry &copy; Thitiphon Phonchita 2023 </p>
    </div> -->
    </section>
  </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
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
    /* min-height: 120px; */
    display: flex;
    padding : 100px;
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
#main {
    margin-right: 150px;
    margin-left: 150px;
    margin-bottom : 200px ;
  }
.button{
    padding:  70px 100px;
    cursor: pointer;
    border: 0px;
    background-color:transparent;
    position: relative;
    transition: all 0.15s ease;

}
.btn1{
    background: #7ED957;
    color: #000;
    border-radius: 10px;
    border-color: #fff;
    transition: all 0.25s ease;
    margin-top: 10px;
    font-size: 15px;
    width: 200px;
    height : 150px ;
}
.btn1:hover{
    transform: translate(-3px,-3px);
}
.btn1:hover::before{
    transform: translate(3px,3px);
}
.btn1 :hover::after{
    transform: translate(2px,2px);
}
.custom-card {
    background-color: #2ECC71  ;
}
.custom-card1 {
    background-color: #3498DB   ;
}
.custom-card2 {
    background-color: #E74C3C    ;
}
.custom-card3 {
    background-color:#F1C40F   ;
}
.card {
    border: none; /* หรือ border: 0; */
}
.card-footer{
    border: none; /* หรือ border: 0; */
}
a{
    text-decoration: none;
}
a:hover {
    color: #293242 !important;
}
</style>