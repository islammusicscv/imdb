<?php
include_once "session.php";
include_once "db.php";
include_once "functions.php";

$user_id = $_SESSION['user_id'];
$id = (int) $_POST['movie_id'];
$rate = (int) $_POST['star'];

if (canUserRateMovie($user_id,$id)) {
    $query = "INSERT INTO rates(user_id,movie_id,rate) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id,$id,$rate]);

    //pridobim povprečno vrednost ocen za film
    $query = "SELECT AVG(rate) as avg FROM rates WHERE movie_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $r = $stmt->fetch();
    $avg = $r['avg'];

    //posodobim film povprečje
    $query = "UPDATE movies SET rate=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$avg,$id]);
}

header("Location: movie.php?id=$id"); die();

?>