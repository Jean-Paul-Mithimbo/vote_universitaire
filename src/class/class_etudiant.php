<?php
// importation de la Classe abstraite Electeur
include ("class_electeur.php");

// Classe Etudiant, fille de Electeur
class Etudiant extends Electeur
{
    // Attributs supplémentaires
    protected $ID_Electeur;
    protected $Nom;
    protected $Prenom;
    protected $Matricule;
    protected $Email;
    protected $Photo;
    protected $ID_Promotion;
    protected $ID_Faculte;
    
    
    

    // Constructeur
    public function __construct(
        $ID_Electeur=null,
        $Nom=null,
        $Prenom=null,
        $Matricule=null, 
        $Email=null, 
        $Photo=null, 
        $ID_Promotion=null, 
        $ID_Faculte=null)
    {
        // parent::__construct($nom, $prenom, $postNom);
        $this->ID_Electeur = $ID_Electeur;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Matricule = $Matricule;
        $this->Email = $Email;
        $this->Photo = $Photo;
        $this->ID_Promotion = $ID_Promotion;
        $this->ID_Faculte = $ID_Faculte;
    }

    // Implémentation de la méthode pour enregistrer l'étudiant dans la base de données
    public function Faire_inscription()
    {
        // Implémentation spécifique pour enregistrer un étudiant
        require('bdd/./connexion.php');
        //verifion la validite du mail

        if (filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            //verifions si le mail existe deja
            $reqmatri = $base->prepare("SELECT * FROM Electeurs WHERE Matricule=?");
            $reqmatri->execute(array($this->Matricule));
            $matriexist = $reqmatri->rowCount();
            echo $matriexist;
            if ($matriexist == 0) {
                $req = $base->prepare('INSERT INTO Electeurs(Nom,Prenom, Matricule, Email,Photo,ID_Promotion,ID_Faculte) 
                    VALUES(?,?,?,?,?,?,?)');
                $req->execute(array($this->Nom, $this->Prenom, $this->Matricule, $this->Email, $this->Photo, $this->ID_Promotion, $this->ID_Faculte)) or die(print_r($base->errorInfo()));
                echo "<script>alert('save!!')</script>";



                echo "
                     <script>
                         var notification = alertify.notify('Enregistré', 'success', 5, function(){  console.log('dismissed'); });
                     </script>
                     ";
            } else {
                // $afficher = "Mail déja utilisé!!";
                echo "<script>alert('cette personne existe  déja!!')</script>";
            }
        } else {
            // $afficher = "Adresse Mail non valide";
            echo "alert('Adresse Mail non valide')";
        }
    }

    // Implémentation de la méthode pour supprimer l'étudiant de la base de données
    public function voter()
    {
        // Implémentation spécifique pour supprimer un étudiant
        echo "Suppression de l'étudiant de la base de données...";
    }
}