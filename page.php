<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}
session_start();
// echo "<a href='logout.php'><button>Atsijungti</button></a><br>";
// echo 'Sveiki, '.$_SESSION['user']['username'].'!';
// echo '<img src="'.$_SESSION['user']['picture'].'">';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style-page.css">
</head>
<body>
    
<a href='logout.php'><button class="btn btn-secondary m-1">Atsijungti</button></a>
    <div class="row w-100">
        <div class="offset-2 col-md-8">
            <div class="card ">
                <div class="card-body d-flex flex-row">
            
                    <img class="me-3" src="<?php echo $_SESSION['user']['picture'];?>">
                    <form class="flex-fill" method="POST" action="post.php">
                        <textarea class="w-100 p-1" rows="3" name="content" placeholder="Ką norite pasakyti, <?php echo $_SESSION['user']['username'];?>?" required></textarea>
                        <input class="btn btn-outline-secondary" type="submit" name="post" value="Paskelbti">
                    </form>
                </div>
            </div>
            <!-- php traukia postus is db ir kuria korteles -->
            <?php
            $mysqli = mysqli_connect('localhost', 'root', '', 'fakebook');
            if(mysqli_connect_error()){
                $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
                header('Location: parduotuve.php');
            }else{
                $sql = "SELECT posts.id, picture, username, post_date, content, likes, comments FROM posts JOIN users WHERE users.id = posts.user_id ORDER BY posts.id DESC";
                $res = mysqli_query($mysqli, $sql);

                // echo "<table>";
                // echo "<tr>";
                while($newArray3 = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    echo "<div class='card mt-3'>";
                    echo "<div class='card-body d-flex flex-column'>";
                    
                    echo "<div class='d-flex flex-row justify-content-between'>";
                    echo "<h6>".$username = $newArray3['username']."</h6>";
                    echo "<p>".$post_date = $newArray3['post_date']."</p>";
                    echo "</div>";
                    echo "<div class='d-flex flex-row'>";
                    echo "<img src='".$picture=$newArray3['picture']."'>";
                    echo "<p class='px-4'>".$content = $newArray3['content']."</p>";
                    echo "</div>";
                    $post_id = $newArray3['id'];
                    if ($newArray3['username']==$_SESSION['user']['username']){
                        echo "<div class='d-flex flex-row justify-content-end'>";
                        echo "<button class='btn btn-outline-secondary me-2'>Redaguoti</button>";
                        
                        // echo $post_id;
                        // var_dump($newArray3);
                        echo "<form action='delete-post.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='$post_id'>";
                        echo "<input type='submit' name='delete' class='btn btn-outline-secondary' value='Ištrinti'>";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "<div class='d-flex flex-row justify-content-around mt-2'>";
                    echo "<form action='like.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='$post_id'>";
                    echo "<input type='submit' name='like' class='btn btn-secondary me-2' value='Patinka'><span>".$likes = $newArray3['likes']."</span>";
                    echo "</form>";
                    echo "<p>Komentarai: ".$comments = $newArray3['comments']."</p>";
                    echo "</div>";
                    
                    // $id = $newArray3['id'];
                    // echo "<form action='irasymas_i_krepseli.php' method='POST'>
                    // <input type='hidden' name='id' value='$id'>
                    // <input type='number' min='0' name='kiekis' placeholder='Kiekis' required><br>
                    // <input type='submit' name='prideti' value='Pridėti į krepšelį'>
                    // </form>";
                    echo "</div>";
                    echo "</div>";
                }
                // echo "</tr>";
                // echo "</table>";
            }
            ?>
        </div>
    </div>

</body>
</html>

<?php
if(@$_SESSION['message']){ //zinute apie nepavykusi prisijungima arba prisijungima prie duomenu bazes
    echo '<p>'.$_SESSION['message'].'</p>';
    
}
unset($_SESSION['message']); //panaikiname zinute is masyvo, kad perkrovus psl jos neberodytu
?>