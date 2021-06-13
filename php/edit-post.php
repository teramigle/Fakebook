<?php
session_start();
if(empty($_SESSION['user'])){
    header('Location: logout.php');
}else{
    
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: logout.php');
    }else{
        $query = "UPDATE posts SET content = '".$_POST['content']."' WHERE id = '".$_POST['id']."';";
        $res = mysqli_query($mysqli, $query);
        
        if($res){

            $_SESSION['message'] = 'Įrašas redaguotas';
            header('Location: ../page.php#'.$_POST['id']);
        }
       
    }
}

    ?>