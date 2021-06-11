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
               
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        }

        if ($uploadOk == 0) {
            $_SESSION['message']='Netinkamas failas';
            header('Location: page.php');
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $image = $_FILES["fileToUpload"]["name"];
                $query = "INSERT INTO posts values('','".$_SESSION['user']['id']."', '".$_POST['content']."', 'uploads/".$image."', '".date("Y-m-d H:i:s")."', '', '');";
                echo $query;
                $res = mysqli_query($mysqli, $query);

            } else {
                $_SESSION['message']="Nepavyko įkelti failo";
                header('Location: page.php');
            }
          }

        $_SESSION['message'] = 'Įrašas paskelbtas';
        header('Location: page.php');
        
    }
}

?>