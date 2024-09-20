<?php

require_Once("Controllers/BaseController.php");


function loginDoctAction(){
	$view = "Views/vLoginDoct.php";

	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$email = $_POST["email"];	
		$pass = $_POST["pass"];	
		$doct = $_POST;	
		$Doct = getDoctParEmail($email);
		if(empty($email))    $erreur["email"] ="L'e-mail ne peut être vide !..."   ;
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez votre mail académique!!..."   ;
		if(empty($pass))    $erreur["user"] ="Le mot de passe ne peut être vide !..."   ;
		elseif(!Doct_exists($doct)) $erreur["user"]= "L'adresse email ou mot de passe incorrect!...";
		if (!isset($erreur)) {									
			
			$_SESSION["emailDoct"] = $_POST["email"];
			$_SESSION["nomDoct"] = $Doct["nom"] ." ".$Doct["prenom"];
			$_SESSION["id"] = $Doct["id_d"];
			$_SESSION["sender_type"] = "doctorants";
			header ("location: index.php?action=EspaceDoct");	
		}
	}

	$variabls =["email" => $email  ?? "" ,
				"pass" => $pass ?? "" ,
				"erreur"=> $erreur ?? ""
				];
	renderIndex($view,$variabls);
}

function PreinscriptionAction(){
	$view = "Views/vPreinscription.php";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$sujet = $_POST["sujet"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		$pass = password_hash($pass2,PASSWORD_DEFAULT) ;
		$id_encadrant = $_POST["id_encadrant"];
		$CNE = $_POST["CNE"];

		if(empty($nom))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prenom)) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($email)) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez votre mail académique!!..."   ;
		if(empty($telephone)) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($sujet))    $erreur["sujet"] ="le sujet ne peut être vide !..."   ;
		if(empty($id_encadrant))    $erreur["encadrant"] ="L'encadrant ne peut être vide !..."   ;
		if(empty($pass1)) $erreur["pass1"]= "Le mot de passe ne peut être vide!...";
		elseif(strlen($pass1) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($pass2)) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($pass1 != $pass2) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";		
		if(empty($CNE)) $erreur["CNE"]= "CNE ne peut être vide!...";		

		if (!isset($erreur)) {
			$t = [$nom,$prenom,$email,$id_encadrant,$sujet,$telephone,$CNE,$pass];
			ajouterDoctAppr($t);
			header("location: index.php");
		}	
	}

	$prof = findAllProf();
	$variabls = ["prof" => findAllProf() ?? "",
				 "nom"=>$nom ?? "",
				 "prenom"=>$prenom ?? "",
				 "email"=>$email ?? "",
				 "telephone"=>$telephone ?? "",
				 "sujet"=>$sujet ?? "",
				 "pass1"=>$pass1 ?? "",
				 "pass2"=>$pass2 ?? "",
				 "id_encadrant"=>$id_encadrant ?? "",
				 "CNE"=>$CNE ?? "",	
				 "erreur"=> $erreur ?? ""
				];
					
	renderIndex($view, $variabls);
}

function ReinscriptionAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vReinscription.php";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$Doctorant = $nom." ".$prenom;
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$sujet = $_POST["sujet"];
		$id_encadrant = $_POST["id_encadrant"];
		$CNE = $_POST["CNE"];
		$id = $_POST["id"];

		if(empty($nom))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prenom)) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($email)) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($telephone)) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($sujet))    $erreur["sujet"] ="le sujet ne peut être vide !..."   ;
		if(empty($id_encadrant))    $erreur["encadrant"] ="L'encadrant ne peut être vide !..."   ;	
		if(empty($CNE)) $erreur["CNE"]= "CNE ne peut être vide!...";	

		if (!isset($erreur)) {
			modifierDoct($nom, $prenom, $email, $id_encadrant,$sujet, $telephone, $CNE, $id);
			$notification = "votre doctorant ".$nom." ".$prenom." a faire une Réinsciption";
			$sender_type = "doctorants";
			$receiver_type = "professeurs";
			$type = "reinscription";
			envoyerNotification($id, $id_encadrant, $notification, $sender_type, $receiver_type,$type,$id);
			header ("location: index.php?action=EspaceDoct");
		}	
	}
	else{
		$id = $_SESSION["id"] ?? "";
		$Doct = getDoctParId($id);
		foreach($Doct as $d){
			$nom = $d["nom"];
			$prenom = $d["prenom"];
			$Doctorant = $nom." ".$prenom;
			$email = $d["email"];
			$telephone = $d["telephone"];
			$sujet = $d["sujet"];
			$id_encadrant = $d["id_encadrant"];
			$CNE = $d["CNE"];
		}
		$erreur = [] ;
	}

	$variabls = ["prof" => findAllProf() ?? "",
				 "Doctorant" => $Doctorant ?? "",
				 "nom"=>$nom ?? "",
				 "prenom"=>$prenom ?? "",
				 "email"=>$email ?? "",
				 "telephone"=>$telephone ?? "",
				 "sujet"=>$sujet ?? "",
				 "id_encadrant"=>$id_encadrant ?? "",
				 "CNE"=>$CNE ?? "",	
				 "id"=>$id ?? "",
				 "erreur"=> $erreur ?? ""
				];					
	renderDoct($view, $variabls);
}

function ValiderReinscriptionProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id = $_GET["id"];
	$id_d = $_GET["id_d"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	
	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];
	$doct = getDoctParId($sender_id)[0]["nom"]." ".getDoctParId($sender_id)[0]["prennom"];
	
	$lastIdAdm = lastIdAdm();
	
	$notificationDoct = "Votre encadrant a validé votre Réinscription.";
	
	$notificationAdm = "Mr : $prof a demandé vous de valider la Réinscription de son doctorant .";
	
	$type = "reinscription";
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_d);
	
	envoyerNotification($receiver_id,$sender_id, $notificationDoct, "professeurs", "doctorants","Autre",$id_d);

	deleteNotification($id);

	header("location: index.php?action=EspaceProf");

}

function RejeterReinscriptionProfAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id = $_GET["id"];
	$id_d = $_GET["id_d"];
	$sender_id = $_GET["sender_id"];
	$receiver_id = $_GET["receiver_id"];
	$prof = getProfParId($receiver_id)[0]["nom"]." ".getProfParId($receiver_id)[0]["prenom"];
	
	$lastIdAdm = lastIdAdm();
	
	$notificationAdm = "Mr : $prof a rejeté une Réinscription de son doctorant .";
	
	$type = "Autre";
	envoyerNotification($receiver_id,$lastIdAdm, $notificationAdm, "professeurs", "administration", $type,$id_d);
	deleteDoct($id_d);
	deleteNotification($id);

	header("location: index.php?action=EspaceProf");

}

function ValiderReinscriptionAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	$id_d = $_GET["id_d"];
	$sender_id = $_GET["sender_id"];
	
	$lastIdAdm = lastIdAdm();
	
	$notificationDoct = "votre Réinscription a validé.";
	$notificationProf = " La Réinscription de votre doctorant a validé.";
	
	$type = "Autre";
	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_d);
	envoyerNotification($lastIdAdm,$id_d, $notificationDoct, "administration", "doctorants", $type,$id_d);
	deleteNotification($id);
	header("location: index.php?action=EspaceAdm");

}

function RejeterReinscriptionAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	$id_d = $_GET["id_d"];
	$sender_id = $_GET["sender_id"];
	
	$lastIdAdm = lastIdAdm();

	$notificationProf = "votre demande de validation de Réinscription a rejeté.";
	
	$type = "Autre";
	
	envoyerNotification($lastIdAdm,$sender_id, $notificationProf, "administration", "professeurs", $type,$id_d);
	deleteNotification($id);
	deleteDoct($id_d);
	header("location: index.php?action=EspaceAdm");

}

function EspaceDoctAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vEspaceDoct.php";
	$id = $_SESSION["id"];
	$actDoct = Get3ActiviteDoct($id);
	$publDoct = get3publicationParDoct($id);
	$nbrePublicationParDoct = nbrePublicationParDoct($id);
	$nbreActParDoct = nbreActParDoct($id);
	$variabls =["id" => $id  ?? "" ,
			"actDoct"=> $actDoct ?? "",
			"publDoct" => $publDoct  ?? "" ,
			"nbrePublicationParDoct"=> $nbrePublicationParDoct ?? "",
			"nbreActParDoct"=> $nbreActParDoct ?? ""
			];
	renderDoct($view,$variabls);	
}

function MesDoctApprAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$view = "Views/vMesDoctAppr.php";

	$id = intval($_GET['id']);
	$mesDoctAppr = getDoctApprParEncadrant($id);
	$variabls =["id"=> $id ,
				"mesDoctAppr"=>$mesDoctAppr
			   ];
	renderProf($view,$variabls);
}

function AccepterDoctApprAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id = $_GET["id"];	
	AccepterDoctApprProf($id);
	header ("location: index.php?action=EspaceProf");		
}

function AccepterDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];	
	AccepterDoctApprAdm();
	RejeterDoctAppr($id);
	header ("location: index.php?action=EspaceAdm");		
}

function RejeterDoctApprAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$id = $_GET["id"];
	RejeterDoctAppr($id);
	header ("location: index.php?action=EspaceProf");	

}

function RejeterDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	RejeterDoctAppr($id);
	header ("location: index.php?action=EspaceAdm");
}

function DetailDoctApprAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$view = "Views/vDetailDoctAppr.php";

	$id = intval($_GET['id']);
	$DoctAppr = getDoctApprParId($id);

	$variabls =["id"=> $id ,
				"DoctAppr"=>$DoctAppr
			   ];
	renderProf($view,$variabls);	

}

function SesDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vSesDoct.php";
	$id = intval($_GET['id']);
	$sesDoct = getDoctParEncadrant($id);
	$encadrant = getProfParId($id)[0]["nom"]." ".getProfParId($id)[0]["prenom"];
	$variabls =["sesDoct" => $sesDoct  ?? "" ,
			"id"=> $_SESSION["id"] ?? "" ,
			"encadrant" => $encadrant
			];
	renderAdm($view,$variabls);
}

function DetailDoctApprAdmAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vDetailDoctApprAdm.php";

	$id = intval($_GET['id']);
	$DoctAppr = getDoctApprParId($id);

	$variabls =["id"=> $id ,
				"DoctAppr"=>$DoctAppr
			   ];
	renderAdm($view,$variabls);
}

function ChangerPasswordDoctAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vChangerPasswordDoct.php";

	$email = $_SESSION["emailDoct"] ?? "";
	$id = $_SESSION["id"];
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$pass = $_POST["pass"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		$doct = ["email" => $email, "pass" => $pass];
		$Doct = getDoctParEmail($email);

		if(empty($pass)) $erreur["pass"]= "Le mot de passe actuel ne peut être vide!...";
		elseif(!Doct_exists($doct)) $erreur["pass"]= "Le mot de passe actuel incorect!...";
		if(empty($pass1)) $erreur["pass1"]= "Le nouveau mot de passe ne peut être vide!...";
		elseif(strlen($pass1) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($pass2)) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($pass1 != $pass2) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";	

		if (!isset($erreur)) {									
			$newPass = password_hash($pass2,PASSWORD_DEFAULT) ;
			changerPassDoct($newPass,$id);
			header ("location: index.php?action=EspaceDoct");	
		}
	}

	$variabls =["email" => $email ?? "",
				"pass" => $pass ?? "",
				"pass1" => $pass1 ?? "",
				"pass2" => $pass2 ?? "",
				"erreur"=> $erreur ?? ""
				];
	renderDoct($view,$variabls);
}

function DeconnexionDoctAction(){
	session_destroy();
	header ("location: index.php?action=loginDoct");
}

function AjouterDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vAjouterDoct.php";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$sujet = $_POST["sujet"];
		$pass1 = $_POST["pass1"];
		$pass2 = $_POST["pass2"];
		$pass = password_hash($pass2,PASSWORD_DEFAULT) ;
		$id_encadrant = $_POST["id_encadrant"];
		$CNE = $_POST["CNE"];

		if(empty($nom))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prenom)) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($email)) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($telephone)) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($sujet))    $erreur["sujet"] ="le sujet ne peut être vide !..."   ;
		if(empty($id_encadrant))    $erreur["encadrant"] ="L'encadrant ne peut être vide !..."   ;
		if(empty($pass1)) $erreur["pass1"]= "Le mot de passe ne peut être vide!...";
		elseif(strlen($pass1) < 4) $erreur["pass1"]= "Le mot de passe doit contenir au moin 4 caractères!...";
		if(empty($pass2)) $erreur["pass2"]= "Il faut confirmer votre mot de passe!...";
		elseif($pass1 != $pass2) $erreur["pass2"]= "Les deux mots de passe ne sont pas identiques!...";		
		if(empty($CNE)) $erreur["CNE"]= "CNE ne peut être vide!...";		

		if (!isset($erreur)) {
			$t = [$nom,$prenom,$email,$id_encadrant,$sujet,$telephone,$CNE,$pass];
			ajouterDoct($t);
			header ("location: index.php?action=EspaceAdm");
		}	
	}

	$variabls = ["prof" => findAllProf() ?? "",
				 "nom"=>$nom ?? "",
				 "prenom"=>$prenom ?? "",
				 "email"=>$email ?? "",
				 "telephone"=>$telephone ?? "",
				 "sujet"=>$sujet ?? "",
				 "pass1"=>$pass1 ?? "",
				 "pass2"=>$pass2 ?? "",
				 "id_encadrant"=>$id_encadrant ?? "",
				 "CNE"=>$CNE ?? "",	
				 "erreur"=> $erreur ?? ""
				];
					
	renderAdm($view, $variabls);
}

function ModifierDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vModifierDoct.php";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$Doctorant = $nom." ".$prenom;
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$sujet = $_POST["sujet"];
		$id_encadrant = $_POST["id_encadrant"];
		$CNE = $_POST["CNE"];
		$id = $_POST["id"];

		if(empty($nom))    $erreur["nom"] ="le nom ne peut être vide !..."   ;
		if(empty($prenom)) $erreur["prenom"]= "Le prenom ne peut être vide!...";
		if(empty($email)) $erreur["email"]= "L'email ne peut être vide!...";
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez l'mail académique!!..."   ;
		if(empty($telephone)) $erreur["telephone"]= "Le telephone ne peut être vide!...";
		if(empty($sujet))    $erreur["sujet"] ="le sujet ne peut être vide !..."   ;
		if(empty($id_encadrant))    $erreur["encadrant"] ="L'encadrant ne peut être vide !..."   ;	
		if(empty($CNE)) $erreur["CNE"]= "CNE ne peut être vide!...";	

		if (!isset($erreur)) {
			modifierDoct($nom, $prenom, $email, $id_encadrant,$sujet, $telephone, $CNE, $id);
			header ("location: index.php?action=EspaceAdm");
		}	
	}
	else{
		$id = $_GET["id"] ?? "";
		$Doct = getDoctParId($id);
		foreach($Doct as $d){
			$nom = $d["nom"];
			$prenom = $d["prenom"];
			$Doctorant = $nom." ".$prenom;
			$email = $d["email"];
			$telephone = $d["telephone"];
			$sujet = $d["sujet"];
			$id_encadrant = $d["id_encadrant"];
			$CNE = $d["CNE"];
		}
		$erreur = [] ;
	}

	$variabls = ["prof" => findAllProf() ?? "",
				 "Doctorant" => $Doctorant ?? "",
				 "nom"=>$nom ?? "",
				 "prenom"=>$prenom ?? "",
				 "email"=>$email ?? "",
				 "telephone"=>$telephone ?? "",
				 "sujet"=>$sujet ?? "",
				 "id_encadrant"=>$id_encadrant ?? "",
				 "CNE"=>$CNE ?? "",	
				 "id"=>$id ?? "",
				 "erreur"=> $erreur ?? ""
				];					
	renderAdm($view, $variabls);
}

function SupprimerDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$id = $_GET["id"];
	deleteDoct($id);
	header ("location: index.php?action=EspaceAdm");
}

function CvMonDoctAction(){
	if (!isset($_SESSION["emailProf"])) { header ("location: index.php?action=loginProf"); exit();}
	$view = "Views/vCvMonDoct.php";
	$id = $_GET["id"];
	$Doct = getDoctParId($id)[0]["nom"]." ".getDoctParId($id)[0]["prenom"];
	$DateInscr = getDoctParId($id)[0]["DateInscr"];
	$actDoct = activiteParDoct($id);
	$publDoct = publicationParDoct($id);
	$orgDoct = getOrgDoct($id);
	$variabls =["id" => $id  ?? "" ,
				"DateInscr" => $DateInscr ,
				"Doct"=>$Doct ?? "",
				"actDoct"=> $actDoct ?? "",
				"publDoct" => $publDoct  ?? "" ,
				"orgDoct" => $orgDoct  ?? "" 
			];
	renderProf($view,$variabls);
}

function CvDoctAction(){
	if (!isset($_SESSION["emailAdm"])) { header ("location: index.php?action=loginAdm"); exit();}
	$view = "Views/vCvDoct.php";
	$id = $_GET["id"];
	$Doct = getDoctParId($id)[0]["nom"]." ".getDoctParId($id)[0]["prenom"];
	$DateInscr = getDoctParId($id)[0]["DateInscr"];
	$actDoct = activiteParDoct($id);
	$publDoct = publicationParDoct($id);
	$orgDoct = getOrgDoct($id);
	$variabls =["id" => $id  ?? "" ,
				"DateInscr" => $DateInscr ,
				"Doct"=>$Doct ?? "",
				"actDoct"=> $actDoct ?? "",
				"publDoct" => $publDoct  ?? "" ,
				"orgDoct" => $orgDoct  ?? "" 
			];
	renderAdm($view,$variabls);
}

function MonCvAction(){
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vMonCv.php";
	$id = $_SESSION["id"];
	$DateInscr = getDoctParId($id)[0]["DateInscr"];
	$actDoct = activiteParDoct($id);
	$publDoct = publicationParDoct($id);
	$orgDoct = getOrgDoct($id);
	$variabls =["id" => $id  ?? "" ,
				"DateInscr" => $DateInscr ,
				"actDoct"=> $actDoct ?? "",
				"publDoct" => $publDoct  ?? "" ,
				"orgDoct" => $orgDoct  ?? "" 
			];
	renderDoct($view,$variabls);
}

function ToutesActDoctAction() {
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vEspaceDoctTtAct.php";
	$id = $_SESSION["id"];
	$actDoct = activiteParDoct($id);
	$publDoct = get3publicationParDoct($id);
	$nbrePublicationParDoct = nbrePublicationParDoct($id);
	$variabls =["id" => $id  ?? "" ,
			"actDoct"=> $actDoct ?? "",
			"publDoct" => $publDoct  ?? "" ,
			"nbrePublicationParDoct"=> $nbrePublicationParDoct ?? ""
			];
	renderDoct($view,$variabls);
}

function ToutesPubDoctAction() {
	if (!isset($_SESSION["emailDoct"])) { header ("location: index.php?action=loginDoct"); exit();}
	$view = "Views/vEspaceDoctTtPub.php";
	$id = $_SESSION["id"];
	$actDoct = Get3ActiviteDoct($id);
	$publDoct = publicationParDoct($id);
	$nbreActParDoct = nbreActParDoct($id);
	$variabls =["id" => $id  ?? "" ,
			"actDoct"=> $actDoct ?? "",
			"publDoct" => $publDoct  ?? "" ,
			"nbreActParDoct"=> $nbreActParDoct ?? ""
			];
	renderDoct($view,$variabls);
}