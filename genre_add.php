<?php 
include_once "header.php";
adminOnly();
?>

<h2>Dodaj žanr</h2>

<form action="genre_insert.php" method="post">
    <input type="text" name="title" placeholder="Vnesi ime žanra" class="form-control" required="required" /><br />
    <input type="text" name="short" placeholder="Vnesi kratico žanra" class="form-control" /><br />
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>
<?php 
include_once "footer.php";
?>