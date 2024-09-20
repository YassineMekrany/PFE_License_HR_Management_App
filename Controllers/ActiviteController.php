<?php

require_Once("Controllers/BaseController.php");


function AjouterActiviteAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}	
	$view = "Views/vAjouterActivite.php";
	$id = intval($_SESSION["id"]);
	$Doct = getDoctParId($id);
	$id_encadrant = intval($Doct[0]["id_encadrant"]);
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
	    $type = $_POST["type"];
		$lieu = $_POST["lieu"];
		$id_d = $_POST["id_d"];
		$id_p = $_POST["id_p"];
		$resume = $_POST["resume"];
		$date_act = $_POST["date_act"];

		if(empty($type))    $erreur["type"] ="le Type d'activité ne peut être vide !..."   ;
		if(empty($lieu)) $erreur["lieu"]= "Lieu ne peut être vide!...";
		if(empty($resume)) $erreur["resume"]= "Resumé ne peut être vide!...";
		if(empty($date_act) or $date_act > Date("Y-m-d H:i:s")) $erreur["date_act"]= "La date est invalide!...";

		if (!isset($erreur)) {
			$id_act = ajouterActivite($type, $lieu, $id_d, $id_p, $resume, $date_act);
			
			$notification = "Votre doctorant ".$Doct[0]["nom"]." ".$Doct[0]["prenom"]." a ajouté une activité.";
			envoyerNotification($id_d, $id_encadrant, $notification, "doctorants", "professeurs", "activite", $id_act);
			header("location: index.php?action=EspaceDoct");
		}	
	}
	$variabls = ["id"=>$_SESSION["id"] ?? "",
	             "id_encadrant"=>$id_encadrant ?? "",
				 "type"=>$type ?? "",
				 "lieu"=>$lieu ?? "",
				 "resume"=>$resume ?? "",
				 "date_act"=> $date_act ?? "",
				 "erreur"=> $erreur ?? ""	
				];	
	renderDoct($view, $variabls);	
}

function ValiderActAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_act = $_GET["id_act"];
	$sender_id = $_GET["sender_id"];


	$id_d = activiteDoct($id_act)[0]["id_d"];

	$lastIdAdm = lastIdAdm();

	validerActAdm($id_act);

	$notificationDoct = "votre dernière activié a validé.";
	$notificationProf = "activité de votre doctorant a validé.";

	$type = "activite";
	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_act);
	envoyerNotification($lastIdAdm,$id_d, $notificationDoct, "administration", "doctorants", $type,$id_act);

	header("location: index.php?action=EspaceAdm");

}

function ValiderActProfAction(){

	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id_act = $_GET["id_act"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];

	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];


	$lastIdAdm = lastIdAdm();

	validerActProf($id_act);

	$notificationDoct = "Votre encadrant a validé votre dernière activité.";

	$notificationAdm = "Mr : $prof a demandé vous de valider une activité de son doctorant .";

	$type = "activite";
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_act);

	envoyerNotification($receiver_id,$sender_id, $notificationDoct, "professeurs", "doctorants", $type,$id_act);

	header("location: index.php?action=EspaceProf");

}

function RejeterActAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_act = $_GET["id_act"];
	$sender_id = $_GET["sender_id"];

	$id_d = activiteDoct($id_act)[0]["id_d"];

	$lastIdAdm = lastIdAdm();

	rejeterActAdm($id_act);

	$notificationDoct = "votre dernière activité a rejeté.";
	$notificationProf = "votre demande de validation d'activité a rejeté.";

	$type = "activite";

	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_act);
	envoyerNotification($lastIdAdm,$id_d, $notificationDoct, "administration", "doctorants", $type,$id_act);

	header("location: index.php?action=EspaceAdm");

}

function RejeterActProfAction(){

	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id_act = $_GET["id_act"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];

	$lastIdAdm = lastIdAdm();

	rejeterActProf($id_act);

	$notificationDoct = "Votre encadrant a rejeté votre dernière activité.";

	$notificationAdm = "Mr : $prof a rejeté une activité de son doctorant .";

	$type = "activite";
	envoyerNotification($receiver_id,$sender_id, $notificationDoct, "professeurs", "doctorants", $type,$id_act);
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_act);
	
	header("location: index.php?action=EspaceProf");

}