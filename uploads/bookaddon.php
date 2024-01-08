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
        $selected_room = $_POST['selected_room'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $currentDate = date("Y-m-d");

        
        
        if(empty($selected_room)){
            $_SESSION['error'] = 'กรุณาเลือกห้อง';
            header("location: booking_db.php");
        }else if(empty($date)){
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
                // $check_items = $conn->prepare("SELECT i.noitem, i.nameitem, i.priceitem, i.total ,i.pricetype
                // FROM items AS i
                // LEFT JOIN (
                //     SELECT noitem, COUNT(noitem) AS booked_count
                //     FROM booksche
                //     GROUP BY noitem
                // ) AS b ON i.noitem = b.noitem
                // WHERE b.booked_count <= i.total;
                
                // ");
                $start_date = $_POST['date'] . ' ' . $_POST['start_time'];
                $end_date = $_POST['date'] . ' ' . $_POST['end_time'];

                $check_items = $conn->prepare("SELECT i.noitem, i.nameitem, i.priceitem, i.total, i.pricetype
                FROM items AS i
                WHERE i.noitem NOT IN (
                    SELECT DISTINCT noitem
                    FROM booksche
                    WHERE date >= '$start_date' AND date <= '$end_date'
                    GROUP BY noitem
                    HAVING COUNT(noitem) >= i.total + 1
                )
                ");
                
                $check_items->execute();
                $items = $check_items->fetchAll(PDO::FETCH_ASSOC);

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
                


                
                $check_items->execute();
                // $result = $check_room->fetch(PDO::FETCH_ASSOC);

                // เปลี่ยน $result เป็น $rooms
                $items = $check_items->fetchAll(PDO::FETCH_ASSOC);

                if ($items) {
                    // มีห้องที่ว่างในช่วงเวลาที่เลือก
                    echo "<h1>Add on</h1>";
                    echo "<form action='payment.php' method='POST'>";
                    foreach ($items as $row) {

                        $noitem = $row['noitem'];
                        $nameitem = $row['nameitem'];
                        $priceitem = $row['priceitem'];
                        $pricetype = $row['pricetype'];
                        // echo "<input type='radio' name='selected_room' value='$roomname'>$roomname<br>";
                        // echo "<p>รายละเอียด: $description</p>";
                        // echo "<h3>$roomname</h3>";
                        echo "<h3><input type='radio' name='selected_addon' value='$noitem'>$noitem</h3>";
                        echo "<p>ชื่อสินค้า: $nameitem </p>";
                        echo "<p>ราคา: $priceitem บาท </p>";
                        echo "<p>รูปแบบราคา: $pricetype </p><hr>";
                        
                        // echo "<input type='radio' name='selected_room' value='$roomname'>$roomname<br>";
                    }
                    echo "<input type='hidden' name='date' value='$date'>";
                    echo "<input type='hidden' name='start_time' value='$start_time'>";
                    echo "<input type='hidden' name='end_time' value='$end_time'>";
                    echo "<input type='hidden' name='selected_room' value='$selected_room'>";
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