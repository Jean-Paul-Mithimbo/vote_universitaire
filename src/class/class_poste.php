<?php
// Classe Etudiant, fille de Electeur
 class  Poste 
{   // Attributs supplémentaires
    protected $ID_Poste;
    protected $Nom_Poste;

    // Constructeur
    public function __construct( $ID_Poste = null, $Nom_Poste = null ) {
        $this->ID_Poste = $ID_Poste;
        $this->Nom_Poste = $Nom_Poste;

    }

    // Implémentation de la méthode pour enregistrer l'étudiant dans la base de données
    public function creer_poste()
    {
        // Implémentation spécifique pour enregistrer un étudiant
        require('bdd/./connexion.php');
        //verifion la validite du mail

    
            //verifions si le poste existe deja
            $req = $base->prepare("SELECT * FROM Postes WHERE Nom_Poste=?");
            $req->execute(array($this->Nom_Poste));
            $reqexist = $req->rowCount();
            // echo $reqexist;
            if ($reqexist == 0) {
                $req = $base->prepare('INSERT INTO Postes(Nom_Poste) 
                    VALUES(?)');
                $req->execute(array($this->Nom_Poste)) or die(print_r($base->errorInfo()));
                echo "
                <script>
                    alert('save!!');
                    var notification = alertify.notify('Poste Enregistré', 'success', 5, function(){  console.log('dismissed'); });
                </script>";

                // echo "
                //      <script>
                //          var notification = alertify.notify('Enregistré', 'success', 5, function(){  console.log('dismissed'); });
                //      </script>
                //      ";
            } else {
                // $afficher = "Mail déja utilisé!!";
                echo "<script>
                    alert('cet poste existe  déja!!');
                    var notification = alertify.error('cet poste existe  déja!!', 'success', 5, function(){  console.log('dismissed'); });

                </script>";
            }
        
    }

   
}
