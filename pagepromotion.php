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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <title>R Laundry</title>
</head>
<body>
    <section>
        <header>
            <a href="Homeowner.php" class="logo"><img src="img/pic6.png" width="70" height="70"></a>
            <ul>
                <li>
                    <div class="action">
                        <a class="profile" onclick="menuToggle();">
                            <img src="https://cdn-icons-png.flaticon.com/128/3033/3033143.png" title="LOGIN" class="login" width="20" height="20">
                        </a>
                        <div class="menu">
                            <ul>
                                <li>
                                    <img src="https://cdn-icons-png.flaticon.com/128/1828/1828427.png" width="30" height="30">
                                    <a href="index.php">Logout</a>
                                </li>
                            </ul>
                            <h3><h3>
                        </div>
                        <script>
                            function menuToggle() {
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
        <div class="h4 text-center alert  mb-5" role="alert">
            <br>
        <img src = "https://cdn-icons-png.flaticon.com/128/1378/1378644.png" width="50" height="50">
        <br><br>
            โปรโมชั่น 
        </div>
        <h3> ปรับราคาสำหรับเครื่อง 10.5 kg.</h3>
        <button class="btn1" onclick="togglePopup('coolPopup')">
            <img src="https://cdn-icons-png.flaticon.com/128/4515/4515726.png" width="50" height="50"> <br> น้ำเย็น
        </button>
        <div class="popup" id="coolPopup">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('coolPopup')">&times;</span>
                <form action="update_procool.php" method="post">
                    <label>ราคาน้ำเย็น</label>
                    <input type="number" name="machine_price_cool" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>

        <button class="btn1" onclick="togglePopup('warmPopup')">
            <img src="https://cdn-icons-png.flaticon.com/128/3343/3343841.png" width="50" height="50"> <br> น้ำอุ่น
        </button>
        <div class="popup" id="warmPopup">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('warmPopup')">&times;</span>
                <form action="update_prowarm.php" method="post">
                    <label>ราคาน้ำอุ่น</label>
                    <input type="number" name="machine_price_warm" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>

        <button class="btn1" onclick="togglePopup('hotPopup')">
            <img src="https://cdn-icons-png.flaticon.com/128/6453/6453208.png" width="50" height="50"> <br> น้ำร้อน
        </button>
        <div class="popup" id="hotPopup">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('hotPopup')">&times;</span>
                <form action="update_prohot.php" method="post">
                    <label>ราคาน้ำร้อน</label>
                    <input type="number" name="machine_price_hot" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>
            <br>
            <br>
            <br>
        <h3> ปรับราคาสำหรับเครื่อง 18 kg. </h3>
        <button class="btn1" onclick="togglePopup('coolPopup1')">
            <img src="https://cdn-icons-png.flaticon.com/128/4515/4515726.png" width="50" height="50"> <br> น้ำเย็น
        </button>
        <div class="popup" id="coolPopup1">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('coolPopup1')">&times;</span>
                <form action="update_procool18.php" method="post">
                    <label>ราคาน้ำเย็น</label>
                    <input type="number" name="machine_price_cool" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>

        <button class="btn1" onclick="togglePopup('warmPopup1')">
            <img src="https://cdn-icons-png.flaticon.com/128/3343/3343841.png" width="50" height="50"> <br> น้ำอุ่น
        </button>
        <div class="popup" id="warmPopup1">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('warmPopup1')">&times;</span>
                <form action="update_prowarm1.php" method="post">
                    <label>ราคาน้ำอุ่น</label>
                    <input type="number" name="machine_price_warm" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>
                      
        <button class="btn1" onclick="togglePopup('hotPopup1')">
            <img src="https://cdn-icons-png.flaticon.com/128/6453/6453208.png" width="50" height="50"> <br> น้ำร้อน
        </button>
        <div class="popup" id="hotPopup1">
            <div class="popup-content">
                <span class="close" onclick="togglePopup('hotPopup1')">&times;</span>
                <form action="update_prohot1.php" method="post">
                    <label>ราคาน้ำร้อน</label>
                    <input type="number" name="machine_price_hot" class="form-control" /><br />
                    <input type="submit" value="ตกลง" class="btn btn-success mt-2" />
                    <a href="pagepromotion.php" class="btn btn-danger mt-2"> ยกเลิก </a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePopup(popupId) {
            var popup = document.getElementById(popupId);
            if (popup.style.display === "block") {
                popup.style.display = "none";
            } else {
                popup.style.display = "block";
            }
        }
    </script>
</body>
</html>

<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Itim', cursive;
        }
        section {
            position: relative;
            width: 100%;
            padding: 60px;
            justify-content: space-between;
            align-items: center;
        }
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            position: relative;
            max-width: 50px;
        }
        header ul {
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
            margin-bottom: 200px;
            margin-top: 50px;
        }
        .button {
            padding: 70px 100px;
            cursor: pointer;
            border: 0px;
            background-color: transparent;
            position: relative;
            transition: all 0.15s ease;
        }
        .btn1 {
            background: #7ED957;
            color: #000;
            border-radius: 10px;
            border-color: #fff;
            transition: all 0.25s ease;
            margin-top: 10px;
            font-size: 15px;
            width: 200px;
            height: 150px;
        }
        .btn1:hover {
            transform: translate(-3px, -3px);
        }
        .btn1:hover::before {
            transform: translate(3px, 3px);
        }
        .btn1:hover::after {
            transform: translate(2px, 2px);
        }
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 40px; /* ปรับขนาด padding ที่ต้องการ */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width: 400px; /* ปรับความกว้างที่ต้องการ */
    height: 200px; /* ปรับความสูงที่ต้องการ */
}
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
        .show {
            display: block;
        }

        @media screen and (min-width: 650px) {
            .action {
                position: relative;
                top: -5px;
                left: -20px;
            }
            .action .profile {
                position: relative;
                width: 60px;
                height: 60px;
                overflow: hidden;
                cursor: pointer;
            }
            .action .profile img {
                position: absolute;
                top: 0;
                width: 50%;
                height: 50%;
                object-fit: cover;
            }
            .action .menu {
                position: absolute;
                top: 70px;
                right: -10px;
                padding: 10px 20px;
                background: #ADD495;
                width: 130px;
                border-radius: 15px;
                transition: 0.5s;
                visibility: hidden;
                opacity: 0;
            }
            .action .menu.active {
                visibility: visible;
                opacity: 1;
            }
            .action .menu::before {
                content: '';
                position: absolute;
                top: -5px;
                right: 45px;
                width: 20px;
                height: 20px;
                background: #ADD495;
                transform: rotate(45deg);
            }
            .action .menu ul li {
                list-style: none;
                padding: 10px 0;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
            }
            .action .menu ul li img {
                max-width: 30px;
                margin-right: 10px;
                opacity: 0.5;
                transition: 0.5s;
            }
            .action .menu ul li:hover img {
                opacity: 1;
            }
            .action .menu ul li a {
                display: inline-block;
                text-decoration: none;
                color: #000;
                font-weight: 500;
                transition: 0.5s;
                margin: auto;
            }
            .action .menu ul li:hover a {
                font-weight: bold;
                color: #fff;
            }
        }
    </style>