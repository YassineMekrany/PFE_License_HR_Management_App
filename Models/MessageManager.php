<?php
require_once("Models/BaseManager.php");

function searchByName($letter){
    // Obtenir une connexion à la base de données
    $conn = getCn();
 
    // Requête SQL pour chercher les noms et prénoms dans les tables de professeurs, doctorants et administration
    $sql = "SELECT nom, prenom, 'professeurs' AS type, id_p AS id FROM professeurs WHERE nom LIKE '%$letter%' OR prenom LIKE '%$letter%' 
            UNION 
            SELECT nom, prenom, 'doctorants' AS type, id_d AS id FROM doctorants WHERE nom LIKE '%$letter%' OR prenom LIKE '%$letter%'
            UNION
            SELECT nom, prenom, 'administration' AS type, id_ad AS id FROM administration WHERE nom LIKE '%$letter%' OR prenom LIKE '%$letter%'";
 
    // Préparer la requête SQL
    $stmt = $conn->prepare($sql);
 
    // Exécuter la requête SQL
    $stmt->execute();
 
    // Afficher les résultats de la recherche
    return $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function envoyerMsg($sender_id, $receiver_id, $message, $sender_type, $receiver_type) {
    getCn()->prepare("INSERT INTO messages (sender_id, receiver_id, message, created_at, sender_type, receiver_type) VALUES (?, ?, ?, NOW(), ?, ?)")->execute([$sender_id, $receiver_id, $message, $sender_type, $receiver_type]);
}

function getMsg($receiver_id, $receiver_type) {
    $connexion = getCn();

    $query = "SELECT * FROM messages WHERE receiver_id = ? AND receiver_type = ? ORDER BY created_at DESC";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get5Msg($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    // Préparation de la requête de sélection
    $query = "SELECT * FROM messages WHERE receiver_id = ? AND receiver_type = ? ORDER BY created_at DESC LIMIT 5";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function lireMsg($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    $query = "UPDATE messages SET status = true WHERE receiver_id = ? AND receiver_type = ? AND status = false";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
}

function nbrMsgNonLus($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    $query = "SELECT COUNT(*) FROM messages WHERE receiver_id = ? AND receiver_type = ? AND status = false";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    $result = $stmt->fetchColumn();

    return $result;
}

