<form id="frm" action="index.php?action=AjouterPublication" method="post">
  <br><br>
  <div class="formB">
    <br>
    <h1> Ajouter une Publication : </h1>
    <input type="hidden" name="date_pub" value="<?= date('Y-m-d'); ?>">
    <input type="hidden" name="id_d" value="<?= $id ?>">
    <br>

    <div class="form-group input-group">
	  <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i>Resumé de publication </span>
      </div>
      <textarea name="resume" style="width:100%" placeholder="Resumé" value="<?= $resume ?? "" ?>"></textarea>
    </div>
    <span class="Err"><?= $erreur["resume"] ?? "" ?> </span>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="rang" class="form-control" placeholder="Rang" type="text" value="<?= $rang ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["rang"] ?? "" ?> </span>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="titre" class="form-control" placeholder="Titre" type="text" value="<?= $titre ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["titre"] ?? "" ?> </span>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="journal" class="form-control" placeholder="Nom du journal" type="text" value="<?= $journal ?? "" ?>">
    </div>
    <span class="Err"><?= $erreur["journal"] ?? "" ?> </span>
    <div class="form-group">
      <br>
      <button type="submit" name="submit" class="btn btn-success" value="Ajouter">Ajouter</button>
      <br><br>
    </div>  
  </div>
</form>