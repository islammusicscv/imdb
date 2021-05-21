<?php 
include_once "header.php";

adminOnly();

include_once "db.php";

$id = (int) $_GET['id'];

$query = "SELECT * FROM actors WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
//iz baze preberem vse o tem igralcu, ki ga urejam
$actor = $stmt->fetch();

?>

<h2>Uredi igralca</h2>

<form action="actor_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $actor['id'];?>" />
    <input type="text" value="<?php echo $actor['first_name'];?>" name="first_name" placeholder="Vnesi ime igralca" class="form-control" required="required" /><br />
    <input type="text" value="<?php echo $actor['last_name'];?>" name="last_name" placeholder="Vnesi priimek igralca" class="form-control" required="required" /><br />
    <input type="text" value="<?php echo $actor['nick'];?>" name="nick" placeholder="Vnesi vzdevek igralca" class="form-control" /><br />
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>
<?php 
include_once "footer.php";
?>