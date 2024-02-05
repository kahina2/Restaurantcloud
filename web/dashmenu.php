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


    <div class="menu">
        <div class="container mt-5">
            <h2 class="text-center">Informations du menu</h2>
            <h5>Un élement du menu ne peut pas avoir le meme nom</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assurez-vous de bien inclure votre fichier de connexion à la base de données
                    require("connexionbdd.php");

                    // Exécutez la requête SELECT
                    $result = $baserestau->query("SELECT * FROM menu");

                    // Vérifiez si la requête a réussi
                    if ($result) {
                        // Parcourez les résultats de la requête
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";

                            // Vérifiez si les clés existent avant de les utiliser
                            $nom = isset($row['Nom']) ? $row['Nom'] : '';
                            $description = isset($row['descriptionn']) ? $row['descriptionn'] : '';
                            $prix = isset($row['prix']) ? $row['prix'] : '';
                            $categorie = isset($row['categorie']) ? $row['categorie'] : '';

                            echo "<td>$nom</td>";
                            echo "<td>$description</td>";
                            echo "<td>$prix</td>";
                            echo "<td>$categorie</td>";
                            echo '<td> 
                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal3" onclick="modifierElement(\'' . $row['Nom'] . '\')">Modifier</button>
                                    <a class="btn btn-danger btn-sm" href="dashmenu.php?delete=' . $nom . '">Supprimer</a>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        // Affichez un message d'erreur si la requête a échoué
                        echo "Erreur lors de la récupération des données : " . $baserestau->errorInfo()[2];
                    }

                    // N'oubliez pas de libérer les ressources après avoir terminé
                    $result->closeCursor();

                    if (isset($_GET['delete'])) {
                        $nomToDelete = $_GET['delete'];

                        // Utilisez une requête DELETE pour supprimer l'élément de la base de données
                        $query = "DELETE FROM menu WHERE Nom = '$nomToDelete'";
                        $resultDelete = $baserestau->exec($query);

                        // Vérifiez si la suppression a réussi
                        if ($resultDelete) {
                            // Redirigez vers la page du tableau de bord après la suppression
                            header("Location: dashmenu.php");
                            exit();
                        } else {
                            echo "Erreur lors de la suppression : " . $baserestau->errorInfo()[2];
                        }
                    }
                    ?>
                </tbody>
            </table>

            <a class="btn w-100" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Ajouter un nouvel élément
            </a>
        </div>

        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'élément du menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        // Assurez-vous de bien inclure votre fichier de connexion à la base de données
                        require("connexionbdd.php");

                        // Vérifiez si la requête a réussi
                        if ($result) {
                            // Parcourez les résultats de la requête
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                // Stockez les valeurs dans des variables pour les utiliser dans le formulaire
                                $nom = $row['Nom'];
                                $description = $row['descriptionn'];
                                $prix = $row['prix'];
                                $categorie = $row['categorie'];

                                echo "<tr>";
                                // ... (le reste de votre code d'affichage)
                                echo '<td> 
               <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal3" onclick="modifierElement(\'' . $nom . '\')">Modifier</button>
                <a class="btn btn-danger btn-sm" href="dashmenu.php?delete=' . $nom . '">Supprimer</a>
              </td>';
                                echo "</tr>";
                            }
                        } else {
                            // Affichez un message d'erreur si la requête a échoué
                            echo "Erreur lors de la récupération des données : " . $baserestau->errorInfo()[2];
                        }

                        // N'oubliez pas de libérer les ressources après avoir terminé
                        $result->closeCursor();
                        ?>

                        <!-- Ensuite, affichez le formulaire en utilisant les variables stockées -->
                        <form method="POST" action="dashmenu.php">
                            <div class="mb-3">
                                <label for="nomm" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nomm" name="nomm" value="<?php echo $nom; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="descriptionm" class="form-label">Description</label>
                                <textarea class="form-control" id="descriptionm" name="descriptionm" rows="3" required><?php echo $description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="prixm" class="form-label">Prix</label>
                                <input type="text" class="form-control" id="prixm" name="prixm" value="<?php echo $prix; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoriem" class="form-label">Catégorie</label>
                                <select class="form-select" id="categoriem" name="categoriem" required>
                                    <option value="Dinner" <?php echo ($categorie == 'Dinner') ? 'selected' : ''; ?>>Dinner</option>
                                    <option value="Breakfast" <?php echo ($categorie == 'Breakfast') ? 'selected' : ''; ?>>Breakfast</option>
                                    <option value="Lunch" <?php echo ($categorie == 'Lunch') ? 'selected' : ''; ?>>Lunch</option>
                                </select>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn" name="modifier">Modifier</button>
                            </div>
                            <?php

                            // Assurez-vous de bien inclure votre fichier de connexion à la base de données
                            require("connexionbdd.php");

                            // Vérifiez si le formulaire de modification a été soumis
                            if (isset($_POST['modifier'])) {
                                // Récupérez les valeurs du formulaire
                                $nomm = $_POST['nomm'];
                                $descriptionm = $_POST['descriptionm'];
                                $prixm = $_POST['prixm'];
                                $categoriem = $_POST['categoriem'];

                                // Utilisez une requête UPDATE pour modifier les données dans la base de données
                                $query = "UPDATE menu SET descriptionn = '$descriptionm', prix = '$prixm', categorie = '$categoriem' WHERE Nom = '$nomm'";
                                $result = $baserestau->exec($query);

                                if ($result !== false) {
                                    echo '<script>window.location.href = "dashmenu.php";</script>';
                                } else {
                                    echo "Erreur lors de la modification : " . implode(" - ", $baserestau->errorInfo());
                                }
                            }
                            ?>
                        </form>


                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un nouvel élément au menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="dashmenu.php" method="post">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix</label>
                                <input type="text" class="form-control" id="prix" name="prix" required>
                            </div>
                            <div class="mb-3">
                                <label for="categorie" class="form-label">Catégorie</label>
                                <select class="form-select" id="categorie" name="categorie" required>
                                    <option value="Dinner">Dinner</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                </select>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn" name="ajouter">Ajouter</button>
                        </div>

                        <?php

                        if (isset($_POST['ajouter'])) {
                            require("connexionbdd.php");
                            $nom = $_POST['nom'];
                            $description = $_POST['description'];
                            $prix = $_POST['prix'];
                            $categorie = $_POST['categorie'];

                            $query = "INSERT INTO menu(Nom, descriptionn, prix, categorie) VALUES ('$nom', '$description', '$prix', '$categorie')";

                            $result = $baserestau->exec($query);

                            if ($result !== false) {
                                echo '<script>window.location.href = "dashmenu.php";</script>';
                            } else {
                                echo "Erreur lors de la modification : " . implode(" - ", $baserestau->errorInfo());
                            }
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <!-- Ajoutez ce script à la fin de votre page avant la balise </body> -->
    <!-- Ajoutez ce script à la fin de votre page avant la balise </body> -->




</body>

</html>