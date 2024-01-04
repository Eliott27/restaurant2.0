<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$base_de_donnees = "Restaurant2.0";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifie si le formulaire de suppression a été soumis
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        // Requête SQL pour supprimer l'élément avec l'ID spécifié
        $query = $connexion->prepare("DELETE FROM contactForm WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

    // Requête SQL pour récupérer toutes les données de la table
    $query = $connexion->prepare("SELECT * FROM contactForm");
    $query->execute();

    // Récupérer les résultats dans un tableau associatif
    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <div class="sidebar-container">
                    <div class="sidebar-header">
                        <img src="Asset/logo.png" width="70" height="70" alt="">
                        <a class="sidebar-brand"><strong>Admin</strong></a>
                    </div>
                    <div class="sidebar-nav">
                        <a class="sidebar-item">
                            <i class="bi bi-house-door"></i>
                            <span>Dashboard</span>
                        </a>
                        <a class="sidebar-item">
                            <img src="Asset/iconMenu.png" width="20" height="20">
                            <span>Menu</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9 main-content">
                <h1><strong>Message</strong></h1>
                <table class="table table-striped table-bordered container-fluid"> 
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serveur = "localhost";
                        $utilisateur = "root";
                        $mot_de_passe = "root";
                        $base_de_donnees = "Restaurant2.0";

                        try {
                            $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
                            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Requête SQL pour récupérer toutes les données de la table
                            $query = $connexion->prepare("SELECT * FROM contactForm");
                            $query->execute();

                            // Récupérer les résultats dans un tableau associatif
                            $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultats as $row) {
                                echo "<tr id='row_" . $row['id'] . "'>";
                                echo "<td>" . $row['Name'] . "</td>";
                                echo "<td>" . $row["Firstname"] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>" . $row['Message'] . "</td>";
                                echo "<td>
                                        <form method='post' action=''>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <button type='submit' name='delete' class='btn btn-danger'>Supprimer</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }                            

                        } catch (PDOException $e) {
                            echo "La connexion a échoué : " . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
