<?php
include_once "session.php";
include_once "db.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$nick = $_POST['nick'];
$id = (int) $_POST['id'];

//preverim, če sta vnešena ime, priimek in id
if ((!empty($first_name)) && (!empty($last_name)) && (!empty($id))) {
    $query = "UPDATE actors SET first_name=?, last_name=?, nick=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name,$last_name,$nick,$id]);

    //preusmeri na seznam vseh žanrov
    header("Location: actors.php"); die();
}

//preusmeri nazaj na vnos - nekaj je narobe
header("Location: actor_edit.php?id=$id"); die();
?>