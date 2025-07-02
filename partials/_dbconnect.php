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




?>