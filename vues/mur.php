<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facebook</title>
</head>
<body>
	<h1>Actualité</h1>
	<?php

	    $sql = "SELECT * FROM ecrit WHERE ( idAuteur 
	    			IN ( SELECT idUtilisateur1 FROM lien WHERE etat='ami'AND (idUtilisateur1=? OR  idUtilisateur2=?) ) 
	    			OR idAuteur IN ( SELECT idUtilisateur2 FROM lien WHERE etat='ami'AND (idUtilisateur1=? OR  idUtilisateur2=?) ) )
	    			AND ( idAmi 
	    			IN ( SELECT idUtilisateur1 FROM lien WHERE etat='ami'AND (idUtilisateur1=? OR  idUtilisateur2=?) ) 
	    			OR idAmi IN ( SELECT idUtilisateur2 FROM lien WHERE etat='ami'AND (idUtilisateur1=? OR  idUtilisateur2=?) ) )
	    			ORDER BY dateEcrit DESC";

	    $query = $pdo -> prepare($sql);

		$query -> execute(array($_SESSION["id"],$_SESSION["id"],$_SESSION["id"],$_SESSION["id"],$_SESSION["id"],$_SESSION["id"],$_SESSION["id"],$_SESSION["id"]));

		 while ($line = $query -> fetch()){
			 	echo "<h2>".$line['titre']."</h2>";

			 	if($line['idAuteur']==$_SESSION['id']){
			 		echo "<a href='index.php?action=effacer&idPublication=".$line['id']."'>Effacer</a>";
			 	}

			 	$sql = "SELECT * FROM user WHERE id=".$line['idAuteur'];
			 	$auteur = $pdo -> prepare($sql);
			 	$auteur -> execute();
			 	$lineAuteur = $auteur -> fetch();

			 	$sql = "SELECT * FROM user WHERE id=".$line['idAmi'];
			 	$murAmi = $pdo -> prepare($sql);
			 	$murAmi -> execute();
			 	$lineMurAmi = $murAmi -> fetch();

			 	if ($line['idAmi'] == $line['idAuteur']){

			 		echo "Posté par ".$lineAuteur['login']." le ".$line['dateEcrit'];
			 		echo "</br>";
			 		echo $line['contenu'];
			 		echo "</br>";
			 		echo "<img src='img/".$line['idAmi']."/".$line['image']."'> ";

			 	} else {

			 		echo "Posté par ".$lineAuteur['login']." sur le mur d ".$lineMurAmi['login']." le ".$line['dateEcrit'];
			 		echo "</br>";
			 		echo $line['contenu'];
			 		echo "</br>";
			 		echo "<img src='img/".$line['idAmi']."/".$line['image']."'> ";

			 	}

		}

	
	?>
</body>
</html>