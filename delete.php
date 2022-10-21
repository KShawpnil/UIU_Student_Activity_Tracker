<?php



/*include('db_connect.php'); */
session_start();
ob_start();
if(isset($_GET['d_id']) && isset($_SESSION['username'])) {

    include('db_connect.php');
    $id = $_GET["d_id"];
    
    
    $sql9 = "DELETE FROM achievements WHERE a_id=$id";
    // echo $sql9;
    $query = mysqli_query($conn, $sql9) or die("Failed query " . mysqli_error($conn));
    
    if($query) {
        header("Location: profile.php");
    } else {
        echo "Failed brah ";
    }
}
else if(!isset($_SESSION['username'])){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}
else {
    header("Location: profile.php");
}

