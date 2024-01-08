<?php
    include 'condb.php';
    $id = $_POST['id_repair'];
    $l_notify = $_POST['notify_date'];
    $l_type = $_POST['type'];
    $l_number = $_POST['number'];
    $l_detail = $_POST['detail'];

    $sql = "UPDATE repair set notify_date='$l_notify', type='$l_type', number='$l_number', status='$l_status', detail='$l_detail' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        if ($type === 'wash') {
            $update_wash_sql = "UPDATE wash SET wash.status = '$status' WHERE wash.number = '$number' AND weight = '$weight'";
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
    mysqli_close($conn);
?>