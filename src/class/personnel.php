<?php
// importation de la Classe abstraite Electeur
include("class_electeur.php");

// Classe Etudiant, fille de Electeur
class Personnel extends Electeur
{
    // Attributs supplémentaires
    protected $ID_Personnel;
    protected $Nom;
    protected $Prenom;
    protected $age;
    protected $Email;
    protected $Photo;
    protected $ID_Promotion;
    protected $ID_Faculte;




    // Constructeur
    public function __construct(
        $ID_Personnel = null,
        $Nom = null,
        $Prenom = null,
        $Email = null,
        $Photo = null,
       
    ) {
        
        $this->ID_Personnel = $ID_Personnel;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Email = $Email;
        $this->Photo = $Photo;
       
    }

    // Implémentation de la méthode pour enregistrer l'étudiant dans la base de données
    public function Faire_inscription()
    {
        // Implémentation spécifique pour enregistrer un étudiant
        require('bdd/./connexion.php');
        //verifion la validite du mail

        if (filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            //verifions si le mail existe deja
            $reqmatri = $base->prepare("SELECT * FROM Electeurs WHERE Matricule=? and Nom=? and Prenom=? and Email=?");
            $reqmatri->execute(array($this->Matricule, $this->Nom, $this->Prenom, $this->Email));
            $matriexist = $reqmatri->rowCount();
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
                echo "<script>
                alert('cette personne existe  déja!!')
                 var notification = alertify.error('cette personne existe  déja!', 'success', 5, function(){  console.log('dismissed'); });
                </script>";
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
