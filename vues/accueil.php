<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facebook</title>
</head>
<body>
	<?php

		echo "Bonjour ".$_SESSION['login']." ! ";
		echo "<a href='index.php?action=deconnexion'>Deconnexion</a>";

		echo "<nav> <ul>";
		echo "<li><a href='index.php?actionMenu=gestion_profil&profil=".$_SESSION['login']."'>".$_SESSION['login']."</a></li>";
        echo "<li><a href='index.php?actionMenu=mur'>Accueil</a></li>";
        echo "<li><a href='index.php?actionMenu=amis'>Amis</a></li>";
		echo "</ul> </nav>";

    ?>

    <form action ="index.php?actionMenu=recherche" method ="post">
        <input type ="text" name="recherche" value="">
        <input type="submit" value ="Rechercher">
    </form>

    <?php

		if (isset($_GET["actionMenu"])) {
            $actionMenu = $_GET["actionMenu"];
        } else {
        	$actionMenu = "mur";
        }

        if (array_key_exists($actionMenu, $listeDesActions) == false) {
            include("vues/404.php"); 
        } else {
            include($listeDesActions[$actionMenu]); 
        }

        

	?>
</body>
</html>
