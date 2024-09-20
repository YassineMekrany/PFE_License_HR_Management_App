<?php
require_once("Models/BaseManager.php");

function ajouterAnnonce(array $e){ 
    getCn()->prepare("INSERT INTO annonce (message,date_deb,date_lim) Values (?,?,?)")->execute($e);
}

function findAllAnnonce(){
    return getCn()->query("SELECT * from annonce")->fetchAll();
}

function DeleteAnnonce($id){
    return getCn()->exec("delete from annonce where id_an = $id ");
}

function getAnnonceParId($id){
    $stmt = getCn()->prepare("SELECT * from annonce where id_an = ?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function modifierAnnonce($message, $date_deb,$date_lim,$Activer, $id) {
    $requete = getCn()->prepare("UPDATE annonce SET message = ?, date_deb = ?, date_lim = ?, Activer = ?  WHERE id_an = ?");
    $requete->execute([$message, $date_deb,$date_lim,$Activer, $id]);
}

function get5DernNews() {
    $conn = getCn();
    $query = "SELECT * FROM annonce Limit 5";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
  
function isReinscriptionActivated() {
    $stmt = getCn()->prepare("SELECT * FROM annonce WHERE message = 'Réinscription'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($result !== false && $result['Activer'] === 1);
}

function isPreinscriptionActivated() {
    $cn = getCn();
    $stmt = $cn->prepare("SELECT * FROM annonce WHERE message = 'Préinscription'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($result !== false && $result['Activer'] == 1);
}

function isDemandeRejoindreProfActivated() {
    $stmt = getCn()->prepare("SELECT * FROM annonce WHERE message = 'Demande Rejoindre au Labo comme Professeur'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($result !== false && $result['Activer'] === 1);
}