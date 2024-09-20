<h1>Réviser la publication :</h1>
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
            <td><a href="#">En attente d'approbation</a></td>
        </tr>
 
            <form method="post" action="">
                <textarea placeholder="Ecrire Remarque ici" name="Remarque" value="<?= $Remarque ?? "" ?>" id="" cols="30" rows="10"></textarea>
                <span class="Err"><?= $erreur["Remarque"] ?? "" ?> </span>
                <input type="hidden" name="sender_id" value="<?= $sender_id ?>">
                <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
                <input type="hidden" name="sender_type" value="professeurs">
                <input type="hidden" name="receiver_type" value="doctorants">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" name="submit" class="btn btn-success" value="Envoyer">Envoyer</button>
            </form>
        <?php }  ?>
    </table>
</div>
