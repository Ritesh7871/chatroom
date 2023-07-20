<?php 

$roomname= $_GET['roomname'];
include 'db_connect.php';

// Execute sql to check wheather room exits
$sql = "select * from rooms where roomname='$roomname'";
$result= mysqli_query($con,$sql);
if($result){
    //check if room exits
    if(mysqli_num_rows($result)==0){
        $message = "This room does not exist.Try Creating a new one";
        echo '<script langauge="javascript">';
        echo 'alert(" '.$message.'");';
         echo'window.location="http://localhost/chatroom";';
        echo' </script>';
    }
}else{
    echo"Error :".mysqli_error($con);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass{
    height:350px;
    overflow-y:scroll;
}
</style>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal">MyAnonymousChat.com</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About</a>
        <a class="p-2 text-dark" href="#">Contact</a>
      </nav>
     
    </div>
<h2>Chat Messages -<?php echo $roomname; ?></h2>

<div class="container">
    <div class="anyclass">
    </div>
</div>



<input type="text" class="form-control"name="usermsg"id="usermsg"placeholder="Add message"><br>
<button class="btn btn-default" name="submitmsg"id="submitmsg">Send</button>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- //If  user submits the form     -->
    <script>
  

      // check for new messages every 1 second
      setInterval(runfunction,1000);
      function runfunction(){
        $.post("htcont.php",{room: '<?php echo $roomname ?>'},function(data,status)
        
        {
          document.getElementsByClassName('anyclass')[0].innerHtml = data;
        });
      }  
      
// using enter key to submit.credit:https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
var input = document.getElementById("usermsg");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
 
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    if(event.keycode ===13){
    document.getElementById("submitmsg").click();
  }
});


     $("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
  $.post("postmsg.php",{text: clientmsg,room:'<?php echo $roomname; ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR']; ?>'},function(data,status){
  
    document.getElementsByClassName('anyclass')[0].innerHTML = data;});
    $("#usermsg").val("");
    return false;
  
});
</script>

</body>
 </html>
