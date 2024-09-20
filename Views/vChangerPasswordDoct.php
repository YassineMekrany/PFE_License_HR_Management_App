<br><br>
<div class="formB"><br>
<form method="post" action="index.php?action=ChangerPasswordDoct">
<h1> Changer votre mot de Passe </h1>
	<input type="hidden" name="email" value="<?= $email ?>">
	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fa fa-lock"></i></span>
		</div>
		<input name="pass" class="form-control" value="<?= $pass ?? "" ?>" placeholder="Mot de Passe Actuel" type="password" id="password-field0">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="button" id="toggle-password0">
				<i class="fa fa-eye"></i>
			</button>
		</div>
	</div>
			<span class="Err"><?= $erreur["pass"] ?? "" ?> </span>

	<div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fa fa-lock"></i></span>
		</div>
		<input name="pass1" class="form-control" value="<?= $pass1 ?? "" ?>" placeholder="Nouveau mot de Passe" type="password" id="password-field1">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="button" id="toggle-password1">
				<i class="fa fa-eye"></i>
			</button>
		</div>
	</div>
	<span class="Err"><?= $erreur["pass1"] ?? "" ?> </span>
		 
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
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-primary">Changer le mot de passe</button><br><br> 
</form>
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
	togglePassword('#toggle-password0', '#password-field0');
	togglePassword('#toggle-password1', '#password-field1');
	togglePassword('#toggle-password2', '#password-field2');
</script>