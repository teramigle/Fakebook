<?php
session_start();
if(@$_SESSION['user']){
    header('Location: page.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row h-100 w-100 align-items-center justify-content-center">
        <div class="col-md-6 px-5 py-2">
            <h1 class="text-center text-decoration-underline header">Fakebook</h1>
            <h3 class="text-center sub-header">Let's fake it!</h3>
        </div>
        <div class="col-md-6 px-5 py-2">
            <div class="card m-2 m-md-5">
                <div class="card-header bg-secondary text-light">
                    <h5 class="mb-0 p-1">Prisijungimas</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="login.php">
                        <input class="d-block p-1 m-1" type="text" name="username" placeholder="Vartotojo vardas" required>
                        <input class="d-block p-1 m-1" type="password" name="password" placeholder="Slaptažodis" required>
                        <input class="btn btn-outline-secondary m-1" type="submit" name="submit" value="Prisijungti">
                        <?php
                            if(@$_SESSION['message']){ //zinute apie nepavykusi prisijungima arba prisijungima prie duomenu bazes
                                echo '<p>'.$_SESSION['message'].'</p>';
                                
                            }
                            unset($_SESSION['message']); //panaikiname zinute is masyvo, kad perkrovus psl jos neberodytu
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>