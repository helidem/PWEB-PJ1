<?php
function create() {
    $errors = false;
	if (count($_POST) > 0) {
        $user_info = array(
            "nom" => $_POST["nom"],
            "pseudo" => $_POST["pseudo"],
            "mdp" => $_POST["mdp"],
            "email" => $_POST["email"],
            "nomE" => $_POST["nomE"],
            "adresseE" => $_POST["adresseE"]
        );
		require ("./model/clientBD.php");
		$errors = valid_registration($user_info);
		if (count($errors) <= 0 && ($id_user = new_user($user_info)) >= 0) {
			$_SESSION['user_info'] = $user_info;
			$_SESSION['user_info']['id'] = $id_user;
			$_SESSION['loggedin'] = 0;
			$nexturl = "index.php?page=accounts&action=accueil";
			header ("Location:" . $nexturl);
			return;
		}
		$errors[] = "Echec de l'inscription. Si aucune autre erreur n'est affichée, c'est probablement une erreur de la base de données.";
	}
    require("./views/accounts/create.php");
}

function accueil() {
	require("views/home/home.php");
}

function connect() {
	$_SESSION['successfulConnection'] = -1;
	if (count($_POST) > 0) {
        $user_info = array(
            "pseudo" => $_POST["pseudo"],
            "mdp" => $_POST["mdp"]
        );
		require ("./model/clientBD.php");
		if (verif_bd($user_info['pseudo'], $user_info['mdp'], $user_info)) {
			$_SESSION['user_info'] = $user_info;
			$_SESSION['user_info']['id'] = $id_user;
			$_SESSION['loggedin'] = 0;
			unset($_SESSION['successfulConnection']);
			$nexturl = "index.php?page=accounts&action=accueil";
			header ("Location:" . $nexturl);
			return;
		}
	}
    require("./views/accounts/connect.php");
}

?>