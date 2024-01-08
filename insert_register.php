<?php

include 'condb.php';

// Receive variable values
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$line = $_POST['line'];
$password = $_POST['password'];

$password = hash('sha512', $password);

// Validate email format
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_domain = explode('@', $email)[1];
    if ($email_domain == 'gmail.com' || $email_domain == 'hotmail.com') {
        // Check if the email already exists
        $check_sql = "SELECT * FROM db_user WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_sql);
        $count = mysqli_num_rows($check_result);

        if ($count > 0) {
            echo "<script> alert('Email นี้มีการลงทะเบียนแล้ว กรุณาลงทะเบียนด้วยอีเมลอื่น'); </script> ";
            echo "<script> window.location='register.php'; </script> "; // Redirect to a suitable page
        } else {
            // Insert the new record if the email does not exist
            $sql = "INSERT INTO db_user(firstname, lastname, email, line_id, password, status)
            VALUES('$firstname', '$lastname', '$email', '$line', '$password', '0')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script> alert('การลงทะเบียนเสร็จสิ้น'); </script> ";
                echo "<script> window.location='login.php'; </script> "; // Redirect to a suitable page
            } else {
                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
                echo "<script> alert('Failed to save data'); </script> ";
            }
        }
    } else {
        echo "<script> alert('กรุณากรอกอีเมลที่ถูกต้อง (ต้องเป็น @gmail.com หรือ @hotmail.com เท่านั้น)'); </script> ";
        echo "<script> window.location='register.php'; </script> "; // Redirect to a suitable page
    }
} else {
    echo "<script> alert('กรุณากรอกอีเมลที่ถูกต้อง'); </script> ";
    echo "<script> window.location='register.php'; </script> "; // Redirect to a suitable page
}

mysqli_close($conn);

?>
