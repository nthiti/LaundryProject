<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["firstname"])) {
    header("location: login.php");
} elseif ($_SESSION["status"] != 1) {
    echo "คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้";
    exit();
}
$firstname = $_SESSION["firstname"];
$today = date("Y-m-d");

$sql_today = "SELECT booking.*, db_user.firstname, db_user.lastname, payment.* 
            FROM booking
            LEFT JOIN db_user ON booking.user_id = db_user.id_user
            LEFT JOIN payment ON booking.id_booking = payment.id_booking
            WHERE booking.dob = '$today' AND wash_num = 18
            ORDER BY CASE 
                WHEN booking.time = '00:00 - 01:00' THEN 1
                WHEN booking.time = '01:00 - 02:00' THEN 2
                WHEN booking.time = '02:00 - 03:00' THEN 3
                WHEN booking.time = '03:00 - 04:00' THEN 4
                WHEN booking.time = '04:00 - 05:00' THEN 5
                WHEN booking.time = '05:00 - 06:00' THEN 6
                WHEN booking.time = '06:00 - 07:00' THEN 7
                WHEN booking.time = '07:00 - 08:00' THEN 8
                WHEN booking.time = '08:00 - 09:00' THEN 9
                WHEN booking.time = '09:00 - 10:00' THEN 10
                WHEN booking.time = '10:00 - 11:00' THEN 11
                WHEN booking.time = '11:00 - 12:00' THEN 12
                WHEN booking.time = '12:00 - 13:00' THEN 13
                WHEN booking.time = '13:00 - 14:00' THEN 14
                WHEN booking.time = '14:00 - 15:00' THEN 15
                WHEN booking.time = '15:00 - 16:00' THEN 16
                WHEN booking.time = '16:00 - 17:00' THEN 17
                WHEN booking.time = '17:00 - 18:00' THEN 18
                WHEN booking.time = '18:00 - 19:00' THEN 19
                WHEN booking.time = '19:00 - 20:00' THEN 20
                WHEN booking.time = '20:00 - 21:00' THEN 21
                WHEN booking.time = '21:00 - 22:00' THEN 22
                WHEN booking.time = '22:00 - 23:00' THEN 23
                WHEN booking.time = '23:00 - 00:00' THEN 24
                ELSE 25
            END";
$result_today = mysqli_query($conn, $sql_today);
// ดึงข้อมูลราคาจากตาราง wash โดยใช้ข้อมูลที่เลือก
$sql_wash = "SELECT price_cool, price_warm, price_hot FROM wash WHERE weight = 18";
$result_wash = $conn->query($sql_wash);

// ดึงข้อมูลราคาจากตาราง dryer โดยใช้ข้อมูลที่เลือก
$sql_dryer = "SELECT price FROM dryer WHERE number = 1"; // ที่นี่คุณควรเปลี่ยนเงื่อนไขตามที่คุณต้องการ
$result_dryer = $conn->query($sql_dryer);

// ตรวจสอบว่ามีข้อมูลที่ดึงมาหรือไม่
if ($result_wash->num_rows > 0 && $result_dryer->num_rows > 0) {
    // ดึงข้อมูลจากแถวแรกของผลลัพธ์ที่ได้
    $row_wash = $result_wash->fetch_assoc();
    $row_dryer = $result_dryer->fetch_assoc();

    // ดึงราคาจากฐานข้อมูลเพื่อนำมาใช้ในการคำนวณ
    $price_cool = $row_wash['price_cool'];
    $price_warm = $row_wash['price_warm'];
    $price_hot = $row_wash['price_hot'];
    $dryer_price = $row_dryer['price'];
} else {
    echo "ไม่พบข้อมูล";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
     crossorigin="anonymous"></script>
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
</style>

</head>
<body>
<section>
          <div class="circle"></div>
            <header>
                <a href = "servicead.php" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
                <ul>
                  <!-- <li><a href="home_user.php">HOME</a></li>
                  <li><a href="service.php">SERVICE</a></li>
                  <li><a href="booking_status.php">MY BOOKING STATUS</a></li> -->
                  <li>
                    <div class="action">
                        <a class = "profile" onclick ="menuToggle();"> 
                            <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" 
                            title="LOGIN" class="login" width =  20 height = 20>
                        </a>
                        <div class ="menu">
                        <ul>
                        <li><img src="https://cdn-icons-png.flaticon.com/128/1828/1828427.png" 
                        width="30" height="30"> 
                          <a href="index.php?logout=1">Logout</a>
                      </li>
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
              
              <div class="content">
                  <div class="imgb">
                  
                  <div class ="d">
                  <h3>ตารางการจองในวันนี้</h3>
    <br>
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search time....">
    <br><br>
<table class="table table-bordered" id="myTable">
<tr>
            <th>วันที่จอง</th>
            <th>เวลาที่จอง</th>
            <th>เครื่องที่จอง</th>
        </tr>
        <?php
        if (mysqli_num_rows($result_today) == 0) {
            echo "วันนี้ยังไม่มีการจอง";
        } 
        while ($row = mysqli_fetch_array($result_today)) {
            
            ?>
              <tr>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['wash_num'] ?></td>
                </tr>
            <?php
        }
        ?>
</table>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        // td1 = tr[i].getElementsByTagName("td")[0]; // แก้ไขตำแหน่งที่ต้องการค้นหา
        td2 = tr[i].getElementsByTagName("td")[1]; // เพิ่มการค้นหาสำหรับคอลัมน์ที่สอง
        if (td2) {
            // txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}

</script>
    </div>
    </div>
                    
                  <div class="textbox">
                  <form action="booking_ad_db.php" method="post" onSubmit="return fncSubmit()">
                  <div class="p-2 alert-success text-center" role="alert">
                  <h4>จองบริการ</h4>
                 </div>
                  <h2> <?php
                        if(isset($_SESSION["firstname"])){
                        echo "<div class = 'text-success'>";
                        echo "Welcome , " . $_SESSION["firstname"] . " 🎉";
                        echo "</div>";
                        }
                        
                        ?></h2>
                        
                        <div class="from-group" >
                    <label for="selected_date">วันที่ :</label>
                    <input type="date" name="selected_date" id="selected_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>" 
                    max="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
<span id="date_warning" style="color: red;"></span>
                        </div>
                        
                        <div class="from-group" >
                            <h5 for = "time" >เวลา</h5>
                            
                            <select name="time"  class="form-control" id="booking_time">
                                <option value="0">--เลือกเวลา (ควรจองเวลา 1 ชั่วโมงถัดไปจากเวลาปัจจุบัน)--</option>
                                <option value="00:00 - 01:00">00:00 - 01:00</option>
                                <option value="01:00 - 02:00">01:00 - 02:00</option>
                                <option value="02:00 - 03:00">02:00 - 03:00</option>
                                <option value="03:00 - 04:00">03:00 - 04:00</option>
                                <option value="04:00 - 05:00">04:00 - 05:00</option>
                                <option value="05:00 - 06:00">05:00 - 06:00</option>
                                <option value="06:00 - 07:00">06:00 - 07:00</option>
                                <option value="07:00 - 08:00">07:00 - 08:00</option>
                                <option value="08:00 - 09:00">08:00 - 09:00</option>
                                <option value="09:00 - 10:00">09:00 - 10:00</option>
                                <option value="10:00 - 11:00">10:00 - 11:00</option>
                                <option value="11:00 - 12:00">11:00 - 12:00</option>
                                <option value="12:00 - 13:00">12:00 - 13:00</option>
                                <option value="13:00 - 14:00">13:00 - 14:00</option>
                                <option value="14:00 - 15:00">14:00 - 15:00</option>
                                <option value="15:00 - 16:00">15:00 - 16:00</option>
                                <option value="16:00 - 17:00">16:00 - 17:00</option>
                                <option value="17:00 - 18:00">17:00 - 18:00</option>
                                <option value="18:00 - 19:00">18:00 - 19:00</option>
                                <option value="19:00 - 20:00">19:00 - 20:00</option>
                                <option value="20:00 - 21:00">20:00 - 21:00</option>
                                <option value="21:00 - 22:00">21:00 - 22:00</option>
                                <option value="22:00 - 23:00">22:00 - 23:00</option>
                                <option value="23:00 - 00:00">23:00 - 00:00</option>
                            </select>
                        </div>
                        <div class="from-group" >
                            <h5 for = "wash_num" >หมายเลขเครื่องซักผ้า</h5>  
                          <select  name="wash_number" class="form-control" >
                                <option value="0">--เลือกเครื่องซักผ้า--</option>
                            <?php
                             $sql = "SELECT weight,number FROM wash WHERE weight = 18 AND (status = 'Start' OR status = 'FINISH')";
                            $result = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_array($result)){
                                ?>
            <option value="<?=$row["weight"]?> kg. 0<?=$row["number"]?>"><?=$row["weight"]?> kg. 0<?=$row["number"]?></option>
                            <?php
                    }
                    mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
                        ?>
      
                            </select>
                            
                        </div>
                        <div class="from-group from-mb " >
                        <h5 for = >อุณหภูมิของน้ำ</h5>
                            <input type="radio" id="radio7" name = "tem" value="Cool"><label>น้ำเย็น</label>
                            <input type="radio" id="radio8" name = "tem" value="Warm"><label>น้ำอุ่น</label>
                            <input type="radio" id="radio9" name = "tem" value="Hot"><label>น้ำร้อน</label>
                        </div> 
                        <div class="from-group from-mb" >
                        <h5 for = >เครื่องอบผ้า</h5>
                            <input type="radio" id="radio1" name = "dryer" value="Yes"><label>ใช้บริการ</label>
                            <input type="radio" id="radio2" name = "dryer" value="No"><label>ไม่ใช้บริการ</label>
                        </div> 
                       
                        <div class="from-group from-mb" >
                        <h5 for = delivery >บริการรับ - ส่ง</h5>
                            <input type="radio" name = "delivery" id="radio3" value="Receive"><label>รับ</label>
                            <input type="radio" name = "delivery" id="radio4" value="Deliver"><label>ส่ง</label>
                            <input type="radio" name = "delivery" id="radio5" value="Receive - Deliver"><label>รับและส่ง</label>
                            <input type="radio" name = "delivery" id="radio6" value="no service"><label>ไม่ใช้บริการ</label>
                        </div>
                        <div class="from-group mt-1" >
                        <label for=""><h5>ที่อยู่ (ชื่อหอพัก) : </h5></label>
                        <input type="text" name="address" id="textfield1" placeholder="กรุณาใส่ที่อยู่">
                    </div>
                    <div class="from-group mt-1" >
                        <label for=""><h5>เบอร์โทรศัพท์ : </h5></label>
                        <input name="phone" maxlength="10" inputmode="numeric" id="textfield" placeholder="กรุณาใส่เบอร์โทรศัพท์" >
                    </div>
                    <div class="from-group mt-1">
                        <label for="price">รวมราคา : </label>
                        <input type="text" name="price" id="price" readonly>
                    </div>
                    <!-- <span id="discount"></span>
                    <input type="hidden" id="booking_count" name="booking_count" value="0">
                    <input type="hidden" id="accumulated_points" name="accumulated_points" value="0"> -->
                        <div class="from-group mt-1" >
                        <input type="submit" value="จองบริการ" name="booking" class="btn btn-success mt-2" id="bookingButton">
                        <a type = "reset" class="btn btn-danger mt-2" href = "servicead.php"> ยกเลิกการจองบริการ </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>

        
</body>
</html>

<script type="text/javascript">
function fncSubmit()
{   
    if(document.getElementById('select').value  == "0"  )
    {
        alert('Please select time');
        return false;
    }
    else if(document.getElementById('radio1').checked  == false && document.getElementById('radio2').checked  == false )
    {
        alert('Please select dryer');
        return false;
    } else if(document.getElementById('radio3').checked  == false && document.getElementById('radio4').checked  == false 
    && document.getElementById('radio5').checked  == false && document.getElementById('radio6').checked  == false)
    {
        alert('Please select delivery');
        return false;
    } 
    else if(document.getElementById('textfield').value == "")
    {
        alert('Please input phone');
        return false;
    }else if(document.getElementById('textfield1').value == "")
    {
        alert('Please input address');
        return false;
    }
}
</script>

<script>
    
    document.getElementById("radio7").addEventListener("change", updatePrice);
document.getElementById("radio8").addEventListener("change", updatePrice);
document.getElementById("radio9").addEventListener("change", updatePrice);

document.getElementById("radio1").addEventListener("change", updatePrice);
document.getElementById("radio2").addEventListener("change", updatePrice);

document.getElementById("radio3").addEventListener("change", updatePrice);
document.getElementById("radio4").addEventListener("change", updatePrice);
document.getElementById("radio5").addEventListener("change", updatePrice);
document.getElementById("radio6").addEventListener("change", updatePrice);

function updatePrice() {
    var selectedTem = document.querySelector('input[name="tem"]:checked').value;
    var selectedDryer = document.querySelector('input[name="dryer"]:checked').value;
    var selectedDeli = document.querySelector('input[name="delivery"]:checked').value;
    var priceField = document.getElementById("price");

    // กำหนดราคาตามที่ผู้ใช้เลือก
    if (selectedTem === "Cool") {
    price = <?php echo $price_cool; ?>;
} else if (selectedTem === "Warm") {
    price = <?php echo $price_warm; ?>;
} else if (selectedTem === "Hot") {
    price = <?php echo $price_hot; ?>;
}

// ถ้าผู้ใช้เลือก "yes" 
if (selectedDryer === "Yes") {
    price += <?php echo $dryer_price; ?>;
}


    // ถ้าผู้ใช้เลือก delivery 
    if (selectedDeli === "Receive") {
        price += 10;
    } else if (selectedDeli === "Deliver") {
        price += 10; 
    } else if (selectedDeli === "Receive - Deliver") {
        price += 20; 
    }

    // แสดงราคาในฟิลด์ "price"
    priceField.value = price;

    // // ตรวจสอบการคำนวณแต้มและส่วนลด
    // var bookingCount = parseInt(document.getElementById("booking_count").value);
    // var accumulatedPoints = parseInt(document.getElementById("accumulated_points").value);
    // var discountField = document.getElementById("discount");

    // if (price >= 100) {
    //     accumulatedPoints += 1;
    //     discountField.innerHTML = "คุณได้รับแต้ม 1 ดวง";
    // } else {
    //     discountField.innerHTML = "";
    // }

    // if (accumulatedPoints >= 5) {
    //     price -= 20;
    //     accumulatedPoints -= 5;
    //     discountField.innerHTML += " และได้รับส่วนลด 20 บาท";
    // }

    // // บันทึกค่าแต้มและส่วนลด
    // document.getElementById("booking_count").value = bookingCount;
    // document.getElementById("accumulated_points").value = accumulatedPoints;

    // // แสดงราคาใหม่หลังจากคำนวณส่วนลด
    // priceField.value = price;
}

</script>

<script>
document.getElementById("selected_date").addEventListener("change", function (event) {
    var selectedDate = new Date(this.value);
    var currentDate = new Date();
    var bookingButton = document.getElementById("bookingButton");

    // แปลง selectedDate เป็นรูปแบบ "YYYY-MM-DD"
    var year = selectedDate.getFullYear();
    var month = (selectedDate.getMonth() + 1).toString().padStart(2, '0'); // เพิ่ม 1 เพราะเดือนเริ่มที่ 0
    var day = selectedDate.getDate().toString().padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;

    if (formattedDate < currentDate) {
        document.getElementById("date_warning").textContent = "คุณสามารถจองได้เฉพาะวันปัจจุบันเท่านั้น (" + currentDate + ")";
        bookingButton.disabled = true; // ปิดใช้งานปุ่ม
        // คำสั่งที่คุณต้องการทำเมื่อวันที่ไม่ถูกต้อง
    } else {
        document.getElementById("date_warning").textContent = "";
        bookingButton.disabled = false; // เปิดใช้งานปุ่ม
        // คำสั่งที่คุณต้องการทำเมื่อวันที่ถูกต้อง
    }
});
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
    width: 500px;
    /* left: 50px; */
    
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
  #myTable {
    width: 100%;
    height: 100px; /* กำหนดความสูงของตารางที่ต้องการ */
    overflow: fixed; /* เพิ่มแถบสกอลล์เมื่อข้อมูลเกินขนาดที่กำหนด */ 
}
@media (max-width: 650px) {
    #myTable {
      width: 100%;
      height: 100px; /* Set the desired table height */
      overflow: fixed; /* Add a scroll bar when the data exceeds the specified size */
    }
    .content{
      position:relative;
      top:10px;
      width: 100%;
      /* display: flex; */
      justify-content: space-between;
      align-items: center;
      
    }
    .content .textbox{
      position: relative;
      right: 300px;
      /* bottom: 200px; */
      width: 500px;
      /* left: 50px; */
      
    }
    .content .textbox h2{
      color: #333;
      font-size: 3em;
      line-height: 1.4em;
      font-weight: 500;
      
    }
    .imgb{
        width: 500px;
        /* display: flex; */
        justify-content: flex-end;
        padding-right: 50px;
        margin-top: 5px;
        margin-left: 180px;
    }
    h3{
      margin-top  : 10px;
    }
  }
    
</style>