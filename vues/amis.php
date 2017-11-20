<h2>Liste des Amis</h2>

<?php
 	$sql = "SELECT * FROM lien WHERE etat='ami' "; 

	$query = $pdo -> prepare($sql);

	$query -> execute();

	echo "<ul>";

	while($line = $query -> fetch()){

		if($line['idUtilisateur1'] == $_SESSION['id'] ){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur2']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";
	            
		} else if($line['idUtilisateur2'] == $_SESSION['id']){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur1']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";
	                
		}

	}

	echo "</ul>";
?>

<h2>En Attente</h2>

<?php
 	$sql = "SELECT * FROM lien WHERE etat='attente' ";

	$query = $pdo -> prepare($sql);

	$query -> execute();

	echo "<ul>";

	while($line = $query -> fetch()){

		if($line['idUtilisateur1'] == $_SESSION['id']){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur2']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";
	            
		} else if($line['idUtilisateur2'] == $_SESSION['id']){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur1']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";  
			echo "<li><a href='index.php?action=invitation&invitation=oui&profil=".$lineAmi['login']."'>Oui</a></li>";
			echo "<li><a href='index.php?action=invitation&invitation=non&profil=".$lineAmi['login']."'>Non</a></li>";  
		}

	}

	echo "</ul>";
?>

<h2>Bannis</h2>

<?php
 	$sql = "SELECT * FROM lien WHERE etat='banni' ";

	$query = $pdo -> prepare($sql);

	$query -> execute();

	echo "<ul>";

	while($line = $query -> fetch()){

		if($line['idUtilisateur1'] == $_SESSION['id']){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur2']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";
	            
		} else if($line['idUtilisateur2'] == $_SESSION['id']){

			$sql = "SELECT * FROM user WHERE id='".$line['idUtilisateur1']."' ";
			$ami =  $pdo -> prepare($sql);
			$ami -> execute();
			$lineAmi = $ami -> fetch();

			echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$lineAmi['login']."'>".$lineAmi['login']."</a></li>";    
		}

	}

	echo "</ul>";
?>