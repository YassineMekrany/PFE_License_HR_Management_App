<form id="frm" action="index.php?action=AjouterOrganisation" method="post">
<br><br>
<div class="formB">
    <br>
    <h1> Ajouter une Organisation : </h1>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
      </div>
      <input name="sujet" class="form-control" value="<?= $sujet ?? "" ?>" placeholder="Sujet de l'organisation" type="text" >
    </div>
    <span class="Err"><?= $erreur["sujet"] ?? "" ?> </span>

    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="bi bi-map-marker"></i> </span>
      </div>
      <input name="lieu" class="form-control" value="<?= $lieu ?? "" ?>" placeholder="Lieu de l'organisation" type="text" >
    </div>
    <span class="Err"><?= $erreur["lieu"] ?? "" ?> </span>
    
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> Date d'organisation </span>
      </div>
      <input name="date_org" class="form-control" value="<?= $date_org ?? "" ?>" placeholder="date" type="date" >
    </div>
    <span class="Err"><?= $erreur["date_org"] ?? "" ?> </span>
    <fieldset>
    <legend style="color:blue">Doctorants invités:</legend>
    <?php foreach ($Doct as $d) { ?>
        <input type="checkbox" name="ids_d[]" value="<?= $d['id_d'] ?>" id="doct" <?= (in_array($d['id_d'], $ids_d)) ? "checked" : "" ?>>
        <label for="doct<?= $d['id_d'] ?>"> <?= $d["nom"]." ".$d["prenom"] ?></label>
        <br>
    <?php } ?>
    </fieldset>

    <span class="Err"><?= $erreur["ids_d"] ?? "" ?> </span>
    <br>
    <fieldset>
        <legend style="color:blue">Professeurs invités :</legend>
        <?php foreach ($Prof as $p) { ?>
        <input type="checkbox" name="ids_p[]" value="<?= $p['id_p'] ?>" id="prof" <?= (in_array($p['id_p'], $ids_p)) ? "checked" : "" ?>>
        <label for="prof"> <?= $p["nom"]." ".$p["prenom"] ?></label>
        <br>
        <?php } ?>
    </fieldset>
    <span class="Err"><?= $erreur["ids_p"] ?? "" ?> </span>

    <div class="form-group">
      <br>
      <button type="submit" name="submit" class="btn btn-success" value="Ajouter">Ajouter</button>
      <br><br>
    </div>  
  </div>
</form>