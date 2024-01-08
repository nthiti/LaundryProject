<?php
    session_start();
    include 'condb.php';
    if(!isset($_SESSION["firstname"])){ //check ค่าว่าง
    header("location:login.php");
    }elseif ($_SESSION["status"] != 2) {
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
                      <h2 class="text-center" >แจ้งข้อมูลการซ่อม</h2>
                      <br>
                      <div>
                      <a href = "owner_show_repair.php"><button type="button" class="btn btn-outline-info">รายการทั้งหมด</button></a>
                      <a href = "repair_ow_fin.php"><button type="button" class="btn btn-outline-success">ทำรายการเสร็จสิ้น</button></a>
                      <a href = "repair_ow_wait.php"><button type="button" class="btn btn-outline-primary">รอดำเนินการ</button></a>
                      </div>
        <br>
        <a href="owner_add_repair.php" class="btn btn-success mb-4">เพิ่มการแจ้งซ่อม</a>
        <div class="table-responsive">
            <h3>ตารางแสดงข้อมูลที่มีการแจ้งซ่อมในวันนี้</h3>
            <table class="table table-bordered">
                <tr>
                    <th>ลำดับที่</th>
                    <th>วันที่</th>
                    <th>ประเภท</th>
                    <th>เลขเครื่อง</th>
                    <th>รายละเอียด</th>
                    <th>สถานะ</th>
                    <th>วันที่ซ่อม</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
                <?php 
                $sql = "SELECT * FROM repair WHERE DATE(notify_date) = CURDATE() AND repair.status = 'WAITING' 
                ORDER BY repair.notify_date DESC";
                $result = mysqli_query($conn, $sql);
                $counter = 1;
                while($row = mysqli_fetch_array($result)) { 
                ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= $row["notify_date"] ?></td>
                    <td><?= $row["type"] ?></td>
                    <td><?= $row["number"] ?></td>
                    <td><?= $row["detail"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <td><?= $row["repair_date"] ?></td>
                    <td><a href="owner_edit_repair.php?id=<?= $row["id"] ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="owner_delect_repair.php?id=<?= $row["id"] ?>" class="btn btn-danger" onclick="Del(this.href);return false";>Delete</a></td>
                </tr>
                <?php
                    $counter++;
                }
                ?>
            </table>
        </div>
        <br>
        <div class="table-responsive">
            <h3>ตารางแสดงข้อมูลการแจ้งซ่อมที่ผ่านมา</h3>
            <table class="table table-bordered">
                <tr>
                    <th>ลำดับที่</th>
                    <th>วันที่</th>
                    <th>ประเภท</th>
                    <th>เลขเครื่อง</th>
                    <th>รายละเอียด</th>
                    <th>สถานะ</th>
                    <th>วันที่ซ่อม</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
                <?php 
                $sql_old = "SELECT * FROM repair WHERE DATE(notify_date) <> CURDATE() AND repair.status = 'WAITING' 
                ORDER BY repair.notify_date DESC";
                $result_old = mysqli_query($conn, $sql_old);
                $counter_old = 1;
                while($row_old = mysqli_fetch_array($result_old)) { 
                ?>
                <tr>
                    <td><?= $counter_old ?></td>
                    <td><?= $row_old["notify_date"] ?></td>
                    <td><?= $row_old["type"] ?></td>
                    <td><?= $row_old["number"] ?></td>
                    <td><?= $row_old["detail"] ?></td>
                    <td><?= $row_old["status"] ?></td>
                    <td><?= $row_old["repair_date"] ?></td>
                    <td><a href="owner_edit_repair.php?id=<?= $row_old["id"] ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="owner_delect_repair.php?id=<?= $row_old["id"] ?>" class="btn btn-danger" onclick="Del(this.href);return false";>Delete</a></td>
                </tr>
                <?php
                    $counter_old++;
                }
                ?>
            </table>
              </div>
    </div>
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