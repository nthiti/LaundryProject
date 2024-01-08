<?php

include 'condb.php';
$id = $_GET['id'];
$sql = "DELETE FROM `images` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
if($result)
{
    header("location: pagepost.php");
}

?>