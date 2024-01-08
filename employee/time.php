<?php 
session_start(); 
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
          <link rel="stylesheet" href="style.css">
    <title>R Laundry</title>
   
  
  </head>
<body>
    <font face = "Roboto Condensed" >
    <div class="center">
        
        <img src="logo copy.png" width="120" height="60">
        <h1> GET WORK</h1>
        <div class = "time">

        <a href="timein.php" class="button">Time In</a>
        <a href="timeout.php" class="button">Time Out</a>       
        </div>
    </div>
        
        
</font>
</body>
</html>

<style>
    body{
    margin: 0;
    padding: 0;
    font-family: Roboto Condensed;
    background: linear-gradient(120deg, #38741e, #7ED957);
    height: 100vh;
    overflow: hidden;
    }
    img{
        float: left;
    }
    h1{
        text-align: center;
        /* margin-right: 50px; */
        margin-top: 90px;
    }
    .center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background: white;
        border-radius: 10px;
        
    }
    .center h1{
        text-align: center;
        padding: 0 0 20px 0;
        /* border-bottom: 1px solid silver; */
    }
    .center h2{
        text-align: center;
        /* padding: 0 0 20px 0; */
        width: 110px;
        height: 50px;
        border-radius : 10px;
        margin-left : 20px;
        padding: auto;
        padding-top :20px;
    }
    .time{
        display: flex;
        margin-left : 50px ;
        padding-top : 30px; 

    }
    .button {
    background : #7ED957;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px 20px;
    cursor: pointer;
    }
    
</style>

