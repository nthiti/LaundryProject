<?php
session_start();
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

    <title>R Laundry</title>
  </head>
<body>
     <!-- <?php
            $query = $db->query("SELECT * FROM  images ORDER BY upload_on DESC");
            if($query->num_rows > 0){
              while($row = $query->FETCH_ASSOC()){
                $imageURL = 'uploads/'.$row['file_name'];
              ?> -->
                  <!-- <img src = "<?php echo $imageURL ?>" alt = "" width= "100%" class = "card-img" > -->
              <!-- <?php
              }
            } else { ?> -->
              <!-- <p>No image Found.... </p> -->
      <!-- <?php   } 
                  ?> -->
        <section>
          <div class="circle"></div>
            <header>
                <a href = "#" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
                <ul>
                  <li><a href="#">HOME</a></li>
                  <li><a href="service.php">SERVICE</a></li>
                  <li><a href="#">BOOKING STATUS</a></li>
                  <li><a href="#">MY BOOKING STATUS</a></li>
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
                            <li><img src = "https://cdn-icons-png.flaticon.com/128/1828/1828427.png" 
                            width = 30 height = 30> 
                            <a href = "logout.php" 
                            <?php
                            // unset($_SESSION['user_login']);
                            ?>
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
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators ">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/R.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?php echo $imageURL ?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/R_laundry.gif" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> 
        
              <div class="content">
                  <div class="textbox">
                    <h2>Welcome , <?php echo $row['firstname'] ?> 🎉</h2>
                    <h2> R Laurdy ให้บริการซักผ้า อบผ้า <br><span>ตลอด 24 ชั่วโมง</span></h2>
                    <p>ร้านของเราให้บริการซักผ้า อบผ้า มีบริการรับ-ส่งถึงหอพัก ยินดีให้บริการ 24 ชั่วโมง
                      <br>ซักอบจบภายใน 1ชม. ซักน้ำร้อน อบร้อนอุณหภูมิสูง ฆ่าเชื้อโรค covid-19
                      <br><span>Free ‼️น้ำยาซักผ้า-น้ำยาปรับผ้านุ่ม เกรดพรีเมียม</span></br>  
                      <br>📌พิกัด หน้ามอ.เกษตร (กำแพงแสน) ติดตลาดนัด ku market </br>
                    </p>
                    <a href ="#" class= "booking">จองบริการของเรา</a>
                  </div>
                  <div class="imgb">
                    <img src="img/pic6.png" class="logo">
                  </div>
              </div>
              <ul class="sci">
                <li><a href="https://www.facebook.com/profile.php?id=100069502676828">
                  <img src = "https://cdn-icons-png.flaticon.com/128/2504/2504903.png"
                  width = 70 height="70"></a></li>
                <li><a href="https://lin.ee/IOcIb89">
                  <img src = "https://cdn-icons-png.flaticon.com/128/2504/2504922.png"
                  width = 70 height="70" ></a></li>
              </ul>
        
</body>
</html>

<style>
*{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'poppins', Roboto Condensed;
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
.carousel{
    /* position: absolute; */
    bottom : 100px;
    z-index: 1;
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
    max-width: 800px;
    left: 100px;
  }
  .content .textbox h2{
    color: #333;
    font-size: 3em;
    line-height: 1.4em;
    font-weight: 500;
    
  }
  .content .textbox h2 span{
    color: #1cc99e;
    line-height: 1.2em;
    font-weight: 900;
  }
  .content .textbox p{
    color: #333;
    font-size: 18px;
  }
  .content .textbox p span{
    color:  #db2a2a;
    line-height: 1.2em;
    font-weight: 500;
  }
  .content .textbox a {
    display: inline-block;
    margin-top: 20px;
    padding: 8px 20px ;
    background: #1cc99e;
    color: #fff;
    border-radius:40px ;
    font-weight:600 ;
    letter-spacing: 1px;
    text-decoration: none;
  }
  .content .imgb{
    width: 700px;
    display: flex;
    justify-content: flex-end;
    padding-right: 50px;
    margin-top: 60px;
  }
  .content .imgb img{
    max-width: 450px;
    position: absolute;
    left: 950px;
    bottom: 5px;
  }
  .sci{
    position:fixed;
    top: 50%;
    right: 30px;
    transform: translateY(-50%); /*ระยะแกน y*/
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 3;
  }
  .sci li{
    list-style: none;
    
  }
  .sci li a {
    display: inline-block;
    margin: 2px 0;
    transform: scale(0.6);
  }
.booking{
  margin-bottom : 15px;
}
  
</style>