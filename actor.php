<?php 
include_once "header.php";
include_once "db.php";

$id = (int) $_GET['id'];

$query = "SELECT * FROM actors WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
//iz baze preberem vse o tem igralcu, ki ga prikazujem
$actor = $stmt->fetch();

?>
<h1><?php echo $actor['first_name'].' '.$actor['last_name']; ?></h1>
<h5><?php echo $actor['nick']; ?></h5>

<div id="slike">
<?php
    //preverim ali igralec ima slike
    $query = "SELECT * FROM actors_images WHERE actor_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    while ($row = $stmt->fetch()) {
        echo '<img src="'.$row['url'].'" width="150" alt="'.$row['title'].'" /> ';
    }
?>

</div>
<?php
if (isAdmin()){
?>
<hr />
<form action="actor_image_upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $actor['id'];?>" />
    <input type="text" name="title" placeholder="Vnesi naslov slike" class="form-control" /><br />
    <input type="file" name="file" class="form-control" /> <br />
    <input type="submit" name="submit" value="Naloži" class="btn btn-primary" />
</form>
<?php
}
?>

<?php 
include_once "footer.php";
?>