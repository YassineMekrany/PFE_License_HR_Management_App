<?php

require_Once("Controllers/BaseController.php");


function ListeAnnonceAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vListeAnnonce.php";

	$annonce = findAllAnnonce();

	$variabls =["annonce" => $annonce  ?? "" ];
	renderAdm($view,$variabls);
}

function AjouterAnnonceAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vAjouterAnnonce.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {

		$message = $_POST["message"];
		$date_deb = $_POST["date_deb"];
		$date_limite = $_POST["date_limite"];

		if(empty($message))    $erreur["message"] ="Message ne peut être vide !..."   ;
		if(empty($date_deb)) $erreur["date_deb"]= "La Date de début ne peut être vide!...";

		if(empty($date_limite) or $date_limite < Date("Y-m-d H:i:s")) $erreur["date_limite"]= "La date est invalide!...";

		if (!isset($erreur)) {
			$t = [$message,$date_deb,$date_limite];
			ajouterAnnonce($t);
			header("location: index.php?action=ListeAnnonce");
		}
	}

	$variabls =["message" => $message ?? "" ,
				"date_deb" => $date_deb ?? "" ,
				"date_limite" => $date_limite ?? "" ,
				"erreur" => $erreur ?? ""
			    ];
	renderAdm($view,$variabls);
}

function DeleteAnnonceAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	DeleteAnnonce($id);
	header ("location: index.php?action=ListeAnnonce");
}

function ModifierAnnonceAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}

	$view = "Views/vModifierAnnonce.php";

	

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$message = $_POST["message"];
		$date_deb = $_POST["date_deb"];
		$date_limite = $_POST["date_limite"];
		$Activer = intval($_POST["Activer"]);
		$id = $_POST["id"];

		if(empty($message))    $erreur["message"] ="Message ne peut être vide !..."   ;
		if(empty($date_deb)) $erreur["date_deb"]= "La Date de début ne peut être vide!...";
		if(empty($date_limite) or $date_limite < Date("Y-m-d H:i:s")) $erreur["date_limite"]= "La date est invalide!...";

		if (!isset($erreur)) {
			modifierAnnonce($message, $date_deb,$date_limite,$Activer, $id);
			header("location: index.php?action=ListeAnnonce");
		}
	}

	else{
		$id = $_GET["id"] ?? "";
		$Annonce = getAnnonceParId($id);
		foreach($Annonce as $A){
			$message = $A["message"];
			$date_deb = $A["date_deb"];
			$date_limite = $A["date_lim"];
			$Activer = $A["Activer"];
		}
		$erreur = [] ;
	}

	$variabls =["id" => $id ?? "" ,
				"message" => $message ?? "" ,
				"date_deb" => $date_deb ?? "" ,
				"date_limite" => $date_limite ?? "" ,
				"Activer" => $Activer ,
				"erreur" => $erreur ?? ""
			    ];
	renderAdm($view,$variabls);
}

function TouteAnnonceAction(){
	$view = "Views/vIndexTtAnnonce.php";
	$variabls = ["Doct" => count(getAll("doctorants")) ,"Prof" => count(getAll("professeurs")) ,"Pub" => count(getAll("publication")) ,"getDernNews" => get5DernNews(),"AllAnnonce"=>findAllAnnonce()] ;	
	renderIndex($view, $variabls);
}