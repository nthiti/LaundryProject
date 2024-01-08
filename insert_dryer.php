<?php
include 'condb.php';

$machine_weight = $_POST['machine_weight'];
$machine_number = $_POST['machine_number'];
$price = $_POST['price'];
$status = $_POST['status'];

$sql = "INSERT INTO dryer(weight,number,price,status)
        VALUES ('$machine_weight','$machine_number','$price','$status')";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>
    alert('save data successfully')
    </script>";
    echo "<script>
    window.location = 'show_dryer.php';
    </script>";
}else{
echo "<script>
    alert('not successfully')
    </script>";
}
mysqli_close($conn);
?>
