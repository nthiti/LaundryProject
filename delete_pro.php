<?php
include 'condb.php';

$ids = $_GET['id_pm'];

$sql = "DELETE FROM promotion WHERE id_pm = '$ids'";
if(mysqli_query($conn, $sql)){
    echo "<script>alert('Delete data successfully')</script>";
    echo "<script>window.location = 'pagepromotion.php';</script>";
}else{
    echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    echo "<script>alert('not successfully')</script>";
}


mysqli_close($conn);
?>
