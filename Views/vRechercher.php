<?php
if (count($results) > 0) {
    echo '<br><h1 class="btn btn-secondary">Résultats</h1><br>';
    echo '<table class="table">';
    echo '<thead><tr><th>Nom et prénom</th></thead>';
    echo '<tbody>';

    foreach ($results as $row) {
        $nom = $row['nom']." ".$row['prenom']." ( ".$row['type']." ) ";
        $type = $row['type'];
        $id = $row['id'];
        ?>
        <tr><td><?= $nom ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <a href="index.php?action=EnvoyerMsg&id_receiver=<?= $id ?>&type_receiver=<?= $type ?>&id_sender=<?= $id_sender ?>&type_sender=<?= $type_sender ?>"> <i  style="font-size: 2em;" class="fab fa-facebook-messenger"></i></a></td></tr>
    <?php }
    echo '</tbody></table>';
} else {
    echo "Aucun résultat trouvé.";
}
?>
