<?php

require_Once("Controllers/BaseController.php");


function AjouterOrganisationAction(){	
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$view = "Views/vAjouterOrganisation.php";

	$Prof = getAll("professeurs");
	$Doct = getAll("doctorants");

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$sujet = $_POST["sujet"];
		$lieu = $_POST["lieu"];
		$ids_p = isset($_POST["ids_p"]) ? $_POST["ids_p"] : [];
		$ids_d = isset($_POST["ids_d"]) ? $_POST["ids_d"] : [];
		$date_org = $_POST["date_org"];

		if(empty($sujet))    $erreur["sujet"] ="Sujet ne peut être vide !..."   ;
		if(empty($lieu)) $erreur["lieu"]= "Lieu ne peut être vide!...";
		if(!isset($_POST["ids_p"])) $erreur["ids_p"]= "Il faut au moin invité un professeur!...";
		if(!isset($_POST["ids_d"])) $erreur["ids_d"]= "Il faut au moin invité un doctorant!...";
		if(empty($date_org) or $date_org < Date("Y-m-d H:i:s")) $erreur["date_org"]= "La date est invalide!...";

		if (!isset($erreur)) {
			$id_org = ajouterOrganisation($sujet, $ids_p, $ids_d, $date_org, $lieu);
		
			$sender_id = $_SESSION["id"];
			$receiver_id = lastIdAdm();
			$notification = "Mr ".$_SESSION["nomProf"]." a vous invité de valider une Organisation qui sera le ".$date_org." à ".$lieu;
			$receiver_type = "administration";
			$sender_type = "professeurs";
			$type = "organisation";
			envoyerNotification($sender_id, $receiver_id, $notification, $sender_type, $receiver_type,$type,$id_org);

			header("location: index.php?action=EspaceProf");
		}	
	}
	
	$variabls = ["Prof"=>$Prof,
				 "Doct"=>$Doct,
				 "sujet"=>$sujet ?? "",
				 "lieu"=>$lieu ?? "",
				 "date_org"=>$date_org ?? "",
				 "ids_p"=>$ids_p ?? [],
				 "ids_d"=>$ids_d ?? [],
				 "erreur"=> $erreur ?? ""
				];	
	renderProf($view, $variabls);	
}

function ValiderOrgAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_org = $_GET["id_org"];
	$sender_id = $_GET["sender_id"];

	$organisation = getOrganisation($id_org);

	$prof = getProfParId($sender_id);

	$lastIdAdm = lastIdAdm();

	validerOrgAdm($id_org);

	foreach($organisation as $org){

		foreach(json_decode($org["ids_d"]) as $id_d){
			$id_d = intval($id_d);
			$sender_id = $lastIdAdm;
			$receiver_id = $id_d;
			$notification = "Mr ".$prof[0]["nom"]." ".$prof[0]["prenom"]." a vous invité à participer une Organisation le ".$org["date_org"]." à ".$org["lieu"];
			$receiver_type = "doctorants";
			$sender_type = "administration";
			$type = "organisation";
			envoyerNotification($sender_id, $receiver_id, $notification, $sender_type, $receiver_type,$type,$id_org);
		}
		
		foreach(json_decode($org["ids_p"]) as $id_p){
			$id_p = intval($id_p);
			$sender_id = $lastIdAdm;
			$receiver_id = $id_p;
			if($prof[0]["id_p"] == $receiver_id){
				$notification = "vous étes ajouté une Organisation le ".$org["date_org"]." à ".$org["lieu"];
			}
			else{
				$notification = "Mr ".$prof[0]["nom"]." ".$prof[0]["prenom"]." a vous invité à participer une Organisation le ".$org["date_org"]." à ".$org["lieu"];
			}
			$receiver_type = "professeurs";
			$sender_type = "administration";
			$type = "organisation";
			envoyerNotification($sender_id, $receiver_id, $notification, $sender_type, $receiver_type,$type,$id_org);
		}

	}

	header("location: index.php?action=EspaceAdm");

}

function RejeterOrgAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_org = $_GET["id_org"];
	$sender_id = $_GET["sender_id"];
	
	$lastIdAdm = lastIdAdm();
	rejeterOrgAdm($id_org);
	
	$notification = "votre dernière organisation a rejeté.";
	
	$type = "organisation";
	
	envoyerNotification($lastIdAdm,$sender_id, $notification, "administration", "professeurs", $type,$id_org);

	header("location: index.php?action=EspaceAdm");

}