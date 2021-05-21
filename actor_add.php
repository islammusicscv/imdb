<?php 
include_once "header.php";

adminOnly();

?>

<h2>Dodaj igralca</h2>

<form action="actor_insert.php" method="post">
    <input type="text" name="first_name" placeholder="Vnesi ime igralca" class="form-control" required="required" /><br />
    <input type="text" name="last_name" placeholder="Vnesi priimek igralca" class="form-control" required="required" /><br />
    <input type="text" name="nick" placeholder="Vnesi vzdevek igralca" class="form-control" /><br />
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>
<?php 
include_once "footer.php";
?>