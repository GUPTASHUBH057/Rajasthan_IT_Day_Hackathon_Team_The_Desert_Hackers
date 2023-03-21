<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

$con = mysqli_connect('localhost','root1','gnjgNsmJgV7S');

if(!$_SESSION['id']){
  header('location:index.php');
}
else{

$selected_db = "bot_data";

mysqli_select_db($con,$selected_db);

}


?>
