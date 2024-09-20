<?php

require_Once("Controllers/BaseController.php");


function loginProfAction(){
	$view = "Views/vLoginProf.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$email = $_POST["email"];	
		$pass = $_POST["pass"];	
		$Prof = getProfParEmail($email);
		$prof = $_POST;
		if(empty($email))    $erreur["email"] ="L'e-mail ne peut être vide !..."   ;
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez votre mail académique!!..."   ;
		if(empty($pass))    $erreur["user"] ="Le mot de passe ne peut être vide !..."   ;
		elseif(!Prof_exists($prof)) $erreur["user"]= "L'adresse email ou mot de passe incorrect!...";
		if (!isset($erreur)) {									
			$_SESSION["emailProf"] = $_POST["email"];
			$_SESSION["nomProf"] = $Prof["nom"] ." ".$Prof["prenom"];
			$_SESSION["id"] = $Prof["id_p"];
			$_SESSION["sender_type"] = "professeurs";
			header ("location: index.php?action=EspaceProf");	
		}
	}

	$variabls =["email" => $email  ?? "" ,
	 			"pass" => $pass ?? "",
				"erreur"=> $erreur ?? ""  
				];
	renderIndex($view,$variabls);
}

function DemandeRejoindreAction(){
	$view = "Views/vDemandeRejoindre.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$prof=$_POST;
		$pass = password_hash($prof["pass2"],PASSWORD_DEFAULT) ;

		if(empty($prof["nom"]))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prof["prenom"])) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($prof["email"])) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($prof["email"]),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($prof["telephone"])) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($prof["specialite"]))    $erreur["specialite"] ="specialité ne peut être vide !..."   ;
		if(empty($prof["pass1"])) $erreur["pass1"]= "Le mot de passe ne peut être vide!...";
		elseif(strlen($prof["pass1"]) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($prof["pass2"])) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($prof["pass1"] != $prof["pass2"]) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";				

		if (!isset($erreur)) {
			$t = [$prof["nom"], $prof["prenom"], $prof["email"],$prof["specialite"], $prof["telephone"],$pass];
			ajouterProfAppr($t);
			header ("location: index.php");
		}	
	}

	$variabls = ["p"=>$prof ?? "",
				 "erreur"=> $erreur ?? ""
				];
	renderIndex($view,$variabls);
}

function AccepterProfAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = intval($_GET["id"]);	
	AccepterProfAppr();
	RejeterProfAppr($id);
	header ("location: index.php?action=EspaceAdm");		
}

function RejeterProfAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	RejeterProfAppr($id);
	header ("location: index.php?action=EspaceAdm");
}

function DetailProfApprAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vDetailProfAppr.php";

	$id = intval($_GET['id']);
	$ProfAppr = getProfApprParId($id);

	$variabls =["id"=> $id ,
				"ProfAppr"=>$ProfAppr
			   ];
	renderAdm($view,$variabls);
}

function EspaceProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}

	$Prof = $_SESSION["nomProf"];
	$mesDoct = getDoctParEncadrant($_SESSION["id"]);
	$view = "Views/vEspaceProf.php";
	$variabls =["Prof" => $Prof  ?? "" ,
			"mesDoct"=> $mesDoct ?? ""  
			];
	renderProf($view,$variabls);	
}

function ChangerPasswordProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}

	$view = "Views/vChangerPasswordProf.php";

	$email = $_SESSION["emailProf"] ;
	$id = $_SESSION["id"];
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$pass = $_POST["pass"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		$prof = ["email" => $email, "pass" => $pass];

		if(empty($pass)) $erreur["pass"]= "Le mot de passe actuel ne peut être vide!...";
		elseif(!Prof_exists($prof)) $erreur["pass"]= "Le mot de passe actuel incorect!...";
		if(empty($pass1)) $erreur["pass1"]= "Le nouveau mot de passe ne peut être vide!...";
		elseif(strlen($pass1) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($pass2)) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($pass1 != $pass2) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";	

		if (!isset($erreur)) {									
			$newPass = password_hash($pass2,PASSWORD_DEFAULT) ;
			changerPassProf($newPass,$id);
			header ("location: index.php?action=EspaceProf");	
		}
	}

	$variabls =["email" => $email,
				"pass" => $pass ?? "",
				"pass1" => $pass1 ?? "",
				"pass2" => $pass2 ?? "",
				"erreur"=> $erreur ?? ""
				];
	renderProf($view,$variabls);
}

function DeconnexionProfAction(){
	session_destroy();
	header ("location: index.php?action=loginProf");
}

function AjouterProfAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vAjouterProf.php";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$prof=$_POST;
		$pass = password_hash($prof["pass2"],PASSWORD_DEFAULT) ;

		if(empty($prof["nom"]))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prof["prenom"])) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($prof["email"])) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($prof["email"]),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($prof["telephone"])) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($prof["specialite"]))    $erreur["specialite"] ="specialité ne peut être vide !..."   ;
		if(empty($prof["pass1"])) $erreur["pass1"]= "Le mot de passe ne peut être vide!...";
		elseif(strlen($prof["pass1"]) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($prof["pass2"])) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($prof["pass1"] != $prof["pass2"]) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";				

		if (!isset($erreur)) {
			$t = [$prof["nom"], $prof["prenom"], $prof["email"],$prof["specialite"], $prof["telephone"],$pass];
			ajouterProf($t);
			header ("location: index.php?action=EspaceAdm");
		}	
	}

	$variabls = ["p"=>$prof ?? "",
				 "erreur"=> $erreur ?? ""
				];	
					
	renderAdm($view, $variabls);
}

function ModifierProfAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vModifierProf.php";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$Professeur = $nom." ".$prenom;
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$specialite = $_POST["specialite"];
		$id = $_POST["id"];

		if(empty($nom))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prenom)) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($email)) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($telephone)) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($specialite))    $erreur["specialite"] ="specialité ne peut être vide !..."   ;	

		if (!isset($erreur)) {
			modifierProf($nom, $prenom, $email, $telephone, $specialite, $id);
			header ("location: index.php?action=EspaceAdm");
		}	
	}
	else{	
		$id = $_GET["id"] ?? "";
		$prof = getProfParId($id);
		foreach($prof as $p){
			$nom = $p["nom"];
			$prenom = $p["prenom"];
			$Professeur = $nom." ".$prenom;
			$email = $p["email"];
			$telephone = $p["telephone"];
			$specialite = $p["specialite"];
		}
		$erreur = [] ;
	}

	$variabls = ["Professeur" => $Professeur ?? "",
				 "nom"=>$nom ?? "",
				 "prenom"=>$prenom ?? "",
				 "email"=>$email ?? "",
				 "telephone"=>$telephone ?? "",
				 "specialite"=>$specialite ?? "",	
				 "id"=>$id ?? "",	
				 "erreur"=> $erreur ?? []
				];					
	renderAdm($view, $variabls);
}

function SupprimerProfAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	deleteProf($id);
	header ("location: index.php?action=EspaceAdm");
}