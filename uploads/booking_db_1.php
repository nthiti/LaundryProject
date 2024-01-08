<?php 
    session_start();
    require_once 'config/db.php';
    if(!isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: nsignin.php');
     }

    if(isset($_POST['next'])){
        // $stmt = $conn->query("SELECT id FROM users");
        // $stmt->execute();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $iduser = $row['id'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $currentDate = date("Y-m-d");

        
        if(empty($date)){
            $_SESSION['error'] = 'กรุณาเลือกวันที่ต้องการจอง';
            header("location: booking.php");
        }else if(empty($start_time)){
            $_SESSION['error'] = 'กรุณาเลือกเวลาต้องการเริ่มจอง';
            header("location: booking.php");
        }else if(empty($end_time)){
            $_SESSION['error'] = 'กรุณาเลือกเวลาต้องการสินสุดจอง';
            header("location: booking.php");
        } else if ($start_time >= $end_time) {
            // echo "เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด";
            $_SESSION['error'] = 'เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด';
            header("location: booking.php");
        }  else if (strtotime($date) < strtotime($currentDate)) {
            $_SESSION['error'] = 'วันที่ต้องเป็นปัจจุบันขึ้นไป';
            header("location: booking.php");
        } 
        else {
            try{
                // $check_noroom = $conn->prepare("SELECT noroom FROM rooms WHERE noroom = :noroom");
                $check_room = $conn->prepare("SELECT roomname,description,noroom FROM rooms WHERE noroom NOT IN(
                    SELECT noroom FROM booksche
                    WHERE date = '$date'
                    AND ((start_time >= '$start_time' AND start_time < '$end_time')
                    OR (end_time > '$start_time' AND end_time <= '$end_time'))
                )");
                // $check_room->execute();
                // // $result = $conn->query($check_room);
                // $result = $check_room->fetchAll(PDO::FETCH_ASSOC);



                // if (count($result) > 0) {
                //     // มีห้องที่ว่างในช่วงเวลาที่เลือก
                //     echo "<h2>ห้องที่ว่างในช่วงเวลานี้:</h2>";
                //     echo "<form action='booking2.php' method='POST'>";
                //     echo "<select name='room'>";
                //     foreach ($result as $row) {
                //         echo "<option value='" . $row['roomname'] . "'>" . $row['roomname'] . "</option>";
                //     }
                //     echo "</select>";
                //     echo "<input type='hidden' name='start_time' value='$start_time'>";
                //     echo "<input type='hidden' name='end_time' value='$end_time'>";
                //     echo "<input type='hidden' name='date' value='$date'>";
                //     echo "<br><input type='submit' value='ตรวจสอบการจองล่วงหน้า'>";
                //     echo "</form>";
                // } else {
                //     // ไม่มีห้องที่ว่างในช่วงเวลาที่เลือก
                //     echo "<h2>ไม่มีห้องที่ว่างในช่วงเวลานี้</h2>";
                // }
                


                
                $check_room->execute();
                // $result = $check_room->fetch(PDO::FETCH_ASSOC);

                // เปลี่ยน $result เป็น $rooms
                $rooms = $check_room->fetchAll(PDO::FETCH_ASSOC);

                if ($rooms) {
                    // มีห้องที่ว่างในช่วงเวลาที่เลือก
                    echo "<h1>ห้องที่ว่าง</h1>";
                    echo "<form action='bookaddon.php' method='POST'>";
                    foreach ($rooms as $row) {
                        $roomname = $row['roomname'];
                        $noroom = $row['noroom'];
                        $room_details = $row['description'];
                        // echo "<input type='radio' name='selected_room' value='$roomname'>$roomname<br>";
                        // echo "<p>รายละเอียด: $description</p>";
                        // echo "<h3>$roomname</h3>";
                        echo "<h3><input type='radio' name='selected_room' value='$noroom'>$noroom</h3>";
                        echo "<p>ชื่อห้อง: $roomname</p>";
                        echo "<p>รายละเอียด: $room_details</p><hr>";
                        
                        // echo "<input type='radio' name='selected_room' value='$roomname'>$roomname<br>";
                    }
                    echo "<input type='hidden' name='date' value='$date'>";
                    echo "<input type='hidden' name='start_time' value='$start_time'>";
                    echo "<input type='hidden' name='end_time' value='$end_time'>";
                    echo "<input type='submit' name ='next' value='ตกลง'>";
                    // <button type="submit" name = "next" class="btn btn-primary">next</button>    </form>

                    echo "</form>";
                } else {
                    // ไม่มีห้องที่ว่างในช่วงเวลาที่เลือก
                    echo "<h2>ไม่มีห้องที่ว่างในช่วงเวลานี้</h2>";
                }

            

            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
            
        }
        
   
    }
?>