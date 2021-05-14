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
        <img src="https://images-na.ssl-images-amazon.com/images/I/7124A8OOL6L._AC_SL1001_.jpg" alt="slika" />

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
<a href="movie_actors.php?id=<?php echo $id;?>" class="btn btn-primary">Igralci v tem filmu</a>
<div class="igralci">
    <div class="igralec">
        <table>
            <tr>
                <td><img src="https://res.cloudinary.com/du1efakdk/image/upload/c_fill,f_auto,h_414,q_auto,w_280/v1617012871/kftv/nig1dtun8ug4gsx1td4n.jpg"
                        alt="igralec" /></td>
                <td>
                    <div class="igralec-podatki">Wan Diesel</div>
                </td>
                <td>
                    <div class="igralec-film-podatki">
                        <div>Jože Novak</div>
                </td>
            </tr>
            <tr>
                <br />
                <td><a href="#">Prikaži vse igralce</a></td>
            </tr>
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