<?php
session_start();
include 'condb.php';

$firstname = $_SESSION["firstname"];

if (isset($_POST['booking'])) {
    $selected_date = $_POST['selected_date'];
    $time = $_POST['time'];
    $wash_num = $_POST['wash_number'];
    $tem = $_POST['tem'];
    $dryer = $_POST['dryer'];
    $delivery = $_POST['delivery'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $price = $_POST['price'];
    $accumulatedPoints = $_POST['accumulated_points'];

    $sql_user = "SELECT id_user FROM db_user WHERE firstname = '$firstname'";
    $query_user = mysqli_query($conn, $sql_user);

    if ($query_user) {
        $user_data = mysqli_fetch_assoc($query_user);
        $user_id = $user_data['id_user'];
        $_SESSION["user_id"] = $user_id;

        $check_existing_booking = "SELECT * FROM booking WHERE dob = '$selected_date' AND time = '$time' AND wash_num = '$wash_num'";
        $query_existing_booking = mysqli_query($conn, $check_existing_booking);

        if (mysqli_num_rows($query_existing_booking) > 0) {
            echo "<script> alert('วันและเวลาที่คุณเลือกถูกจองไปแล้ว กรุณาเช็ควันและเวลาก่อนทำการจอง ขอบคุณค่ะ'); 
                window.location.href = 'booking01.php'; </script>";
            exit;
        } else {
            $all_washers = array("18kg.01", "18kg.02");

            $booked_washers = array();
            $sql_check_booked = "SELECT wash_num FROM booking WHERE dob = '$selected_date' AND time = '$time'";
            $result_check_booked = mysqli_query($conn, $sql_check_booked);

            if ($result_check_booked) {
                while ($row = mysqli_fetch_assoc($result_check_booked)) {
                    $booked_washers[] = $row['wash_num'];
                }
            } else {
                $_SESSION['error'] = 'Error checking booked washers.';
                header("location: booking01.php");
                exit;
            }

            $available_washers = array_diff($all_washers, $booked_washers);

            echo '<select name="wash_number" class="form-control">';
            echo '<option value="0">--เลือกเครื่องซักผ้า--</option>';

            foreach ($available_washers as $washer) {
                echo "<option value=\"$washer\">$washer</option>";
            }

            echo '</select>';

            $query = "INSERT INTO booking(dob, time, wash_num, temperature, dryer, delivery, address, phone, total, point , user_id) 
                      VALUES ('$selected_date', '$time', '$wash_num', '$tem', '$dryer', '$delivery', '$address', '$phone', $price, '$accumulatedPoints', '$user_id')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $_SESSION['success'] = "Add Successfully!! <a href ='home.php'>Click here</a> to Status";
                header("location: payment.php");
            } else {
                $_SESSION['error'] = "Failed to add booking";
                header("location: booking01.php");
            }
        }
    }
}
?>
