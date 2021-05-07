<?php 
include_once 'header.php';
include_once 'db.php';

$id = (int) $_GET['id'];

$query = "SELECT * FROM movies WHERE id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$movie = $stmt->fetch();


?>

<div class="film">
    <div class="film-slike">
        <img src="https://images-na.ssl-images-amazon.com/images/I/7124A8OOL6L._AC_SL1001_.jpg" alt="slika" />
    </div>
    <div class="film-podatki">
        <div class="naslov"><?php echo $movie['title'];?></div>
        <div class="zanri"><?php echo getGenres($movie['id']);?></div>
        <div class="leto"><?php echo $movie['year_release'];?></div>
        <div class="dolzina"><?php echo fromMinToString($movie['duration']);?></div>
        <div class="ocena"> * * * * *</div>
        <div class="opis"><?php echo $movie['description'];?></div>
    </div>
</div>
<div class="igralci">
    <div class="igralec">
        <img src="https://res.cloudinary.com/du1efakdk/image/upload/c_fill,f_auto,h_414,q_auto,w_280/v1617012871/kftv/nig1dtun8ug4gsx1td4n.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Van Diesel (Jože Novak)</div>            
        </div>
    </div>
    <div class="igralec">
        <img src="https://res.cloudinary.com/du1efakdk/image/upload/c_fill,f_auto,h_414,q_auto,w_280/v1617012871/kftv/nig1dtun8ug4gsx1td4n.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Van Diesel (Jože Novak)</div>            
        </div>
    </div>
</div>
<div class="komentarji">
    <form action="comment_insert.php" method="post">
        <textarea name="content" class="form-control" placeholder="Vnesi komentar"></textarea><br />
        <input type="submit" value="Pošlji" class="btn btn-primary" />
    </form>
    <div class="komentarji-prikaz">
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
        <div class="komentar">
            <div class="komentar-podatki">
                Goraz Žižek (25. 4. 2021 @ 13:24)
            </div>
            <div>To je najjači film ever. Priporočam ogled. </div>
        </div>
    </div>
</div>



<?php 
include_once 'footer.php';
?>