<?php
// importation de la Classe abstraite Electeur
include("class_electeur.php");

// Classe candidat, fille de Electeur
class Candidat extends Electeur
{
    // Attributs supplémentaires
    protected $ID_Candidat;
    protected $Numero_Candidature;
    protected $ID_Electeur;
    protected $ID_Poste;
    protected $ID_Session;
    protected $Photo;




    // Constructeur
    public function __construct(
        $ID_Candidat = null,
        $Numero_Candidature = null,
        $ID_Electeur = null,
        $ID_Poste = null,
        $ID_Session = null,
        $Photo = null
    ) {
        // parent::__construct($nom, $prenom, $postNom);
        $this->ID_Candidat = $ID_Candidat;
        $this->Numero_Candidature = $Numero_Candidature;
        $this->ID_Electeur = $ID_Electeur;
        $this->ID_Poste = $ID_Poste;
        $this->ID_Session = $ID_Session;
        $this->Photo = $Photo;
    }

    // Implémentation de la méthode pour enregistrer un candidat
    public function enregistrer_candidat()
    {
        require('bdd/./connexion.php');
        //verifion la validite du mail


        $reqi = $base->prepare("SELECT * FROM Candidats WHERE ID_Electeur=? and ID_Poste=? and ID_Session=?");
        $reqi->execute(array($this->ID_Electeur, $this->ID_Poste, $this->ID_Session));
        $reqexist = $reqi->rowCount();
        echo $reqexist;
        if ($reqexist == 0) {
            $req = $base->prepare('INSERT INTO Candidats(Numero_Candidature,ID_Electeur, ID_Poste, ID_Session,Photo) 
                    VALUES(?,?,?,?,?)');
            $req->execute(array($this->Numero_Candidature, $this->ID_Electeur, $this->ID_Poste, $this->ID_Session, $this->Photo)) or die(print_r($base->errorInfo()));
            echo "<script>alert('save!!')</script>";



            echo "
                     <script>
                         var notification = alertify.notify('Enregistré', 'success', 5, function(){  console.log('dismissed'); });
                     </script>
                     ";
        } else {
            // $afficher = "Mail déja utilisé!!";
            echo "<script>alert('cette personne existe  déja!!');
                 var notification = alertify.error('cet candidat existe  déja!!', 'success', 5, function(){  console.log('dismissed'); });
                </script>";
        }
    }

    // Implémentation de la méthode pour supprimer l'étudiant de la base de données
    public function voter()
    {
        // Implémentation spécifique pour supprimer un étudiant
        echo "Suppression de l'étudiant de la base de données...";
    }
}
