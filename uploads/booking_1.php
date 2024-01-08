<?php
 session_start();
 require_once 'config/db.php';
 if(!isset($_SESSION['user_login'])){
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location: nsignin.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Room </title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="link.css">

</head>
<body>
 
<div class="container">
        <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="user.php" class="nav-link" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="booking.php" class="nav-link active">Booking</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
        </header>
        <?php if(isset($_SESSION['error'])){?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php }?>
        <?php if(isset($_SESSION['success'])){?>
            <div class="alert alert-success" role="alert">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php }?>
        <?php if(isset($_SESSION['warning'])){?>
            <div class="alert alert-warning" role="alert">
                <?php 
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                ?>
            </div>
        <?php }?>  
    </div>
        <h1> จองห้อง</h1>
    <hr>
    <form method="POST" action="booking_db.php">
    <label for="date">วัน/เดือน/ปี ที่ต้องการจอง : </label>
    <input type="date" id="date" name="date" required>

    <label for="time">เลือกเวลาที่ต้องการเริ่มจอง :</label>
        <select id="start_time" name="start_time">
            <!-- <option value="#">เลือกเวลา</option> -->
            <option value="08:00:00">08:00</option>
            <option value="09:00:00">09:00</option>
            <option value="10:00:00">10:00</option>
            <option value="11:00:00">11:00</option>
            <option value="12:00:00">12:00</option>
            <option value="13:00:00">13:00</option>
            <option value="14:00:00">14:00</option>
            <option value="15:00:00">15:00</option>
            <option value="16:00:00">16:00</option>
            <option value="17:00:00">17:00</option>
            <option value="18:00:00">18:00</option>
            <option value="19:00:00">19:00</option>
            <option value="20:00:00">20:00</option>
        </select>
        <label for="time">เลือกเวลาที่ต้องการสิ้นสุด :</label>
        <select id="end_time" name="end_time">
            <!-- <option value="#">เลือกเวลา</option> -->
            <option value="08:00:00">08:00</option>
            <option value="09:00:00">09:00</option>
            <option value="10:00:00">10:00</option>
            <option value="11:00:00">11:00</option>
            <option value="12:00:00">12:00</option>
            <option value="13:00:00">13:00</option>
            <option value="14:00:00">14:00</option>
            <option value="15:00:00">15:00</option>
            <option value="16:00:00">16:00</option>
            <option value="17:00:00">17:00</option>
            <option value="18:00:00">18:00</option>
            <option value="19:00:00">19:00</option>
            <option value="20:00:00">20:00</option>
        </select>
        <button type="submit" name = "next" class="btn btn-primary">next</button>    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>   
  
</body>
</html>