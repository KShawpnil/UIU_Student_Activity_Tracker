<?php

include('db_connect.php');

session_start();

if(isset($_SESSION['username'])){
  $username=mysqli_real_escape_string($conn,$_SESSION['username']);

  if(strlen($username)==9 && is_numeric($username)){
    $sql = "SELECT * FROM student WHERE s_id='$username'";
    $result = mysqli_query($conn, $sql);
    $user=mysqli_fetch_assoc($result);
  }
  else{
    $sql = "SELECT * FROM verifier WHERE v_id='$username'";
    $result = mysqli_query($conn, $sql);
    $user=mysqli_fetch_assoc($result);
  }
  
  $_SESSION['username'] = $username;
  // mysqli_free_result($result);
  // mysqli_close($conn);

}
else{
  header("HTTP/1.0 404 Not Found");
  echo "<h1>404 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}

if(isset($_GET['e_id'])){
    $e_id=$_GET['e_id'];
    $event_id=mysqli_real_escape_string($conn,$_GET['e_id']);
    $sql="SELECT *
          FROM events
          WHERE e_id = '$event_id'";
    $result=mysqli_query($conn,$sql);
    $event=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    // mysqli_close($conn);

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

if(!empty($_POST['viewparticipantsbutton'])){
    $_SESSION['searchtype'] = "eventstudents";
    $_SESSION['searchtext'] = "$e_id";
    header("Location:view_all_profiles.php");
}

if(!empty($_POST['enrollbutton'])){
  $sqlenroll = "INSERT INTO participates(s_id, e_id) 
                VALUES ('$username','$e_id')";
  $result = mysqli_query($conn, $sqlenroll);
  $_SESSION['enrolled']='true';
}

$sqlstudentevents = "SELECT * FROM participates INNER JOIN events ON participates.e_id=events.e_id WHERE participates.s_id='$username' AND participates.e_id='$e_id'";
$sqlstudenteventsresult = mysqli_query($conn, $sqlstudentevents);
$userstudentevents = mysqli_fetch_all($sqlstudenteventsresult, MYSQLI_ASSOC);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UIUSAT - Specific Event</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link href="nav.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css" >

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- Search -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- search end -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
      
    />
  </head>
  <body>
    <!-- Header -->
   
  <!-- Navbar -->
   
      
  <div class="site-nav"> 
         <!-- Nav bar Start -->
            <nav class="navbar navbar-expand-xl"style="position:relative; left:95px ;Background-color:#cf8c10;">
	<a href="#" class="navbar-brand"style="position:relative; left:15px ;"><i class="fa fa-cube"></i>UIU<b>SAT</b></a>  		
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
    <form method="POST">
      <div class="search">
      <input type="text" name="searchtext" id="search" placeholder="Search" style="position:relative; top: 38px; width: 200px; left:-40px; padding:6px; border-radius:5px;">
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
        <button name="submitsearch" class="btn" style="position:relative; top: -38px; left: 330px; background-color:#FFF; ">Search</button>
      </div>
    </form>
		<div class="navbar-nav ml-auto" style="position:relative; left:280px"">
    <?php
      if(strlen($username)==9 && is_numeric($username)){
      ?>
        <a href="studenthome.php" class="nav-item nav-link active"><i class="fa fa-home"></i><span>Home</span></a>
      <?php
      }
      else{
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
        
<!-- form -->

<div class="wrapper">
    <div class="form">
    <div class="container">
      
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      
    </div>
    <div class="carousel-inner ">
      <div class="carousel-item active azaira mt-3" style="text-align:center" data-bs-interval="10000">
        <!-- <img src="'event_images/'.'$event[image]'" class="d-block w-100" alt="..."> -->
        <img src="./event_images/<?php echo $event['image']; ?>"style="object-fit: cover; width:50%; height:350px;"><br></br>
      </div>
      <br></br>
    </div>
</div>
      <div class="inputfield">
          <label>Name Of Event:</label>
          <input type="text" class="input" value="<?php echo $event['name']; ?>" name="eventname" readonly>
      </div>  
      <div class="inputfield">
          <label>Date Of Event: </label>
          <input type="text" class="input" value="<?php echo $event['event_date']; ?>" name="eventdate" readonly>
       </div>  
       <div class="inputfield">
          <label>Time Of Event: </label>
          <input type="text" class="input" value="<?php echo $event['event_time']; ?>" name="eventtime" readonly>
       </div>  
      <div class="inputfield">
          <label>Location Of Event: </label>
          <input type="text" class="input" value="<?php echo $event['location']; ?>" name="eventlocation" readonly>
       </div> 
     
      <div class="inputfield">
          <label>Description: </label>
          <textarea type="text" rows="20" cols="50" class="input" name="eventsummary" readonly><?php echo $event['summary']; ?>
          </textarea>
       </div>
       <div class="inputfield">
          <label>Guests: </label>
          <input type="text" class="input" value="<?php echo $event['guests']; ?>" name="eventguests" readonly>
       </div> 
       <div class="inputfield">
          <label>Special Members: </label>
          <input type="text" class="input" value="<?php echo $event['special_members']; ?>" name="eventspecialmembers" readonly>
       </div>  
      <div class="inputfield">
          <label>Keywords: </label>
          <input type="text" class="input" value="<?php echo $event['keywords']; ?>" name="eventkeywords" readonly>
       </div>

    <?php
      if(strlen($username)==9 && is_numeric($username) && (!$sqlstudenteventsresult->num_rows > 0)){
      ?>
        <form method="post">
        <div class="inputfield">
          <input name="enrollbutton" type="submit" value="Enroll Now" class="btn">
        </div>
        </form>
      <?php
      }
      else if(!(strlen($username)==9 && is_numeric($username))){
      ?>
        <form method="post">
        <div class="inputfield">
          <input name="viewparticipantsbutton" type="submit" value="View Participants" class="btn">
        </div>
        </form>
      <?php
      }
      else{
        }
    ?>
      
    </div>
</div>	

	
</body>
</html>