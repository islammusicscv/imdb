<?php
include_once "session.php";
include_once "db.php";
include_once "functions.php";

$id = (int) $_GET['id'];

//dobim za kateri film je bil ta komentar
$query = "SELECT * FROM comments WHERE id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$result = $stmt->fetch();
$movie_id = $result['movie_id'];


if (canCurrentUserDeleteComent($id)) {
    $query = "DELETE FROM comments WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
} 

header("Location: movie.php?id=$movie_id#komentar-sidro"); die();

?>