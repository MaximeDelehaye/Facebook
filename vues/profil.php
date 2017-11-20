<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facebook</title>
</head>
<body>

	<?php

		$sql = "SELECT * FROM user WHERE id=?";

		$profilDe = $pdo -> prepare($sql);

		$profilDe-> execute(array($_GET['id']));

		$lineProfilDe = $profilDe -> fetch();

		echo "<h1>Profil de ".$lineProfilDe['login']."</h1>";



		$ok = false;

		if( !isset($_GET["id"]) || $_GET["id"]==$_SESSION["id"] ) {
        	$id = $_SESSION["id"];
        	$ok = true; 
   
 
    		echo "<form action='index.php?action=publication&id=".$id."' enctype='multipart/form-data' method ='post' >";

    ?>

			<input type ="text" name="titre" value="Titre">
			<input type ="text" name="publication" style="width:600px;height:50px;">
			<input type ="file" name="image">
			<input type ="submit">
			</form>

	 <?php

    	}else {
	        $id = $_GET["id"];
	        
	        $sql = "SELECT * FROM lien WHERE etat='ami'
	                AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";

	        $query = $pdo -> prepare($sql);

	        $query -> execute(array($_GET['id'],$_SESSION["id"],$_SESSION["id"],$_GET['id']));

	        if($line = $query -> fetch()){
	        	$ok = true;

	        	echo "<form action ='index.php?action=publication&id=".$id."' enctype='multipart/form-data' method ='post'>";

    ?>

				<input type ="text" name="titre" value="Titre">
				<input type ="text" name="publication" value=" " style="width:600px;height:50px;">
				<input type="file" name="image">
				<input type="submit">
				</form>

	<?php
	        } 

    	}

    	if($ok==false) {
       		 echo "Vous n êtes pas  ami, vous ne pouvez voir son mur !!";  

       		$sql = "SELECT * FROM lien 
	                WHERE ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";

	        $demande = $pdo -> prepare($sql);

	        $demande -> execute(array($_GET['id'],$_SESSION["id"],$_SESSION["id"],$_GET['id']));

	        if( ($line = $demande-> fetch()) == false ){

	        	echo "</br>Voulez vous devenir son ami ?";
	        	echo "<li><a href='index.php?action=invitation&demande=oui&idProfil=".$_GET['id']."'>Oui</a></li>";
				echo "<li><a href='index.php?action=invitation&demande=non&idProfil=".$_GET['id']."'>Non</a></li>";
	        }

       		      
   		} else {
    
   			 $sql = "SELECT * FROM ecrit WHERE idAmi=? order by dateEcrit DESC";

   			 $query = $pdo -> prepare($sql);

			 $query -> execute(array($_GET['id']));

			 while ($line = $query -> fetch()){
			 	echo "<h2>".$line['titre']."</h2>";

			 	if($line['idAuteur']==$_SESSION['id']){
			 		echo "<a href='index.php?action=effacer&idPublication=".$line['id']."&id=".$_GET['id']."'>Effacer</a>";
			 	}

			 	$sql = "SELECT * FROM user WHERE id=".$line['idAuteur'];
			 	$auteur = $pdo -> prepare($sql);
			 	$auteur -> execute();
			 	$lineAuteur = $auteur -> fetch();
			 	echo "Posté par ".$lineAuteur['login']." le ".$line['dateEcrit'];

			 	echo "</br>";

			 	echo $line['contenu'];

			 	echo "</br>";

			 	echo "<img src='img/".$id."/".$line['image']."'> ";
			 }

    	}

    	if( isset($_GET['erreur']) ){

    		$erreur = $_GET['erreur'];
    		echo "<script>alert('$erreur');</script>";
    	}



	?>



</body>
</html>