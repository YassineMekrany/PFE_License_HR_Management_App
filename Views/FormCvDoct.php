<h2 style="color:red">Date de première Inscription : <?= $DateInscr ?></h2>
<br>
<h1>Les activités :</h1>
<div style="background-color:white;">
    <table class="table">
        <tr> 
            <th>Type d'activité</th>
            <th>Date</th>
            <th>Lieu</th>
        </tr> 
        <?php foreach ($actDoct as $ac) { ?>
            <tr>
                <td><a href="#"><?= $ac["type"]; ?></a></td>
                <td><a href="#"><?= $ac["date_act"]; ?></a></td>
                <td><a href="#"><?= $ac["lieu"]; ?></a></td>
            </tr><?php } ?>
    </table>
</div>
<br>
<h1>Les publications :</h1>
<div style="background-color:#F5F5F5;">
    <table class="table">
        <tr> 
            <th>Titre</th>
            <th>Résumé</th>
            <th>Journal</th>
            <th>Date de publication</th>
        </tr> 
        <?php foreach ($publDoct as $pub) { ?>
            <tr>
                <td><a href="#"><?= $pub["titre"]; ?></a></td>
                <td><a href="#"><?= $pub["resume"]; ?></a></td>
                <td><a href="#"><?= $pub["journal"]; ?></a></td>
                <td><a href="#"><?= $pub["date_pub"]; ?></a></td>
            </tr><?php } ?>
    </table>
    <br>
<h1>Les Participations :</h1>
<div style="background-color:#F5F5F5;">
    <table class="table">
        <tr>
            <th>Organisation (s)</th>
        </tr> 
        <?php foreach ($orgDoct as $org) { ?>
            <tr>
                <td><a href="#"><?= $org["sujet"]; ?></a></td>
                <td><a href="#"><?= " à ".$org["lieu"]; ?></a></td>
                <td><a href="#"><?= " le ".$org["date_org"]; ?></a></td>
            </tr><?php } ?>
    </table>
</div>
