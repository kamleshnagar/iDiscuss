<?php

$showAlert = false;
$showError = "false";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['login_email'];
    $pass = $_POST['login_pass'];

    $redirect = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '/forum/index.php';
    $separator = (parse_url($redirect, PHP_URL_QUERY)) ? '&' : '?';
    if (!empty($email) && !empty($pass)) {

        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $numrows = mysqli_num_rows($result);
        if ($numrows === 1) {
            $row = mysqli_fetch_assoc($result);
            echo var_dump($row);
            if (password_verify($pass, $row['user_pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $email;
               
                $_SESSION['sno'] = $row['sno'];
                
                echo

                header("location:" . $redirect . $separator . "&logout=false&loginsuccess=true&user_email=" . $email);

                exit();
            } else {
                $showError = "Please enter valid email or password";
                header("location:" . $redirect . $separator . "logout=false&loginsuccess=false&error=$showError");
                exit();
            }
        } else {
            $showError = "User not found. Please sign up before logging in.";
            header("location:" . $redirect . $separator . "logout=false&loginsuccess=false&error=$showError");
            exit();
        }
    } else {
        $showError = "Fill all the required fields.";
        header("location:" . $redirect . $separator . "logout=false&loginsuccess=false&error=$showError");
        exit();
    }
}


