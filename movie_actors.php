<?php
    include_once "header.php";

    adminOnly();
    
    include_once "db.php";
    include_once "functions.php";

    $id = (int) $_GET['id'];

    $movie = getMovieData($id);
    
    $query = "SELECT * FROM roles WHERE movie_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $roles = array();
    $actors = array();
    while ($row = $stmt->fetch()) {
        $actor_id = $row['actor_id'];
        $actors[] = $actor_id;
        //za igralca si zapomnim vlogo
        $roles[$actor_id] = $row['role'];
    }
?>

<h1><?php echo $movie['title'].' ('.$movie['year_release'].')'; ?></h1>

<form action="roles_insert.php" method="post">
    <input type="hidden" name="movie_id" value="<?php echo $id;?>" />
    <?php
        $query = "SELECT * FROM actors";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            //pogledam ali je igralec, ki ga izpisujem v seznamu že sodelujočih igralcev
            if (in_array($row['id'],$actors)) {
                echo '<input type="checkbox" checked="checked" name="actors[]" value="'.$row['id'].'" /> '
                .$row['first_name'].' '.$row['last_name'].'<br />';
                echo '<input type="text" value="'.$roles[$row['id']].'" placeholder="Vnesi ime vloge" name="role['.$row['id'].']" class="form-control" /><br />';
            }
            else {
                echo '<input type="checkbox" name="actors[]" value="'.$row['id'].'" /> '
                .$row['first_name'].' '.$row['last_name'].'<br />';
                echo '<input type="text" placeholder="Vnesi ime vloge" name="role['.$row['id'].']" class="form-control" /><br />';
            }
            echo '<hr />';

        }
    ?>
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>
<?php
    include_once "footer.php";
?>