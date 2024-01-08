<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>

<header>
        <a href = "#" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
        <ul>
        <li><a href="register.php"><img src = "https://cdn-icons-png.flaticon.com/128/318/318477.png"
        width = "30" height = "30" title = "Go to login" ></a></li>
</header>
    
    <div class = "container">
    <h3 class = "mt-5">login</h3>
    <hr>
    <form action = "login_db.php" method ="POST">
    <div class="mb-3">
        <input type="email" class="form-control" name = "email" aria-describedby="email" 
        required placeholder="Email" >
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" name = "password"
        required placeholder="password" >
        </div>
        <?php
        if(isset($_SESSION["Error"])){
          echo "<div class = 'text-danger'>";
          echo $_SESSION["Error"];
          echo "</div>";
        }
        ?>
        <input type="submit" value="Login" class="btn btn-success mt-2" >
    </form>
    <hr>
    <p>Not a member yet? Click to <a href = "register.php"> register </a></p>
    </div>

</body>
</html>


</body>
</html>

<style>
   body{
  background-image: url('https://scontent.fbkk31-1.fna.fbcdn.net/v/t1.15752-9/364182386_647177914043197_2694652478836126237_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeH6pIuNedGxS_bGTd8VQbZfdMl7HoYq-uV0yXsehir65c1QrWyqKwN4ffHXPJOu0Z8t8bqa_gXGssGZprnuXoMI&_nc_ohc=cd74ZGXW_RUAX-Iy3O2&_nc_ht=scontent.fbkk31-1.fna&oh=03_AdQXVoGPXlqjpMaFfWRvIWR79he6qRVxad4jdpmhq4gguw&oe=64EC14C2');
  background-size: cover;
  background-repeat: no-repeat;
  height : 730px;
}
  header{
    position: absolute;
    top: 0;
    left:0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
  }
  header .logo{
    position: relative;
    max-width: 50px;
  }
  header ul{
    position: relative;
    display: flex;
  }
  header ul li {
    list-style: none;
  }
  header ul li a {
    display: inline-block;
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    text-decoration: none;
    margin-top: 20px;
  }
  header ul li img {
    display: inline-block;
    text-decoration: none;
    align-items: center;
  }
.container{
    background:#D0F4DE;
    width: 600px;
    border-radius: 5px;
    height: 350px;
    margin-top: 250px;
    border: 10px ;
    font-size : 16px;
}
h3{
    padding : 15px;
    text-align: center;
}
a{
    color : red;
}

</style>