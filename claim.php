<?php 
// getting the value of post parameter
$room = $_POST['room'];

// checking string size
if(strlen($room)>20 or strlen($room)<2){
    $message = "Please Choose a name between 2 to 20 characters";
   echo '<script langauge="javascript">';
   echo 'alert(" '.$message.'");';
    echo'window.location="http://localhost/chatroom";';
   echo' </script>';
}
else if(!ctype_alnum($room)){
    $message = "Please Choose an alphanumeric room name";
    echo '<script langauge="javascript">';
    echo 'alert(" '.$message.'");';
    echo'window.location="http://localhost/chatroom";';
    echo '</script>';
}
else{
    //connect to the database
    include 'db_connect.php';
}

// check if room already exists

$sql = "select * from rooms where roomname='$room'";
$result=mysqli_query($con,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        $message = "Please Choose a different room name.This room is already claimed";
        echo '<script langauge="javascript">';
        echo 'alert(" '.$message.'");';
         echo'window.location="http://localhost/chatroom";';
        echo' </script>';
    }
    else{
        $sql="INSERT INTO rooms ( `roomname`, `stime`) VALUES ( '$room', current_timestamp());";
        // $sql="Insert into rooms ('roomname','stime') values ('$room',CURRENT_TIMESTAMP);";
        if(mysqli_query($con,$sql)){
            $message = "Your room is ready and you can chat now!";
            echo '<script langauge="javascript">';
            echo 'alert(" '.$message.'");';
             echo'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';
            echo' </script>';
        }
    }
}
else{
    echo"Error:".mysqli_erro($con);
}
?>