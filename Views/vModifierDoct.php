<form id="frm" action="index.php?action=ModifierDoct" method="post">
    <div class="formH" style="color:orange;background-color:white;" >
        <p style="color:blue;">Modifer  les informations de Doctorant : <?= $Doctorant ?></p>
    </div><br>

    <input type="hidden" name="id" value="<?= $id ?>" /> 

    <div class="formB">
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="nom" class="form-control" value="<?= $nom ?? "" ?>" placeholder="Nom" type="text">
        </div>
        <span class="Err"><?= $erreur["nom"] ?? "" ?> </span>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="prenom" class="form-control" value="<?= $prenom ?? "" ?>" placeholder="Prénom" type="text">
        </div>
        <span class="Err"><?= $erreur["prenom"] ?? "" ?> </span>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" class="form-control" value="<?= $email ?? "" ?>" placeholder="Email" type="email">
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
            <input name="telephone" class="form-control" value="<?= $telephone ?? "" ?>" placeholder="n° Téléphone" type="text">
        </div>
        <span class="Err"><?= $erreur["telephone"] ?? "" ?> </span>

        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-user-tie"></i></span>
            </div>

            <select name="id_encadrant">
                <option value="" length="50">----Encadrant----</option>
                <?php foreach ($prof as $p): ?>
                <option value="<?= $p["id_p"] ?>" <?= ($p["id_p"]==$id_encadrant)?"selected": "" ?> ><?= $p["nom"]." ".$p["prenom"] ?></option>
                <?php endforeach; ?>
			</select>
	</div>	
<span class="Err"><?= $erreur["encadrant"] ?? "" ?> </span>
<span class="Err"><?= $erreur["encadrant"] ?? "" ?> </span>
<div class="form-group input-group">
	<div class="input-group-prepend">
		<span class="input-group-text"> <i class="fa fa-book"></i> </span>
	</div>
	<input name="sujet" class="form-control" value="<?= $sujet ?? "" ?>" placeholder="sujet" type="text">
</div>
<span class="Err"><?= $erreur["sujet"] ?? "" ?> </span>

<div class="form-group input-group">
	<div class="input-group-prepend">
		<span class="input-group-text"> </span>
	</div>
	<input name="CNE" class="form-control" value="<?= $CNE ?? "" ?>" placeholder="CNE" type="text">
</div>
<span class="Err"><?= $erreur["CNE"] ?? "" ?> </span>
<div class="form-group">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<button type="submit" class="btn btn-primary">Modifier</button><br>
</div>  
</div>                                                                                     
</form>