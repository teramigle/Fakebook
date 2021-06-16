<?php
session_start();
if(empty($_SESSION['user'])){
    header('Location: php/logout.php');
}else{
    
    $mysqli = mysqli_connect("localhost", "root", "", "fakebook");
    if(mysqli_connect_error()){
        $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
        header('Location: page.php');
    }else{
        var_dump($_POST); 
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo $target_file;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if(isset($_POST["submit"])&&$target_file!="uploads/") {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        } else {
            date_default_timezone_set('EET');
            $query = "INSERT INTO posts values('','".$_SESSION['user']['id']."', '".$_POST['content']."', '', '".date("Y-m-d H:i:s")."', '', '');";
            $res = mysqli_query($mysqli, $query);
            $_SESSION['message']='Įrašas paskelbtas';
            header('Location: page.php');
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
