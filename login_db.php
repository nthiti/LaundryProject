<?php

    include 'condb.php';
    session_start();

    $email =$_POST['email'];
    $password = $_POST['password'];

    $password = hash('sha512',$password);

    $sql = "SELECT * FROM db_user WHERE email = '$email' and password = '$password' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $status = $row['status'];

    

    if($row > 0){
        $_SESSION["id"] = $row["id_user"];
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
        $_SESSION["firstname"] = $row['firstname'];
        $_SESSION["lastname"] = $row['lastname'];
        $_SESSION["status"] = $row['status'];
        

        if ($status == '0' && $status != '1' && $status != '2') {
            header("location: home_user.php");
            exit();
        } elseif ($status == '1' && $status != '0' && $status != '2') {
            header("location: Homead.php");
            exit();
        } elseif ($status == '2' && $status != '0' && $status != '1') {
            header("location: Homeowner.php");
            exit();
        }
        
    }else {
        $_SESSION["Error"] = "<p> email / password is invalid </p>";
        $show = header("location:login.php");

    }

    echo $show;
?>