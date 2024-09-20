<?php 
if(count($DoctAppr) + count($ProfAppr) == 0) {
    echo "<h1>Aucune demande d'inscription</h1>";
} else { 
?>
<div style="background-color:white;"><br>
<br>
<table class="table">
    <tr>         
        <th><i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>Candidat (s)</th>
        <th></th>
        <th></th>
    </tr>           
    
    <?php foreach($DoctAppr as $d){ ?>
    <tr>
        <td> <a href="index.php?action=DetailDoctApprAdm&id=<?= $d["id_d"] ?>"><?= $d["nom"]." ".$d["prenom"] ?> </a></td>
        <td> <a href="#"><?= "Candidat Déjà approuvé par son encadrant. "?> </a></td>
        <td> <a class="btn btn-success" href="index.php?action=AccepterDoct&id=<?=  $d["id_d"] ?>&nom=<?=  $d["nom"] ?>&prenom=<?=  $d["prenom"] ?>&email=<?=  $d["email"] ?>&id_encadrant=<?=  $d["id_encadrant"] ?>&sujet=<?=  $d["sujet"] ?>&telephone=<?=  $d["telephone"] ?>&CNE=<?=  $d["CNE"] ?>&pass=<?=  $d["password"] ?>"> Accepter</a></td>
        <td> <a class="btn btn-danger" href="index.php?action=RejeterDoct&id=<?=  $d["id_d"] ?>"> Rejeter</a></td>
    </tr>
    <?php } ?>
    
    <?php foreach($ProfAppr as $p){ ?>
    <tr>
        <td> <a href="index.php?action=DetailProfAppr&id=<?= $p["id_p"] ?>"><?= $p["nom"]." ".$p["prenom"] ?> </a></td>
        <td> <a href="#"><?= "Demande de rejoindre comme Professeur. "?> </a></td>
        <td> <a class="btn btn-success" href="index.php?action=AccepterProf&id=<?= $p["id_p"] ?>&nom=<?=  $p["nom"] ?>&prenom=<?=  $p["prenom"] ?>&email=<?=  $p["email"] ?>&telephone=<?=  $p["telephone"] ?>&specialite=<?=  $p["specialite"] ?>&pass=<?=  $p["password"] ?>"> Accepter</a></td>
        <td> <a class="btn btn-danger" href="index.php?action=RejeterProf&id=<?= $p["id_p"] ?>"> Rejeter</a></td>
    </tr>   
    <?php } ?>  
</table>
</div>
<?php } ?>
