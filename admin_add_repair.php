<?php
    session_start();
    include 'condb.php';
    if(!isset($_SESSION["firstname"])){ //check ค่าว่าง
    header("location:login.php");
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
        <a href = "admin_show_repair.php" class ="logo"><img src = "img/pic6.png"
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
        <div class="row">
            <div class="col">
                <div class="h4 text-center alert alert-success mb-4" role="alert">เพิ่มการแจ้งซ่อม</div>
                <form method="POST" action="admin_insert_repair.php">                
                <label>Date</label>
<input type="date" name="notify_date" class="form-control" placeholder="Please select a date" required
       min="<?php echo date('Y-m-d'); ?>"
       max="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"><br>
                    

                    <label>Type</label>
                    <select name="type" class="form-control" id="typeSelect">
                        <option value="0">--Please select a type--</option>
                        <option value="wash">Wash</option>
                        <option value="dry">Dry</option>
                    </select><br>

                    <label>Machine Number</label>
                    <select name="wash_number" class="form-control">
                        <option value="0">--Machine Number--</option>
                        <?php
                        $sql = "SELECT weight,number FROM wash";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row["number"] . ' | ' . $row["weight"] . '">' . $row["weight"] . "Kg. 0" . $row["number"] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="dry_number" class="form-control" id="dryNumberSelect" style="display:none;">
                      <option value="0">--Machine Number--</option>
                      <?php
                      $sql = "SELECT weight,number FROM dryer";
                      $result = mysqli_query($conn, $sql);

                      while ($row = mysqli_fetch_array($result)) {
                          echo '<option value="0' . $row["number"] .'">' . $row["weight"] . "Kg. 0" . $row["number"] . '</option>';
                      }
                      mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
                      ?>
                    </select>

                    <script>
                        // เพิ่มรหัส JavaScript เพื่อเปลี่ยนรายการใน "Machine Number" ตามประเภทที่ผู้ใช้เลือก
                        const typeSelect = document.getElementById("typeSelect");
                        const washNumberSelect = document.querySelector('select[name="wash_number"]');
                        const dryNumberSelect = document.querySelector('select[name="dry_number"]');

                        typeSelect.addEventListener("change", function () {
                            // เมื่อผู้ใช้เลือกประเภท (Wash หรือ Dry)
                            // ให้ทำการแสดงหรือซ่อนรายการใน "Machine Number"
                            if (typeSelect.value === "wash") {
                                washNumberSelect.style.display = "block"; // แสดง dropdown ของ wash
                                dryNumberSelect.style.display = "none"; // ซ่อน dropdown ของ dry
                            } else if (typeSelect.value === "dry") {
                                washNumberSelect.style.display = "none"; // แสดง dropdown ของ wash
                                dryNumberSelect.style.display = "block"; // ซ่อน dropdown ของ dry
                            }
                        });
                    </script>

                    <br>


                    <div class="input-group">
                        <label class="input-group-text">Detail</label>
                        <input type="text" name="detail" class="form-control" aria-label="Detail" placeholder="Write something.." style="height:150px">
                    </div><br>
                    <!-- <textarea name="detail" class="form-control" aria-label="With textarea" placeholder="Write something.." style="height:200px" required></textarea><br> -->

                    <label>Status</label>
                        <select name="status" class="form-control">
                        <option value="0">--Please select a status--</option>
                        <option value="WAITING">Waiting</option>
                        <option value="FINISH" disabled="disabled">Finish</option>
                    </select><br>

                    <label>Repair Date</label>
                    <input type="date" name = "repair_date" class="form-control" placeholder = "Please select a Repair Date" disabled="disabled"><br>

                    <input type="submit" value="Submit" class="btn btn-success" name="add_repair">
                    <a href="admin_show_repair.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
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