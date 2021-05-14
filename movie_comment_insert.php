<?php
include_once "session.php";
include_once "db.php";

$id = (int) $_POST['id'];
$content =  $_POST['content'];
$user_id = $_SESSION['user_id'];
//preverim, da je vsebina v komentarju
if (!empty($content)) {
    $query = "INSERT INTO comments(content,movie_id,user_id) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$content,$id,$user_id]);
}

header("Location: movie.php?id=$id#komentar-sidro")

?>