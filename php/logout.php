<?php
session_start();
session_destroy();

$mysqli = mysqli_connect("localhost", "root", "", "fakebook");

if(mysqli_connect_error()){
      
    header('Location: ../index.php');
    
}else{
    
    setcookie('user', 'jdhsd', time()-60);
}

header('Location: ../index.php');

?>