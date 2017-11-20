<?php

$id = $_GET['id'];

$sql = "INSERT INTO ecrit VALUES(NULL,?,?,NOW(),?,?,?)";

$query = $pdo -> prepare($sql);

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
$maxsize = 2000000;

$erreur = false;

/*if ($_FILES['image']['error'] > 0){
		$erreur = true;
		$msgErreur="Erreur lors du transfert";
} */

if ($_FILES['image']['size'] > $maxsize){
		$erreur = true;
		$msgErreur = "Le fichier est trop volumineux";
} 

if($erreur == false){

	if ( in_array($extension_upload,$extensions_valides) ) {

		$query -> execute(array($_POST['titre'],$_POST['publication'],$_FILES["image"]["name"],$_SESSION['id'],$id));

		$tmp_name = $_FILES["image"]["tmp_name"];

		$name = $_FILES["image"]["name"];

		move_uploaded_file($tmp_name,"img/$id/$name");;

	} else if(empty($_FILES["image"]["name"])){

		$query -> execute(array($_POST['titre'],$_POST['publication'],NULL,$_SESSION['id'],$id));
	
	}else {  
		$erreur=true;                                                         
		$msgErreur = "Ce n est pas une image";
	}
}

if($erreur==true){
	header("Location: index.php?actionMenu=profil&id=$id&erreur=$msgErreur"); 
} else if ($erreur==false){
	header("Location: index.php?actionMenu=profil&id=$id");	
}


?>