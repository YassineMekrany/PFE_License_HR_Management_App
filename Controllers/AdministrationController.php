<?php

require_Once("Controllers/BaseController.php");


function loginAdmAction(){
	$view = "Views/vLoginAdm.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$email = $_POST["email"];	
		$pass = $_POST["pass"];		
		$Adm = getAdmParEmail($email);
		$adm = $_POST;
		if(empty($email))    $erreur["email"] ="L'e-mail ne peut être vide !..."   ;
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez votre mail académique!!..."   ;
		if(empty($pass))    $erreur["user"] ="Le mot de passe ne peut être vide !..."   ;
		elseif(!Adm_exists($adm)) $erreur["user"]= "L'adresse email ou mot de passe incorrect!...";

		if (!isset($erreur)) {									
			$_SESSION["emailAdm"] = $_POST["email"];
			$_SESSION["nomAdm"] = $Adm["nom"] ." ".$Adm["prenom"];
			$_SESSION["id"] = $Adm["id_ad"];
			$_SESSION["sender_type"] = "administration";
			header ("location: index.php?action=EspaceAdm");	
		}
	}

	$variabls =["email" => $email  ?? "" ,
				"pass" => $pass ?? "",
			    "erreur"=> $erreur ?? ""
			   ];
	renderIndex($view,$variabls);
}

function EspaceAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vEspaceAdm.php";

	$mesDoct = getDoctParEncadrant($_SESSION["id"]);
	$Prof = findAllProf();
	$_SESSION["id"];
	$variabls =["Prof" => $Prof  ?? "" ,
			"id"=> $_SESSION["id"] ?? ""  
			];
	renderAdm($view,$variabls);	
}

function ApproverMembreAction() {
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
    $view = "Views/vApproverMembre.php";
	$DoctAppr = findAllDoctApprAdm();
    $ProfAppr = findAllProfApprAdm();

    $variables = ["DoctAppr" => $DoctAppr,
				  "ProfAppr" => $ProfAppr
				 ];

    renderAdm($view, $variables);
}

function ChangerPasswordAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vChangerPasswordAdm.php";

	$email = $_SESSION["emailAdm"] ;
	$id = $_SESSION["id"];
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$pass = $_POST["pass"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		$adm = ["email" => $email, "pass" => $pass];

		if(empty($pass)) $erreur["pass"]= "Le mot de passe actuel ne peut être vide!...";
		elseif(!Adm_exists($adm)) $erreur["pass"]= "Le mot de passe actuel incorect!...";
		if(empty($pass1)) $erreur["pass1"]= "Le nouveau mot de passe ne peut être vide!...";
		elseif(strlen($pass1) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($pass2)) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($pass1 != $pass2) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";	

		if (!isset($erreur)) {									
			$newPass = password_hash($pass2,PASSWORD_DEFAULT) ;
			changerPassAdm($newPass,$id);
			header ("location: index.php?action=EspaceAdm");	
		}
	}

	$variabls =["email" => $email,
				"pass" => $pass ?? "",
				"pass1" => $pass1 ?? "",
				"pass2" => $pass2 ?? "",
				"erreur"=> $erreur ?? ""
				];
	renderAdm($view,$variabls);
}

function DeconnexionAdmAction(){
	session_destroy();
	header ("location: index.php?action=loginAdm");
}