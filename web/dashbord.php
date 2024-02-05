<?php
// Assurez-vous de bien inclure votre fichier de connexion à la base de données
require("connexionbdd.php");

// Initialisez les messages d'erreur
$emailError = $ancienmdpError = $nouveaumdpError = $confirmationmdpError = $updateMessage = "";

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les valeurs du formulaire
    $email = $_POST['email'];
    $ancienmdp = $_POST['ancienmdp'];
    $nouveaumdp = $_POST['MotDePasse'];
    $confirmationmdp = $_POST['ConfirmationMDP'];

    // Vérifiez si les champs sont vides
    if (empty($email)) {
        $emailError = "Le champ Email est requis.";
    }
    if (empty($ancienmdp)) {
        $ancienmdpError = "Le champ Mot de passe actuel est requis.";
    }
    if (empty($nouveaumdp)) {
        $nouveaumdpError = "Le champ Nouveau Mot de passe est requis.";
    }
    if (empty($confirmationmdp)) {
        $confirmationmdpError = "Le champ Confirmation Mot de passe est requis.";
    }

    // Vérifiez si les messages d'erreur sont vides, puis procédez à la validation
    if (empty($emailError) && empty($ancienmdpError) && empty($nouveaumdpError) && empty($confirmationmdpError)) {
        // Les champs sont remplis, procédez à la vérification des mots de passe
        $query = "SELECT * FROM admin WHERE email = :email AND mdp = :ancienmdp";
        $stmt = $baserestau->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':ancienmdp', $ancienmdp);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Le mot de passe actuel est correct, vérifiez les nouveaux mots de passe
            if ($nouveaumdp == $confirmationmdp) {
                // Mettez à jour le mot de passe dans la base de données
                $queryUpdate = "UPDATE admin SET mdp = :nouveaumdp WHERE email = :email";
                $stmtUpdate = $baserestau->prepare($queryUpdate);
                $stmtUpdate->bindParam(':nouveaumdp', $nouveaumdp);
                $stmtUpdate->bindParam(':email', $email);
                $stmtUpdate->execute();

                $updateMessage = "Mot de passe modifié avec succès.";
            } else {
                $confirmationmdpError = "Les nouveaux mots de passe ne correspondent pas.";
            }
        } else {
            $ancienmdpError = "Le mot de passe actuel est incorrect.";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/dash.css">
    <title>Dashboard</title>
</head>

<body>
    <header class="header" role="banner">
        <h1 class="logo">
            <a href="index.php">Mon <span>Restaurant</span></a>
        </h1>
        <div class="nav-wrap">
            <nav class="main-nav" role="navigation">
                <ul class="unstyled list-hover-slide">
                    <li><a href="dashbord.php">Profile</a></li>
                    <li><a href="dashinformation.php">Informations</a></li>
                    <li><a href="dashevenement.php">Evenement</a></li>
                    <li><a href="dashmenu.php">Menu</a></li>

                </ul>
            </nav>

        </div>
    </header>
    <nav class="navbar bg-body-tertiary" style="margin-left: 17.5em;">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <form class="d-flex profile" role="search">
                <a href="index.php" style="text-decoration: none;"> <label for="">Voir mon site </label></a>

            </form>
        </div>
    </nav>

    <div class="profilee">
        <h2 class="text-center mt-4"> Mon profile</h2>

        <form method="POST" action="dashbord.php">
            <!-- Affichez les messages d'erreur et de mise à jour -->
            <p style="color: red;"><?php echo $emailError; ?></p>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <p style="color: red;"><?php echo $ancienmdpError; ?></p>
            <div class="mb-3">
                <label for="ancienmdp" class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" id="ancienmdp" name="ancienmdp" required>
            </div>
            <p style="color: red;"><?php echo $nouveaumdpError; ?></p>
            <div class="mb-3">
                <label for="MotDePasse" class="form-label">Nouveau Mot de passe</label>
                <input type="password" class="form-control" id="MotDePasse" name="MotDePasse" required>
            </div>
            <p style="color: red;"><?php echo $confirmationmdpError; ?></p>
            <div class="mb-3">
                <label for="ConfirmationMDP" class="form-label">Confirmation Mot de passe</label>
                <input type="password" class="form-control" id="ConfirmationMDP" name="ConfirmationMDP" required>
            </div>

            <button type="submit" class="btn w-100">
                Modifier
            </button>

        </form>

        <!-- Afficher le message de mise à jour -->
        <p style="color: green;"><?php echo $updateMessage; ?></p>
    </div>



    <!-- ... Votre code HTML existant ... -->

    <!-- ... Fin de votre code HTML ... -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>