<?php
ob_start();

include('db_connect.php');

session_start();

if (isset($_POST['submitachievement'])) {
  // $_SESSION['username'] = $username;
  header("Location: submit.php");
  $sql5 =  mysqli_query($conn, "SELECT * FROM achievements WHERE s_id='$username'");
  //$result2 = mysqli_query($conn, $sql5)
  // or die("No sql: $sql5");
  while ($row = mysqli_fetch_array($sql5)) {
    echo "<div id = 'file_div'";
    echo "file src = 'images/'" . $row['file_link'] . "'>";
    echo "<p>" . $row['category'] . "</p>";
    echo "<p>" . $row['name'] . "</p>";
    echo "<p>" . $row['external_file'] . "</p>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>" . $row['keywords'] . "</p>";
    echo "<p>" . $row['v_id'] . "</p>";
    echo "</div>";
  }
}

if (isset($_POST['submit9'])) {

  //$sql5 =  mysqli_query($conn, "DELETE FROM achievements WHERE s_id='$username'"); 
  header("Location:delete.php");
}

if (isset($_SESSION['username'])) {
  $username = mysqli_real_escape_string($conn, $_SESSION['username']);

  if (strlen($username) == 9 && is_numeric($username)) {
    $sql = "SELECT * FROM student WHERE s_id='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // $username=$user['s_id'];
    // $email = $user['email'];
    // $name = $user['name'];
    // $phone = $user['phone'];
    // $department = $user['department'];
    // $gender = $user['gender'];
    // $dob = $user['dob'];
    $sqlprojects = "SELECT * FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$user[s_id]' AND achievements.category LIKE 'project'";
    $result = mysqli_query($conn, $sqlprojects);
    $userprojects = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sqlinternships = "SELECT * FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$user[s_id]' AND achievements.category LIKE 'internship'";
    $result = mysqli_query($conn, $sqlinternships);
    $userinternships = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sqlawards = "SELECT * FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$user[s_id]' AND achievements.category LIKE 'honors and awards'";
    $result = mysqli_query($conn, $sqlawards);
    $userawards = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sqlextracurricularactivities = "SELECT * FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$user[s_id]' AND achievements.category LIKE 'extra-curricular activities'";
    $result = mysqli_query($conn, $sqlextracurricularactivities);
    $userextracurricularactivities = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sqlstudentevents = "SELECT * FROM participates INNER JOIN events ON participates.e_id=events.e_id WHERE participates.s_id='$user[s_id]'";
    $result = mysqli_query($conn, $sqlstudentevents);
    $userstudentevents = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_POST['submitpicture'])) {
      $image_link = $_FILES['file']['name'];
      $targetpicture = "profile_pictures/" . basename($_FILES['file']['name']);
      // $image = $_FILES['img'];  

      if (move_uploaded_file($_FILES['file']['tmp_name'], $targetpicture)) {
        $msg = "Uploaded successfully";
      } else {
        $msg = "Error in uploading";
      }

      $sqlpicture = "UPDATE student
                      SET image_id='$image_link'
                      WHERE s_id='$username'";
      $resultpicture = mysqli_query($conn, $sqlpicture);
    }
  } else {
    $sql = "SELECT * FROM verifier WHERE v_id='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // $username=$user['v_id'];
    // $email = $user['email'];
    // $name = $user['name'];
    // $phone = $user['phone'];
    // $department = $user['department'];
    // $gender = $user['gender'];
    // $dob = $user['dob'];
    // $designation = $user['designation'];



    if (isset($_POST['submitpicture'])) {
      $image_link = $_FILES['file']['name'];
      $targetpicture = "profile_pictures/" . basename($_FILES['file']['name']);
      // $image = $_FILES['img'];  

      if (move_uploaded_file($_FILES['file']['tmp_name'], $targetpicture)) {
        $msg = "Uploaded successfully";
      } else {
        $msg = "Error in uploading";
      }

      $sqlpicture = "UPDATE verifier
                      SET image_id='$image_link'
                      WHERE s_id='$username'";
      $resultpicture = mysqli_query($conn, $sqlpicture);
    }
  }



  $_SESSION['username'] = $username;
  // mysqli_free_result($result);
  // mysqli_close($conn);
  ob_end_flush();
} else {
  header("HTTP/1.0 404 Not Found");
  echo "<h1>404 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}

if (isset($_POST['submitsearch'])) {
  if (!empty($_POST['searchtext'])) {
    $searchtype = filter_input(INPUT_POST, 'searchtype', FILTER_SANITIZE_STRING);
    $searchtext = mysqli_real_escape_string($conn, $_POST['searchtext']);
    if ($searchtype == "Students") {
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
      } else {
        echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
      }
    } else if ($searchtype == "Verifiers") {
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
      } else {
        echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
      }
    } else if ($searchtype == "Achievements") {
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
      } else {
        echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
      }
    } else if ($searchtype == "Events") {
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
      } else {
        echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
      }
    } else if ($searchtype == "Notices") {
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
      } else {
        echo "<script>alert('Sorry. We do not have that information in our database.')</script>";
      }
    } else {
      echo "<script>alert('Please choose an option to search.')</script>";
    }
  }
}



?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UIUSAT - My Profile</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" media="print" onload="this.media='all'" />
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" />
  </noscript>
  <link href="css/font-awesome/css/all.min.css?ver=1.2.1" rel="stylesheet">
  <link href="css/mdb.min.css?ver=1.2.1" rel="stylesheet">
  <link href="css/aos.css?ver=1.2.1" rel="stylesheet">
  <link href="css/main.css?ver=1.2.1" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="nav.css" rel="stylesheet">
  <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
  <noscript>
    <style type="text/css">
      [data-aos] {
        opacity: 1 !important;
        transform: translate(0) scale(1) !important;
      }
    </style>
  </noscript>
</head>

<body class="bg-light" id="top">
  <header class="d-print-none">
    <div class="container text-center text-lg-left">
      <div class="site-nav">
        <!-- Nav bar Start -->
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark" style="left:90px ;">
          <a href="#" class="navbar-brand"><i class="fa fa-cube"></i>UIU<b>SAT</b></a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Collection of nav links, forms, and other content for toggling -->
          <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
            <!-- <form class="navbar-form form-inline">
              <div class="input-group search-box" style="position:relative; left:-10px">
                <input type="text" id="search" class="form-control" placeholder="Search here...">
                <span class="input-group-addon"><i class="material-icons"></i></span>
              </div>
            </form> -->

            <!-- <form  action="search.php" method="POST" class="navbar-form form-inline">
              <div class="input-group search-box" style="position:relative; left: -20px;">
                  <input type="text" name="searchtext" class="form-control" placeholder="Search here...">
                  <button type="submit" name="searchbutton">Search</button>
                  <span class="input-group-addon"><i class="material-icons"></i></span>
              </div>
            </form> -->

            <form method="POST">
              <div class="search">
                <input type="text" name="searchtext" id="search" placeholder="Search" style="position:relative; top: 40px; width: 200px; left:-50px; padding:6px; border-radius:5px;">



                <!-- <div class="col col-lg-6"> -->
                <!-- <label for="exampleFormControlInput1" class="form-label">Choose From Below</label> -->
                <select class="form-select" name="searchtype" aria-label="Default select example" style="position:relative; left: 170px; width: 150px">
                  <option selected>Filter</option>
                  <option value="Students">Students</option>
                  <option value="Verifiers">Verifiers</option>
                  <option value="Achievements">Achievements</option>
                  <option value="Events">Events</option>
                  <option value="Notices">Notices</option>
                </select>
                <!-- </div> -->

                <!-- <button name="submitfiltersearch" class="btn">Search</button> -->
                <button name="submitsearch" class="btn" style="position:relative; top: -40px; left: 280px; background-color:#FFF; ">Search</button>
              </div>
            </form>


            <?php
            ?>

            <div class="navbar-nav ml-auto" style="position:relative; left:280px">
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
              <a href="view_all_events.php" class="nav-item nav-link"><i class="fa fa-briefcase"></i><span>Events</span></a>
              <a href="view_all_notices.php" class="nav-item nav-link"><i class="fa fa-envelope"></i><span>Notices</span></a>
              <a href="notification.php" class="nav-item nav-link"><i class="fa fa-bell"></i><span>Notifications</span></a>
              <a href="logout.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket"></i><span>Log Out</span></a>
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
      </div>
    </div>
    </div>
  </header>
  <div class="page-content" style="position: relative;top: 30px; background-color:#ccc7d1">
    <div class="container">
      <div class="resume-container">
        <div class="shadow-1-strong bg-white my-5" id="intro">
          <div class="b-info text-white">
            <div class="cover b-image" style="position: relative;top: -1px;"><img src="images/head3.png" style="height:480px;width:1115px;">
              <div class="mask" style="background-color: rgba(187, 147, 147, 0.164);backdrop-filter: blur(2px);">
                <div class="text-center p-5">
                  <?php
                  if (strlen($username) == 9 && is_numeric($username)) {
                  ?>
                    <div class="avatar p-1"><img class="img-thumbnail shadow-2-strong" src="images/student.jpg" width="160" height="160" /></div>
                  <?php
                  } else {
                  ?>
                    <div class="avatar p-1"><img class="img-thumbnail shadow-2-strong" src="images/verifier.jpg" width="160" height="160" /></div>
                  <?php
                  }
                  ?>
                  <div class="header-bio mt-3">
                    <div data-aos="zoom-in" data-aos-delay="0">
                      <h2 class="h1"><?php echo $user['name']; ?></h2>
                      <p>Welcome to My Profile!</p>
                    </div>
                    <div class="header-social mb-3 d-print-none" data-aos="zoom-in" data-aos-delay="200">
                    </div>
                    <?php
                  if (strlen($username) == 9 && is_numeric($username)) {
                  ?>
                    <form action="pdf.php" method="GET" target="_blank">
                      <div class="d-print-none" style="float: right inherit;">

                        <a class="btn btn-outline-light btn-lg shadow-sm mt-1 me-3" style="text-decoration: none; color: #FFF" href="pdf.php?s_id=<?php echo $user["s_id"] ?>" data-aos="fade-right" data-aos-delay="700">Generate CV</a>
                        <!-- <a class="btn btn-info btn-lg shadow-sm mt-1" name="changeprofilepicturebutton" data-aos="fade-left" data-aos-delay="700">Change Profile Picture</a> -->
                        <!-- <label for="exampleFormControlInput1" class="form-label">Select Image </label>
                      <form action="" method="POST">
                      <input type="file" class="form-control" id="exampleFormControlInput1" name="file">
                      <div class="inputfield">
                        <input type="submitpicture" value="Update Picture" class="btn" name="submitpicture">
                      </div>
                      </form>
                      </div> -->
                    </form>
                  <?php
                  }
                  ?>
                    
                    <!-- <div class="d-print-none"><a class="btn btn-outline-light btn-lg shadow-sm mt-1 me-3" href="pdf.php?s_id=<?php echo $user["s_id"] ?>" data-aos="fade-right" data-aos-delay="700">Download CV</a></div> -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="shadow-1-strong bg-white my-5 p-5" id="about">
          <div class="about-section">
            <div class="row">
              <div class="col-md-6">
                <!----  <h2 class="h2 fw-light mb-4">About Me</h2>
       <p>Hello! I’m Walter Patterson. I am passionate about UI/UX design and Web Design. I am a skilled <strong>front-end developer</strong> and master of graphic design tools such as Photoshop and Sketch. I am a quick learner and a team worker that gets the job done.</p>
          <p>I can easily capitalize on low hanging fruits and quickly maximize timely deliverables for real-time schemas.</p>-->
              </div>
              
              <div class="bio">
                <div class="col-md-5 offset-lg-1">
                  <div class="row mt-2">
                    <h2 class="h2 fw-light mb-4">Bio</h2>
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="far fa-calendar-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i>Name</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['name']; ?></div>
                    </div>
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="far fa-envelope pe-2 text-muted" style="width:24px;opacity:0.85;"></i> ID</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $username; ?></div>
                    </div>
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="fab fa-skype pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Email</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['email']; ?></div>
                    </div>
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="fas fa-phone pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Phone</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['phone']; ?></div>
                    </div>
                    <!-- <div class="col-sm-5">
              <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Address</div>
            </div>
            <div class="col-sm-7">
              <div class="pb-2">131 W, City Center, New York, U.S.A</div>
            </div> -->
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Department</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['department']; ?></div>
                    </div>
                    <!-- <div class="col-sm-5">
              <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> CGPA</div>
            </div>
            <div class="col-sm-7">
              <div class="pb-2">3.77</div>
            </div> -->
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> DOB</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['dob']; ?></div>
                    </div>
                    <div class="col-sm-5">
                      <div class="pb-2 fw-bolder"><i class="fas fa-map-marker-alt pe-2 text-muted" style="width:24px;opacity:0.85;"></i> Gender</div>
                    </div>
                    <div class="col-sm-7">
                      <div class="pb-2"><?php echo $user['gender']; ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php
      if (strlen($username) == 9 && is_numeric($username)) {
      ?>

      <?php
      }
      ?>

      <?php
      if (strlen($username) == 9 && is_numeric($username)) {
      ?>
        <div class="shadow-1-strong bg-white my-5 p-5" id="education">
          <div class="education-section">
            <h2 class="h2 fw-light mb-4">Skills:</h2>
            <div class="List">
              <ol>
                <?php
                $sqlallkeywords = "SELECT achievements.keywords FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username'";
                $result = mysqli_query($conn, $sqlallkeywords);
                $userallkeywords = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($userallkeywords as $rowkeywords) {
                  foreach ($rowkeywords as $singlekeyword) {
                    echo $singlekeyword . " ";
                  }
                }
                ?>
              </ol>
            </div>
          </div>
        </div>


    </div>
    <h1 class="h2 fw-light mb-4">Achievements</h1>
    <form action="" method="POST">
      <div class="input-group" style="float: right inherit;">
        <button name="submitachievement" href="submit.php" class="btn1">Add Achievement</button>
        <!---style="color: grey; width: 70px" <a style="color: grey; width: 70px" name="submit1" href="edit_profile.php" > Edit Profile</a> -->
      </div>
      <div class="shadow-1-strong bg-white my-5 p-5" id="experience">
        <div class="work-experience-section">
          <h2 class="h2 fw-light mb-4">Projects:</h2>
          <?php
          if (!empty($userprojects)) {
            $count = 0;
            foreach ($userprojects as $userproject) {
              $count++;
          ?>
              <div class="timeline">
                <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
                  <div class="timeline-head px-4 pt-3">

                    <div class="h6">Project: <span class="text-muted h6"><?php echo $count; ?></span></div>
                    <div class="h6">Title: <span class="text-muted h6"><?php echo $userproject['name']; ?></span></div>
                    <div class="h6">Description: <span class="text-muted h6"><?php echo $userproject['description']; ?></span></div>
                    <div class="h6">Keywords: <span class="text-muted h6"><?php echo $userproject['keywords']; ?></span></div>
                    <div class="h6">External File Link: <span class="text-muted h6"><?php echo $userproject['external_file']; ?></span></div>
                    <div class="h6">Verification: <span class="text-muted h6">
                        <?php
                        if ($userproject['is_verified'] == 1) {
                          echo ("Verified by " . $userproject['v_id']);
                        } else {
                          echo ("Not Verified");
                        }
                        ?>
                      </span></div>
                    <a href="view_specific_achievement.php?a_id=<?php echo $userproject['a_id'] ?>">
                      <div class="h6"><span class="text-muted h6"><?php echo ("Click To View Details"); ?></span></div>
                    </a>
                    <div class="h6">Image: <span class="text-muted h6"></span></div>
                    <div class="myimg"><img src="./images/<?php echo $userproject['file_link']; ?>" style="width:400px;height: 250px;border-radius: 10px; border: 6px solid #f08c09; padding: 3px;"></div>

                    <div class="input-group" style="float: right inherit;">
                      <a class="btn5" style="text-decoration: none; color: white;" href="delete.php?d_id=<?php echo $userproject["a_id"] ?>">Delete</a>
                    </div>
                    <br></br>
                    <!-- <br></br> -->
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="shadow-1-strong bg-white my-5 p-5" id="experience">
        <div class="work-experience-section">
          <h2 class="h2 fw-light mb-4">Internship:</h2>
          <?php
          if (!empty($userinternships)) {
            $count = 0;
            foreach ($userinternships as $userinternship) {
              $count++;
          ?>
              <div class="timeline">
                <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
                  <div class="timeline-head px-4 pt-3">

                    <div class="h6">Internship: <span class="text-muted h6"><?php echo $count; ?></span></div>
                    <div class="h6">Title: <span class="text-muted h6"><?php echo $userinternship['name']; ?></span></div>
                    <div class="h6">Description: <span class="text-muted h6"><?php echo $userinternship['description']; ?></span></div>
                    <div class="h6">Keywords: <span class="text-muted h6"><?php echo $userinternship['keywords']; ?></span></div>
                    <div class="h6">External File Link: <span class="text-muted h6"><?php echo $userinternship['external_file']; ?></span></div>
                    <div class="h6">Verification: <span class="text-muted h6">
                        <?php
                        if ($userinternship['is_verified'] == 1) {
                          echo ("Verified by " . $userinternship['v_id']);
                        } else {
                          echo ("Not Verified");
                        }
                        ?>
                      </span></div>
                    <a href="view_specific_achievement.php?a_id=<?php echo $userinternship['a_id'] ?>">
                      <div class="h6"><span class="text-muted h6"><?php echo ("Click To View Details"); ?></span></div>
                    </a>
                    <div class="h6">Image: <span class="text-muted h6"></span></div>
                    <div class="myimg"><img src="./images/<?php echo $userinternship['file_link']; ?>" style="width:400px;height: 250px;border-radius: 10px; border: 6px solid #f08c09; padding: 3px;"></div>

                    <div class="input-group" style="float: right inherit;">
                      <a class="btn5" style="text-decoration: none; color: white;" href="delete.php?d_id=<?php echo $userinternship["a_id"] ?>">Delete</a>
                    </div>
                    <br></br>
                    <!-- <br></br> -->
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="shadow-1-strong bg-white my-5 p-5" id="experience">
        <div class="work-experience-section">
          <h2 class="h2 fw-light mb-4">Honors & Awards:</h2>
          <?php
          if (!empty($userawards)) {
            $count = 0;
            foreach ($userawards as $useraward) {
              $count++;
          ?>
              <div class="timeline">
                <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
                  <div class="timeline-head px-4 pt-3">
                    <div class="h6">Honors: <span class="text-muted h6"><?php echo $count; ?></span></div>
                    <div class="h6">Title: <span class="text-muted h6"><?php echo $useraward['name']; ?></span></div>
                    <div class="h6">Description: <span class="text-muted h6"><?php echo $useraward['description']; ?></span></div>
                    <div class="h6">Keywords: <span class="text-muted h6"><?php echo $useraward['keywords']; ?></span></div>
                    <div class="h6">External File Link: <span class="text-muted h6"><?php echo $useraward['external_file']; ?></span></div>
                    <div class="h6">Verification: <span class="text-muted h6">
                        <?php
                        if ($useraward['is_verified'] == 1) {
                          echo ("Verified by " . $useraward['v_id']);
                        } else {
                          echo ("Not Verified");
                        }
                        ?>
                      </span></div>
                    <a href="view_specific_achievement.php?a_id=<?php echo $useraward['a_id'] ?>">
                      <div class="h6"><span class="text-muted h6"><?php echo ("Click To View Details"); ?></span></div>
                    </a>
                    <div class="h6">Image: <span class="text-muted h6"></span></div>
                    <div class="myimg"><img src="./images/<?php echo $useraward['file_link']; ?>" style="width:400px;height: 250px;border-radius: 10px; border: 6px solid #f08c09; padding: 3px;"></div>

                    <div class="input-group" style="float: right inherit;">
                      <a class="btn5" style="text-decoration: none; color: white;" href="delete.php?d_id=<?php echo $useraward["a_id"] ?>">Delete</a>
                    </div>
                    <br></br>
                    <!-- <br></br> -->
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="shadow-1-strong bg-white my-5 p-5" id="experience">
        <div class="work-experience-section">
          <h2 class="h2 fw-light mb-4">Extra-Curricular Activities:</h2>
          <?php
          if (!empty($userextracurricularactivities)) {
            $count = 0;
            foreach ($userextracurricularactivities as $userextracurricularactivity) {
              $count++;
          ?>
              <div class="timeline">
                <div class="timeline-card timeline-card-info" data-aos="fade-in" data-aos-delay="0">
                  <div class="timeline-head px-4 pt-3">
                    <div class="h6">Activity: <span class="text-muted h6"><?php echo $count; ?></span></div>
                    <div class="h6">Title: <span class="text-muted h6"><?php echo $userextracurricularactivity['name']; ?></span></div>
                    <div class="h6">Description: <span class="text-muted h6"><?php echo $userextracurricularactivity['description']; ?></span></div>
                    <div class="h6">Keywords: <span class="text-muted h6"><?php echo $userextracurricularactivity['keywords']; ?></span></div>
                    <div class="h6">External File Link: <span class="text-muted h6"><?php echo $userextracurricularactivity['external_file']; ?></span></div>
                    <div class="h6">Verification: <span class="text-muted h6">
                        <?php
                        if ($userextracurricularactivity['is_verified'] == 1) {
                          echo ("Verified by " . $userextracurricularactivity['v_id']);
                        } else {
                          echo ("Not Verified");
                        }
                        ?>
                      </span></div>
                    <a href="view_specific_achievement.php?a_id=<?php echo $userextracurricularactivity['a_id'] ?>">
                      <div class="h6"><span class="text-muted h6"><?php echo ("Click To View Details"); ?></span></div>
                    </a>
                    <div class="h6">Image: <span class="text-muted h6"></span></div>
                    <div class="myimg"><img src="./images/<?php echo $userextracurricularactivity['file_link']; ?>" style="width:400px;height: 250px;border-radius: 10px; border: 6px solid #f08c09; padding: 3px;"></div>

                    <div class="input-group" style="float: right inherit;">
                      <a class="btn5" style="text-decoration: none; color: white;" href="delete.php?d_id=<?php echo $userextracurricularactivity["a_id"] ?>">Delete</a>
                    </div>
                    <br></br>
                    <!-- <br></br> -->
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="shadow-1-strong bg-white my-5 p-5" id="education">
        <div class="education-section">
          <h2 class="h2 fw-light mb-4">Events Participation Badges:</h2>
          <div class="List">
            <ol>
              <?php
              if (!empty($userstudentevents)) {
                $count = 0;
                foreach ($userstudentevents as $userstudentevent) {
                  $count++;
              ?>
                  <div class="h6">Number: <span class="text-muted h6"><?php echo $count; ?></span></div>
                  <a href="view_specific_event.php?e_id=<?php echo $userstudentevent['e_id'] ?>"><?php echo htmlspecialchars($userstudentevent['name']) ?></a><br></br>
              <?php
                }
              }
              ?>
              <!-- <li>UIU megahunt</li>
        <li>UIU megahunt</li> -->
            </ol>
          </div>
        </div>
      </div>
  </div>
  </div>
<?php
      }
?>

<!-- <div class="shadow-1-strong bg-white my-5 p-5 d-print-none" id="portfolio">
    <div class="portfolio-section">
      <h2 class="h2 fw-light mb-4">Portfolio</h2>
      <div class="row g-0">
        <div class="col-md-6"><a href="https://dribbble.com/" target="_blank"><img class="img-fluid" src="images/project-1.jpg" width="800" height="500" /></a></div>
        <div class="col-md-6 d-flex align-items-center" data-aos="fade-left" data-aos-delay="100">
          <div class="m-4 mt-md-2">
            <p class="text-teal text-small">Frontend / HTML / CSS / JavaScript</p>
            <h3>Photo Agency Website</h3>
            <p class="text-muted">Built highly performant website front end for a Photography agency. Delivered codebase in HTML, CSS and modern JavaScript.</p>
          </div>
        </div>
      </div>
      <div class="row g-0 portfolio-reverse">
        <div class="col-md-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
          <div class="m-4 mt-md-2 text-end">
            <p class="text-teal text-small">Graphic Design / Photoshop / Sketch</p>
            <h3>Restaurant Website Design</h3>
            <p class="text-muted">Web design for popular resturant chain involving complex layouts done in both Photoshop and Sketch. Collaborated with back-end and front-end team for finished product.</p>
          </div>
        </div>
        <div class="col-md-6"><a href="https://www.behance.net/" target="_blank"><img class="img-fluid" src="images/project-2.jpg" width="800" height="500" /></a></div>
      </div>
      <div class="row g-0">
        <div class="col-md-6"><a href="https://dribbble.com/" target="_blank"><img class="img-fluid" src="images/project-3.jpg" width="800" height="500" /></a></div>
        <div class="col-md-6 d-flex align-items-center" data-aos="fade-left" data-aos-delay="100">
          <div class="m-4 mt-md-2">
            <p class="text-teal text-small">Frontend / HTML / CSS / JavaScript</p>
            <h3>E-Commerce Website</h3>
            <p class="text-muted">Built highly performant website for an E-commerce Portal. Worked with back-end team to timely deliver codebase in HTML, CSS and modern JavaScript.</p>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<!-- </footer> -->
<script src="scripts/mdb.min.js?ver=1.2.1"></script>
<script src="scripts/aos.js?ver=1.2.1"></script>
<script src="scripts/main.js?ver=1.2.1"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>