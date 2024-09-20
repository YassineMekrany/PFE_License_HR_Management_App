<?php
require_once("Models/BaseManager.php");

function getDoctParEmail($email){
    $stmt = getCn()->prepare("SELECT * from doctorants where email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ajouterDoct(array $e){ 
    $year = date("Y");
    getCn()->prepare("INSERT INTO doctorants (nom,prenom,email,id_encadrant,sujet,telephone,CNE,password,DateInscr) VALUES (?,?,?,?,?,?,?,?,?)")->execute(array_merge($e, [$year]));
}


function deleteDoct($id){
    return getCn()->exec("delete from doctorants where id_d = $id ");
}

function getDoctParId($id){
    $stmt = getCn()->prepare("SELECT * from doctorants where id_d = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDoctApprParId($id){
    $stmt = getCn()->prepare("SELECT * from doctorantsappr where id_d = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDoctApprParEncadrant($id_encadrant){
    $stmt = getCn()->prepare("SELECT * from doctorantsappr where id_encadrant = ? AND approverProf = 0");
    $stmt->execute([$id_encadrant]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function findAllDoctApprAdm(){
    $stmt = getCn()->prepare("SELECT * from doctorantsappr where approverProf = 1 AND approverAdm = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getDoctParEncadrant($id_encadrant){
    $stmt = getCn()->prepare("SELECT * from doctorants where id_encadrant = ?");
    $stmt->execute([$id_encadrant]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function modifierDoct($nom, $prenom, $email, $id_encadrant, $sujet, $telephone, $CNE, $id) {
    $requete = getCn()->prepare("UPDATE doctorants SET nom = ?, prenom = ?, email = ?, id_encadrant = ?, sujet = ?, telephone = ?, CNE = ? WHERE id_d = ?");
    $requete->execute([$nom, $prenom, $email, $id_encadrant, $sujet, $telephone, $CNE, $id]);
}

function changerPassDoct($password,$id) {
    $requete = getCn()->prepare("UPDATE doctorants SET password = ?  WHERE id_d = ?");
    $requete->execute([$password , $id]);
}

function ajouterDoctAppr(array $e){
    getCn()->prepare("INSERT INTO doctorantsappr (nom,prenom,email,id_encadrant,sujet,telephone,CNE,password) Values (?,?,?,?,?,?,?,?)")->execute($e);
}

function AccepterDoctApprProf($id){ 
    $requete = getCn()->prepare("UPDATE doctorantsappr SET approverProf = 1  WHERE id_d = ? ");
    $requete->execute([$id]);
}

function AccepterDoctApprAdm(){
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $email = $_GET['email'];
    $id_encadrant = $_GET['id_encadrant'];
    $sujet = $_GET['sujet'];
    $telephone = $_GET['telephone'];
    $CNE = $_GET['CNE'];
    $password = $_GET['pass'];
    $year = date("Y");
    
    $requete = getCn()->prepare("INSERT INTO doctorants(nom, prenom, email, id_encadrant, sujet, telephone, CNE, password,DateInscr) VALUES (?, ?, ?, ?, ?, ?, ?, ? , ?)");
    $requete->execute([$nom, $prenom, $email, $id_encadrant, $sujet, $telephone, $CNE, $password,$year]);
}


function RejeterDoctAppr($id){
    return getCn()->exec("delete from doctorantsappr where id_d = $id ");
}

function Doct_exists(array $user){	
    if (!isset($user['email'])) {
        return false;
    }
	$Rq= getCn()->prepare ("select password from doctorants where email = ? ");	
	$Rq->execute([$user["email"]]);
	$passHash= $Rq->fetchColumn();
	return password_verify($user["pass"],$passHash) ;	
}