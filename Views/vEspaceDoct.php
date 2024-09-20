<br>
<h1>Vos activités :</h1>
<div style="background-color:white;">
    <table class="table">
        <tr> 
            <th>Type d'activité</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Statut</th>
        </tr> 
        <?php foreach ($actDoct as $ac) { ?>
            <tr>
                <td><a href="#"><?= $ac["type"]; ?></a></td>
                <td><a href="#"><?= $ac["date_act"]; ?></a></td>
                <td><a href="#"><?= $ac["lieu"]; ?></a></td>
                <td>
                    <?php if ($ac["approverAdm"] == 0) { ?>
                        <p style="color:orange;">En attente</p>
                    <?php } elseif ($ac["approverAdm"] == 1) { ?>
                        <p style="color:green;">Activité validée</p>
                    <?php } ?>
                </td>
            </tr>
        <?php } 
        if ($nbreActParDoct > 3) { ?>
            <tr>
                <td colspan="4"><a href="index.php?action=ToutesActDoct">Afficher toutes les activités</a></td> 
            </tr>
        <?php } ?>
        <tr>
            <td colspan="4"><a href="index.php?action=AjouterActivite"><i class="bi bi-plus-circle"></i> Ajouter une activité</a></td> 
        </tr>
    </table>
</div>
<br>
<h1>Vos publications :</h1>
<div style="background-color:#F5F5F5;">
    <table class="table">
        <tr> 
            <th>Titre</th>
            <th>Résumé</th>
            <th>Journal</th>
            <th>Date de publication</th>
            <th>Statut</th>
        </tr> 
        <?php foreach ($publDoct as $pub) { ?>
            <tr>
                <td><a href="#"><?= $pub["titre"]; ?></a></td>
                <td><a href="#"><?= $pub["resume"]; ?></a></td>
                <td><a href="#"><?= $pub["journal"]; ?></a></td>
                <td><a href="#"><?= $pub["date_pub"]; ?></a></td>
                <td>
                    <?php if ($pub["approverAdm"] == 0) { ?>
                        <p style="color:orange;">En attente</p>
                    <?php } elseif ($pub["approverAdm"] == 1) { ?>
                        <p style="color:green;">Publication validée</p>
                    <?php } ?>
                </td>
            </tr>
        <?php } 
        if ($nbrePublicationParDoct > 3) { ?>
            <td colspan="5"><a href="index.php?action=ToutesPubDoct">Afficher Plus de publications</a></td> 
        </tr><?php } ?>
        <tr>
            <td colspan="5"><a href="index.php?action=AjouterPublication"><i class="bi bi-plus-circle"></i> Ajouter publication</a></td> 
        </tr>
    </table>
</div>
