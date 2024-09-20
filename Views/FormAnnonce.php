<div class="form-group input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Date de début</span>
  </div>
  <input name="date_deb" class="form-control" value="<?= $date_deb ?? "" ?>" placeholder="Date de début" type="date" >
</div>
<span class="Err"><?= $erreur["date_deb"] ?? "" ?> </span>

<div class="form-group input-group">
  <div class="input-group-prepend">
    <span class="input-group-text"> <i class="bi bi-map-marker"></i> </span>
  </div>
  <input name="message" class="form-control" value="<?= $message ?? "" ?>" placeholder="Message de l'annonce" type="text" >
</div>
<span class="Err"><?= $erreur["message"] ?? "" ?> </span>

<div class="form-group input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Date Limite de l'annonce</span>
  </div>
  <input name="date_limite" class="form-control" value="<?= $date_limite ?? "" ?>" placeholder="Date Limite de l'annonce" type="date" >
</div>
<span class="Err"><?= $erreur["date_limite"] ?? "" ?> </span>