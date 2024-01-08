<?php

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "register_system";

$db = new mysqli($dbHost, $dbUsername , $dbPassword , $dbName);
if($db->connect_error){
    die("Connect filed:" . $db->connect_error);
}

?>