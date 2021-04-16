<?php 
include_once "header.php";
include_once "db.php";
?>

<a href="genre_add.php" class="btn btn-primary">Dodaj žanr</a> 
<br />
<div class="genres">
<?php
$query = "SELECT * FROM genres";
$stmt = $pdo->prepare($query);
$stmt->execute();
//izpis vseh žanrov
while ($row = $stmt->fetch()) {
    echo '<div class="genre">';
    echo $row['title'];
    echo '<br />';
    echo '<span>'.$row['short'].'</span>';
    echo '<br />';
    echo '<a href="genre_edit.php?id='.$row['id'].'">Uredi</a> ';
    echo '<a href="genre_delete.php?id='.$row['id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
    echo '</div>';
}
?>
</div>

<?php 
include_once "footer.php";
?>