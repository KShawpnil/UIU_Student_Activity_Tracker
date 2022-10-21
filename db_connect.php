<?php 

// $server = "localhost";
// $user = "root";
// $pass = "";
// $database = "uiusatdb";

// //Create a connectio
// $conn = new mysqli($server, $user, $pass, $database);
$conn = mysqli_connect('localhost', 'root', '', 'uiusatdb');

//Check Connection
if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>