<h1>
    Envoyer Message à 
    <?php 
        if($type_receiver == "professeurs") {
            echo $Prof;
        }
        elseif($type_receiver == "doctorants") {
            echo $Doct; 
        }
        elseif($type_receiver == "administration") {
            echo $Adm; 
        }
    ?>
</h1>
<br>
<form method="post" action="index.php?action=EnvoyerMsg">
    <textarea placeholder="Ecrire Message" name="message" id="" cols="30" rows="10" required></textarea><br>
    <input type="hidden" name="sender_id" value="<?= $id_sender ?>">
    <input type="hidden" name="receiver_id" value="<?= $id_receiver ?>">
    <input type="hidden" name="sender_type" value="<?= $type_sender ?>">
    <input type="hidden" name="receiver_type" value="<?= $type_receiver ?>">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" name="submit" class="btn btn-success" value="Envoyer">Envoyer</button>
</form>
