<?php
    include_once "header.php";
    include_once "db.php";
    include_once "functions.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM movies WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $movie = $stmt->fetch();
?>

<div class="film">
    <div class="film-slike">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php 
            $query = "SELECT * FROM multimedia WHERE movie_id=? AND type='img'";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            $numImages = $stmt->rowCount(); //število slik, v bazi za ta film

            for($i=0;$i<$numImages;$i++) {
                if ($i==0) {
                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="active"></li>';
                }
                else {
                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
                }
            }
        ?>
            
        </ol>
        <div class="carousel-inner">
        <?php
            $i=0;
            while ($row = $stmt->fetch()) {
                if ($i==0) {
                    echo '<div class="carousel-item active">';
                }
                else {
                    echo '<div class="carousel-item">';
                }                
                echo '<img class="d-block w-100" src="'.$row['url'].'" alt="First slide">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<p>'.$row['title'].'</p>';
                echo '</div>';
                echo '</div>';
                $i++;
            }
        ?>
            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <?php 
        if (isAdmin()) {
        ?>
        <form action="movie_image_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $movie['id'];?>" />
            <input type="text" name="title" placeholder="Vnesi naslov slike" class="form-control" /><br />
            <select name="type" class="form-control">
                <option value="img">Slika</option>
                <option value="video">Video</option>
            </select><br />
            <input type="file" placeholder="Naloži sliko filma" class="form-control" name="file" /> <br />
            <input type="submit" value="Naloži" />
        </form>
        <?php
        }
        ?>
    </div>
    <div class="film-podatki">
        <div class="naslov"><?php echo $movie['title'];?></div>
        <div class="zanri"><?php echo getGenres($movie['id']);?></div>
        <div class="leto"><?php echo $movie['year_release'];?></div>
        <div class="dolzina"><?php echo FromMinToString($movie['duration']);?></div>
        <div class="ocena">* * * * *</div>
        <div class="opis"><?php echo $movie['description']; ?></div>
    </div>
</div><br />
<hr /><br />
<h2>Igralska zasedba</h2></br>
<?php 
    if (isAdmin()) {
        echo '<a href="movie_actors.php?id='.$id.'" class="btn btn-primary">Igralci v tem filmu</a>';
    }
?>
<div class="igralci">
    <div class="igralec">
        <table>
        <?php 
            $query = "SELECT a.id, a.first_name, a.last_name, r.role 
                      FROM roles r INNER JOIN actors a ON a.id=r.actor_id 
                      WHERE (r.movie_id=?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            //izvrši se tolikokrat, kot je igralcev v nekem filmu
            while ($row = $stmt->fetch()) { 
        ?>
            <tr>
                <td>
                    <img src="<?php echo getActorAvatar($row['id']);?>" alt="igralec" />
                </td>
                <td>
                    <div class="igralec-podatki">
                        <?php echo $row['first_name'].' '.$row['last_name']; ?>
                    </div>
                </td>
                <td>
                    <div class="igralec-film-podatki">
                        <div>
                            <?php echo $row['role'];?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php 
            }
        ?>
            <!--<tr>
                <br />
                <td><a href="#">Prikaži vse igralce</a></td>
            </tr>-->
        </table>
    </div>
</div>

<br />
<hr /><br />
<h2>Komentarji</h2></br>
<div class="komentarji">
    <form action="movie_comment_insert.php" method="post">
        <input type="hidden" name="id" value="<?php echo $movie['id'];?>" />
        <textarea name="content" class="form-control" placeholder="Vnesi komentar"></textarea><br />
        <input type="submit" value="Pošlji" class="btn btn-primary" />
    </form>

    <div class="komentarji-prikaz" id="komentar-sidro">
    <?php


        //iz baze preberem vse komentarje za ta movie
        $query = "SELECT * FROM comments WHERE movie_id=? ORDER BY date_add DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        while ($row = $stmt->fetch()) {        
    ?>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card post">
                        <div class="post-heading">
                            <div class="float-left image"><img
                                    src="<?php echo getUserAvatar($row['user_id']);?>"
                                    class="img-circle avatar" alt="user profile image"></div>
                            <div class="float-left meta">
                                <div class="title h5"><?php echo getUserName($row['user_id']);?></div>
                                <div class="text-muted time"><?php echo getSloDateTime($row['date_add']);?></div>
                            </div>
                        </div>
                        <div class="post-description"><?php echo $row['content'];?></div>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
?>
    </div>
</div>

<?php
    include_once 'footer.php';
?>