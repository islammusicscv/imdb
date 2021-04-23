<?php
include_once "session.php";
include_once "db.php";

$id = (int) $_GET['id'];

$query = "DELETE FROM movies WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

header("Location: movies.php"); die();

?>