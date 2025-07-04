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



<div class="container my-4 p-md-3 p-1 bg-dark text-light" style="border-radius: 10px;">

    <div class="jumbotron bg-dark text-light px-md-5 px-3 py-3">
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


<div class="container p-3 shadow-lg bg-light "style="border: 2px solid #ccd2d9;  border-radius: 10px;">
    <h1>Star a Discussion</h1>


    <?php

    $showError = false;
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = htmlspecialchars($_POST['thread_title']);
        $th_desc = htmlspecialchars($_POST['thread_desc']);
        if (!empty($th_title) && !empty($th_desc)) {

            $sno = $_POST['sno'];

            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
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
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
        $user = $_SESSION['user_email'];
        echo '
  <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
        <div class="mb-3">
            <label for="thread_title" class="form-label">Title</label>
            <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title short.</div>
        </div>
        <div class="form-group shadow-sm">
            <label for="thread_desc" class="py-2">Ellaborate your concern</label>
            <textarea class="form-control" id="thread_desc" name="thread_desc" style="height: 100px"></textarea>
             <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
            
        </div>
        <button type="submit" class="btn btn-success my-2">Submit</button>
    </form>
</div>
  ';
    } else {
        echo '
        <form>
                <div class="mb-3">
                    <label for="thread_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Keep your title short.</div>
                </div>
                <div class="form-group">
                    <label for="thread_desc" class="py-2">Ellaborate your concern</label>
                    <textarea class="form-control" id="thread_desc" name="thread_desc" style="height: 100px"></textarea>
                </div>
        </form>
                <div>
                <button class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#loginmodal">Submit</button>
                </div>
    </div>
';
    }
    ?>


    <?php


$sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);
$noResult = true;

echo '<div class="container my-4 p-3  text-light" style="border-radius: 10px; background-color:rgb(41, 45, 48);">
<h1 class="px-1">Browse Questions</h1>
';
while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $thread_id = $row['thread_id'];
        $thread_title =htmlspecialchars( $row['thread_title']);
        $thread_desc = htmlspecialchars($row['thread_desc']);
        $thread_time = htmlspecialchars($row['timestamp']);
        $thread_user_id = ($row['thread_user_id']);
        
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);


        $user =  ($row2['user_email']);





        echo
        '<hr><div class="container  my-md-4 my-2 py-3 bg-dark " style="border-radius: 10px;"  >
            <div class="media mb-4 d-flex py-2 ">
                <img src="img/userdefault.png" class=" rounded-circle img-fluide" alt="Generic placeholder image" style="width:50px; height:50px;">
                
                <h5 class="px-2"><a href="thread.php?threadid=' . $thread_id . '" class="text-light  text-decoration-none">' . $thread_title . '</a></h5>
                
            </div>
                <div class="media-body">
                    ' . $thread_desc . '
                    <p class="mt-4"><em>Posted by: <a href="" class="text-success text-decoration-none fs-6">' . $user . '</a><br> At ' . $thread_time . '</em></p>
                </div>
        </div>';
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





<?php include('./partials/_footer.php'); ?>
