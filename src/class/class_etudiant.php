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
        public function Verifier_etudiant()
    {
        require('bdd/connexion.php');
        // Vérifions si le matricule existe déjà
        $reqmatri = $base->prepare("SELECT * FROM Electeurs WHERE Matricule = ?");
        $reqmatri->execute(array($this->Matricule));
        $matriexist = $reqmatri->rowCount();

        if ($matriexist != 0) {
            if ($res = $reqmatri->fetch()) {
                $_SESSION['ID_Electeur'] = $res['ID_Electeur'];
                $_SESSION['Nom'] = $res['Nom'];
                $_SESSION['Prenom'] = $res['Prenom'];
                $_SESSION['Photo'] = $res['Photo'];
            }
        } else {
            unset($_SESSION['ID_Electeur']);
            echo "<script>
                alert('Cette personne n\'existe pas!');
                alertify.error('Cette personne n\'existe pas', 5, function() { console.log('dismissed'); });
              </script>";
        }
    }


    // Implémentation de la méthode pour inserer les votes dans la base de donné
    public function voter($ID_Candidat)
    {
        require('bdd/connexion.php');
        // verifion le poste du candidat
        $req = $base->prepare("SELECT ID_Poste FROM Candidats WHERE ID_Candidat = ?");
        $req->execute(array($ID_Candidat));
        $res = $req->rowCount();

        if ($res != 0){
            $ID_Poste = $res['ID_Poste'];
        }


        // Vérifions si le matricule existe déjà
        $reqvote = $base->prepare("SELECT * FROM Votes WHERE ID_Candidat = ?  and ID_Electeur=?");
        $reqvote->execute(array($ID_Candidat, $this->ID_Electeur));
        $voteExist = $reqvote->rowCount();

        if ($voteExist == 0) {
            $req = $base->prepare('INSERT INTO Votes(ID_Candidat,ID_Electeur) 
                    VALUES(?,?)');
            $req->execute(array($ID_Candidat, $this->ID_Electeur)) or die(print_r($base->errorInfo()));
            echo "
                     <script>
                         var notification = alertify.notify('Vote éffectué', 'success', 5, function(){  console.log('dismissed'); });
                     </script>
                     ";

           
        } else {
            unset($_SESSION['ID_Electeur']);
            echo "<script>
                alert('Cette personne a déjà voter');
                alertify.error('Cette personne a déjà voter', 5, function() { console.log('dismissed'); });
              </script>";
        }
    }
}