<?php
require_once("Models/BaseManager.php");

function lastIdAdm() {
    $cn = getCn();
    $stmt = $cn->query("SELECT MAX(id_ad) FROM administration");
    $lastId = $stmt->fetchColumn();
    return $lastId;
}

function getAdmParEmail($email){
    $stmt = getCn()->prepare("SELECT * from administration where email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAdmParId($id){
    $stmt = getCn()->prepare("SELECT * from administration where id_ad = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function changerPassAdm($password,$id) {
    $requete = getCn()->prepare("UPDATE administration SET password = ?  WHERE id_ad = ?");
    $requete->execute([$password , $id]);
}

function Adm_exists(array $user){	
    if (!isset($user['email'])) {
        return false;
    }
	$Rq= getCn()->prepare ("select password from administration where email = ? ");	
	$Rq->execute([$user["email"]]);
	$passHash= $Rq->fetchColumn();
	return password_verify($user["pass"],$passHash) ;	
}