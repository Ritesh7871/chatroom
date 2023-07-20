<?php
$servername="localhost";
$username="root";
$password ="";
$database="chatroom";

// creating database connection
$con = mysqli_connect($servername,$username,$password,$database);

// checking connection
 if(!$con){
    die("failed to connect". mysqli_connect_error());
 }
?>