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
        $post_id = $_POST['id'];
        echo $post_id;
        $sql = "delete from posts where id=".$post_id.";";
        mysqli_query($mysqli, $sql);

        $sql2 = "delete from comments where post_id=".$post_id.";";
        mysqli_query($mysqli, $sql2);
        
        $sql3 = "delete from likes where post_id=".$post_id.";";
        mysqli_query($mysqli, $sql3);

        $_SESSION['message'] = 'Įrašas ištrintas';
        header('Location: ../page.php');
    }
}
?>
