<?php
   session_start(); 
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
    <link rel="stylesheet" href="style.css">
    <title>R Laundry</title>
    
  </head>
  <body>
        </div>
            <nav>
                <div class="nav-left">
                    <a href="home.php">
                    <img src="logo copy.png"href ="home.php" class="logo"></a>
                </div>
                <div class="nav-right">
                    <div class="search-box">
                    <a href="login.php" > 
                        <img src="login.png" title="LOGIN" class="login" >
                        </a>
                        
                    </div>
                </div>
              </nav>
          <!-- Main Content -->
    <div id="main">
      <!-- Welcome Section -->
      <div class = "data">
        <h1>Repair</h1>
        <div class = "date">
        <form>
            <label for="ddate">Date</label>
            <input type="date" id="ddate" name="ddate" value="">
            <br>
            <div class = "sselect">
                
            <form>
                <label>Machine</label>
                <select id="machine" name="machine">
                <option value="wash">washing machine 01</option>
                <option value="wash">washing machine 02</option>
                <option value="wash">washing machine 03</option>
                <option value="wash">washing machine 04</option>
                <option value="dry">dryer 01</option>
                <option value="dry">dryer 02</option>
                </select>
            </form>
            </div>
        <div>
        <form action="#">
        <label>Detail</label>
  <textarea name="message" rows="30" cols="80"></textarea>
  <br><br>
  <input type="submit">
</form>
        </div>
        </form>
        
 
      </div>
    </div>
  
  </body>
</html>

<style>
    *{
    margin: 0;
    padding: 0;
    font-family: 'poppins', roboto Condensed;
}
body{
    background: #ffffff;
    font-family:"Itim";
}
nav{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #7ED957;
    padding: 5px 5%;
}
.logo{
    width: 160px;
    margin-right: 45px;
}
.nav-left{
    display: flex;
    align-items: center;
}
.nav-left ul li {
    list-style: none;
    display: inline-block;
}
.nav-left ul li img{
    width:  28px;
    margin:  0 15px;
}
.login{
    width: 30px;
    margin-right: 45px;
}
.nav-drop ul{
    list-style: none;
    background-color:#7ED957;
    text-align: center;
    margin: 0px;
    padding: 0px;
    padding-left: 10px;
    padding-right: 10px;
}

.nav-drop li {
    font-size: 10px;
    line-height: 10px;
    text-align: left;
}

.nav-drop a {
    text-decoration: none;
    color: #000;
    display: block;
    padding-left: 15px;
    border-bottom: 1px solid #000 ;
    transition: .3s;
}

.nav-drop a:hover{
    background-color: #27eb93;
}
#main {
    text-align: left;
    margin-left: 50px;
    margin-right: 50px;
    padding: 3rem;
    background-color: #F1F1F1;
    height: 560px;
  }
h1{
    text-align : center;
}
  input[type=text] {
    width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}

input[type=text]:focus {
  border: 3px solid #555;
}
select {
  width: 50%;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  border-style: groove;
  background-color: #fff;
  margin-top : 10px;
  margin-left : 20px;

}
label{
    font-size : 16px;
}
.sselect{
    /* padding : 10px; */
    width: 70%;
    /* margin-left : 20px; */
}
textarea{
    width:100%;
    height:300px;
}
.date label{
    margin-right: 10px;
    top: 50px;
} 
input[ type="submit"]{
    text-align: center;
}
</style>