<?php
// Database connection file

$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername, $username, $password, $database) or die("Connection failed----------------------->: " . mysqli_connect_error());


$create_table_catagories = "CREATE TABLE IF NOT EXISTS `idiscuss`.`categories` (`category_id` INT NOT NULL AUTO_INCREMENT , `category_name` VARCHAR(255) NOT NULL , `category_discription` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,`image_url` VARCHAR(255) NULL , PRIMARY KEY (`category_id`)) ENGINE = InnoDB;";
mysqli_query($conn, $create_table_catagories);

$create_table_threads = "CREATE TABLE IF NOT EXISTS `idiscuss`.`threads` (`thread_id` INT NOT NULL AUTO_INCREMENT , `thread_title` VARCHAR(255) NOT NULL , `thread_desc` TEXT NOT NULL , `thread_cat_id` INT NOT NULL , `thread_user_id` INT NOT NULL , `timestamp`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`thread_id`)) ENGINE = InnoDB;";
mysqli_query($conn, $create_table_threads);



$create_table_users = "CREATE TABLE IF NOT EXISTS `idiscuss`.`users` (`sno` INT(8) NOT NULL AUTO_INCREMENT , `user_email` VARCHAR(30) NOT NULL , `user_pass` VARCHAR(255) NOT NULL , `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`)) ENGINE = InnoDB;";
mysqli_query ($conn, $create_table_users);

$create_contact = "CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT DEFAULT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`sno`) ON DELETE SET NULL
) ENGINE=InnoDB;";
mysqli_query($conn, $create_contact);
?>