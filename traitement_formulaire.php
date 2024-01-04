<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "root";
$base_de_donnees = "Restaurant2.0";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $Name = !empty($_POST['Name']) ? $_POST['Name'] : null;
    $Firstname = !empty($_POST['Firstname']) ? $_POST['Firstname'] : null;
    $Email = !empty($_POST['Email']) ? $_POST['Email'] : null;
    $Message = !empty($_POST['Message']) ? $_POST['Message'] : null;

    // Vérifier que les valeurs ne sont pas nulles avant l'insertion
    if ($Name !== null && $Firstname !== null && $Email !== null && $Message !== null) {
        // Requête SQL pour insérer les données dans la base de données
        $query = $connexion->prepare("INSERT INTO contactForm (Name, Firstname, Email, Message) VALUES (:Name, :Firstname, :Email, :Message)");
        $query->bindParam(":Name", $Name);
        $query->bindParam(":Firstname", $Firstname);
        $query->bindParam(":Email", $Email);
        $query->bindParam(":Message", $Message);
        $query->execute();

        echo "Données insérées avec succès";
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }

} catch (PDOException $e) {
    echo "L'insertion des données a échoué : " . $e->getMessage();
}
?>
