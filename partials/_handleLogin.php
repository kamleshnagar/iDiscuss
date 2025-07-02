<?php

$showAlert = false;
$showError = "false";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['login_email'];
    $pass = $_POST['login_pass'];
    if (!empty($email) && !empty($pass)) {
    
        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $numrows = mysqli_num_rows($result);
        if ($numrows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['user_pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $email;
                header("location:/forum/index.php?loginsuccess=true&user_email=$email");
                exit();
            } else {
                $showError = "Please enter valid email or password";
                header("location:/forum/index.php?loginsuccess=false&error=$showError");;
                exit();
            }
        }
    } else {
         $showError = "Fill all the required fields.";
        header("location:/forum/index.php?loginsuccess=false&error=$showError");
        exit();
    }
}
