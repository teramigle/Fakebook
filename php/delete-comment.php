<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}else{
    session_start();
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: ../page.php');
    }else if(isset($_POST['delete'])){
        
        $comment_id = $_POST['id'];
        $sql = "delete from comments where id=".$comment_id.";";
        mysqli_query($mysqli, $sql);
        

        $query = "select comments from posts where id=".$_POST['post_id'].";";
        $res = mysqli_query($mysqli, $query);
        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
                

        $query = "update posts set comments=".($newArray['comments']-1)." where id=".$_POST['post_id'].";";
        $res = mysqli_query($mysqli, $query);
        
        $_SESSION['message'] = 'Komentaras ištrintas';
        header('Location: ../page.php#'.$_POST['post_id']);
    }
}
?>