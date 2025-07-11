

<?php
// Turn off displaying errors to the user
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Enable error logging
ini_set('log_errors', 1);

// Define the path to the error log file
ini_set('error_log', __DIR__ . '/logs/php-error.log');

// Optional: create logs directory if it doesn't exist
if (!file_exists(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0777, true);
}
?>


<?php
// Database connection file

$servername = "159.89.161.154";
$username = "root";
$password = "kamlesh0095Nagar";
$database = "idiscuss";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    exit('Something went wrong. Please try again later.');
}


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



// $threads_table_fulltext = "ALTER TABLE `threads` ADD FULLTEXT (`thread_title`, `thread_desc`);";
// mysqli_query ($conn, $threads_table_fulltext);

// $users_table_fulltext = "ALTER TABLE `users` ADD FULLTEXT (`user_email`);";
// mysqli_query ($conn, $users_table_fulltext);

// $comments_table_fulltext = "ALTER TABLE `comments` ADD FULLTEXT (`comment_content`);";
// mysqli_query ($conn, $comments_table_fulltext);
 



?>
