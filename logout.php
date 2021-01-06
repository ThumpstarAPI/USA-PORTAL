<?php
session_start();
$id = $_SESSION['id'];


if(!empty($id)){
    session_destroy();
    echo "<script> 
                sessionStorage.clear(); 
            window.location.replace('login.php');
          </script>";
}

?>