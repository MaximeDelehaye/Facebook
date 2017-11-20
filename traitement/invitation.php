<?php

if(isset($_GET['invitation'])){

	$sql = "SELECT * FROM user WHERE login=?";

	$query = $pdo -> prepare($sql);

	$query -> execute(array($_GET['profil']));

	$line = $query -> fetch();

	$idAmi = $line['id'];


	if($_GET['invitation']=="oui"){

		$sql = "UPDATE lien SET etat='ami' WHERE ( (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?) )";

		$invitation =  $pdo -> prepare($sql);
		$invitation -> execute(array($_SESSION['id'],$idAmi,$idAmi,$_SESSION['id']));

		header("Location: index.php?actionMenu=amis");

	}elseif($_GET['invitation']=="non"){

		$sql = "UPDATE lien SET etat='banni' WHERE ( (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?) )";

		$invitation =  $pdo -> prepare($sql);
		$invitation -> execute(array($_SESSION['id'],$idAmi,$idAmi,$_SESSION['id']));

		header("Location: index.php?actionMenu=amis");

	}

}

if(isset($_GET['demande'])){

	$idAmi = $_GET['idProfil'];

	if($_GET['demande']=="oui"){

		$sql = "INSERT INTO lien VALUES(NULL,?,?,'attente')";

		$invitation =  $pdo -> prepare($sql);
		$invitation -> execute(array($_SESSION['id'],$idAmi));

		header("Location: index.php?actionMenu=profil&id=$idAmi");

	}elseif($_GET['demande']=="non"){

		$sql = "INSERT INTO lien VALUES(NULL,?,?,'banni')";

		$invitation =  $pdo -> prepare($sql);
		$invitation -> execute(array($_SESSION['id'],$idAmi));

		header("Location: index.php?actionMenu=profil&id=$idAmi");

	}
}






?>
