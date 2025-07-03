<?php
$title = "iDiscuss";

include('./partials/_dbconnect.php');
include('./partials/_header.php'); ?>



<!-- <h2 class="text-center my-4">Welcome to <a href="index.php" class="text-success text-decoration-none fs-2 fw-bolder">iDiscuss</a></h2> -->

<!-- slider starts here -->
<div class=" container-fluid mt-1"  style="max-height:400px; object-fit:contain;">
  <div id="carouselExampleIndicators" class="carousel slide bg-dark w-100" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="container-fluid p-0" >
      <div class="carousel-inner w-100 " >
        <div class="carousel-item active">
          <img src="img/image1.png" class="d-block w-100  img-fluide" alt="..."  style="max-height:400px">
        </div>
        <div class="carousel-item">
          <img src="img/image2.png" class="d-block w-100 img-fluide" alt="..."  style="max-height:400px;">
        </div>
        <div class="carousel-item">
          <img src="img/image3.png" class="d-block  w-100 img-fluide" alt="..."  style="max-height:400px;">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>


<div class="container my-4 py-2 px-5">
  <div class="row">
    <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['category_id'];
      $cat = $row['category_name'];
      $desc = $row['category_discription'];
      $img = $row['image_url'];
      echo '<div class="col-md-4 my-4">
      <div class="card box-md-shadow" style="min-height: 28rem; ">
        <img  style="min-height: 300px;" src="' . $img . '" class="card-img-top" alt="...">
        <div class="card-body" >
          <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '" style="text-decoration:none; color:black">' . $cat . '</a></h5>
          <p class="card-text">' . substr($desc, 0, 100) . '...</p>
          <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary" >View Threads</a>
        </div>  
      </div>
    </div>';
    };

    ?>


  </div>

</div>

<?php include('_footer.php'); ?>