<?php
$title = "iDiscuss";

include('./partials/_dbconnect.php');
include('./partials/_header.php'); ?>



<!-- <h2 class="text-center my-4">Welcome to <a href="index.php" class="text-success text-decoration-none fs-2 fw-bolder">iDiscuss</a></h2> -->

<!-- SEARCH RESULTS starts here -->


<div class="searchResults container py-5 bg-dark text-light my-5 " style="border-radius: 10px;">
    <h1>Search results for <em>"<?= $_GET['search']  ?>"</em></h1>
    <hr>
    <?php
    $searchvalue = $_GET['search'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) AGAINST ('$searchvalue');";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if ($numrows != 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=" . $thread_id;
        }

        echo '
            
            <div class="result">
            <h3> <a href="' . $url . '" class="text-success text-decoration-none"> ' . $thread_title . '</a></h3>
            <p>' . $thread_desc . '</p>
            </div>        
            ';
    }else{
        echo 'No results Found';
    }
    ?>


</div>





<?php include('_footer.php'); ?>