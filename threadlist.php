<?php
include('./partials/_dbconnect.php'); ?>

<?php

$id = $_GET['catid'];

$sql = "SELECT * FROM `categories` WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $catname = $row['category_name'];
    $catdesc = $row['category_discription'];
    $web = $row['website'];
};
?>


<?php
$title = "iDiscuss-" . $catname;
include('./partials/_header.php');


?>



<div class="container my-4 p-3 bg-dark text-light">

    <div class="jumbotron bg-dark text-light px-5 py-3">
        <h1 class="display-4"><b>Welcome to the <?php echo $catname ?> forums</b></h1>
        <p class="lead"> <?php echo $catdesc ?></p>
        <hr class="my-4">
        <p>Focus on your substantive comments and not on other commenters, personally. Users are entitled to choose not to enter into debate with you. Don't post or link to inappropriate, offensive or illegal material. Inappropriate content is anything that may offend or is not relevant to the forum.</p>
        <p class="lead">
        <p>Following button will redirect you on <a href="<?php echo $web ?>"><?php echo $web ?></a> </p>
        <a class="btn btn-success btn-lg my-auto" href="<?php echo $web ?>" role="button">Learn more</a>
        </p>
    </div>

</div>


<div class="container p-3">
    <h1>Star a Discussion</h1>


    <?php

    $showError = false;
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = mysqli_real_escape_string($conn, $_POST['thread_title']);
        $th_desc = mysqli_real_escape_string($conn, $_POST['thread_desc']);
        if (!empty($th_title) && !empty($th_desc)) {
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            $showAlert = true;
             echo      "<script>
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
        } else
            $showError = true;
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error !</strong> Please fill all require field.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    ?>

    <form class="" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <div class="mb-3">
            <label for="thread_title" class="form-label">Title</label>
            <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title short.</div>
        </div>
        <div class="form-group">
            <label for="thread_desc" class="py-2">Ellaborate your concern</label>
            <textarea class="form-control" id="thread_desc" name="thread_desc" style="height: 100px"></textarea>
        </div>
        <button type="submit" class="btn btn-success my-2">Submit</button>
    </form>
</div>





<?php



$sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);
$noResult = true;

echo '<div class="container my-4 p-3 bg-dark text-light">
        <h1 class="px-1">Browse Questions</h1>
        <hr>';
while ($row = mysqli_fetch_assoc($result)) {
    $noResult = false;
    $thread_id = $row['thread_id'];
    $thread_title = $row['thread_title'];
    $thread_desc = $row['thread_desc'];


    echo
    '<div class="container  my-4 p-3 d-flex">
            <div class="media d-flex">
                <img src="img/userdefault.png" class="m-3 mt-4 rounded-circle img-fluide" alt="Generic placeholder image" style="width:50px; height:50px;">
                <div class="media-body">
                    <h5 class="mt-4"><a href="thread.php?threadid=' . $thread_id . '" class="text-light text-decoration-none">' . $thread_title . '</a></h5>
                    ' . $thread_desc . '
                </div>
            </div>
        </div><hr>';
}

if ($noResult) {
    echo '
        <div class=" my-4 p-3">
            <h4>No threads found.</h4>
            <p>Be the first person to ask a <b><a href="#thread_title" class="text-decoration-none text-success">Question.</a></p>
         </div>
    </div>
    ';
}


?>





<?php include('_footer.php'); ?>

