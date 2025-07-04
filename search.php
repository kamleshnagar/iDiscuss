<?php
$title = "iDiscuss";
include('./partials/_dbconnect.php');
include('./partials/_header.php');
?>

<div class="searchResults container px-3">
    <h1>Search results for <em>"<?= htmlspecialchars($_GET['search']) ?>"</em></h1>
</div>
<hr>

<?php
$searchvalue = $_GET['search'];
$noResults = true;

// ---------------------- 1. Search in Threads ----------------------
$sql1 = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) AGAINST (? IN NATURAL LANGUAGE MODE)";
$stmt1 = mysqli_prepare($conn, $sql1);
mysqli_stmt_bind_param($stmt1, "s", $searchvalue);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);

while ($row = mysqli_fetch_assoc($result1)) {
    showThread($row, $conn);
    $noResults = false;
}

// ---------------------- 2. Search by User Email ----------------------
$sql2 = "SELECT * FROM `users` WHERE MATCH (`user_email`) AGAINST (? IN NATURAL LANGUAGE MODE)";
$stmt2 = mysqli_prepare($conn, $sql2);

mysqli_stmt_bind_param($stmt2, "s", $searchvalue);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

while ($userRow = mysqli_fetch_assoc($result2)) {
    $user_id = $userRow['sno'];
    $user_email = $userRow['user_email'];

    // Get threads by this user
    $sqlThreads = "SELECT * FROM `threads` WHERE `thread_user_id` = ?";
    $stmtT = mysqli_prepare($conn, $sqlThreads);
    mysqli_stmt_bind_param($stmtT, "i", $user_id);
    mysqli_stmt_execute($stmtT);
    $threadsResult = mysqli_stmt_get_result($stmtT);

    while ($row = mysqli_fetch_assoc($threadsResult)) {
        showThread($row, $conn);
        $noResults = false;
    }
}

// ---------------------- 3. Search in Comments ----------------------
$sql3 = "SELECT * FROM `comments` WHERE MATCH (`comment_content`) AGAINST (? IN NATURAL LANGUAGE MODE)";
$stmt3 = mysqli_prepare($conn, $sql3);
mysqli_stmt_bind_param($stmt3, "s", $searchvalue);
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);

while ($commentRow = mysqli_fetch_assoc($result3)) {
    $thread_id = $commentRow['thread_id'];

    $sqlThread = "SELECT * FROM `threads` WHERE `thread_id` = ?";
    $stmtTh = mysqli_prepare($conn, $sqlThread);
    mysqli_stmt_bind_param($stmtTh, "i", $thread_id);
    mysqli_stmt_execute($stmtTh);
    $threadResult = mysqli_stmt_get_result($stmtTh);

    while ($threadRow = mysqli_fetch_assoc($threadResult)) {
        showThread($threadRow, $conn);
        showComment($commentRow, $threadRow, $conn);
        $noResults = false;
    }
}

if ($noResults) {
    echo '<div class="container my-5"><h4>No results found. Try different keywords.</h4></div>';
}

// ---------------------- Function to display thread ----------------------
function showThread($row, $conn)
{
    $thread_title = htmlspecialchars($row['thread_title']);
    $thread_desc = htmlspecialchars($row['thread_desc']);
    $thread_id = $row['thread_id'];
    $thread_user_id = $row['thread_user_id'];
    $thread_timestamp = $row['timestamp'];

    // Get user email
    $sql = "SELECT `user_email` FROM `users` WHERE `sno` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $thread_user_id);
    mysqli_stmt_execute($stmt);
    $userResult = mysqli_stmt_get_result($stmt);
    $userRow = mysqli_fetch_assoc($userResult);
    $user_email = htmlspecialchars($userRow['user_email']);

    $url = "thread.php?threadid=" . $thread_id;

    echo '

    <div class="result container p-4 bg-dark text-light rounded my-4">
        <h3><a href="' . $url . '" class="text-success text-decoration-none">' . $thread_title . '</a></h3>
        <p>' . $thread_desc . '</p>
        <div class="d-flex justify-content-between mt-3">
            <p><em>Posted by: <span class="text-success fw-bolder">' . $user_email . '</span></em></p>
            <p><em>at ' . $thread_timestamp . '</em></p>
        </div>
    </div>
    ';
}
?>
<?php
function showComment($row, $row2, $conn)
{

    $comment_content = htmlspecialchars($row['comment_content']);
    $thread_id = $row2['thread_id'];
    $thread_user_id = $row2['thread_user_id'];
    $comment_time = $row['comment_time'];
  
    

    $sql = "SELECT `user_email` FROM `users` WHERE `sno` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $thread_user_id);
    mysqli_stmt_execute($stmt);
    $userResult = mysqli_stmt_get_result($stmt);
    $userRow = mysqli_fetch_assoc($userResult);
    $user = htmlspecialchars($userRow['user_email']);

    $url = "thread.php?threadid=" . $thread_id;


    echo '
    
    <h3 class="container"> Comments </h3>
    <div class="container  my-4 p-3 d-flex " style="border-radius: 10px; ">
    <div class="container media d-flex">
    <img src="img/userdefault.png" class="m-3 rounded-circle img-fluide" alt="Generic placeholder image" style="width:50px; height:50px;">
    <div class="media-body container ">
    <div class="my-4  text-light d-flex  justify-content-between "><a href="' . $url . '" class="text-success text-decoration-none fs-5 "> <b>' . $user . '</b></a>
    <span class="text-end "><em> at ' . $comment_time . '</em></span>
    </div>
    
    <p>' . $comment_content . '</p>
    </div>
    </div>
    </div>
    <hr>
    ';
}
?>

<?php include('./partials/_footer.php'); ?>