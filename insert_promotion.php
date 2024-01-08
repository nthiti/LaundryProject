<?php
session_start();
include 'condb.php';

$point = $_POST['point'];
$discount = $_POST['discount'];



$sql = "INSERT INTO promotion(point,discount)
        VALUES ('$point','$discount')";
$result = mysqli_query($conn,$sql);


if($result){
    echo "<script> alert('save data successfully'); </script>";
    echo "<script>window.location = 'pagepromotion.php';</script>";
}else{
echo "<script> alert('not successfully');</script>";
}
mysqli_close($conn);
?>
