<?php

require_Once("Controllers/BaseController.php");


function AjouterPublicationAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}	
	$view = "Views/vAjouterPublication.php";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$titre = $_POST["titre"];
		$rang = $_POST["rang"];
		$id_d = $_POST["id_d"];
		$journal = $_POST["journal"];
		$resume = $_POST["resume"];
		$date_pub = $_POST["date_pub"];
		
		if(empty($titre))    $erreur["titre"] ="le Titre ne peut être vide !..."   ;
		if(empty($rang)) $erreur["rang"]= "Le Rang ne peut être vide!...";
		if(empty($resume)) $erreur["resume"]= "Resumé ne peut être vide!...";
		if(empty($journal)) $erreur["journal"]= "Journal ne peut être vide!...";

		if (!isset($erreur)) {
			$id_pub = ajouterPublication($titre, $rang, $id_d, $journal, $resume, $date_pub);
		
			foreach(getDoctParId($id_d) as $Doct){
			$sender_id = $Doct["id_d"];
			$receiver_id = $Doct["id_encadrant"];
			$notification = "votre doctorant ".$Doct["nom"]." ".$Doct["prenom"]." a ajouté une publication";
			$sender_type = "doctorants";
			$receiver_type = "professeurs";
			$type = "publication";
			envoyerNotification($sender_id, $receiver_id, $notification, $sender_type, $receiver_type,$type,$id_pub);
			}

			header("location: index.php?action=EspaceDoct");
		}	
	}
	
	$variabls = ["id"=>$_SESSION["id"] ?? "",
				 "titre"=>$titre ?? "",
				 "rang"=>$rang ?? "",
				 "resume"=>$resume ?? "",
				 "journal"=>$journal ?? "",
				 "erreur"=> $erreur ?? ""
				];	
	renderDoct($view, $variabls);	
}

function ValiderPubAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_pub = $_GET["id_pub"];
	$sender_id = $_GET["sender_id"];
	
	
	$id_d = publicationDoct($id_pub)[0]["id_d"];
	
	$lastIdAdm = lastIdAdm();
	
	validerPubAdm($id_pub);
	
	$notificationDoct = "votre dernière publication a validé.";
	$notificationProf = "publication de votre doctorant a validé.";
	
	$type = "publication";
	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_pub);
	envoyerNotification($lastIdAdm,$id_d, $notificationDoct, "administration", "doctorants", $type,$id_pub);

	header("location: index.php?action=EspaceAdm");

}

function ValiderPubProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id_pub = $_GET["id_pub"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	
	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];
	$doct = getDoctParId($sender_id)[0]["nom"]." ".getDoctParId($sender_id)[0]["prennom"];
	
	$lastIdAdm = lastIdAdm();
	
	validerPubProf($id_pub);
	
	$notificationDoct = "Votre encadrant a validé votre dernière publication.";
	
	$notificationAdm = "Mr : $prof a demandé vous de valider une publication de son doctorant .";
	
	$type = "publication";
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_pub);
	
	envoyerNotification($receiver_id,$sender_id, $notificationDoct, "professeurs", "doctorants", $type,$id_pub);

	header("location: index.php?action=EspaceProf");

}

function RejeterPubAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id_pub = $_GET["id_pub"];
	$sender_id = $_GET["sender_id"];
	
	
	$id_d = publicationDoct($id_pub)[0]["id_d"];
	
	$lastIdAdm = lastIdAdm();
	
	rejeterPubAdm($id_pub);
	
	$notificationDoct = "votre dernière publication a rejeté.";
	$notificationProf = "votre demande de validation de publication a rejeté.";
	
	$type = "publication";
	
	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_pub);
	envoyerNotification($lastIdAdm,$id_d, $notificationDoct, "administration", "doctorants", $type,$id_pub);

	header("location: index.php?action=EspaceAdm");

}

function RejeterPubProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id_pub = $_GET["id_pub"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];
	
	$lastIdAdm = lastIdAdm();
	
	rejeterPubProf($id_pub);
	
	$notificationDoct = "Votre encadrant a rejeté votre dernière publication.";
	
	$notificationAdm = "Mr : $prof a rejeté une publication de son doctorant .";
	
	$type = "publication";
	envoyerNotification($receiver_id,$sender_id, $notificationDoct, "professeurs", "doctorants", $type,$id_pub);
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_pub);
	
	header("location: index.php?action=EspaceProf");

}

function ReviserPubAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$view = "Views/vReviserPub.php";

	$id_pub = $_GET["id_pub"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	$publDoct = getPublicationDoctAppr($id_pub);
	$publication_approuvee = publicationDoctAppr($id_pub);
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$Remarque = $_POST["Remarque"];

		if(empty($Remarque))    $erreur["Remarque"] ="Remarque ne peut être vide !..."   ;

		if (!isset($erreur)) {
			$notification = "Votre encadrant a ajouté une remarque sur votre dernière publication</br>".$Remarque;
			$type = "publication";
			envoyerNotification($receiver_id,$sender_id, $notification, "professeurs", "doctorants", $type,$id_pub);
			header("location: index.php?action=EspaceProf");
		}	
	}	
	$variabls = ["Remarque"=>$Remarque ?? "",
				 "id_pub"=>$id_pub ?? "",
				 "sender_id"=>$sender_id ?? "",
				 "receiver_id"=>$receiver_id ?? "",
				 "publDoct"=>$publDoct ?? "",
				 "publication_approuvee"=>$publication_approuvee ?? "",
				 "erreur"=> $erreur ?? ""	
			    ];	
	renderProf($view, $variabls);

}
