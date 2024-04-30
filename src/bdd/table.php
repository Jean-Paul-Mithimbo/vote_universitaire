<?php
try {
    require_once("connexion.php");
    // Table des facultés
    $base->exec("
         CREATE TABLE Facultes (
            ID_Faculte INT PRIMARY KEY AUTO_INCREMENT,
            Nom_Faculte VARCHAR(255)
        );
    ");
    //Table des promotions 
    $base->exec("
        CREATE TABLE Promotions (
        ID_Promotion INT PRIMARY KEY AUTO_INCREMENT,
         Nom_Promotion VARCHAR(255)
        
        );
    ");
    // Table des postes
    $base->exec("
        CREATE TABLE Postes (
        ID_Poste INT PRIMARY KEY AUTO_INCREMENT,
        Nom_Poste VARCHAR(255)
        );
    ");
    // Table des électeurs
    $base->exec("
        
        CREATE TABLE Electeurs (
            ID_Electeur INT PRIMARY KEY AUTO_INCREMENT,
            Nom VARCHAR(255),
            Prenom VARCHAR(255),
            Matricule VARCHAR(10),
            Email VARCHAR(255),
            Photo VARCHAR(255),            
            ID_Promotion INT,
            ID_Faculte INT,
          
            FOREIGN KEY (ID_Promotion) REFERENCES Promotions(ID_Promotion),
            FOREIGN KEY (ID_Faculte) REFERENCES Facultes(ID_Faculte)
        );
    ");
    // Table admin
    $base->exec("
        
        CREATE TABLE Admin (
            ID_Admin INT PRIMARY KEY AUTO_INCREMENT,
            Nom VARCHAR(255),
            Prenom VARCHAR(255),
            Email VARCHAR(255),
            Photo VARCHAR(255)            
           
        );
    ");
    // Table des sessions électorales
    $base->exec("
        
        CREATE TABLE Sessions_Electorales (
            ID_Session INT PRIMARY KEY AUTO_INCREMENT,
            Date DATE,
            Detail VARCHAR(255)
        );
    ");
    // Table des candidats
    $base->exec("
        
        CREATE TABLE Candidats (
            ID_Candidat INT PRIMARY KEY AUTO_INCREMENT,
            Numero_Candidature INT,
            ID_Electeur INT,
            ID_Poste INT,
            ID_Session INT,
            FOREIGN KEY (ID_Electeur) REFERENCES Electeurs(ID_Electeur),
            FOREIGN KEY (ID_Poste) REFERENCES Postes(ID_Poste),
            FOREIGN KEY (ID_Session) REFERENCES Sessions_Electorales(ID_Session)
        );
    ");
    // Table des votes
    $base->exec("
         
        CREATE TABLE Votes (
            ID_Vote INT PRIMARY KEY AUTO_INCREMENT,
            ID_Candidat INT,
            ID_Electeur INT,
            FOREIGN KEY (ID_Candidat) REFERENCES Candidats(ID_Candidat),
            FOREIGN KEY (ID_Electeur) REFERENCES Electeurs(ID_Electeur)
        );
    ");
    // Vue pour les résultats par poste et session électorale
    $base->exec("
        CREATE VIEW Resultats AS
        SELECT 
            p.ID_Poste,
            p.Nom_Poste,
            s.ID_Session,
            s.Date AS Date_Session,
            s.Detail AS Lieu_Session,
            c.ID_Candidat,
            c.Numero_Candidature,
            e.Nom AS Nom_Candidat,
            e.Prenom AS Prenom_Candidat,
            e.Matricule AS Matricule_Candidat,
            pr.Nom_Promotion AS Promotion_Candidat,
            pr.ID_Promotion AS ID_Promotion_Candidat,
            COUNT(v.ID_Vote) AS Nombre_de_voix,
            COUNT(v.ID_Vote) * 100.0 / SUM(COUNT(v.ID_Vote)) OVER(PARTITION BY c.ID_Poste, s.ID_Session) AS Pourcentage_de_voix
        FROM
            Postes p
        JOIN 
            Candidats c ON p.ID_Poste = c.ID_Poste
        JOIN 
            Sessions_Electorales s ON c.ID_Session = s.ID_Session
        JOIN 
            Electeurs e ON c.ID_Electeur = e.ID_Electeur
        JOIN 
            Promotions pr ON e.ID_Promotion = pr.ID_Promotion
        LEFT JOIN 
            Votes v ON c.ID_Candidat = v.ID_Candidat
        GROUP BY 
            p.ID_Poste, s.ID_Session, c.ID_Candidat;
    ");

   
    
} catch (Exception $exept) {
    die("Erreur: " . $exept->getMessage());
}
?>