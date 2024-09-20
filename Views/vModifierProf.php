<form id="frm" action="index.php?action=ModifierProf" method="post">
    <br>
    <div class="formH" style="color:orange;background-color:white;" >
	<p style="color:blue;">Modifer les informations de Professeur : <?= $Professeur ?? "" ?></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div><br>

    <div class="formB"><br>
	<input type="hidden" name="id" value="<?= $id ?>" /> 
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="nom" class="form-control" value="<?= $nom ?? "" ?>" type="text" placeholder="Nom">
        </div>
        <span class="Err"><?= $erreur["nom"] ?? "" ?> </span>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="prenom" class="form-control" value="<?= $prenom ?? "" ?>" type="text" placeholder="Prénom">
        </div>  
        <span class="Err"><?= $erreur["prenom"] ?? "" ?> </span>  
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" class="form-control" value="<?= $email ?? "" ?>" type="email" placeholder="Email Académique">
        </div>
        <span class="Err"><?= $erreur["email"] ?? "" ?> </span>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <select class="custom-select" style="max-width: 120px;">
                <option selected="">+212</option>
                <option value="1">+213</option>
                <option value="2">+198</option>
                <option value="3">+701</option>
            </select>
            <input name="telephone" class="form-control" value="<?= $telephone ?? "" ?>" type="text" placeholder="n° Téléphone">
        </div>
        <span class="Err"><?= $erreur["telephone"] ?? "" ?> </span>

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-graduation-cap"></i></span>
		</div>
        <input name="specialite" class="form-control" value="<?= $specialite ?? "" ?>" type="text" placeholder="Spécialité">
    </div>
	<span class="Err"><?= $erreur["specialite"] ?? "" ?> </span>                               
    <div class="form-group">
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<button type="submit" class="btn btn-primary">Modifier</button><br><br>
    </div>  
</div>                                                                 
</form>