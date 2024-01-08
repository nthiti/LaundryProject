<?php
    include 'condb.php';
    $id = $_POST['id_repair'];
    $notify = $_POST['notify_date'];
    $ftype = $_POST['type'];
    $fnumber = $_POST['number'];
    $fdetail = $_POST['detail'];
    $fstatus = $_POST['status'];
    $re_date = $_POST['repair_date'];

    $sql = "UPDATE repair set notify_date='$notify', type='$ftype', number='$fnumber', status='$fstatus',
    detail='$fdetail', repair_date='$re_date' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        if ($ftype === 'wash') {
            $update_wash_sql = "UPDATE wash SET status = '$fstatus' WHERE number = '$fnumber'";
            mysqli_query($conn, $update_wash_sql);
        } elseif ($ftype === 'dry') {
            $update_dryer_sql = "UPDATE dryer SET status = '$fstatus' WHERE number = '$fnumber'";
            mysqli_query($conn, $update_dryer_sql);
        }
    
        echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
        echo "<script>window.location='owner_show_repair.php';</script>";
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
    }
    mysqli_close($conn);
?>
