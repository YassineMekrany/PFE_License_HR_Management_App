<form id="frm" action="index.php?action=ModifierAnnonce" method="post">

<br><br>

<div class="formB"><br>
<h1> Modifier une Annonce : </h1>

<?php include_once("Views/FormAnnonce.php"); ?>                     

<input type="hidden" name="id" value="<?= $id ?? "" ?>">

<fieldset>
    <legend>Activation :</legend>
    <label>
        <input type="radio" name="Activer" value="1" <?= ($Activer==1)?"checked": "" ?>>
        Activer
    </label><br>
    <label>
        <input type="radio" name="Activer" value="0" <?= ($Activer==0)?"checked": "" ?>>
        Désactiver
    </label>
</fieldset>

	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-success">Modifier</button><br><br>
</form>
</div>