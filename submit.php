<?php

include('db_connect.php');

session_start();

if (isset($_SESSION['username'])) {
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $sql = "SELECT * FROM student WHERE s_id='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
}
else{
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

if(isset($_POST['submitsearch'])){
    if(!empty($_POST['searchtext'])){
        $searchtype = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_STRING);
        $searchtext=mysqli_real_escape_string($conn,$_POST['searchtext']);
        if($searchtype=="Students"){
          $sql = "SELECT *
                  FROM student
                  WHERE name LIKE '%$searchtext%'
                    OR s_id LIKE '%$searchtext%'";
          $result = mysqli_query($conn, $sql);
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['searchtext'] = $_POST['searchtext'];
            $_SESSION['searchtype'] = "students";
            header("Location:view_all_profiles.php");
          }
          else {
            echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
          }
        }
        else if($searchtype=="Verifiers"){
          $sql = "SELECT *
                  FROM verifier
                  WHERE name LIKE '%$searchtext%'
                    OR v_id LIKE '%$searchtext%'";
          $result = mysqli_query($conn, $sql);
          echo ("Happy1");
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['searchtext'] = $_POST['searchtext'];
            $_SESSION['searchtype'] = "verifiers";
            echo "Happy2";
            header("Location:view_all_profiles.php");
          }
          else {
            echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
          }
        }
        else if($searchtype=="Achievements"){
          $sql = "SELECT *
                  FROM achievements
                  WHERE name LIKE '%$searchtext%'
                    OR keywords LIKE '%$searchtext%'";
          $result = mysqli_query($conn, $sql);
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['searchtext'] = $_POST['searchtext'];
            $_SESSION['searchtype'] = "achievements";
            header("Location: view_all_profiles.php");
          }
          else {
            echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
          }
        }
        else if($searchtype=="Events"){
          $sql = "SELECT *
                  FROM events
                  WHERE name LIKE '%$searchtext%'
                    OR summary LIKE '%$searchtext%'
                    OR keywords LIKE '%$searchtext%'";
          $result = mysqli_query($conn, $sql);
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['searchtext'] = $_POST['searchtext'];
            $_SESSION['searchtype'] = "events";
            header("Location:view_all_events.php");
          }
          else {
            echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
          }
        }
        else if($searchtype=="Notices"){
          $sql = "SELECT *
                  FROM notices
                  WHERE name LIKE '%$searchtext%'
                    OR content LIKE '%$searchtext%'
                    OR keywords LIKE '%$searchtext%'";
          $result = mysqli_query($conn, $sql);
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['searchtext'] = $_POST['searchtext'];
            $_SESSION['searchtype'] = "notices";
            header("Location: view_all_notices.php");
          }
          else {
            echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
          }
        }
        else{
          echo "<script>alert('Please choose an option to search.')</script>";
        }
      }
  }

$msg = "";

if (isset($_POST['submit'])) {
    $target = "images/" . basename($_FILES['file_link']['name']);

    //$a_id = $_GET['a_id'];
    $a_category = $_POST['category'];
    $a_name = $_POST['name'];
    $a_external_file = $_POST['external_file'];
    $a_description = $_POST['description'];
    $a_keywords = $_POST['keywords'];
    //$a_file_link = $_POST['file_link'];
    $file_links = $_FILES['file_link']['name'];
    $a_s_id = $user['s_id'];
    $a_verified_by = $_POST['v_id'];

    $result = mysqli_query($conn, "INSERT INTO achievements (category, name, external_file, description, keywords, v_id, file_link, s_id) 
         VALUES ('$a_category','$a_name', '$a_external_file','$a_description', '$a_keywords', '$a_verified_by', '$file_links', '$a_s_id')");
    // mysqli_query($conn, $sql5);

    if (move_uploaded_file($_FILES['file_link']['tmp_name'], $target)) {
        $msg = "Uploaded successfully";
    } else {
        $msg = "Error in uploading";
    }

    if ($result) {
        header("location:profile.php");
    } else {
        echo "<script>alert('Something went wrong!')</script>";
    }

    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Submitting Achievement</title>
    <link rel="stylesheet" href="Bcolor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />

    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" media="print" onload="this.media='all'" />
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" />
    </noscript> -->
    <link href="css/font-awesome/css/all.min.css?ver=1.2.1" rel="stylesheet">
    <!-- <link href="css/mdb.min.css?ver=1.2.1" rel="stylesheet">
    <link href="css/aos.css?ver=1.2.1" rel="stylesheet"> -->
    <!-- <link href="css/main.css?ver=1.2.1" rel="stylesheet"> -->
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="nav.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <!-- <noscript>
        <style type="text/css">
            [data-aos] {
                opacity: 1 !important;
                transform: translate(0) scale(1) !important;
            }
        </style>
    </noscript> -->
</head>
<body class="bg-light" id="top">
    <header class="d-print-none">
        <div class="container text-center text-lg-left">
            <div class="site-nav">
                <!-- Nav bar Start -->
                <nav class="navbar navbar-expand-xl navbar-dark bg-dark"style="position: relative; top: -3px; left: 5px;">
                    <a href="#" class="navbar-brand"><i class="fa fa-cube"></i>UIU<b>SAT</b></a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Collection of nav links, forms, and other content for toggling -->
                    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">

                        <!-- <form  action="search.php" method="POST" class="navbar-form form-inline">
                            <div class="input-group search-box" style="position:relative; left:-10px">
                                <input type="text" name="search" class="form-control" placeholder="Search here...">
                                <button type="submit" name="submit-search">Search</button>
                                <span class="input-group-addon"><i class="material-icons"></i></span>
                            </div>
                        </form> -->
                        <form method="POST">
                        <div class="search">
                        <input type="text" name="searchtext" id="search" placeholder="Search" style="position:relative; top: 36px; width: 200px; left:-225px; padding:6px; border-radius:5px;">

                        

                        <!-- <div class="col col-lg-6"> -->
                            <!-- <label for="exampleFormControlInput1" class="form-label">Choose From Below</label> -->
                            <select class="form-select" name="searchtype" aria-label="Default select example" style="position:relative; top:-2px; left: 170px; width: 150px">
                            <option selected>Filter</option>
                            <option value="Students">Students</option>
                            <option value="Verifiers">Verifiers</option>
                            <option value="Achievements">Achievements</option>
                            <option value="Events">Events</option>
                            <option value="Notices">Notices</option>
                            </select>
                        <!-- </div> -->

                        <!-- <button name="submitfiltersearch" class="btn">Search</button> -->
                        <button name="submitsearch" class="btn" style="position:relative; top: -39px; left: 115px; height:37px; background-color:#FFF; ">Search</button>
                        </div>
                        </form>

                        <div class="navbar-nav ml-auto">
                        <?php
                        if (strlen($username) == 9 && is_numeric($username)) {
                        ?>
                            <a href="studenthome.php" class="nav-item nav-link active"><i class="fa fa-home"></i><span>Home</span></a>
                        <?php
                        } else {
                        ?>
                            <a href="teacherhome.php" class="nav-item nav-link active"><i class="fa fa-home"></i><span>Home</span></a>
                        <?php
                        }
                        ?>
                            <a href="profile.php" class="nav-item nav-link"><i class="fa fa-users"></i><span>Profile</span></a>
                            <a href="view_all_events.php" class="nav-item nav-link"><i class="fa fa-briefcase"></i><span>Event</span></a>
                            <a href="view_all_notices.php" class="nav-item nav-link"><i class="fa fa-envelope"></i><span>Notice</span></a>
                            <a href="notification.php" class="nav-item nav-link"><i class="fa fa-bell"></i><span>Notifications</span></a>
                            <a href="logout.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
                            <?php
                            if (strlen($username) == 9 && is_numeric($username)) {
                            ?>
                            <div class="nav-item dropdown">
                                <a href="profile.php" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="images/student.jpg" class="avatar" alt="Avatar"> Student </a>
                            </div>
                            <?php
                            }
                            else {
                            ?>
                            <div class="nav-item dropdown">
                                <a href="profile.php" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action"><img src="images/verifier.jpg" class="avatar" alt="Avatar"> Verifier </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                </nav>
                <!-- Nav bar end -->
                <div class="container form-main" style="margin-top: 100px; position: relative; top: -100px; left: 25px;">
                    <br></br>
                    <h2 style="text-align: center;">
                        Add Your Achievements
                    </h2>
                    <br>
                    <div class="container pt-5 pb-5" style="background-color: #c0c0c0; width: 850px;">
                        <form action="submit.php" class="form-input  d-flex justify-content-center" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="100000000">
                            <div class="row mx-5" style="width: 400px;">

                                <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Choose Achievement Type </label>
                                        <select name="category">
                                            <option value="project">Project</option>
                                            <option value="internship">Internship</option>
                                            <option value="honors and awards">Honors and Awards</option>
                                            <option value="extra-curricular activities">Extra-Curricular Activities</option>
                                        </select><br>
                                    </div>
                                </div>

                                <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name Of Achievement</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name Of Achievement" name="name" />
                                    </div>
                                </div>

                                <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">External File Link </label>
                                        <input type="link" class="form-control" id="exampleFormControlInput1" placeholder="One link only" name="external_file" />
                                    </div>
                                </div>

                                <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Description </label>
                                        <input type="medium text" class="form-control" id="exampleFormControlInput1" placeholder="Maximum 2000 characters" name="description" />
                                    </div>
                                </div>

                                <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="(comma-separated list)" name="keywords" />
                                    </div>
                                </div>

                                <!-- <div class="col col-lg-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tag Verifier</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Verifier Username" name="v_id" />
                                    </div>
                                </div> -->

                                <div class="col col-lg-12 text-center"> <br>
                                    <!--<form action="upload.php" method="POST" enctype="multipart/form-data"> here-->

                                    <label for="exampleFormControlInput1" class="form-label">Choose Image File </label>
                                    <input type="file" class="form-control" id="exampleFormControlInput1" name="file_link">

                                    <!-- <button type="submit" name="submit">Upload</button>  no need  </form>-->
                                    </br>
                                </div>

                                <div class="col col-lg-12 text-center"> <br>
                                    <button type="submit" class="btn btn-outline-primary" style="width: 80px; background-color: rgb(33, 57, 33); color: white; border-radius: 0%; border: 0px transparent;" name="submit">Submit</button> </br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>