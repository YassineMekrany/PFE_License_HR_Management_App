<?php
require_once("Models/BaseManager.php");

function activiteDoct($id){
    $stmt = getCn()->prepare("SELECT * from activite where id_act = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function Get3ActiviteDoct($id){
    $stmt = getCn()->prepare("SELECT * from activite where id_d = ? ORDER BY date_act DESC LIMIT 3");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function activiteParDoct($id){
    $stmt = getCn()->prepare("SELECT * from activite where id_d = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function nbreActParDoct($id){
    $stmt = getCn()->prepare("SELECT COUNT(*) as nb_lignes from activite where id_d = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['nb_lignes'];
}

function activiteDoctAppr($id_act){
    $stmt = getCn()->prepare("SELECT * from activite where id_act = ?");
    $stmt->execute([$id_act]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $act) {
        if ($act['approverProf'] == 0) {
            return true;
        }
    }
    return false;
}

function activiteDoctApprAdm($id_act){
    $stmt = getCn()->prepare("SELECT * from activite where id_act = ?");
    $stmt->execute([$id_act]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $act) {
        if ($act['approverProf'] == 1 AND $act['approverAdm'] == 0) {
            return true;
        }
    }
    return false;
}

function ajouterActivite($type, $lieu, $id_d, $id_p, $resume, $date_act) {
    $cn = getCn();
    $cn->prepare("INSERT INTO activite (type, lieu, id_d, id_p, resume, date_act) VALUES (?, ?, ?, ?, ?, ?)")->execute([$type, $lieu, $id_d, $id_p, $resume, $date_act]);
    return $cn->lastInsertId();
}

function validerActProf($id) {
    $requete = getCn()->prepare("UPDATE activite SET approverProf = 1 WHERE id_act = ?");
    $requete->execute([$id]);
}

function validerActAdm($id) {
    $requete = getCn()->prepare("UPDATE activite SET approverAdm = 1 WHERE id_act = ?");
    $requete->execute([$id]);
}

function rejeterActProf($id) {
    return getCn()->exec("delete from activite where id_act = $id ");
}

function rejeterActAdm($id) {
    return getCn()->exec("delete from activite where id_act = $id ");
}

