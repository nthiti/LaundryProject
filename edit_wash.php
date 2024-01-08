<?php

session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location: login.php");
} elseif ($_SESSION["status"] != 2) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}
$ids = $_GET['id'];
$sql = "SELECT * FROM wash WHERE id ='$ids' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
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
        <a href = "show_wash.php" class ="logo"><img src = "img/pic6.png"
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
<div class = "container ">

<div class="h4 text-center alert alert-success mt-5 mb-10 " role="alert">
  แก้ไขข้อมูลเครื่องซักผ้า
</div>
  <form action="update_wash.php" method="post">
                <label>Id เครื่องซักผ้า</label>
                <input type="number" name="id" class="form-control" readonly value=<?=$row['id']?> > <br>
                <label>น้ำหนักเครื่อง</label>
                <input type="float" name="machine_weight" class="form-control" value=<?=$row['weight']?> id ="text/javascript" > <br>
                <label>หมายเลขเครื่อง</label>
                    <input type="text"  name="machine_number" class="form-control" value=<?=$row['number']?> id ="text/javascript" ><br>
                <label>ราคาน้ำเย็น</label>
                    <input type="number" name="machine_price_cool" class="form-control" value=<?=$row['price_cool']?> id ="text/javascript"  ><br>
                <label>ราคาน้ำอุ่น</label>
                    <input type="number"  name="machine_price_warm" class="form-control" value=<?=$row['price_warm']?> id ="text/javascript" ><br>
                <label>ราคาน้ำร้อน</label>
                    <input type="number" name="machine_price_hot" class="form-control" value=<?=$row['price_hot']?> id ="text/javascript" ><br>
                <div class="from-group mb-3" >
                        <label for = "Status_m" >สถานะเครื่องซักผ้า</label>
                        <select name="status" class="form-control" id="select" value=<?=$row['status']?> id ="text/javascript" >
                            <!-- <option value="0">--Please select status--</option> -->
                            <option value="Start">พร้อมใช้งาน</option>
                            <option value="Not Start">ไม่พร้อมใช้งาน</option>
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" >
                    <a href = "show_wash.php" class="btn btn-danger mt-2"> ยกเลิก </a>
            </form>
    </div>
</body>
</html>

<script type="text/javascript">
    function updateScore(answer, correct) {
      if (answer == correct) {
    $.get('index.php', {'score': '1'}, function(d) {
        alert('Vote Accepted: ' + d);
    });
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
    /* min-height: 120px; */
    display: flex;
    padding : 60px;
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
  @media screen and (min-width : 650px) {
   *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Itim', cursive;
  }
  section{
    position: relative;
    width: 100%;
    /* min-height: 100vh; */
    padding: 60px;
    /* display: flex; */
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

}
</style>
