<?php if(count($mesDoct) == 0){ ?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tu n'encadre aucun doctorant Mr <?= $Prof ?> . </h1>
<br>
</div>
<?php }  
else { ?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mes Doctorants : </h1>
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
            
			
			foreach($mesDoct as $d){
			?>
			<tr>
				<td> <a href="index.php?action=CvMonDoct&id=<?= $d["id_d"] ?>"><?php echo $d["nom"]." ".$d["prenom"]; ?> </a></td>
				<td> <a href="index.php?action=CvMonDoct&id=<?= $d["id_d"] ?>"><?php echo $d["sujet"]; ?> </a></td>
                <td> <a href="index.php?action=CvMonDoct&id=<?= $d["id_d"] ?>"><?php echo $d["telephone"]; ?> </a></td>
				<td> <a href="index.php?action=CvMonDoct&id=<?= $d["id_d"] ?>"><?php echo $d["email"]; ?> </a></td>
                <td><a class="btn btn-warning" href="index.php?action=EnvoyerMsg&id_receiver=<?= $d["id_d"] ?>&type_receiver=doctorants&id_sender=<?= $_SESSION["id"] ?>&type_sender=professeurs "><i class="fab fa-facebook-messenger"></i></a></td><?php } ?> 
			</tr>	
</table>

</div>
<?php } ?>

