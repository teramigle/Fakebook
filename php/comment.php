<?php
session_start();
if(empty($_SESSION['user'])){
    header('Location: logout.php');
}else{
    
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: ../page.php');
    }else{
        $query = "INSERT INTO comments values('', '".$_POST['id']."','".$_SESSION['user']['id']."', '".$_POST['content']."');";
        // echo $query;
        $res = mysqli_query($mysqli, $query);

        $query = "select comments from posts where id=".$_POST['id'].";";
        $res = mysqli_query($mysqli, $query);
        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);    

        $query = "update posts set comments=".($newArray['comments']+1)." where id=".$_POST['id'].";";
        $res = mysqli_query($mysqli, $query);
        
        if($res){

            $_SESSION['message'] = 'Komentaras paskelbtas';
            header('Location: ../page.php#'.$_POST['id']);
        }
    }
}

    ?>