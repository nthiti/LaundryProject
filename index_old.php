<?php
    session_start();
    require_once 'config/db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<header>
        <a href = "#" class ="logo"><img src = "img/pic6.png"
                  width="70" height="70"></a>
        <ul>
        <li><a href="signin.php"><img src = "https://cdn-icons-png.flaticon.com/128/318/318477.png"
        width = "30" height = "30" title = "Go to login" ></a></li>
</header>
    <div class = "container">
    <h3 class = "mt-4">Register</h3>
    <hr>
    <form action = "singup_db.php" method ="post">
        <?php if(isset($_SESSION['error'])) { ?>
            <div class = "alert alert-danger" role = "alert" >
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);                
                ?>
            </div>
        <?php  } ?>
        <?php if(isset($_SESSION['success'])) { ?>
            <div class = "alert alert-success" role = "alert" >
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);                
                ?>
            </div>
        <?php  } ?>
        <?php if(isset($_SESSION['warning'])) { ?>
            <div class = "alert alert-warning" role = "alert" >
                <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);                
                ?>
            </div>
        <?php  } ?>
    <div class="mb-1">
        <label for="firstname" class="form-label">First name</label>
        <input type="text" class="form-control" name = "firstname" 
        placeholder="...firstname" aria-describedby="firstname">
    </div>
    <div class="mb-1">
        <label for="lastname" class="form-label">Last name</label>
        <input type="text" class="form-control" name = "lastname" 
        placeholder="...lastname" aria-describedby="lastname">
    </div>
    <div class="mb-1">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name = "email" 
        placeholder="...email" aria-describedby="email">
    </div>
    <div class="mb-1">
        <label for="line" class="form-label">Line ID</label>
        <input type="text" class="form-control" name = "line" 
        placeholder="...Line id"aria-describedby="lastname">
    </div>
    <div class="mb-1">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name = "password"
        placeholder="...password">
    </div>
    <div class="mb-2">
        <label for="confirm password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name = "c_password"
        placeholder="...confirm password" >
    </div>
    <button style="width:100%;text-align:center;" type="submit" name = "signup"class="btn">Sign Up</button>
    </form>
    <hr>
    <p>Already a member? Click to <a href = "signin.php" > login </a></p>
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
    width: 700px;
    border-radius: 5px;
    height: 710px;
    margin-top: 110px;
    border: 5px ;
    font-size : 16px;
}
h3{
    padding : 8px;
    text-align: center;
}
.btn{
    background: #92CEA8;
    padding : 5px;
    border-style: solid;
    border-width: 5px;
    font-weight: bold;
    font-size: 20px;
}
a{
    color : red;
}
</style>