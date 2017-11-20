<?php

$sql = "INSERT INTO user VALUES(NULL,?,?,PASSWORD(?),?,?)";

$query = $pdo -> prepare($sql);

$query -> execute(array($_POST['login'],$_POST['mail'],$_POST['password'],$_POST['genre'],$_POST['naissance']));

/////////////////////////////////////////////////////////////////////

$sql = "SELECT * FROM user WHERE login=? AND mdp=PASSWORD(?)";

$query = $pdo -> prepare($sql);

$query -> execute(array($_POST['login'],$_POST['password']));

$line = $query -> fetch();

$_SESSION['id'] = $line['id'];
$_SESSION['login'] = $line['login'];

mkdir("img/".$_SESSION['id'].", 0777, true);

header("Location: index.php");
?>