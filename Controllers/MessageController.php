<?php

require_Once("Controllers/BaseController.php");


function RechercherAction(){	
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vRechercher.php";

	$id_sender = $_SESSION['id'];
    $type_sender = $_SESSION['sender_type'];

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
	    $search = $_POST['search'];
		$results = searchByName($search);
	
		$variabls = ["id_sender" => $id_sender,
					 "type_sender" => $type_sender,
					 "results" => $results ?? []
					];	
		if ($_SESSION["sender_type"] == "professeurs") {
			renderProf($view, $variabls);
		} elseif ($_SESSION["sender_type"] == "doctorants") {
			renderDoct($view, $variabls);
		} elseif ($_SESSION["sender_type"] == "administration") {
			renderAdm($view, $variabls);
		}			
	}	
}

function EnvoyerMsgAction(){
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vEnvoyerMsg.php";

	$id_receiver = $_GET['id_receiver'] ?? "";
	$id_sender = $_GET['id_sender'] ?? "";
	$type_receiver = $_GET['type_receiver'] ?? "";
	$type_sender = $_GET['type_sender'] ?? "";

	$id = $_SESSION["id"];
	$sender_type_S = $_SESSION["sender_type"];

	foreach(getProfParId($id_receiver) as $prof)
		$Prof = $prof["nom"]." ".$prof["prenom"];
	foreach(getDoctParId($id_receiver) as $doct)
		$Doct = $doct["nom"]." ".$doct["prenom"];
	foreach(getAdmParId($id_receiver) as $adm)
		$Adm = $adm["nom"]." ".$adm["prenom"]; 


	if ($_SERVER["REQUEST_METHOD"]=="POST") {

		$sender_id = $_POST['sender_id'];
		$receiver_id = $_POST['receiver_id'];
		$message = $_POST['message'];
		$sender_type = $_POST['sender_type'];
		$receiver_type = $_POST['receiver_type'];
	
		envoyerMsg($sender_id, $receiver_id, $message, $sender_type, $receiver_type);
		
		if ($sender_type == "professeurs") {
			header("location: index.php?action=EspaceProf");
			exit();
		} elseif ($sender_type == "doctorants") {
			header("location: index.php?action=EspaceDoct");
			exit();
		} elseif ($sender_type == "administration") {
			header("location: index.php?action=EspaceAdm");
			exit();
		}

	}	

	$variabls = ["Prof" => $Prof ?? "",
				"Doct" => $Doct ?? "",
				"Adm" => $Adm ?? "",
				"id_receiver" => $id_receiver,
				"id_sender" => $id_sender,
				"type_receiver" => $type_receiver,
				"type_sender" => $type_sender
				];	
	if ($type_sender == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($type_sender == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($type_sender == "administration") {
		renderAdm($view, $variabls);
	}
}


function RecevoirMsgAction(){
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vRecevoirMsg.php";

	$receiver_id = $_GET['receiver_id'];
    $receiver_type = $_GET['receiver_type'];
    $messages = get5Msg($receiver_id, $receiver_type);
    $Allmessage = getMsg($receiver_id, $receiver_type);
    $lireMsg = lireMsg($receiver_id, $receiver_type);

	$variabls = [
		"receiver_id" => $receiver_id,
		"receiver_type" => $receiver_type,
		"messages" => $messages,
		"Allmessage" => $Allmessage,
		"lireMsg" => $lireMsg
	];	
	
	if ($receiver_type == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($receiver_type == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($receiver_type == "administration") {
		renderAdm($view, $variabls);
	}
}

function AfficherPlusMsgAction(){
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vRecevoirTousMsg.php";

	$receiver_id = $_GET['receiver_id'];
    $receiver_type = $_GET['receiver_type'];
    $messages = get5Msg($receiver_id, $receiver_type);
    $Allmessage = getMsg($receiver_id, $receiver_type);
    $lireMsg = lireMsg($receiver_id, $receiver_type);

	$variabls = [
		"receiver_id" => $receiver_id,
		"receiver_type" => $receiver_type,
		"messages" => $messages,
		"Allmessage" => $Allmessage,
		"lireMsg" => $lireMsg
	];	
	
	if ($receiver_type == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($receiver_type == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($receiver_type == "administration") {
		renderAdm($view, $variabls);
	}
}