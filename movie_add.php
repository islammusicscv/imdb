<?php 
include_once "header.php";
?>

<h2>Dodaj film</h2>

<form action="movie_insert.php" method="post">
    <input type="text" name="title" placeholder="Vnesi naslov filma" class="form-control" required="required" /><br />
    <input type="number" name="duration" placeholder="Vnesi dolžino filma (v min)" class="form-control" /><br />
    <input type="number" name="year_release" placeholder="Vnesi letnico filma" class="form-control" /><br />
    <textarea name="description" cols="15" rows="5" placeholder="Vnesi opis filma" class="form-control"></textarea><br /> 
    <div class="form-control">
    <?php
        include_once "db.php";
        $query = "SELECT * FROM genres";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            echo '<input type="checkbox" name="genres[]" value="'.$row['id'].'" /> '.$row['title'].'<br />';
        }
    ?>
    </div> <br />
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>
<?php 
include_once "footer.php";
?>