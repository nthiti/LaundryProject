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
        <h1>TIME IN</h1>
        <div class = "employ">
        <img src="https://pbs.twimg.com/media/FvsXSpUakAgrweT?format=jpg&name=4096x4096" 
        width="100" height="120">
            <div class = "name">
                <h3>Name : Sim Jaeyun</h3>
                <h4>Position : Employee</h4>
            </div>
            <div class = "date">
            <form action = "" method = "get">
                    <input type = "date">
                </form> 
                <form action = "" method = "get">
                    <input type = "time">
                </form>
                    
            </div>
            <a href="time.php" class="button">Check</a> 
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
        padding: 0 0 10px 0;
        /* border-bottom: 1px solid silver; */
    }
    .employ{
        
        margin-left : 70px ;
        /* padding-top : 20px;  */

    }
    .name{
        margin-left : 50px;
        padding-top : 10px;
        font-size : 16px;
    }
    .button {
    background : #7ED957;
    border: none;
    color: white;
    padding: 10px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    display: center;
    margin : 10px;
    margin-left : 80px ;
    /* cursor: pointer; */
    }
    .date {
        display: flex;
        margin-top : 40px;
        /*padding-left : 20px; */
    }
    .date form{
        display: flex;
        margin-left : 10px;
    }
</style>

