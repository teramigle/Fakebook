<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'fakebook');
if(mysqli_connect_error()) {
    $_SESSION['message'] = 'Nepavyko prisijungti prie duomenų bazės'; 
    header('Location: ../index.php');
}else{
    $username = $_POST['username'];
    $password = $_POST['password'];
$password = md5($password);
    
    $checkUser = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username' && `password` = '$password'");
    
    if(mysqli_num_rows($checkUser)>0){ //jei yra db vartotojas tokiu vardu  ir slaptazodziu
        $user = mysqli_fetch_assoc($checkUser); //uzklausos rezultata pavercia asoc masyvu
        //session masyve sukuriame masyva vartotojas, jo parametru reiksmems priskiriam is uzklausos sukurto user asoc masyvo reiksmes
        $_SESSION['user'] = [
            "id"=>$user['id'],
            "username"=>$user['username'],
            "picture"=>$user['picture']
        ];
        
        header('Location: ../page.php');
    }else{
        $_SESSION['message'] = 'Prisijungti nepavyko'; 
        header('Location: ../index.php');
    }
}
?>