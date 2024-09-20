<?php
session_start();
require_once("fonction_BD.php");
require_once("vendor/autoload.php");
include_once("head.php");

$email = $_POST["email"];

$phone = getPhoneByEmail($email);

if ($email !== null) {

    // Générer un code aléatoire
    $code = rand(1000, 9999);
    $message = "Votre code de vérification est : " . $code;

    $client = new \GuzzleHttp\Client();
    $res = $client->request('POST', 'https://www.freesms.ma/sendmsg.php', [
        'form_params' => [
            'source' => 'FreeSMS', // le nom de l'expéditeur
            'sms_body' => $message,
            'sms_mobile' => $phone, // le numéro de téléphone du destinataire (format international ex: +212)
            'sms_key' => 'VotreCle',
        ]
    ]);

    $response = json_decode($res->getBody(), true);

    if ($response['error'] === false) {
        // Envoyer le code généré à la page suivante pour vérification
        header("Location: verifyCode.php?phone=$phone&code=$code");
        exit();
    } else {
        echo 'Erreur lors de l\'envoi du SMS: ' . $response['msg'];
    }
    


?>

    <body class="bg-gradient-left">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Mot de passe oublié</h1>
                                    </div>
                                    <form class="user" id="frm" name="forgotPasswordForm" action="" method="post">  
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">code envoyé à : <?= $email ?></span>
                                            </div>
                                        </div> 
                                        <div class="form-group input-group">   
                                            <div class="input-group-prepend">
                                                <input type="text" class="form-control" id="verification_code" name="verification_code" placeholder="saisir le code de confirmation">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block btn-sm">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php 
}
else { ?>
    <body class="bg-gradient-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Mot de passe oublié</h1>
                                        </div>
                                        <form>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aucun membre avec cet email</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php
}
?>
