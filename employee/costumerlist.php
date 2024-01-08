<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto Condensed">
        <link rel="stylesheet" href="bookingstyle.css">
<title>Custumer List</title>
</head>

<body>
    <font face ="Itim">
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
            <h1 class="text-head" >
            <img src = "https://cdn-icons-png.flaticon.com/128/3126/3126647.png"
            width = 30 height = 30 >
                Custumer List</h1>
            <table class="my-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Wash</th>
                        <th>Dry</th>
                        <th>Cost</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="active-row">
                        <td>C0001</td>
                        <td>10/05/2022</td>
                        <td>9.00 - 10.00</td>
                        <td>Nene</td>
                        <td>10.5 Kg. [03]</td>
                        <td>Yes</td>
                        <td>100</td>
                        <td>Finish</td>
                    </tr>
                    <tr>
                         <td>C0002</td>
                        <td>13/05/2022</td>
                        <td>12.00 - 13.00</td>
                        <td>Mena</td>
                        <td>10.5 Kg. [02]</td>
                        <td>No</td>
                        <td>60</td>
                        <td>Finish</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </font>
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
    height: ;
    margin-right: 50px;
    padding: 3rem;
    background-color: #F1F1F1;
  }
@media screen and (min-width : 650px) {
    .nav-drop li{
        width: 200px;
        border-bottom: none;
        height: 50px;
        line-height: 50px;
        font-size: 18px;
        display: inline-block ;
        margin-right: -4px;
    }
    .nav-drop a{
        border-bottom:  none;
    }

    .nav-drop > ul > li{
        text-align: center;
    }
    .nav-drop > ul > li > a {
        padding-left: 0;
    }
/* Table */
.my-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 00.9em;
    min-width: 400px;
    border-radius: 5px 5px 0 0; /* border-radius ทำให้มุมกรอบมนๆ */
    overflow: hidden;
    box-shadow: 0 0 8px rgb(0, 0, 0.15);
    margin: auto;
    width: 100%;
}
.my-table thead tr{
    background-color: #368614;
    color: #fff;
    text-align: left;
    font-weight: bold;
}
.my-table th,.my-table td{
    padding: 12px 15px;
}
.my-table tbody tr {
    border-bottom: 1px solid #ddd;
}
.my-table tbody tr:nth-of-type(even){
    background-color: #fff;
}
.my-table tbody tr:last-of-type {
    border-bottom: 2px solid #368614;
}
.my-table tbody td.active-collum { 
    font-weight: bold;
    color: #000000;
}
.my-table tbody tr.active-row { 
    font-weight: bold;
    background-color: #bcf3bc;
    color: #ff0303;
}
.text-head {
    text-align: center;
    margin-bottom : 20px;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}
th {
    text-align : center;
}

</style>