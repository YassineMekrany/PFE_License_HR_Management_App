<?php 
if(count($sesDoct) == 0){?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mr <?= $encadrant ?> n'encadre aucun doctorant . </h1>
<br>
</div>
<?php }  
else { ?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Les Doctorants Encadrés par: <?= $encadrant ?> </h1>
<br>
<table class="table">
	<tr> 
		<th>Nom </th>
		<th>Sujet</th>
		<th>Téléphone</th>
        <th>Email</th>
        <th></th>
        <th></th>
	</tr>	
		 
	<?php
	foreach($sesDoct as $d){
	?>
	<tr>
		<td> <a href="index.php?action=CvDoct&id=<?= $d["id_d"] ?>"><?php echo $d["nom"]." ".$d["prenom"]; ?> </a></td>
		<td> <a href="index.php?action=CvDoct&id=<?= $d["id_d"] ?>"><?php echo $d["sujet"]; ?> </a></td>
        <td> <a href="index.php?action=CvDoct&id=<?= $d["id_d"] ?>"><?php echo $d["telephone"]; ?> </a></td>
		<td> <a href="index.php?action=CvDoct&id=<?= $d["id_d"] ?>"><?php echo $d["email"]; ?> </a></td>
        <td> <a class="btn btn-warning" href="index.php?action=EnvoyerMsg&id_receiver=<?= $d["id_d"] ?>&type_receiver=doctorants&id_sender=<?= $id ?>&type_sender=administration "><i class="fab fa-facebook-messenger"></i></a></td>
		<td> <a class="btn btn-primary" href="index.php?action=ModifierDoct&id=<?=  $d["id_d"] ?>"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
        <td> <a class="btn btn-secondary" href="index.php?action=SupprimerDoct&id=<?=  $d["id_d"] ?>"><i class="bi bi-trash"></i><?php } ?> </a></td>
	</tr>
	<tr>
        <td colspan="4"><a href="index.php?action=AjouterDoct"><i class="bi bi-plus-circle"></i>Ajouter un Doctorant</a></td> 
    </tr>	
</table>

</div>
<?php } ?>

