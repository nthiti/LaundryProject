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
<div class = "container ">

<div class="h4 text-center alert alert-success mt-5 mb-10 " role="alert">
  EDIT Profile
</div>
  <form action="update_profile.php" method="post">
                <!-- <label>Id </label>
                <input type="number" name="id" class="form-control" readonly value=<?=$row['id']?> > <br> -->
                <label>ชื่อ</label>
                <input type="text" name="fn" class="form-control" value=<?=$row['firstname']?> id = "text/javascript"> <br>
                <label>นามสกุล</label>
                <input type="text"  name="ln" class="form-control" value=<?=$row['lastname']?>  id = "text/javascript" ><br>
                <label>email</label>
                <input type="text"   readonly class="form-control" value=<?=$row['email']?> ><br>
                <label>ไอดีไลน์</label>
                <input type="text"   readonly class="form-control" value=<?=$row['line_id']?> ><br>
                <input type="submit" value="update" class="btn btn-success mt-2" >
                <a href = "setting.php" class="btn btn-danger mt-2"> Cancel </a>
            </form>
    </div>
</body>
</html>

<script type="text/javascript">
    function updateScore(answer, correct) {
      if (answer == correct) {
    $.get('index.php', {'score': '1'}, function(d) {
        alert('Vote Accepted: ' + d);
    });
  }
}
</script>