<?php
    include_once "session.php"; 
    include_once "db.php";

    $movie_id = (int) $_POST['movie_id'];
    $actors = $_POST['actors'];

    //vse vloge, najprej izbrišem
    $query = "DELETE FROM roles WHERE movie_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$move_id]);

    //vnesi vse vloge
    foreach ($actors as $actor_id) {
        $role = $_POST["role[$actor_id]"];
        $query = "INSERT INTO roles(actor_id,movie_id,role) VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$actor_id,$movie_id,$role]);
    }

    header("Location: movie.php?id=$movie_id"); die();
?>