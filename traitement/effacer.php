<?php
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql = "DELETE FROM ecrit WHERE id=".$_GET['idPublication']." "; 
	$query = $pdo -> prepare($sql);
	$query -> execute();
	header("Location: index.php?actionMenu=profil&id=$id");
} else {
	$sql = "DELETE FROM ecrit WHERE id=".$_GET['idPublication']." "; 
	$query = $pdo -> prepare($sql);
	$query -> execute();
	header("Location: index.php?actionMenu=mur");
}

?>