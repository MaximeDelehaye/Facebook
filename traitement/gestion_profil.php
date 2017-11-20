<?php

$sql = "SELECT * FROM user WHERE login=?";

$query = $pdo -> prepare($sql);

$query -> execute(array($_GET['profil']));

$line = $query -> fetch();

$id = $line['id'];

header("Location: index.php?actionMenu=profil&id=$id");


?>