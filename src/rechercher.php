<?php
// Connexion à la base de données
include('bdd/connexion.php');
// $serveur = "localhost";
// $nom_utilisateur = "votre_utilisateur";
// $mot_de_passe = "votre_mot_de_passe";
// $nom_base_de_donnees = "votre_base_de_donnees";

// try {
//     $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $nom_utilisateur, $mot_de_passe);
//     // Configure PDO pour générer des exceptions en cas d'erreurs SQL
//     $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Échec de la connexion : " . $e->getMessage());
// }

// Requête pour récupérer les enregistrements en fonction de la recherche
if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $requete = "SELECT * FROM Electeurs WHERE Matricule LIKE ? OR Nom LIKE ? OR Prenom LIKE ? OR Email LIKE ?";
    $statement = $base->prepare($requete);
    // Ajout de '%' autour de la variable $recherche pour une correspondance partielle
    $recherche_param = "%$recherche%";
    $statement->execute([$recherche_param, $recherche_param, $recherche_param, $recherche_param]);

    // Génère les options pour la liste déroulante
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['ID_Electeur'] . "'>" . $row['Prenom'] . " " . $row['Nom'] . "</option>";
    }
}
