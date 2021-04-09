<?php
include_once "header.php";
?>

<h3>Prijava</h3>

<form action="login_check.php" method="post">
    <input type="email" name="email" placeholer="Vnesi e-pošto" requried="requried" /><br />
    <input type="password" name="pass" placeholer="Vnesi geslo" requried="requried" /><br />
    <input type="submit" value="Prijava" />
</form>

<?php
include_once "footer.php";
?>