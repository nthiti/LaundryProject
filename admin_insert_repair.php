<?php
    include 'condb.php';
    $notify_date = $_POST['notify_date'];
    $type = $_POST['type'];
    if ($_POST['type'] === 'wash') {
        $selected_value = explode(" | ", $_POST['wash_number']);
        $number = $selected_value[0];
        $weight = $selected_value[1];
    } elseif ($_POST['type'] === 'dry') {
        $number = $_POST['dry_number'];
        $weight = $_POST['weight'];
    }
    $detail = $_POST['detail'];
    $status = $_POST['status'];
    $repair_date = $_POST['repair_date'];

    $check_sql = "SELECT * FROM repair WHERE notify_date = '$notify_date' AND type = '$type'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>alert('วันนี้ได้ทำการแจ้งเตือนเครื่องนี้ไปแล้ว');</script>";
    echo "<script>window.location='admin_show_repair.php';</script>";
} else {
    $sql = "INSERT INTO repair(notify_date, type, weight, number, detail, status, repair_date)
    VALUES('$notify_date', '$type', '$weight','$number','$detail','$status', '$repair_date')";
    $result = mysqli_query($conn,$sql);
    
    if ($result) {
        if ($type === 'wash') {
            $update_wash_sql = "UPDATE wash SET status = '$status' WHERE number = '$number'AND weight = '$weight'";
            mysqli_query($conn, $update_wash_sql);
        } elseif ($type === 'dry') {
            $update_wash_sql = "UPDATE dryer SET status = '$status' WHERE number = '$number'";
            mysqli_query($conn, $update_wash_sql);
        }
    
        echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='admin_show_repair.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
    }
}
    mysqli_close($conn);
?>
