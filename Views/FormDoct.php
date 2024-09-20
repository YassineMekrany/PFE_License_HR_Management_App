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
	<option value="" length = "50">----Encadrant----</option>
	<?php foreach ($prof as $p): ?>
	<option value="<?= $p["id_p"] ?>" <?= ($p["id_p"]==$id_encadrant)?"selected": "" ?> ><?= $p["nom"]." ".$p["prenom"] ?></option>
	<?php endforeach; ?>
</select> <span class="Err"> </span>
</div>
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

<div class="form-group input-group">
	<div class="input-group-prepend">
		<span class="input-group-text"><i class="fa fa-lock"></i></span>
	</div>
	<input name="pass1" class="form-control" value="<?= $pass1 ?? "" ?>" placeholder="Mot de Passe" type="password" id="password-field1">
	<div class="input-group-append">
		<button class="btn btn-outline-secondary" type="button" id="toggle-password1">
			<i class="fa fa-eye"></i>
		</button>
	</div>
</div>
<span class="Err"><?= $erreur["pass1"] ?? "" ?> </span>
<div class="form-group">
	<span class="error-message" id="error-message"><?= $errorMessage ?? "" ?></span>
</div>  

<div class="form-group input-group">
<div class="input-group-prepend">
	<span class="input-group-text"><i class="fa fa-lock"></i></span>
</div>
<input name="pass2" class="form-control" value="<?= $pass2 ?? "" ?>" placeholder="Confirmer mot de Passe" type="password" id="password-field2">
<div class="input-group-append">
	<button class="btn btn-outline-secondary" type="button" id="toggle-password2">
		<i class="fa fa-eye"></i>
	</button>
</div>
</div>
<span class="Err"><?= $erreur["pass2"] ?? "" ?> </span>
<div class="form-group">
<span class="error-message" id="error-message"><?= $errorMessage ?? "" ?></span>
</div>                 
<script>
	function togglePassword(toggleId, passwordId) {
	const togglePassword = document.querySelector(toggleId);
	const passwordField = document.querySelector(passwordId);

	togglePassword.addEventListener('click', function() {
		const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
		passwordField.setAttribute('type', type);
		this.querySelector('i').classList.toggle('fa-eye');
		this.querySelector('i').classList.toggle('fa-eye-slash');
	});
	}
	togglePassword('#toggle-password1', '#password-field1');
	togglePassword('#toggle-password2', '#password-field2');
</script>