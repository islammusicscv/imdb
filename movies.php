<?php 
include_once "header.php";
include_once "db.php";
?>

<a href="movie_add.php" class="btn btn-primary">Dodaj film</a> 
<br />
<div class="movies">
<?php
$query = "SELECT * FROM movies";
$stmt = $pdo->prepare($query);
$stmt->execute();
//izpis vseh filmov
while ($row = $stmt->fetch()) {
    echo '<div class="movie">';
    echo '<a href="movie.php?id='.$row['id'].'">';
        echo $row['title'];
    echo '</a>';
    echo '<br />';
    echo '<span>'.$row['year_release'].'</span>';
    echo '<br />';
    echo '<a href="movie_edit.php?id='.$row['id'].'">Uredi</a> ';
    echo '<a href="movie_delete.php?id='.$row['id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
    echo '</div>';
}
?>
</div>

<?php 
include_once "footer.php";
?>