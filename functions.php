<?php
/**
Fukcija nam vrača ime in priimek uporabnika glede na id uporabnika
@id - user id
*/
function getUserName($id) {
    require "db.php";
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $user = $stmt->fetch();

    return $user['first_name'].' '.$user['last_name'];
}


/**
Fukcija nam vrača url avatarja uporabnika glede na id uporabnika
@id - user id
*/
function getUserAvatar($id) {
    require "db.php";
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $user = $stmt->fetch();

    if (!empty($user['avatar'])) {
        return $user['avatar'];
    } 
    else {
        return './assets/img/no-avatar.jpg';
    }
}

/**
Funkcija nam vrača timestamp v obliki SLO: dd. mm. yyyy @ hh:mm
@timestamp - timestamp format
*/
function getSloDateTime($timpestamp) {
    return date('j. n. Y @ G:i', strtotime($timpestamp));
}
/**
Funkcija nam vrne podatke o filmu glede na id
*/
function getMovieData($id) {
    require "db.php";
    $query = "SELECT * FROM movies WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
 
    return $stmt->fetch();
}

/**
Funkcija vrne avatar igralca
 */
 function getActorAvatar($id) {
    require "db.php";
    $query = "SELECT * FROM actors_images WHERE actor_id=? ORDER BY date_add ASC LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $result = $stmt->fetch();
    //če igralec nima slike, vrne povezavo do "prazne" slike
    if (!empty($result['url'])) {
        return $result['url'];
    } 
    else {
        return './assets/img/no-avatar.jpg';
    }
 }

?>