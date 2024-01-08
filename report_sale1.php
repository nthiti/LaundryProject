<?php
    include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">

    <section>
          
          <header>
              <a href = "Homeowner.php" class ="logo"><img src = "img/pic6.png"
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
                      <!-- <ul>
                          <li><img src = "https://cdn-icons-png.flaticon.com/128/900/900797.png" 
                          width = 30 height = 30> 
                          <a href = "#" >Setting</a></li>
                          
                      </ul> -->
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
        <div class="container">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        ผลรวมของการจองรายวัน
                                    </div>
                                    <div class="card-body">
                                        <!-- กราฟผลรวมการจองรายวัน -->
                                        <?php
                                            // คำสั่ง SQL สำหรับการนับจำนวนการจองในแต่ละวัน
                                            $sql ="SELECT dob, COUNT(*) AS totalCheckINbyDate FROM booking
                                                    GROUP BY dob
                                                    ORDER BY dob DESC";
                                            // $sql = "SELECT dob, COUNT(*) AS totalCheckINbyDate FROM booking GROUP BY dob ORDER BY dob DESC";

                                            // ทำการส่งคำสั่ง SQL ไปยังฐานข้อมูล
                                            $result = mysqli_query($conn, $sql);

                                            //for chart
                                            $datesave = array();
                                            $total = array();

                                            foreach($result AS $rs) {
                                                $datesave[] = "\"".$rs['dob']."\"";
                                                $total[] = "\"".$rs['totalCheckINbyDate']."\"";
                                            }
                                            $datesave = implode(",", $datesave);
                                            $total = implode(",", $total);

                                            // echo $datesave;
                                            // ถ้าใช้คำสั่งนี้ print_r($datesave); จะแสดงเป็น Array 
                                        
                                        ?>
                                        <!-- ต้องเชื่อมเน็ตถึงใช้ได้ -->
                                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
                                        <!--devbanban.com-->
                                        <canvas id="myChart" width="800px" height="300px"></canvas>
                                        <script>
                                            var ctx = document.getElementById("myChart").getContext('2d');
                                            var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                            labels: [<?php echo $datesave;?>
                                            
                                            ],
                                            datasets: [{
                                            label: 'จำนวนการจองต่อวัน',
                                            data: [<?php echo $total;?>
                                            ],
                                            backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                            }]
                                            },
                                            options: {
                                            scales: {
                                            yAxes: [{
                                            ticks: {
                                            beginAtZero:true
                                            }
                                            }]
                                            }
                                            }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        จำนวนการจองต่อเดือน
                                    </div>
                                    <div class="card-body">
                                        <!-- กราฟรายเดือน -->
                                        <?php
                                            // คำสั่ง SQL สำหรับการนับจำนวนการจองในแต่ละวัน
                                            $sql ="SELECT DATE_FORMAT(dob, '%Y-%m') AS monthYear, COUNT(*) AS totalCheckINbyMonth
                                                    FROM booking
                                                    GROUP BY monthYear
                                                    ORDER BY monthYear DESC";

                                            // ทำการส่งคำสั่ง SQL ไปยังฐานข้อมูล
                                            $result = mysqli_query($conn, $sql);

                                            //for chart
                                            $datesave = array();
                                            $total = array();

                                            foreach($result AS $rs) {
                                                $datesave[] = "\"".$rs['monthYear']."\"";
                                                $total[] = "\"".$rs['totalCheckINbyMonth']."\"";
                                            }
                                            $datesave = implode(",", $datesave);
                                            $total = implode(",", $total);

                                            // echo $datesave;
                                            // ถ้าใช้คำสั่งนี้ print_r($datesave); จะแสดงเป็น Array 
                                        
                                        ?>
                                        <!-- ต้องเชื่อมเน็ตถึงใช้ได้ -->
                                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
                                        <!--devbanban.com-->
                                        <canvas id="myChart_month" width="800px" height="300px"></canvas>
                                        <script>
                                            var ctx = document.getElementById("myChart_month").getContext('2d');
                                            var myChart_month = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                            labels: [<?php echo $datesave;?>
                                            
                                            ],
                                            datasets: [{
                                            label: 'ผลรวมการจองรายเดือน',
                                            data: [<?php echo $total;?>
                                            ],
                                            backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                            }]
                                            },
                                            options: {
                                            scales: {
                                            yAxes: [{
                                            ticks: {
                                            beginAtZero:true
                                            }
                                            }]
                                            }
                                            }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ตาราง -->
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                รายการ
                            </div><br>
                            
                            <div class="card-body">
                                <form method="POST" action="report_sale1.php">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="date" name="dt1" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="date" name="dt2" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form><br>
                                <table id="datatablesSimple">
                                    <thead class="table-dark" >
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Wash Number</th>
                                        <th>Temperature</th>
                                        <th>Dryer</th>
                                        <th>Delivery</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Total</th>
                                        <!-- <th>Status</th> -->
                                    </thead>
                                    <?php
                                    $ddt1 = @$_POST['dt1']; 
                                    $ddt2 = @$_POST['dt2']; 
                                    if(($ddt1 != "") & ($ddt2 != "")) {
                                        echo "ค้นหาจากวันที่ $ddt1 ถึง $ddt2 ";
                                        $sql = "SELECT * FROM booking WHERE dob BETWEEN '$ddt1' AND '$ddt2'";

                                    } else {
                                        $sql = "SELECT * FROM booking";
                                    }

                                    $total_sum = 0;
                                    // $sql = "SELECT * FROM booking";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_array($result)){ 
                                    // $status = $row['booking_status'];
                                    $total_sum = $total_sum + intval($row["Total"]);


                                    ?>
                                    <tr>
                                        <td><?=$row["id_booking"]?></td>
                                        <td><?=$row["dob"]?></td>
                                        <td><?=$row["time"]?></td>
                                        <td><?=$row["wash_num"]?></td>
                                        <td><?=$row["temperature"]?></td>
                                        <td><?=$row["dryer"]?></td>
                                        <td><?=$row["delivery"]?></td>
                                        <td><?=$row["address"]?></td>
                                        <td><?=$row["phone"]?></td>
                                        <td><?=$row["Total"]?></td>
                                        <!--if($status ==1){
                                            echo "ชำระเงินแล้ว";
                                        } else if($status ==2) {
                                            echo "ชำระเงินแล้ว";
                                        } else if($status ==0) {
                                            echo "ยกเลิกการจอง";
                                        }
                                         -->
                                
                                    </tr>
                                    <?php
                                        }
                                        mysqli_close($conn);
                                    ?>
                                </table>
                                <div class="text-center">
                                    <b>
                                        รวมเป็นเงินทั้งหมด <?=number_format($total_sum,2)?> บาท
                                    </b>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
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
    padding: 60px;
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
    padding : 10px 20px;
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
    padding : 10px 0;
    border-top: 1px solid rgba(0,0,0,0.05);
    display : flex;
    align-items: center;
}
.action .menu ul li img {
    max-width: 30px;
    margin-right: 10px;
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
</style>