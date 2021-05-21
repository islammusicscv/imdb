<?php
include_once "session.php";

adminOnly();

include_once "db.php";

$id = (int) $_POST['id']; //kateri film urejam
$title = $_POST['title'];
$duration = (int) $_POST['duration'];
$year_release = (int) $_POST['year_release'];
$genres = $_POST['genres'];
$user_id = $_SESSION['user_id'];
$description = $_POST['description'];

//preverim, če je vnešena naslov
if ((!empty($title))) {
    //posodobim film
    $query = "UPDATE movies SET title=?,duration=?,year_release=?,description=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$duration,$year_release,$description,$id]);

    //vse žanre, kateremu film pripada, najprej izbrišem
    $query = "DELETE FROM genres_movies WHERE movie_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    //vnesi žanre
    foreach ($genres as $genre_id) {
        $query = "INSERT INTO genres_movies(genre_id,movie_id) VALUES (?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$genre_id,$id]);
    }

    //preusmeri na seznam vseh filmov
    header("Location: movies.php"); die();
}

//preusmeri nazaj na vnos - nekaj je narobe
header("Location: movie_edit.php?id=$id"); die();
?>