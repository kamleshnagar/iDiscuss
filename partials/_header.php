
<?php
session_start();
include('_dbconnect.php');

echo
'
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>' . $title . '</title>
</head>
<style>
*{
margin:0;
padding:0
box-sizing: border-box;

}
</style>

<body>

<div class="mb-5">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand text-success fs-2 fw-bolder" href="../../forum">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../forum">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../forum/about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Catagories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $category_id = $row['category_id'];
  $cat = $row['category_name'];


  echo
  ' <li><a class="dropdown-item" href="threadlist.php?catid=' . $category_id . '">' . $cat . '</a></li>';
}


echo
'</ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../forum/contact.php">Contact</a>
          </li>
        </ul>
        ';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
  $user = $_SESSION['user_email'];
  echo '<form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
          <div class="text-light m-2">Welcome ' . $user . '</div>
          <div class="mx-3">
           <a role="button" class="text-decoration-none btn btn-outline-success m-1""  href="/forum/partials/_handleLogout.php">Logout</a>
            
          </div>';
} else {
  echo '<form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
          <div class="mx-3">
            <button class="btn btn-outline-success m-1" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
            <button class="btn btn-outline-success m-1" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>
          </div>';
}
echo
'</div>
</div>
</nav>';

include('_loginmodal.php');
include('_signupmodal.php');
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account has been created successfully. You can login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
  $msg = ($_GET['error']);
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> ' . htmlspecialchars($msg) . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
  $user = $_GET['user_email'];
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Welcome <b> ' . htmlspecialchars($user) . '</b> you\'re successfully loggedin. 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
  $msg = $_GET['error'];
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> ' . htmlspecialchars($msg) . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_SESSION['logout']) && $_SESSION['logout'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account has been Logged out successfully. You can login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
unset($_SESSION['logout']);

}
?>
