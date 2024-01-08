<?php
include 'condb.php';

$ids=$_GET['id'];
$sql = "DELETE FROM dryer WHERE id = '$ids'";
if(mysqli_query($conn,$sql)){
    echo "<script>alert('Delete data successfully')</script>";
    echo "<script>window.location = 'show_dryer.php';</script>";
}else{
    echo "Error : " . $sql . "<br>" . mysql_error($conn);
    echo "<script>alert('not successfully')</script>";
}
mysqli_close($conn);
?>

