<?php
include_once "session.php";

adminOnly();

include_once "db.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$nick = $_POST['nick'];

//preverim, če sta vnešena ime in priimek
if ((!empty($first_name)) && (!empty($last_name))) {
    $query = "INSERT INTO actors(first_name,last_name,nick) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name,$last_name,$nick]);

    //preusmeri na seznam vseh žanrov
    header("Location: actors.php"); die();
}

//preusmeri nazaj na vnos - nekaj je narobe
header("Location: actor_add.php"); die();
?>