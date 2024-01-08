<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location: login.php");
} elseif ($_SESSION["status"] != 2) {
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
          <div class="circle"></div>
            <header>
                <a href = "pagereport.php"  class ="logo mt-1" ><img src = "https://cdn-icons-png.flaticon.com/128/11502/11502464.png"
                  width="30" height="30" title = "Back"></a>
              </header>
  <div class = "container">
  <div class="h4 text-center alert alert-success mb-10 " role="alert">
  ข้อมูลผู้ใช้งาน
</div>
<table class="table table-bordered">
      <tr>
       <th>ชื่อ</th>
       <th>นามสกุล</th>
       <th>วันที่จอง</th>
       <th>เวลาที่จอง</th>
       <th>เครื่องซักผ้า</th>
       <th>บริการรับ - ส่ง</th>
       <th>ที่อยู่</th>
       <th>เบอร์โทรศัพท์</th>
       <th>ราคา</th>
      </tr>
  </table>
  <?php
  $sql = "SELECT date"
  ?>
</div>
<section>
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
    padding: 100px;
    justify-content: space-between;
    align-items: center;
    /* background: #FFFDFA; */
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

@media screen and (min-width : 650px) {
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
.circle{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #92CEA8 ;
    clip-path:circle(600px at right 900px) ;

  }
</style>