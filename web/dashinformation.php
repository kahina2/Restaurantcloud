<?php
require("connexionbdd.php");

// Vérifiez si le formulaire de modification a été soumis
if (isset($_POST['modifierInfos'])) {
    // Récupérez les valeurs du formulaire
    $nom = $baserestau->quote($_POST['noms']);
    $specialite = $baserestau->quote($_POST['specialite']);
    $phraseaccroche = $baserestau->quote($_POST['phraseaccroche']);
    $adresse = $baserestau->quote($_POST['adresse']);
    $fblink = $baserestau->quote($_POST['fblink']);
    $phonenumber = $baserestau->quote($_POST['phonenumber']);
    $heureouverture = $baserestau->quote($_POST['heureouverture']);
    $heurefermeture = $baserestau->quote($_POST['heurefermeture']);

    // Utilisez une requête UPDATE pour modifier les données dans la base de données
    $query = "UPDATE information SET nom = $nom, specialite = $specialite, phraseaccroche = $phraseaccroche, 
              adresse = $adresse, fblink = $fblink, phonenumber = $phonenumber, 
              heureouverture = $heureouverture, heurefermeture = $heurefermeture WHERE id = 1";
    $result = $baserestau->exec($query);

    if ($result !== false) {
        echo '<script>window.location.href = "dashinformation.php";</script>';
    } else {
        echo "Erreur lors de la modification : " . implode(" - ", $baserestau->errorInfo());
    }
} ?>
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


    <div class="information">
        <!-- As a heading -->
        <?php
        // Assurez-vous de bien inclure votre fichier de connexion à la base de données
        require("connexionbdd.php");

        // Récupérez les valeurs de votre base de données pour l'ID 1
        $query = "SELECT * FROM information WHERE id = 1";
        $result = $baserestau->query($query);

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <div class="container mt-5">
            <h2 class="text-center"> Informations du site</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Caractéristique</th>
                        <th>Donnée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nom</td>
                        <td><?php echo $row['nom']; ?></td>
                    </tr>
                    <tr>
                        <td>Spécialité</td>
                        <td><?php echo $row['specialite']; ?></td>
                    </tr>
                    <tr>
                        <td>Phrase d'accroche</td>
                        <td><?php echo $row['phraseaccroche']; ?></td>
                    </tr>
                    <tr>
                        <td>Adresse</td>
                        <td><?php echo $row['adresse']; ?></td>
                    </tr>
                    <tr>
                        <td>Page Facebook</td>
                        <td><?php echo $row['fblink']; ?></td>
                    </tr>
                    <tr>
                        <td>Numéro de téléphone</td>
                        <td><?php echo $row['phonenumber']; ?></td>
                    </tr>
                    <tr>
                        <td>Heure d'ouverture</td>
                        <td><?php echo $row['heureouverture']; ?></td>
                    </tr>
                    <tr>
                        <td>Heure de fermeture</td>
                        <td><?php echo $row['heurefermeture']; ?></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Modifier
            </button>


        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Remplis les informations de ton site</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="dashinformation.php">
                            <div class="mb-3">
                                <label for="nomsite" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nomsite" name="noms" value="<?php echo $row['nom']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="specialite" class="form-label">Spécialité</label>
                                <input type="text" class="form-control" id="specialite" name="specialite" value="<?php echo $row['specialite']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phraseaccroche" class="form-label">Phrase d'accroche</label>
                                <input type="text" class="form-control" id="phraseaccroche" name="phraseaccroche" value="<?php echo $row['phraseaccroche']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $row['adresse']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="fblink" class="form-label">Page Facebook</label>
                                <input type="text" class="form-control" id="fblink" name="fblink" value="<?php echo $row['fblink']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phonenumber" class="form-label">Numéro de téléphone</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $row['phonenumber']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="heureouverture" class="form-label">Heure d'ouverture</label>
                                <input type="text" class="form-control" id="heureouverture" name="heureouverture" value="<?php echo $row['heureouverture']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="heurefermeture" class="form-label">Heure de fermeture</label>
                                <input type="text" class="form-control" id="heurefermeture" name="heurefermeture" value="<?php echo $row['heurefermeture']; ?>" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn" name="modifierInfos">Changer</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
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