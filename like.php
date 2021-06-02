<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}else{
    session_start();
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: page.php');
    }else if(isset($_POST['like'])){
        $post_id = $_POST['id'];
        echo $post_id;
        $sql = "select likes from posts where id=".$post_id.";";
        $res = mysqli_query($mysqli, $sql);
        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
        var_dump($newArray);
        echo $newArray['likes'];
        $sql = "update posts set likes=".($newArray['likes']+1)." where id=".$post_id.";";
        mysqli_query($mysqli, $sql);
        $_SESSION['message'] = 'Įrašas pamėgtas';
        header('Location: page.php');
    }
}
?>