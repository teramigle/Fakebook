<?php
session_start();
if(empty($_SESSION['user'])){
    header('Location: php/logout.php');
}

if(@$_SESSION['message']){ 
    echo '<div class="alert alert-warning alert-dismissible text-center position-fixed top-0 start-50 translate-middle-x fade show" role="alert" style="z-index:1000;">'.$_SESSION['message'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    
}
unset($_SESSION['message']); 

?>

<!DOCTYPE html>
<html lang="en" style="scroll-behavior:auto;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style-page.css">
    <link rel="icon" href="images/wojak.jpg">
</head>
<body>

    <div class="d-flex justify-content-between flex-row m-2 mb-3">
        <a href='php/logout.php' id='top'><button class="btn btn-secondary" id="logout">Atsijungti</button></a>
        <div id="search" class="input-group h-50 w-auto">
            <input type="search" class="form-control rounded pe-0" placeholder="Vartotojas/įrašas" aria-label="Paieška"
                aria-describedby="search-addon" />
            <button type="button" class="btn btn-secondary">Ieškoti</button>
        </div>
    </div>
    
    <div class="d-flex justify-content-end">
        <span id="tags-span">
        
        </span>
    </div>
    <div class="row w-100 m-0">
        <div class="offset-1 col-10 offset-md-2 col-md-8">
            <div class="card ">
                <div class="card-body d-flex flex-row">
                    <img class="me-3" src="<?php echo $_SESSION['user']['picture'];?>">
                    <form class="flex-fill" method="POST" action="post.php" enctype="multipart/form-data">
                        <textarea class="w-100 p-1 mb-2" rows="3" name="content" placeholder="Ką pasakysite, <?php echo $_SESSION['user']['username'];?>?" required></textarea>
                        <input type="file" class="w-100 d-block mb-2" id="fileToUpload" name="fileToUpload" accept="image/png, image/jpeg">
                        <input class="btn btn-outline-secondary" type="submit" name="submit" value="Paskelbti">
                        
                    </form>
                </div>
            </div>
            <!-- php traukia postus is db ir kuria korteles -->
            <?php
            $mysqli = mysqli_connect('localhost', 'root', '', 'fakebook');
            if(mysqli_connect_error()){
                $_SESSION['message']='Nepavyko prisijungti prie duomenų bazės';
                header('Location: php/logout.php');
            }else{
                $sql = "SELECT posts.id, picture, username, post_date, content, likes, comments, `image` FROM posts JOIN users WHERE users.id = posts.user_id ORDER BY posts.id DESC";
                $res = mysqli_query($mysqli, $sql);

                while($postsArray = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    $post_id = $postsArray['id'];
                    // var_dump($postsArray);
                    echo "<div class='post'>";
                    echo "<div class='card post-card mt-3' id=".$post_id.">";
                    echo "<div class='card-body d-flex flex-column'>";
                    
                    echo "<div class='d-flex flex-row justify-content-between'>";
                    echo "<h5 class='username'>".$username = $postsArray['username']."</h5>";
                    echo "<p class='text-end'>".$post_date = $postsArray['post_date']."</p>";
                    echo "</div>";
                    echo "<div class='d-flex flex-row mb-2'>";
                    echo "<img src='".$picture=$postsArray['picture']."'>";
                    echo "<p class='mx-3 w-100 content' name='content' rows='5' style='line-break: anywhere;'>".$content = $postsArray['content']."</p>";
                    echo "<input type='hidden' name='id' value='$post_id'>";
                    echo "</div>";
                    if($postsArray['image']!=''){
                    echo "<div class = 'd-flex justify-content-center mb-2'>";
                    echo "<img class='image' style=' border-radius: 0!important;' src='".$image=$postsArray['image']."'>";
                    echo "</div>";
                    }
                    
                    if ($postsArray['username']==$_SESSION['user']['username']){
                        echo "<div class='d-flex flex-row justify-content-end mt-2'>";
                        // echo "<form action='edit-post.php' method='POST'>";
                        echo "<div>";
                        echo "<input type='button' name='edit' class='btn btn-outline-secondary me-2 edit-button' value='Redaguoti'>";
                        
                        echo "</div>";
                        // echo "</form>";
                        echo "<form action='php/delete-post.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='$post_id'>";
                        echo "<input type='submit' name='delete' class='btn btn-outline-secondary' value='Ištrinti'>";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "<div class='d-flex flex-row justify-content-around mt-3'>";
                    echo "<form action='php/like.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='$post_id'>";
                    echo "<input type='submit' name='like' class='btn btn-secondary me-2 like-button' value='Patinka'><span>".$likes = $postsArray['likes']."</span>";
                    echo "</form>";
                    echo "<div><button class='btn btn-secondary me-2 comment-button'>Komentuoti</button><span>".$comments = $postsArray['comments']."</span></div>";
                    echo "</div>";
                    
                    
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='card d-none'><div class='card-body d-flex flex-row'>
                    <img class='me-3' style='width: 70px; height: 70px;' src='".$_SESSION['user']['picture']."'>
                    <form class='flex-fill mb-0' action='php/comment.php' method='POST'>
                    <textarea class='w-100' rows='3' name='content' placeholder='Ką pakomentuosite, ".$_SESSION['user']['username']."?' required></textarea>
                    <input type='hidden' name='id' value='$post_id'>
                    <input type='submit' class='btn btn-outline-secondary mt-2' value='Paskelbti'>
                    <button type='button' class='btn btn-outline-secondary mt-2 close' onclick='this.parentElement.parentElement.parentElement.classList.add(`d-none`);'>Uždaryti</button>

                    </form>
                    </div></div>";

                    // spausdinamos korteles su komentarais

                    $commentssql = "SELECT comments.id, picture, username, content from users join comments where user_id = users.id && post_id = $post_id ORDER BY comments.id desc";
                    $commentsres = mysqli_query($mysqli, $commentssql);
                    
                    while($commentsArray = mysqli_fetch_array($commentsres, MYSQLI_ASSOC)){
                        echo "<div class='card'>";
                        echo "<div class='card-body d-flex flex-column'>";
                    
                    echo "<div class='d-flex flex-row justify-content-between mb-2'>";
                    echo "<h6>".$username = $commentsArray['username']."</h6>";
                    // echo "<p>".$post_date = $newArray3['post_date']."</p>";
                    echo "</div>";
                    echo "<div class='d-flex flex-row'>";
                    echo "<img style='width: 70px; height: 70px;' src='".$picture=$commentsArray['picture']."'>";
                    echo "<p class='mx-3 w-100' name='content' style='line-break: anywhere;'>".$content = $commentsArray['content']."</p>";
                    echo "</div>";
                    if ($commentsArray['username']==$_SESSION['user']['username']){
                        echo "<div class='d-flex justify-content-end'>";
                        echo "<form action='php/delete-comment.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='".$commentsArray['id']."'>";
                        echo "<input type='hidden' name='post_id' value='".$post_id."'>";
                        echo "<input type='submit' name='delete' class='btn btn-outline-secondary' value='Ištrinti'>";
                        echo "</form>";
                        echo "</div>";
                    }

                    
                    echo "</div>";
                    echo "</div>";
                    
                    }

                    echo "</div>";
                }
                
            }
            ?>
        </div>
    </div>
    <a href="#top" id="bottom" class="position-fixed bottom-0 end-0"><button class="btn btn-secondary bg-white text-secondary border border-secondary m-1">Į viršų</button></a>
    <script src="js/edit.js"></script>
    <script src="js/comment.js"></script>
    <script src="js/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
</body>
</html>