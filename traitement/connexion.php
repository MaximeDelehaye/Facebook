<?php

$sql = "SELECT * FROM user WHERE login=? AND mdp=PASSWORD(?)";

$query = $pdo -> prepare($sql);

$query -> execute(array($_POST['login'],$_POST['password']));

$line = $query -> fetch();

if($line == false){
	include($listeDesActions['identification']);
}else {
	$_SESSION['id'] = $line['id'];
	$_SESSION['login'] = $line['login'];

	header("Location: index.php");
}

?>