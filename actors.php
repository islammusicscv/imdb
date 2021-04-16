<?php 
include_once "header.php";
include_once "db.php";
?>

<a href="actor_add.php" class="btn btn-primary">Dodaj igralca</a> 
<br />
<div class="actors">
<?php
$query = "SELECT * FROM actors";
$stmt = $pdo->prepare($query);
$stmt->execute();
//izpis vseh igralcev
while ($row = $stmt->fetch()) {
    echo '<div class="actor">';
    echo $row['first_name'].' '.$row['last_name'];
    echo '<br />';
    echo '<span>'.$row['nick'].'</span>';
    echo '<br />';
    echo '<a href="actor_edit.php?id='.$row['id'].'">Uredi</a> ';
    echo '<a href="actor_delete.php?id='.$row['id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a> ';
    echo '</div>';
}
?>
</div>

<?php 
include_once "footer.php";
?>