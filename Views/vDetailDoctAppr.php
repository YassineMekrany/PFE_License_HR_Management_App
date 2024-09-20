<table class="table">
	<tr>		 
		<th><i class="fas fa-chalkboard-teacher fa-lg mr-3"></i>Condidat </th>
        <th>Sujet</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>CNE</th>
	</tr>			
		 
		 	<?php 
            
			
			foreach($DoctAppr as $d){
			?>
			<tr>
				<td> <a href="#"><?php echo $d["nom"]." ".$d["prenom"]; ?> </a></td>
                <td> <a href="#"><?php echo $d["sujet"]; ?> </a></td>
                <td> <a href="#"><?php echo $d["email"]; ?> </a></td>
                <td> <a href="#"><?php echo $d["telephone"]; ?> </a></td>
                <td> <a href="#"><?php echo $d["CNE"]; ?> </a></td>
				<td> <a class="btn btn-success" href="index.php?action=AccepterDoctAppr&id=<?= $d["id_d"] ?>"> Accepter</a></td>
        <td> <a class="btn btn-danger" href="index.php?action=RejeterDoctAppr&id=<?=  $d["id_d"] ?>"> Rejeter<?php } ?> </a></td>
			</tr>	
</table>