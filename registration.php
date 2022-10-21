<?php

include('db_connect.php');

session_start();

if (isset($_POST['submit'])) {

  $user_name = $_POST['student-id'];
  $email = $_POST['email'];
  $full_name = $_POST['full-name'];
  $phone = $_POST['phone'];
  $department = $_POST['dept'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $designation = $_POST['designation'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-pass'];
  if ($password == $confirm_password) {
    $sql = "SELECT * FROM student WHERE s_id='$user_name'";
		$result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM verifier WHERE v_id='$user_name'";
		$result2 = mysqli_query($conn, $sql2);
		if (strlen($user_name)==9 && is_numeric($user_name)) {
			if(!$result->num_rows > 0){
        $sql = "INSERT INTO student (s_id, name, phone, email, password, gender, dob, department)
            VALUES ('$user_name', '$full_name', '$phone', '$email', '$password', '$gender', '$dob', '$department')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          
          // $username = "";
        // $email = "";
          // $_POST['password'] = "";
          // $_POST['cpassword'] = "";
          header("location:index.php");
          // echo "<script>alert('Dear Student, your registration is complete.')</script>";
        }
        else {
          echo "<script>alert('Something went wrong!')</script>";
        }
      }
      else{
        echo "<script>alert('This username already exists.')</script>";
      }
    }
    else if(!$result2->num_rows > 0){
      $sql = "INSERT INTO verifier (v_id, name, phone, email, password, gender, dob, department, designation)
          VALUES ('$user_name', '$full_name', '$phone', '$email', '$password', '$gender', '$dob', '$department', '$designation')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        
        // $username = "";
      // $email = "";
        // $_POST['password'] = "";
        // $_POST['cpassword'] = "";
        header("location:index.php");
        // echo "<script>alert('Dear Verifier, your registration is complete.')</script>";
      }
      else {
        echo "<script>alert('Something went wrong!')</script>";
      }
    }
    else {
      echo "<script>alert('This username already exists.')</script>";
    }
  }
  else {
    echo "<script>alert('Passwords did not match.')</script>";
  }
  //$role=$_POST[''];

  //connection to database server
  // $con = new mysqli('localhost', 'root', '', 'uiusatdb');
  // if ($con->connect_errno) {
  //   die('Connection Faild');
  // } else {
  //   $stmt = $con->prepare("INSERT INTO user(user_id, email, full_name, phone, dob, department, gender, password, designation) 
  // values (?,?,?,?,?,?,?,?,?)");
  //   $stmt->bind_param("sssssssss", $user_name, $email, $full_name, $phone, $dob, $department, $gender, $password, $designation);
  //   $stmt->execute();
  //   echo "Registered Succesfull";
  //   $stmt->close();
  //   $con->close();
  //   header("location:login.php");
  // }
  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UIUSAT - Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
</head>

<body>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap');

    body {
      font-family: 'Source Sans Pro', sans-serif;
      background-color: #f8f2e8;
    }

    .log-btn {
      text-decoration: none;
    }

    .form-main {
      margin-top: 600px;
    }
  </style>
  <div class="container mt-5 form-main">
    <div class="text-center mb-5">
      <h2 style="color: rgb(138, 113, 66)">Welcome to UIUSAT</h2>
    </div>
    <div class="container pt-5 pb-3" style="background-color: #f9ebd1;">

      <form action="" class="form-input" method="post">
        <div class="row mx-5">
          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Username</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ex: 011201195 or SA" name="student-id" required/>
            </div>
          </div>

          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Email</label>
              <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required/>
            </div>
          </div>

          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ex: Khaled Saifullah" name="full-name" required/>
            </div>
          </div>

          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Phone</label>
              <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="ex: 01822......" name="phone" required/>
            </div>
          </div>

          <div class="col col-lg-6">
            <label for="exampleFormControlInput1" class="form-label">Department</label  required>
            <select class="form-select" name="dept" aria-label="Default select example">
              <option selected>Choose Your Department</option>
              <option value="CSE">BSCSE</option>
              <option value="EEE">BSEEE</option>
              <option value="BBA">BBA</option>
              <option value="BSCE">BSCE</option>
              <option value="BSECO">BSECO</option>
              <option value="BSAIS">BSAIS</option>
            </select>
          </div>

          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Designation</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ex: Professor, Assistand Professor, Club President" name="designation" required/>
            </div>
          </div>

          <div class="col col-lg-6">
            <label for="exampleFormControlInput1" class="form-label">Gender</label>
            <select class="form-select" name="gender" aria-label="Default select example">
              <option selected>Choose your gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Female">Other</option>
            </select>
          </div>

          <!-- <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Address</label
              >
              <input
                type="email"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="name@example.com"
              />
            </div>
          </div> -->


          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
              <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="dob" />
            </div>
          </div>




          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Pasword</label>
              <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="ex: Password" name="password" required/>
            </div>
          </div>



          <div class="col col-lg-6">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="ex: Password" name="confirm-pass" required/>
            </div>
          </div>


          <div class="col col-lg-12 text-center">
            <button type="submit" class="btn btn-outline-primary" style="
                  width: 400px;
                  background-color: rgb(33, 57, 33);
                  color: white;
                  border-radius: 0%;
                  border: 0px transparent;
                "
                name="submit">
              Create Account
            </button>
          </div>
          <div class="col col-lg-12 text-center mt-2">
            <p>
              Already have an account? <a class="log-btn" href="index.php">Login</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>