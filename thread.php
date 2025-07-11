<?php

include('./partials/_dbconnect.php'); ?>

<?php



$thread_id = $_GET['threadid'];
$sql = "SELECT * FROM `threads` WHERE thread_id=$thread_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {


    $thread_id = $row['thread_id'];
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
    $thread_time = $row['timestamp'];
    $thread_user_id = $row['thread_user_id'];
};
?>





<?php
$title = "iDiscuss-" . $thread_title;

include('./partials/_header.php');
?>
<?php
$sqlauthor = "SELECT user_email FROM `users` WHERE sno=$thread_user_id";
$result = mysqli_query($conn, $sqlauthor);
$row = mysqli_fetch_assoc($result);
$author = $row['user_email'];

?>
<div class="container-fluid bg-dark" style="border-radius:10px;">
    <div class="container bg-dark text-light py-4 my-4 " >

        <h1 class="display-4"><b> <?php echo $thread_title ?></b></h1>
        <p class="lead"> <?php echo $thread_desc ?></p>

        <p class="text-left"><small> Posted by: </small><em><span class="text-success fw-bolder"> <?php echo $author ?></span></em></p>
    </div>
</div>

<div class="container p-3" style="border: 2px solid rgba(12, 173, 108, 0.39);  border-radius: 10px;">
    <h1>Post a comment</h1>
    <?php

    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment_content = htmlspecialchars($_POST['comment_content']);
        $sno = $_POST['sno'];
        if (!empty($comment_content)) {

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$thread_id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            echo        "<script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                     </script>";
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! Please wait for  community to response.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        } else {
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Write some text to post comment.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }


    ?>

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
        $user = $_SESSION['user_email'];
        echo ' <form class="" method="post" action="' . $_SERVER['REQUEST_URI'] . ' ">

        <div class="form-group">
            <label for="comment_content" class="py-2">Type your comment</label>
            <textarea class="form-control" id="comment_content" name="comment_content" style="height: 100px"></textarea>
            <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success my-2 text-end">Post Comment</button>
        </div>

    </form>';
    } else {
        echo ' <form>

        <div class="form-group">
            <label for="comment_content" class="py-2">Type your comment</label>
            <textarea class="form-control" id="comment_content" name="comment_content" style="height: 100px"></textarea>
        </div>
        </form>
        <div class="text-end">
            <button type="submit" class="btn btn-success my-2 text-end"  data-bs-toggle="modal" data-bs-target="#loginmodal">Post Comment</button>
        </div>

        ';
    }
    ?>
</div>

<?php

$sql = "SELECT * FROM `comments` WHERE thread_id = '$thread_id'";
$result = mysqli_query($conn, $sql);
$noResult = true;


echo '<div class="container-fluid  my-4 p-3 bg-light text-dark " style="border-radius: 10px;">
        <div class="container ">
                 <h1 >Discussions</h1>
        </div>
       ';
while ($row = mysqli_fetch_assoc($result)) {
    $noResult = false;
    $comment_id = $row['comment_id'];
    $comment_content = htmlspecialchars($row['comment_content']);
    $comment_by = htmlspecialchars($row['comment_by']);
    $comment_time = $row['comment_time'];

    $sql2 = "SELECT user_email FROM `users` WHERE sno='$comment_by'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);


    $user =  $row2['user_email'];


    echo
    '<hr><div class="container text-light my-md-4 p-3" style="border-radius: 10px; background-color:rgb(41, 45, 48);">
            <div class="d-flex text-wrap my-2">
                <img src="img/userdefault.png" class=" rounded-circle img-fluide" alt="Generic placeholder image" style="width:50px; height:50px;">
                <div class="media-body container px-2 d-md-flex  justify-content-md-between ">
                <a href="thread.php?threadid=' . $thread_id . '" class="text-success text-decoration-none fs-5 "> <b>' . $user . '</b></a>
                <div class="text-start text-md-end "><em> at ' . $comment_time . '</em></div>
            </div>
                  
                    
            </div>
                <div >'
                 . $comment_content . '
                </div> 
        </div>';
}

if ($noResult) {
    echo '
        <div class=" my-md-4 p-3">
            <h4>No Comments found.</h4>
           
         </div>
    </div>
    ';
}

?>





<?php include('./partials/_footer.php'); ?>
