<?php 
if(count($Prof) == 0){?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;n'existe Aucun professeur dans laboratoire :</h1>
<br>
<?php
}
else{ ?>
<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Les professeurs de laboratoire :</h1>
<br>
<table class="table">
			<tr> 
				<th>Nom </th>
				<th>Spécialité</th>
				<th>Téléphone</th>
        <th>Email</th>
        <th></th>
        <th></th>
			</tr>	
		 
		 	<?php 
			foreach($Prof as $p){
			?>
			<tr>
				<td> <a href="index.php?action=SesDoct&id=<?= $p["id_p"] ?>"><?php echo $p["nom"]." ".$p["prenom"]; ?> </a></td>
				<td> <a href="index.php?action=SesDoct&id=<?= $p["id_p"] ?>"><?php echo $p["specialite"]; ?> </a></td>
        		<td> <a href="index.php?action=SesDoct&id=<?= $p["id_p"] ?>"><?php echo $p["telephone"]; ?> </a></td>
				<td> <a href="index.php?action=SesDoct&id=<?= $p["id_p"] ?>"><?php echo $p["email"]; ?> </a></td>
				<td><a class="btn btn-warning" href="index.php?action=EnvoyerMsg&id_receiver=<?= $p["id_p"] ?>&type_receiver=professeurs&id_sender=<?= $id ?>&type_sender=administration "><i class="fab fa-facebook-messenger"></i></a></td>	
        		<td> <a class="btn btn-primary" href="index.php?action=ModifierProf&id=<?=  $p["id_p"] ?>"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
        		<td> <a class="btn btn-secondary" href="index.php?action=SupprimerProf&id=<?=  $p["id_p"] ?>"><i class="bi bi-trash"></i><?php } ?> </a></td>
			</tr>	
            <tr>
                <td colspan="4"><a href="index.php?action=AjouterProf"><i class="bi bi-plus-circle"></i> Ajouter un Professeur </a></td> 
            </tr>
</table>

</div>

<?php } ?>