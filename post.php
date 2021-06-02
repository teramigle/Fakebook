<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}else{
    session_start();
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: page.php');
    }else{
        $query = "INSERT INTO posts values('','".$_SESSION['user']['id']."', '".$_POST['content']."', '".date("Y-m-d H:i:s")."', '', '');";
        echo $query;
        $res = mysqli_query($mysqli, $query);
        var_dump($res);
        
        if($res){

            $_SESSION['message'] = 'Įrašas paskelbtas.';
            header('Location: page.php');
        }
    }
}

    ?>