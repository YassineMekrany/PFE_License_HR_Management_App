<?php

require_Once("Controllers/BaseController.php");


function MesNotificationsAction(){
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vMesNotifications.php";

	$receiver_id = $_GET['receiver_id'];
	$receiver_type = $_GET['receiver_type'];
	
	$Notifications = get5Notifications($receiver_id, $receiver_type);
	$AllNotifications = getNotifications($receiver_id, $receiver_type);
	$lireNotifications = lireNotifications($receiver_id, $receiver_type);

	$variabls = ["receiver_id" => $receiver_id,
				 "receiver_type" => $receiver_type,
				 "Notifications" => $Notifications,
				 "AllNotifications" => $AllNotifications,
				 "lireNotifications" => $lireNotifications
				];	
	if ($receiver_type == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($receiver_type == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($receiver_type == "administration") {
		renderAdm($view, $variabls);
	}
}

function AfficherPlusNotificationsAction(){
	if (!isset($_SESSION["id"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vMesToutesNotifications.php";

	$receiver_id = $_GET['receiver_id'];
	$receiver_type = $_GET['receiver_type'];
	
	$Notifications = get5Notifications($receiver_id, $receiver_type);
	$AllNotifications = getNotifications($receiver_id, $receiver_type);
	$lireNotifications = lireNotifications($receiver_id, $receiver_type);

	$variabls = ["receiver_id" => $receiver_id,
				 "receiver_type" => $receiver_type,
				 "Notifications" => $Notifications,
				 "AllNotifications" => $AllNotifications,
				 "lireNotifications" => $lireNotifications
				];	
	if ($receiver_type == "professeurs") {
		renderProf($view, $variabls);
	} elseif ($receiver_type == "doctorants") {
		renderDoct($view, $variabls);
	} elseif ($receiver_type == "administration") {
		renderAdm($view, $variabls);
	}
}