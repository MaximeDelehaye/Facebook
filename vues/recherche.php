<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facebook</title>
</head>
<body>
	<h1>Utilisateurs</h1>

<?php

$sql = "SELECT * FROM user WHERE login LIKE '%".$_POST['recherche']."%' ";

	$query = $pdo->prepare($sql);

	$query->execute();

	echo "<ul>";

	while ( $line = $query->fetch() ){
		echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$line['login']."'>".$line['login']."</a></li>";
	}

	echo "</ul>";
?>

</body>
</html>