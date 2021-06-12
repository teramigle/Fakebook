<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}else{
    session_start();
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: ../page.php');
    }else if(isset($_POST['like'])){
        $post_id = $_POST['id'];
        $sql="select * from likes";
        $res = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_assoc($res))
            {
            
            if($row['post_id']==$post_id && $row['user_id']==$_SESSION['user']['id']){
                $_SESSION['message'] = 'Jūs jau pamėgote šį įrašą';
                header('Location: ../page.php#'.$post_id);
                die();
            }
            }

        $sql = "select likes from posts where id=".$post_id.";";
        $res = mysqli_query($mysqli, $sql);
        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
        
        $_SESSION['liked']=$post_id;
        
        $sql = "update posts set likes=".($newArray['likes']+1)." where id=".$post_id.";";
        mysqli_query($mysqli, $sql);
        
        $sql = "insert into likes values('', '".$post_id."', '".$_SESSION['user']['id']."');";
        mysqli_query($mysqli, $sql);

        $_SESSION['message'] = 'Įrašas pamėgtas';
        header('Location: ../page.php#'.$post_id);
    }
}
?>