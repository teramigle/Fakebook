<?php
if(empty($_COOKIE['user'])){
    header('Location: logout.php');
}
session_start();
if(@$_SESSION['message']){ //zinute apie nepavykusi prisijungima arba prisijungima prie duomenu bazes
    echo '<div class="alert alert-warning alert-dismissible text-center position-fixed top-0 start-50 translate-middle-x fade show" role="alert" style="z-index:1000;">'.$_SESSION['message'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    
}
unset($_SESSION['message']); //panaikiname zinute is masyvo, kad perkrovus psl jos neberodytu
// $likedPosts = array();
//                     array_push($likedPosts, $_SESSION['liked']);
//                     var_dump($likedPosts);
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
    <link rel="icon" href="wojak.jpg">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    
    
</head>
<body>

<a href='logout.php' id='top'><button class="btn btn-secondary m-1 mb-4" id="logout">Atsijungti</button></a>
    <div class="row w-100">
        <div class="offset-2 col-md-8">
            <div class="card ">
                <div class="card-body d-flex flex-row">
            
                    <img class="me-3" src="<?php echo $_SESSION['user']['picture'];?>">
                    <form class="flex-fill" method="POST" action="post.php">
                        <textarea class="w-100 p-1 mb-2" rows="3" name="content" placeholder="Ką norite pasakyti, <?php echo $_SESSION['user']['username'];?>?" required></textarea>
                        <input class="btn btn-outline-secondary" type="submit" name="post" value="Paskelbti">
                    </form>
                </div>
            </div>
            <!-- php traukia postus is db ir kuria korteles -->
            <?php
            $mysqli = mysqli_connect('localhost', 'root', '', 'fakebook');
            if(mysqli_connect_error()){
                $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
                header('Location: page.php');
            }else{
                $sql = "SELECT posts.id, picture, username, post_date, content, likes, comments FROM posts JOIN users WHERE users.id = posts.user_id ORDER BY posts.id DESC";
                $res = mysqli_query($mysqli, $sql);

                // echo "<table>";
                // echo "<tr>";
                while($newArray3 = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    $post_id = $newArray3['id'];
                    echo "<div class='card mt-3' id=".$post_id.">";
                    echo "<div class='card-body d-flex flex-column'>";
                    
                    echo "<div class='d-flex flex-row justify-content-between'>";
                    echo "<h6>".$username = $newArray3['username']."</h6>";
                    echo "<p>".$post_date = $newArray3['post_date']."</p>";
                    echo "</div>";
                    echo "<div class='d-flex flex-row'>";
                    echo "<img src='".$picture=$newArray3['picture']."'>";
                    echo "<p class='mx-3 w-100' name='content' rows='5'>".$content = $newArray3['content']."</p>";
                    echo "<input type='hidden' name='id' value='$post_id'>";
                    echo "</div>";
                    
                    if ($newArray3['username']==$_SESSION['user']['username']){
                        echo "<div class='d-flex flex-row justify-content-end'>";
                        // echo "<form action='edit-post.php' method='POST'>";
                        echo "<div>";
                        echo "<input type='button' name='edit' class='btn btn-outline-secondary me-2 edit-button' value='Redaguoti'>";
                        
                        echo "</div>";
                        // echo "</form>";
                        echo "<form action='delete-post.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='$post_id'>";
                        echo "<input type='submit' name='delete' class='btn btn-outline-secondary' value='Ištrinti'>";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "<div class='d-flex flex-row justify-content-around mt-2'>";
                    echo "<form action='like.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='$post_id'>";

                    

                    echo "<input type='submit' name='like' class='btn btn-secondary me-2 like-button' value='Patinka'><span>".$likes = $newArray3['likes']."</span>";
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
    <a href="#top" id="bottom" class="position-fixed bottom-0 end-0"><button class="btn btn-secondary bg-white text-secondary border border-secondary m-1">Į viršų</button></a>
    <script src="edit.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>