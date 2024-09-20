<?php 
if(count($mesDoctAppr) == 0) echo "<h1>Aucune demande d'inscription</h1>";
else{ ?>
<div style="background-color:white;"><br>
<br>
<table class="table">
	<tr>		 
		<th><i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>Condidat </th>
        <th></th>
        <th></th>
	</tr>			
		 
	<?php 
		foreach($mesDoctAppr as $d){
	?>
	<tr>
		<td> <a href="index.php?action=DetailDoctAppr&id=<?= $d["id_d"] ?>"><?= $d["nom"]." ".$d["prenom"] ?> </a></td>               
		<td> <a class="btn btn-success" href="index.php?action=AccepterDoctAppr&id=<?=  $d["id_d"] ?> "> Accepter</a></td>
        <td> <a class="btn btn-danger" href="index.php?action=RejeterDoctAppr&id=<?=  $d["id_d"] ?>"> Rejeter</a></td>
	</tr>	
	<?php } ?>
</table>
</div>
<?php } ?>