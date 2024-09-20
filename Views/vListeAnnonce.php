<div style="background-color:white;"><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bullhorn"></i>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gérer les annonces :</h1>
<br>

<br>
<table class="table">
			<tr> 
				<th>date de début </th>
				<th>Sujet</th>
                <th>Date Limite</th>
				<th>Activé</th>
        		<th></th>
        		<th></th>
			</tr>	
		 
		 	<?php 
            
			
			foreach($annonce as $an){
			?>
			<tr>
				<td> <a href="#"><?php echo $an["date_deb"]; ?> </a></td>
				<td> <a href="#"><?php echo $an["message"]; ?> </a></td>
				<td> <a href="#"><?php echo $an["date_lim"]; ?> </a></td>
				<td>
				<?php if ($an["Activer"] == 1) { ?>
					<i class="fas fa-check" style="color:green;font-size:24px;"></i>
				<?php } else { ?>
					<i class="fas fa-times" style="color:red;font-size:24px;"></i>
				<?php } ?>
				</td><td> <a class="btn btn-primary" href="index.php?action=ModifierAnnonce&id=<?=  $an["id_an"] ?>"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
				<td> <a class="btn btn-secondary" href="index.php?action=DeleteAnnonce&id=<?=  $an["id_an"] ?>"><i class="bi bi-trash"></i><?php } ?> </a></td>
			</tr>	
            <tr>
                <td colspan="4"><a href="index.php?action=AjouterAnnonce"><i class="bi bi-plus-circle"></i>Ajouter une Annonce </a></td> 
            </tr>
</table>









</div>