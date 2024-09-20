<?php include("head.php"); ?>

<?php
// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    
    // Récupérer les valeurs des champs de formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
   
    $email = "e.doctorat.fes@gmail.com";
    
    // Adresse e-mail de destination
    $to = $_POST['email'];
    
    // Sujet de l'e-mail
    $subject = 'Nouvelle préinscription: ' . $nom . ' ' . $prenom;
    
    // Corps de l'e-mail
    $message = 'Nom: ' . $nom . "\r\n" .
               'Prénom: ' . $prenom . "\r\n" .
               'Email: ' . $email . "\r\n";
    
    // En-têtes de l'e-mail
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    // Envoyer l'e-mail
    if(mail($to, $subject, $message, $headers)) {
        // Si l'e-mail est envoyé avec succès
        echo 'success';
    } else {
        // Si l'e-mail n'a pas pu être envoyé
        echo 'error';
    }
    
}
?>
