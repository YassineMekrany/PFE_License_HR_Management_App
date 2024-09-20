<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include "headEspDoct.php";
include_once "fonction_BD.php";

$id = $_SESSION["id"];

$actDoct = activiteDoct($id);
$publDoct = publicationParDoct($id);
?>
<br>
<h1>votre activités :</h1>
<div style="background-color:white;">
    <table class="table">
        <tr> 
            <th>Type d'activité</th>
            <th>Date</th>
        </tr> 
        <?php
        foreach ($actDoct as $ac) {
        ?>
        <tr>
            <td><a href="#"><?= $ac["type"]; ?></a></td>
            <td><a href="#"><?= $ac["date_act"]; ?></a></td>
        </tr>
        <?php } 
        if(nbreActParDoct($id) > 3){
        ?>
        <tr>
            <td colspan="5"><a href="#toutesActDoct.php">Afficher tous les activités</a></td> 
        </tr><?php } ?>
        <tr>
            <td colspan="2"><a href="AjouterActivite.php"><i class="bi bi-plus-circle"></i> Ajouter activité</a></td> 
        </tr>
    </table>
</div>
<br>
<h1>votre publications :</h1>
<div style="background-color:#F5F5F5;">
    <table class="table">
        <tr> 
            <th>Titre</th>
            <th>Résumé</th>
            <th>Journal</th>
            <th>Date de publication</th>
            <th>Statut</th>
        </tr> 
        <?php 
        foreach ($publDoct as $pub) {
        ?>
        <tr>
            <td><a href="#"><?= $pub["titre"]; ?></a></td>
            <td><a href="#"><?= $pub["resume"]; ?></a></td>
            <td><a href="#"><?= $pub["journal"]; ?></a></td>
            <td><a href="#"><?= $pub["date_pub"]; ?></a></td>
            <td><a href="#">
                <?php
                if ($pub["approverAdm"] == 0 ) {
                    echo "<p style=\"color:orange;\">En attente</p>";
                } elseif($pub["approverAdm"] == 1) {
                    echo "<p style=\"color:green;\">Publication validée</p>";
                } 
                 ?>
            </a></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5"><a href="AjouterPublication.php"><i class="bi bi-plus-circle"></i> Ajouter publication</a></td> 
        </tr>
    </table>
</div>
