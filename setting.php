<?php
session_start();
include 'condb.php';
if(!isset($_SESSION["firstname"])){ //check ค่าว่าง
  header("location:login.php");
}
$firstname = $_SESSION["firstname"];
$sql = "SELECT * FROM db_user WHERE firstname = '$firstname' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>R Laundry</title>
  </head>
<body>
<section>
          <div class="circle"></div>
            <header>
                <a href = "home_user.php"  class ="logo mt-1" ><img src = "https://cdn-icons-png.flaticon.com/128/11502/11502464.png"
                  width="30" height="30" title = "Back"></a>
              </header>
  <div class = "container">
  <div class="h4 text-center alert alert-success  mb-10 " role="alert">
  แก้ไขข้อมูลส่วนตัว
</div>
  <h4> <?php
                        if(isset($_SESSION["firstname"])){
                        echo "<div class = 'text-success'>";
                        echo "Welcome , " . $_SESSION["firstname"] . " 🎉";
                        echo "</div>";
                        }?></h4>
<a href = "edit_profile.php" class="btn btn-success mb-2"> Edit Profile </a>
              <br><br><label>ชื่อ</label>
                <input type="text" name="firstname" readonly class="form-control" value=<?=$row['firstname']?> > <br>
                <label>นามสกุล</label>
                <input type="text"  name="lastname" readonly class="form-control" value=<?=$row['lastname']?> ><br>
                <label>email</label>
                <input type="text"  readonly class="form-control" value=<?=$row['email']?> ><br>
                <label>ไอดีไลน์</label>
                <input type="text"  readonly class="form-control" value=<?=$row['line_id']?> ><br>
              </div>
<section>
</body>
</html>

</script>

<style>
  @media screen and (min-width : 650px) {
   *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'poppins', Roboto Condensed;
  }
  section{
    position: relative;
    width: 100%;
    min-height: 100vh;
    padding: 100px;
    /* display: flex; */
    justify-content: space-between;
    align-items: center;
    background: #FFFDFA;

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

}
</style>