<br>
<h1 class="btn btn-secondary">Mes Notifications</h1>
<br>
<?php 
foreach ($Notifications as $Notification) {
    if($Notification["type"] == "publication") { 
        $approuveePub = publicationDoctAppr($Notification["id_type"]);
        $approuveeAdmPub = publicationDoctApprAdm($Notification["id_type"]);
    }
    if($Notification["type"] == "activite") { 
        $approuveeAct = activiteDoctAppr($Notification["id_type"]);
        $approuveeAdmAct = activiteDoctApprAdm($Notification["id_type"]);
    }
    if($Notification["type"] == "organisation") { 
        $approuveeOrg = apprOrganisation($Notification["id_type"]);
    } ?>
<table class="table"> 
    <tr>
    <?php if($Notification["type"] == "reinscription" AND $Notification["receiver_type"] == "professeurs") { ?>
        <td>
            <a href="index.php?action=CvMonDoct&id=<?= $Notification["id_type"] ?>"><?= $Notification['notification'] ?></a>
        </td>
        <td>
            <?php 
                echo "le ".$Notification['date'];
            ?> 
        </td><?php }
        elseif($Notification["type"] == "reinscription" AND $Notification["receiver_type"] == "administration") { ?>
                <td>
            <a href="index.php?action=CvDoct&id=<?= $Notification["id_type"] ?>"><?= $Notification['notification'] ?></a>
        </td>
        <td>
            <?php 
                echo "le ".$Notification['date'];
            ?> 
        </td><?php }
        else { ?>
                <td>
            <a href="#"><?= $Notification['notification'] ?></a>
        </td>
        <td>
            <?php 
                echo "le ".$Notification['date'];
            ?> 
        </td>
        <?php }
         
            if($Notification["type"] == "publication" AND !$approuveePub AND $Notification["receiver_type"] == "professeurs") { 
        ?>
                <td>Publication vérifiée</td>
        <?php  
            } elseif($Notification["type"] == "publication" AND $Notification["receiver_type"] == "professeurs") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderPubProf&id_pub=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterPubProf&id_pub=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Rejeter</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="index.php?action=ReviserPub&id_pub=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Réviser</a>
                </td>
        <?php } 
        elseif($Notification["type"] == "publication" AND $approuveeAdmPub AND $Notification["receiver_type"] == "administration") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderPubAdm&id_pub=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterPubAdm&id_pub=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Rejeter</a>
                </td>
        <?php } ?>
        

        <?php if($Notification["type"] == "reinscription" AND $Notification["receiver_type"] == "professeurs") { ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderReinscriptionProf&id=<?= $Notification["id"] ?>&id_d=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterReinscriptionProf&id=<?= $Notification["id"] ?>&id_d=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Rejeter</a>
                </td>
        <?php } 
        elseif($Notification["type"] == "reinscription" AND $Notification["receiver_type"] == "administration") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderReinscriptionAdm&id=<?= $Notification["id"] ?>&id_d=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterReinscriptionAdm&id=<?= $Notification["id"] ?>&id_d=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Rejeter</a>
                </td>
        <?php } ?>



        <?php 
            if($Notification["type"] == "organisation" AND !$approuveeOrg AND $Notification["receiver_type"] == "administration") { 
        ?>
                <td>organisation vérifiée</td>
        <?php  
            } elseif($Notification["type"] == "organisation" AND $Notification["receiver_type"] == "administration") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderOrgAdm&id_org=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterOrgAdm&id_org=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Rejeter</a>
                </td>
        <?php } ?>

        <?php 
                if($Notification["type"] == "activite" AND !$approuveeAct AND $Notification["receiver_type"] == "professeurs") { 
            ?>
                <td>Activité vérifiée</td>
        <?php 
            } elseif($Notification["type"] == "activite" AND $Notification["receiver_type"] == "professeurs") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderActProf&id_act=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterActProf&id_act=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>&receiver_id=<?= $Notification["receiver_id"] ?>">Rejeter</a>
                </td>
        <?php } 
        elseif($Notification["type"] == "activite" AND $approuveeAdmAct AND $Notification["receiver_type"] == "administration") { 
        ?>
                <td>
                    <a class="btn btn-success" href="index.php?action=ValiderActAdm&id_act=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Valider</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?action=RejeterActAdm&id_act=<?= $Notification["id_type"] ?>&sender_id=<?= $Notification["sender_id"] ?>">Rejeter</a>
                </td>
        <?php } ?>
    </tr>	
</table>

<?php } 
if (count($AllNotifications) > 5) {
?>
    <a class="btn btn-light" href="index.php?action=AfficherPlusNotifications&receiver_type=<?= $receiver_type ?>&receiver_id=<?= $receiver_id ?>">Afficher tous les Notifications...</a> 
<?php 
} 
?>
