<?php
// echo password_hash("1234",PASSWORD_DEFAULT);
?>
<body class="bg-gradient-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-icon">
                        <i class="fas fa-user-graduate fa-3x" style="font-size: 30em;"></i>
                        </div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Connexion en tant que Doctorant</h1>
                                    </div>
                                    <form class="user" id="frm" name = "loginForm" action = "index.php?action=loginDoct" method = "post">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input name="email" class="form-control" value="<?= $email ?? "" ?>" placeholder="Email Académique" type="email">
                                        </div>
                                        <span class="Err"><?= $erreur["email"] ?? "" ?> </span>
                                        <br><br>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input name="pass" class="form-control" value="<?= $pass ?? "" ?>" placeholder="Mot de Passe" type="password" id="password-field">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="Err"><?= $erreur["user"] ?? "" ?> </span>
                                        <br>
                                        <div class="form-group">
                                            <span class="error-message" id="error-message"><?= $errorMessage ?? "" ?></span>
                                        </div>
                                        <br>
                                        <div class="form-group text-center">
                                            <button type="submit" name="submit" class="btn btn-success">Se Connecter</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Si vous avez oublié votre mot de passe, n'hésitez pas à visiter l'administration.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#toggle-password');
        const passwordField = document.querySelector('#password-field');

        togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>