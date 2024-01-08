<?php
session_start();
include 'condb.php';
include_once 'dbConfig.php';
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
                    <div class="container"><br>
              
        <div class="container">
        <div class="alert alert-success" role="alert">
        <h4 class="text-center">Upload Image</h4>
            </div>
          <div class = "row mt-5">
            <div class = "col-12">
              <form action = "upload_ow.php" method ="post" enctype = "multipart/form-data"> 
                <div class="text-center justify-content-center align-items-center p-4 border-2 border-dashed rounded-3">
                  <h6 class ="my-2">Select image file to upload</h6>
                  <input type="file" name = "file" class ="frome-control streched-link" accept = "image/gif, image/jpeg , image/png">
                  <p class = "small mb-0 mt-2"><b>Note : </b>Only JPG , JPEG , PNG , GIF </p>
                </div>
                <div class="d-sm-flex justify-content-end mt-2"> 
                  <input type="submit" name = "submit" value = "upload" class=  "btn btn-sm btn-primary mb-3">
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <?php if(!empty($statusMsg)){ ?>
                <div class="alert alert-secondary" role ="alert">
                  <?php echo $statusMsg; ?>
                </div>
           <?php } ?>
          </div>
          <div class=" row g-2">
            <?php
            $query = $db->query("SELECT * FROM  images ORDER BY upload_on DESC");
            if($query->num_rows > 0){
              while($row = $query->FETCH_ASSOC()){
                $imageURL = 'uploads/'.$row['file_name'];
              ?>
      <table class="table table-bordered text-center">
      <tr>
      <th>ID</th>
       <th>Picture</th>
        <th>Delete</th>
      </tr>
      <?php
 
      ?>
       <tr>
       <td><?=$row["id"]?></td>
      <td ><img src = "<?php echo $imageURL ?>" alt = "" width= "100%" class = "card-img" ></td>
      <td><a href = "deletepost.php?id=<?=$row["id"]?>" class="btn btn-outline-danger mt-2" onclick = "Del(this.href);return false;"> Delete </a></td>                </tr>
    <?php
  }
  mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
    ?>
    </table>
              <?php
              }
             else { ?>
              <!-- <p>No image Found.... </p> -->
      <?php   }
                  ?>
          </div>
        </div>

</div>

</body>
</html>

<script language = "JavaScript">
function Del(mmyypage){
  var agree = confirm("Do you want to delete the data?");
  if(agree){
    window.location=mypage;
  }
}


</script>
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
    height: 100%;
    padding: 100px;
    /* display: flex; */
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
  .circle{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    /* height: 100%; */
    background: #92CEA8 ;
    clip-path:circle(600px at right 1000px) ;

  }
}
</style>