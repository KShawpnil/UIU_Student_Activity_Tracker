<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="bloodbucket.png">

</head>

<body>

    <head>
        <nav class="navbar navbar-light bg-dark justify-content-between" style="font-family: 'Poppins', sans-serif; font-weight:400; color:white; text-transform:uppercase">

            <a class="navbar-brand">Dashboard</a>
            <a class="btn btn-danger" href="index.php" role="button">Log out</a>
        </nav>
    </head>
    <div class="container-fluid" style="font-style: 'Poppins', sans-serif;">
        <div class="row">
            <div class="col-lg-3" style="font-family: 'Poppins', sans-serif; font-weight:400; color:white">
                <div class="card my-5 bg-primary">
                    <div class="card-body">
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'bloodbucket');
                        $que = "SELECT * FROM registration";
                        $val = mysqli_query($con, $que);
                        $cont = mysqli_num_rows($val) - 1;
                        ?>
                        <h3 class="card-title">
                            Total Users
                        </h3>
                        <h2 style="font-weight: bold;font-size:40px">
                            <?php
                            echo "$cont";
                            $con->close();
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="font-family: 'Poppins', sans-serif; font-weight:400; color:white">
                <div class="card my-5 bg-success">
                    <div class="card-body">
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'bloodbucket');
                        $que = "SELECT * FROM blood_requests";
                        $val = mysqli_query($con, $que);
                        $cont = mysqli_num_rows($val);
                        ?>
                        <h3 class="card-title">
                            Total Requests
                        </h3>
                        <h2 style="font-weight: bold;font-size:40px">
                            <?php
                            echo "$cont";
                            $con->close();
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="font-family: 'Poppins', sans-serif; font-weight:400; color:white">
                <div class="card my-5 bg-warning">
                    <div class="card-body">
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'bloodbucket');
                        $que = "SELECT COUNT(DISTINCT(id)) FROM donors";
                        $val = mysqli_query($con, $que);
                        $cont = "";
                        while ($row = mysqli_fetch_assoc($val)) {
                            $cont = $row['COUNT(DISTINCT(id))'];
                        }
                        ?>
                        <h3 class="card-title">
                            Total Donors
                        </h3>
                        <h2 style="font-weight: bold;font-size:40px">
                            <?php
                            echo "$cont";
                            $con->close();
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="font-family: 'Poppins', sans-serif; font-weight:400; color:white">
                <div class="card my-5 bg-info">
                    <div class="card-body">
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'bloodbucket');
                        $que = "SELECT COUNT(DISTINCT(id)) FROM personal_inventory;";
                        $val = mysqli_query($con, $que);
                        $cont = "";
                        while ($row = mysqli_fetch_assoc($val)) {
                            $cont = $row['COUNT(DISTINCT(id))'];
                        }
                        ?>
                        <h3 class="card-title">
                            Total Blood Banks
                        </h3>
                        <h2 style="font-weight: bold;font-size:40px">
                            <?php
                            echo "$cont";
                            $con->close();
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="font-weight-bolder text-center">Users</h3>


        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
        $query = "SELECT * FROM registration WHERE id != 3";
        $values = mysqli_query($connection, $query);
        ?>
        <table class="table my-3">
            <thead class="thead-dark">
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Height(m)</th>
                <th>Blood Group</th>
                <th>Zilla</th>
                <th>Upazilla</th>
                <!-- <th>Password</th> -->
                <th>Action</th>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($values)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $phone = $row['phone'];
                $email = $row['email'];
                $age = $row['age'];
                $gender = $row['gender'];
                $height = $row['height'];
                $bg = $row['bg'];
                $add_zilla = $row['add_zilla'];
                $add_upazilla = $row['add_upazilla'];
                $password = $row['password'];
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $firstname; ?></td>
                        <td><?php echo $lastname; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $age; ?></td>
                        <td><?php echo $gender; ?></td>
                        <td><?php echo $height; ?></td>
                        <td><?php echo $bg; ?></td>
                        <td><?php echo $add_zilla; ?></td>
                        <td><?php echo $add_upazilla; ?></td>
                        <!-- <td><?php echo $password; ?></td> -->
                        <td><a href="delete.php?id=<?php echo $id ?>">Delete</a></td>
                    </tr>
                </tbody>
            <?php
            }
            $connection->close();
            ?>

        </table>
        <!-- ser abtahi you are done here xd  -->
        <!-- Total Request -->
        <h3 class="font-weight-bolder text-center">Requests</h3>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
        $query = "SELECT blood_requests.id as id,firstname,lastname,phone_n,zilla,upazilla,blood_requests.bloodGroup as blood_group,requestType,blood_requests.quantity as q,req_time
        FROM blood_requests
        LEFT JOIN registration
        ON blood_requests.id = registration.id";
        $values = mysqli_query($connection, $query);
        ?>

        <table class="table my-3">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Location </th>
                <th>Blood Group</th>
                <th>Request Type</th>
                <th>Quantity</th>
                <th>Request Time</th>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($values)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $phone_n = $row['phone_n'];
                $zilla = $row['zilla'];
                $upazilla = $row['upazilla'];
                $blood_group = $row['blood_group'];
                $requestType = $row['requestType'];
                $quantity = $row['q'];
                $req_time = $row['req_time'];
            ?>
                <tbody>
                    <tr>
                        <td><?php echo  $id ?></td>
                        <td><?php echo $firstname . ' ' . $lastname ?></td>
                        <td><?php echo $phone_n ?></td>
                        <td><?php echo $zilla . ', ' . $upazilla ?></td>
                        <td><?php echo $blood_group ?></td>
                        <td><?php echo $requestType ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $req_time ?></td>
                    </tr>
                </tbody>
            <?php
            }
            $connection->close();
            ?>
        </table>
        <!-- Total Request -->


        <!-- Total Donors -->
        <h3 class="font-weight-bolder text-center">Donors</h3>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
        $query = "SELECT donors.id as id,firstname,lastname,COUNT(donors.id) as total_donation,phone,email FROM donors
        LEFT JOIN registration
        ON donors.id = registration.id
        GROUP BY donors.id";
        $values = mysqli_query($connection, $query);
        ?>
        <table class="table my-3">
            <thead class="thead-dark">
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Donated (times) </th>
                <th>Phone</th>
                <th>Email</th>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($values)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $total_donation = $row['total_donation'];
                $phone = $row['phone'];
                $email = $row['email'];
            ?>
                <tbody>
                    <tr>
                        <td><?php echo  $id ?></td>
                        <td><?php echo $firstname ?></td>
                        <td><?php echo $lastname ?></td>
                        <td><?php echo $total_donation ?></td>
                        <td><?php echo '0' . $phone ?></td>
                        <td><?php echo $email ?></td>
                    </tr>
                </tbody>
            <?php
            }
            $connection->close();
            ?>
        </table>
        <!-- Total Donors -->







        <h3 class="font-weight-bolder text-center">Bank History</h3>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
        $query = "SELECT personal_inventory.id as id,firstname,lastname,blood_group,quantity,Last_stored
        FROM personal_inventory
        LEFT JOIN registration
        ON personal_inventory.id = registration.id
        ORDER BY personal_inventory.id";
        $values = mysqli_query($connection, $query);
        ?>
        <table class="table my-3">
            <thead class="thead-dark">
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Blood Group</th>
                <th>Quantity (Bag's')</th>
                <th>Time Stored</th>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($values)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $blood_group = $row['blood_group'];
                $quantity = $row['quantity'];
                $Las_stored = $row['Last_stored'];
            ?>
                <tbody>
                    <tr>
                        <td><?php echo  $id ?></td>
                        <td><?php echo $firstname ?></td>
                        <td><?php echo $lastname ?></td>
                        <td><?php echo $blood_group ?></td>
                        <td><?php echo $quantity ?></td>
                        <td><?php echo $Las_stored ?></td>
                    </tr>
                </tbody>
            <?php
            }
            $connection->close();
            ?>
        </table>

        <h3 class="font-weight-bolder text-center">FAQs</h3>
        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
        $query = "SELECT * FROM faqs";
        $values = mysqli_query($connection, $query);
        ?>


        <table class="table my-3">
            <thead class="thead-dark">
                <th>Full Name</th>
                <th>Email</th>
                <th>Questions</th>
                <th>Answers</th>
                <th>Action</th>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($values)) {
                $fullname = $row['fullname'];
                $email = $row['email'];
                $question = $row['questions'];
                $answers = $row['answers'];
            ?>
                <?php
                if ($answers == "") {
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $question; ?></td>
                            <td>
                                <?php
                                if (isset($_POST['update'])) {
                                    $answers = $_POST['answers'];
                                    $connection = mysqli_connect('localhost', 'root', '', 'bloodbucket');
                                    $qu = "UPDATE faqs SET answers = '$answers' WHERE fullname = '$fullname'";
                                    mysqli_query($connection, $qu);
                                }
                                ?>
                                <form action="dashboard.php" method="post" name="myform">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Answer " id="floatingTextarea" name="answers"></textarea>
                                        <button type="submit" class="btn btn-primary my-2" name="update">Update</button>

                                    </div>
                                </form>
                            </td>
                            <td><a href="faq_update.php?fullname=<?php echo $fullname ?>">Delete</a></td>
                        </tr>
                    </tbody>

                <?php
                } else {
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $question; ?></td>
                            <td><?php echo $answers; ?></td>
                            <td><a href="faq_update.php?fullname=<?php echo $fullname ?>">Delete</a></td>
                        </tr>
                    </tbody>

                <?php
                }
                ?>



            <?php
            }
            $connection->close();
            ?>
        </table>



    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>

</html>