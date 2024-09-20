<?php
try {
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	require ("Controllers/IndexController.php");
	require ("Controllers/DoctorantController.php");
	require ("Controllers/ProfesseurController.php");
	require ("Controllers/AdministrationController.php");
	require ("Controllers/PublicationController.php");
	require ("Controllers/ActiviteController.php");
	require ("Controllers/OrganisationController.php");
	require ("Controllers/MessageController.php");
	require ("Controllers/NotificationController.php");
	require ("Controllers/AnnonceController.php");

	$action = $_GET["action"] ?? "index" ;
	$action = $action . "Action" ;

	if (!is_callable($action))
		throw new Exception ("Cette action n'est pas authorisée");
	$action () ;
}
catch(Exception $e) {
	//die ("Une erreur est survenue " . $e->getMessage());
	$view = "Views/vError.php";
	$variabls = [ "message" => $e->getMessage() ] ;
	if ($_SESSION["sender_type"] == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($_SESSION["sender_type"] == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($_SESSION["sender_type"] == "administration") {
		renderAdm($view, $variabls);
	}
	else{
		renderIndex($view, $variabls);
	}
}