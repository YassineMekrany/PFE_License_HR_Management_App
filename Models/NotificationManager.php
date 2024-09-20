<?php
require_once("Models/BaseManager.php");

function envoyerNotification($sender_id, $receiver_id, $notification, $sender_type, $receiver_type, $type, $id_type) {
    getCn()->prepare("INSERT INTO notifications (sender_id, receiver_id, notification, date, sender_type, receiver_type, type, id_type) VALUES (?, ?, ?, NOW(), ?, ? ,? ,?)")->execute([$sender_id, $receiver_id, $notification, $sender_type, $receiver_type, $type, $id_type]);
}

function getNotifications($receiver_id, $receiver_type) {
    $connexion = getCn();

    $query = "SELECT * FROM notifications WHERE receiver_id = ? AND receiver_type = ? ORDER BY date DESC";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get5Notifications($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    $query = "SELECT * FROM notifications WHERE receiver_id = ? AND receiver_type = ? ORDER BY date DESC LIMIT 5";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lireNotifications($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    $query = "UPDATE notifications SET status = true WHERE receiver_id = ? AND receiver_type = ? AND status = false";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
}

function nbrNotificationsNonLus($receiver_id, $receiver_type) {
    // Connexion à la base de données
    $connexion = getCn();

    $query = "SELECT COUNT(*) FROM notifications WHERE receiver_id = ? AND receiver_type = ? AND status = false";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$receiver_id, $receiver_type]);
    $result = $stmt->fetchColumn();

    return $result;
}

function deleteNotification($id){
    return getCn()->exec("delete from notifications where id = $id ");
}