<?php
require_once("Models/BaseManager.php");

function apprOrganisation($id){
    $stmt = getCn()->prepare("SELECT * from organisation where id_org = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $org) {
        if ($org['approverAdm'] == 0) {
            return true;
        }
    }
    return false;
}

function ajouterOrganisation($sujet, $ids_p, $ids_d, $date_org, $lieu) {
    $cn = getCn();
    $ids_p_json = json_encode($ids_p);
    $ids_d_json = json_encode($ids_d);
    $cn->prepare("INSERT INTO organisation (sujet, ids_p, ids_d, date_org, lieu) VALUES (?, ?, ?, ?, ?)")->execute([$sujet, $ids_p_json, $ids_d_json, $date_org, $lieu]);
    return $cn->lastInsertId();
}

function getOrganisation($id){
    $stmt = getCn()->prepare("SELECT * from organisation where id_org = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validerOrgAdm($id) {
    $requete = getCn()->prepare("UPDATE organisation SET approverAdm = 1 WHERE id_org = ?");
    $requete->execute([$id]);
}

function rejeterOrgAdm($id) {
    return getCn()->exec("delete from organisation where id_org = $id ");
}

function getOrgDoct($id) {
    $ids_d = json_encode([$id]);
    $stmt = getCn()->prepare("SELECT * from organisation where JSON_CONTAINS(ids_d, ?, '$')");
    $stmt->execute([$ids_d]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
