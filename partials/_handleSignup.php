<?php
$showAlert = false;
$showError = "false";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $user_email = htmlspecialchars($conn, $_POST['signup_email']);
    $pass = htmlspecialchars($conn, $_POST['signup_password']);
    $cpass = htmlspecialchars($conn, $_POST['signup_cpassword']);
    $redirect = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '/forum/index.php';
    $separator = (parse_url($redirect, PHP_URL_QUERY)) ? '&' : '?';

    if (!empty($user_email) && !empty($pass) && !empty($cpass)) {
        // check for exisitng email 
        $existSql = "select * from `users` where user_email = '$user_email'";
        $result = mysqli_query($conn, $existSql);
        $numrows = mysqli_num_rows($result);
        if ($numrows > 0) {
            $showError = "Email already exists.";
            header("location:" . $redirect . $separator . "signupsuccess=false&error=$showError");
            exit();
        } else {
            if ($pass == $cpass) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;

                    header("location:" . $redirect . $separator . "signupsuccess=true");
                    exit();
                }
            } else {
                $showError = "Password do not match";
                header("location:" . $redirect . $separator . "signupsuccess=false&error=$showError");
                exit();
            }
        }
    } else {
        $showError = "Fill all the required fields.";
       header("location:" . $redirect . $separator . "signupsuccess=false&error=$showError");
        exit();
    }
}
