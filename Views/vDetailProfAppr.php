<table class="table">
	<tr>		 
		<th><i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>Condidat </th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Spécialité</th>
	</tr>			
		 
		 	<?php 
            
			
			foreach($ProfAppr as $p){
			?>
			<tr>
				<td> <a href="#"><?php echo $p["nom"]." ".$p["prenom"]; ?> </a></td>
                <td> <a href="#"><?php echo $p["email"]; ?> </a></td>
                <td> <a href="#"><?php echo $p["telephone"]; ?> </a></td>
                <td> <a href="#"><?php echo $p["specialite"]; ?> </a></td>
				<td> <a class="btn btn-success" href="index.php?action=AccepterProf&id=<?= $p["id_p"] ?>&nom=<?=  $p["nom"] ?>&prenom=<?=  $p["prenom"] ?>&email=<?=  $p["email"] ?>&telephone=<?=  $p["telephone"] ?>&specialite=<?=  $p["specialite"] ?>&pass=<?=  $p["password"] ?>"> Accepter</a></td>
        <td> <a class="btn btn-danger" href="index.php?action=RejeterProf&id=<?=  $p["id_p"] ?>"> Rejeter<?php } ?> </a></td>
			</tr>	
</table>