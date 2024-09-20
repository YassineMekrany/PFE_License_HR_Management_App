
<h1 class="btn btn-success">Boîte de réception</h1>
<br>
<?php  
require_Once("Controllers/BaseController.php");
foreach ($Allmessage as $message) {
?>
    <table class="table"> 
        <tr>
            <td>
                <a href="#"><?= $message['message'] ?></a>
            </td>
            <td>
            <?php 
                echo "par ";
                if ($message['sender_type'] == "professeurs") {
                    $prof = getProfParId($message['sender_id']);
                    echo $prof[0]["nom"]." ".$prof[0]["prenom"];
                } elseif ($message['sender_type'] == "doctorants") {
                    $doct = getDoctParId($message['sender_id']);
                    echo $doct[0]["nom"]." ".$doct[0]["prenom"]; 
                } elseif ($message['sender_type'] == "administration") {
                    $adm = getAdmParId($message['sender_id']);
                    echo $adm[0]["nom"]." ".$adm[0]["prenom"]; 
                } 
                echo " - ".$message["created_at"]; 
                ?> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a style="text-align:right" class="btn btn-light" href="index.php?action=EnvoyerMsg&id_receiver=<?= $message['sender_id'] ?>&type_receiver=<?= $message['sender_type'] ?>&id_sender=<?= $message['receiver_id'] ?>&type_sender=<?= $message['receiver_type'] ?>"><i class="fa fa-reply"></i> Répondre</a>
            </td>
        </tr>	
    </table>
<?php
} ?><br>
