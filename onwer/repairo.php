<?php
   session_start(); 
   include '\condb.php';
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
        <div class = "date">
        <h1 class = "text-head">
        <img src = "https://cdn-icons-png.flaticon.com/128/2760/2760290.png" 
         width = 30 height = 30>
        Repair</h1>

<input type="text" id="myInput" onkeyup="myFunction()" 
placeholder="Search for Date" title="Type in a date">

            <table id="myTable">
            <tr  id = header>
                <th>Date</th>
                <th>Machine</th>
                <th>Detail</th>
            </tr>
        <tbody>
        <?php
  $sql = "SELECT * FROM booking" ;
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($result)){
      ?>
      <tr>
      <td><?=$row["dob"]?></td>
      <td><?=$row["time"]?></td>
      <td><?=$row["Total"]?></td>
    </tr>
    <?php
  }
  mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
    ?>
            <tr class="active-row">
                <td>10/06/2023</td>
                <td>washing machine 04</td>
                <td>Loud washing machine</td>
                <td>รออัพเดต</td>
            </tr>
        </tbody>
            </table>

            <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
            </script>
            
                
            
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
#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 50%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
  margin-top : 10px;
}

#myTable {
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
#mytable th, #mytabel td{
    padding: 12px 15px;
}
#myTable th{
    background-color: #368614;
    color: #fff;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    padding : 10px;
}

#myTable tbody tr {
  border-bottom: 1px solid #ddd;
  font-size: 16px;
    text-align : center;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
 
}
#mytable tbody tr:last-of-type {
    border-bottom: 2px solid #368614;
}
#my-table tbody td.active-collum { 
    font-weight: bold;
    color: #000000;
    
}
.text-head {
    text-align: center;
    margin-bottom : 20px;
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;

}
td{
    padding : 10px;
}
</style>