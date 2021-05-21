<?php
    include_once "session.php"; 

    adminOnly();

    include_once "db.php";

    $movie_id = (int) $_POST['movie_id'];
    $actors = $_POST['actors'];
    $role = $_POST['role'];

    //vse vloge, najprej izbrišem
    $query = "DELETE FROM roles WHERE movie_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);

    //vnesi vse vloge
    foreach ($actors as $actor_id) {
        //$role_value = ;
        $query = "INSERT INTO roles(actor_id,movie_id,role) VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$actor_id,$movie_id,$role[$actor_id]]);
    }

    header("Location: movie.php?id=$movie_id"); die();
?>