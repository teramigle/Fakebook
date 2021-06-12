<?php
session_start();
if(@$_SESSION['user']){
    header('Location: page.php');
}
if(@$_SESSION['message']){ //zinute apie nepavykusi prisijungima arba prisijungima prie duomenu bazes
    echo '<div class="alert alert-warning alert-dismissible text-center position-absolute top-0 start-50 translate-middle-x fade show" role="alert">'.$_SESSION['message'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    
}
unset($_SESSION['message']); //panaikiname zinute is masyvo, kad perkrovus psl jos neberodytu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="images/wojak.jpg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
</head>
<body>
    <div class="row h-100 w-100 mx-0 align-items-center justify-content-center">
        <div class="col-md-6 px-3 px-md-5 py-2">
            <h1 class="text-center text-decoration-underline header">Fakebook</h1>
            <h3 class="text-center sub-header">Let's fake it!</h3>
        </div>
        <div class="col-md-6 px-5 py-2">
            <div class="card m-2 m-md-5">
                <div class="card-header bg-secondary text-light">
                    <h5 class="mb-0 p-1">Prisijungimas</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="php/login.php">
                        <input class="d-block p-1 m-1" type="text" name="username" placeholder="Vartotojo vardas" required>
                        <input class="d-block p-1 m-1" type="password" name="password" placeholder="Slaptažodis" required>
                        <input class="btn btn-outline-secondary m-1" type="submit" name="submit" value="Prisijungti">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>