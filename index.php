<?php

include("config/actions.php");
include("config/bdd.php");
session_start();
ob_start(); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facebook</title>
</head>
<body>
	<?php

		if(empty($_SESSION['id'])){
			echo "<nav> <ul>";
			echo "<li><a href='index.php?action=identification'>Se Connecter</a></li>";
            echo "<li><a href='index.php?action=creation_compte'>Créé Un Compte</a></li>";
			echo "</ul> </nav>";
		} else {
			$action="accueil";
		}

		if (isset($_GET["action"])) {
            $action = $_GET["action"];
        } else if(empty($_SESSION['id'])) {
        	$action = "depart";
        }

        if (array_key_exists($action, $listeDesActions) == false) {
            include("vues/404.php"); 
        } else {
            include($listeDesActions[$action]); 
        }

        ob_end_flush();

	?>
</body>
</html>