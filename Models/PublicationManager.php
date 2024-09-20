<?php
require_once("Models/BaseManager.php");

function publicationDoct($id){
    $stmt = getCn()->prepare("SELECT * from publication where id_pub = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function publicationParDoct($id){
    $stmt = getCn()->prepare("SELECT * from publication where id_d = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function nbrePublicationParDoct($id){
    $stmt = getCn()->prepare("SELECT COUNT(*) as nb_lignes from publication where id_d = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['nb_lignes'];
}

function get3publicationParDoct($id){
    $stmt = getCn()->prepare("SELECT * from publication where id_d = ?  ORDER BY date_pub DESC LIMIT 3");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPublicationDoctAppr($id_pub){
    $stmt = getCn()->prepare("SELECT * from publication where approverProf = 0 AND id_pub = ?");
    $stmt->execute([$id_pub]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function publicationDoctAppr($id_pub){
    $stmt = getCn()->prepare("SELECT * from publication where id_pub = ?");
    $stmt->execute([$id_pub]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $publication) {
        if ($publication['approverProf'] == 0) {
            return true;
        }
    }
    return false;
}

function getPublicationDoctApprAdm($id_pub){
    $stmt = getCn()->prepare("SELECT * from publication where approverAdm = 0 AND approverProf = 1 AND id_pub = ?");
    $stmt->execute([$id_pub]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function publicationDoctApprAdm($id_pub){
    $stmt = getCn()->prepare("SELECT * from publication where id_pub = ?");
    $stmt->execute([$id_pub]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $publication) {
        if ($publication['approverProf'] == 1 AND $publication['approverAdm'] == 0) {
            return true;
        }
    }
    return false;
}

function ajouterPublication($titre, $rang, $id_d, $journal, $resume, $date_pub) {
    $cn = getCn();
    $cn->prepare("INSERT INTO publication (titre, rang, id_d, journal, resume, date_pub) VALUES (?, ?, ?, ?, ?, ?)")->execute([$titre, $rang, $id_d, $journal, $resume, $date_pub]);
    return $cn->lastInsertId();
}

function validerPubProf($id) {
    $requete = getCn()->prepare("UPDATE publication SET approverProf = 1 WHERE id_pub = ?");
    $requete->execute([$id]);
}

function validerPubAdm($id) {
    $requete = getCn()->prepare("UPDATE publication SET approverAdm = 1 WHERE id_pub = ?");
    $requete->execute([$id]);
}

function rejeterPubProf($id) {
    return getCn()->exec("delete from publication where id_pub = $id ");
}

function rejeterPubAdm($id) {
    return getCn()->exec("delete from publication where id_pub = $id ");
}
