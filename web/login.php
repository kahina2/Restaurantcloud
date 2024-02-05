<?php
session_start();
if (isset($_POST["seconnecter"])) {
    require('connexionbdd.php');
    $trouve = false;
    // recuperer les email et mdp de la base de donnée
    $compte = $baserestau->query("SELECT email,mdp FROM admin");
    while ($tuple = $compte->fetch()) {
        if ($tuple['email'] == $_POST['email'] && $tuple['mdp'] == $_POST['mdp']) {
            $trouve = true;
            break;
        }
    };
    if ($trouve == true) {
        $_SESSION['connected'] = true;
        // laisser la session enregistrer
        $_SESSION['email'] = $_POST['email'];
        header('Location:dashbord.php');
    } else {
        $_SESSION['connected'] = false;
        header('Location:login.php');
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Connection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">

</head>

<body class="img js-fullheight" style="background-image: url(img/login.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Login</h3>
                        <form action="login.php" method="post" class="signin-form">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" name="mdp" type="password" class="form-control" placeholder="Mot de passe" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="seconnecter" id="seconnecter" class="form-control btn btn-primary submit px-3">Se
                                    connecter</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Se souvenir de moi
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Mot de passe oublier?</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>