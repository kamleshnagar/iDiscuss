<?php
include('./partials/_dbconnect.php'); ?>
<?php

$thread_id = $_GET['threadid'];
$sql = "SELECT * FROM `threads` WHERE thread_id=$thread_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {


    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];
};
?>

<?php
$title = "iDiscuss-" . $thread_title;
include('./partials/_header.php');
?>





<div class="container bg-dark text-light py-4 my-4 ">

    <h1 class="display-4"><b> <?php echo $thread_title ?></b></h1>
    <p class="lead"> <?php echo $thread_desc ?></p>

    <p class="text-left"><b>Posted by: Kamlesh</b></p>
</div>


<div class="container p-3">
    <h1>Post a comment</h1>



    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment_content = $_POST['comment_content'];
        $th_desc = $_POST['thread_desc'];
        // $sql = "INSERT INTO `comments` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        // $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! Please wait for  community to response.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    ?>

    <form class="" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">

        <div class="form-group">
            <label for="comment_content" class="py-2">Type your comment</label>
            <textarea class="form-control" id="comment_content" name="comment_content" style="height: 100px"></textarea>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success my-2 text-end">Post Comment</button>
        </div>

    </form>
</div>





<?php
// $id = $_GET['catid'];
$sql = "SELECT * FROM `comments` WHERE thread_id = '$thread_id'";
$result = mysqli_query($conn, $sql);
$noResult = true;

echo '<div class="container my-4 p-3 bg-light text-dark rounded">
        <div class="container">
                 <h1>Discussions</h1>
        </div>
        <hr>';
while ($row = mysqli_fetch_assoc($result)) {
    $noResult = false;
    $comment_id = $row['comment_id'];
    $comment_content = $row['comment_content'];
    $comment_by = $row['comment_by'];
    echo
    '<div class="container  my-4 p-3 d-flex ">
            <div class="media d-flex">
                <img src="img/userdefault.png" class="m-3 mt-4 rounded-circle img-fluide" alt="Generic placeholder image" style="width:50px; height:50px;">
                <div class="media-body">
                    <h5 class="mt-4"><a href="thread.php?threadid=' . $thread_id . '" class="text-dark text-decoration-none mt-2"> <b>' . $comment_by . '</b></a></h5>
                    ' . $comment_content . '
                </div>
            </div>
        </div><hr>';

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if ($noResult) {
    echo '
        <div class=" my-4 p-3">
            <h4>No Comments found.</h4>
           
         </div>
    </div>
    ';
}

?>





<?php include('_footer.php'); ?>