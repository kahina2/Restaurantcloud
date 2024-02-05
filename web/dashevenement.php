<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/dash.css">
    <title>Evenement</title>
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

    <div class="evenement">
        <div class="container mt-5">
            <h2 class="text-center">Informations de l'événement</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Caractéristique</th>
                        <th>Donnée</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assurez-vous de bien inclure votre fichier de connexion à la base de données
                    require("connexionbdd.php");

                    // Exécutez la requête SELECT
                    $result = $baserestau->query("SELECT * FROM evenement");

                    // Vérifiez si la requête a réussi
                    if ($result) {
                        // Parcourez les résultats de la requête
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            // Vérifiez si les clés existent avant de les utiliser
                            $titre = isset($row['titre']) ? $row['titre'] : '';
                            $description = isset($row['description']) ? $row['description'] : '';
                            $place = isset($row['place']) ? $row['place'] : '';
                            $heur = isset($row['heur']) ? $row['heur'] : '';

                            echo " <td>Titre</td>";
                            echo " <td>$titre</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo " <td>Description</td>";

                            echo " <td>$description</td>";

                            echo "</tr>";
                            echo "<tr>";
                            echo " <td>Place</td>";
                            echo " <td>$place</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo " <td>heure</td>";
                            echo " <td>$heur</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Affichez un message d'erreur si la requête a échoué
                        echo "Erreur lors de la récupération des données : " . $baserestau->errorInfo()[2];
                    }
                    ?>
                </tbody>
            </table>

            <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                Modifier
            </button>
        </div>

        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier les informations de l'événement
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="titre" name="titre" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="descriptioneven" name="descriptioneven" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="place" class="form-label">Place</label>
                                <input type="text" class="form-control" id="place" name="place" required>
                            </div>
                            <div class="mb-3">
                                <label for="heure" class="form-label">Heure</label>
                                <input type="text" class="form-control" id="heure" name="heure" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn">Changer</button>
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