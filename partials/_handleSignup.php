<?php
$showAlert = false;
$showError = "false";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $user_email = $_POST['signup_email'];
    $pass = $_POST['signup_password'];
    $cpass = $_POST['signup_cpassword'];


    if (!empty($user_email) && !empty($pass) && !empty($cpass)) {
        // check for exisitng email 
        $existSql = "select * from `users` where user_email = '$user_email'";
        $result = mysqli_query($conn, $existSql);
        $numrows = mysqli_num_rows($result);
        if ($numrows > 0) {
            $showError = "Email already exists.";
            header("location:/forum/index.php?signupsuccess=false&error=$showError");
            exit();
        } else {
            if ($pass == $cpass) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    header("location:/forum/index.php?signupsuccess=true");
                    exit();
                }
            } else {
                $showError = "Password do not match";
                header("location:/forum/index.php?signupsuccess=false&error=$showError");
                exit();
            }
        }
    } else {
        $showError = "Fill all the required fields.";
        header("location:/forum/index.php?signupsuccess=false&error=$showError");
        exit();
    }
}
