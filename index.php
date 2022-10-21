<?php

include('db_connect.php');

session_start();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  if(strlen($username)==9 && is_numeric($username)){
    $sql = "SELECT * FROM student WHERE s_id='$username' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $row['s_id'];
      header("Location: studenthome.php");
    }
  }
  else if(1){
    $sql = "SELECT * FROM verifier WHERE v_id='$username' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $row['v_id'];
      header("Location: teacherhome.php");
    }
  }
	
	else {
		echo "<script>alert('Oh No! Email or Password is Wrong OR You Do Not Have An Account.')</script>";
	}
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UIUSAT - Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
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
    <div class="container form-main" style="margin-top: 170px;">
      <div class="text-center mb-5">
        <h2 style="color: rgb(138, 113, 66)">Welcome to UIUSAT</h2>
      </div>
      <div class="container pt-5 pb-3" style="background-color: #f9ebd1; width: 700px;">
        <form action="" class="form-input  d-flex justify-content-center" method="post">
          <div class="row mx-5" style="width: 400px;">
            <div class="col col-lg-12">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Username</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Username"
                  name="username"
                />
              </div>
            </div>

            <div class="col col-lg-12">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Password"
                  name="pass"
                />
              </div>
            </div>
            <div class="col col-lg-12 text-center">
              <button
                type="submit"
                class="btn btn-outline-primary"
                style="
                  width: 60px;
                  background-color: rgb(33, 57, 33);
                  color: white;
                  border-radius: 0%;
                  border: 0px transparent;
                "
                name="submit">
                Login
              </button>
            </div>
            <div class="col col-lg-12 text-center mt-2">
              <p>
                Don't have an account? <a class="log-btn" href="registration.php">Signup</a>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
