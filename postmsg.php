<?php 
include 'db_connect.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];
// $sql = "insert into msgs ('msg','room','ip','stime') values ('$msg','$room','$ip',CURRENT_TIMESTAMP())";
$sql="INSERT INTO `msgs` ( `msg`, `room`, `ip`, `stime`) VALUES ( '$msg', '$room', '$ip', current_timestamp())";
$result= mysqli_query($con,$sql);
mysqli_close($con);




?>