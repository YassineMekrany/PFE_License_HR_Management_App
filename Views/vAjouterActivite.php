<form id="frm" action="index.php?action=AjouterActivite" method="post">
  <br><br>
  <div class="formB">
    <br>
    <h1> Ajouter une Activité : </h1>
    <input type="hidden" name="id_d" value="<?= $id ?>">
    <input type="hidden" name="id_p" value="<?= $id_encadrant ?>">
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i>Resumé d'activité </span>
      </div>
      <textarea name="resume" style="width:100%" placeholder="Resumé" value="<?= $resume ?? "" ?>"></textarea>
    </div>
    <span class="Err"><?= $erreur["resume"] ?? "" ?> </span>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="type" class="form-control" placeholder="Type d'activité" type="text" value="<?= $type ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["type"] ?? "" ?> </span>
     <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="lieu" class="form-control" placeholder="lieu d'activité" type="text" value="<?= $lieu ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["lieu"] ?? "" ?> </span>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> Date d'activité </span>
      </div>
      <input name="date_act" class="form-control" placeholder="date" type="date" value="<?= $date_act ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["date_act"] ?? "" ?> </span>
    <div class="form-group">
      <br>
      <button type="submit" name="submit" class="btn btn-success" value="Ajouter">Ajouter</button>
      <br><br>
    </div>  
  </div>
</form>