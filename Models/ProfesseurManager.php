<?php
require_once("Models/BaseManager.php");

function getProfParEmail($email){
    $stmt = getCn()->prepare("SELECT * from professeurs where email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ajouterProf(array $e){ 
    getCn()->prepare("INSERT INTO professeurs (nom,prenom,email,specialite,telephone,password) Values (?,?,?,?,?,?)")->execute($e);
}

function ajouterProfAppr(array $e){ 
    getCn()->prepare("INSERT INTO professeursappr (nom,prenom,email,specialite,telephone,password) Values (?,?,?,?,?,?)")->execute($e);
}

function findAllProfApprAdm(){
    $stmt = getCn()->prepare("SELECT * from professeursappr");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProfApprParId($id){
    $stmt = getCn()->prepare("SELECT * from professeursappr where id_p = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AccepterProfAppr() {
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $email = $_GET['email'];
    $telephone = $_GET['telephone'];
    $specialite = $_GET['specialite'];
    $password = $_GET['pass'];
    
    $requete = getCn()->prepare("INSERT INTO professeurs(nom, prenom, email, specialite, telephone, password) VALUES (?, ?, ?, ?, ?, ?)");
    $requete->execute([$nom, $prenom, $email, $specialite, $telephone, $password]);
}


function RejeterProfAppr($id){
    return getCn()->exec("delete from professeursappr where id_p = $id ");
}

function findAllProf(){
    return getCn()->query("SELECT * from professeurs")->fetchAll();
}

function getAll($table){
    return getCn()->query("SELECT * from $table")->fetchAll();
}

function deleteProf($id){
    return getCn()->exec("delete from professeurs where id_p = $id ");
}

function getProfParId($id){
    $stmt = getCn()->prepare("SELECT * from professeurs where id_p = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function modifierProf($nom, $prenom, $email, $specialite, $telephone, $id) {
    $requete = getCn()->prepare("UPDATE professeurs SET nom = ?, prenom = ?, email = ?, specialite = ? , telephone = ?   WHERE id_p = ?");
    $requete->execute([$nom, $prenom, $email, $specialite, $telephone ,$id]);
}

function changerPassProf($password,$id) {
    $requete = getCn()->prepare("UPDATE professeurs SET password = ?  WHERE id_p = ?");
    $requete->execute([$password , $id]);
}

function Prof_exists(array $user){
        if (!isset($user['email'])) {
        return false;
    }	
	$Rq= getCn()->prepare ("select password from professeurs where email = ? ");	
	$Rq->execute([$user["email"]]);
	$passHash= $Rq->fetchColumn();
	return password_verify($user["pass"],$passHash) ;	
}