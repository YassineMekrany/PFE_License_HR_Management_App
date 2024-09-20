<?php
include("fonction_BD.php");

$message = $_POST["message"];
$date_pub = $_POST["date_pub"];
$date_lim = $_POST["date_lim"];
$lien = $_POST["lien"];
$id = $_POST["id"];

modifierAnnonce($message,$date_lim, $lien, $id);

header("location: listeAnnonce.php");