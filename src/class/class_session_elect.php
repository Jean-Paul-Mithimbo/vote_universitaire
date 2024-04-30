<?php
// Classe Etudiant, fille de Electeur
class  Session_electorale
{   // Attributs supplémentaires
    protected $ID_Session;
    protected $Date;
    protected $Detail;

    // Constructeur
    public function __construct($ID_Session = null, $Date = null, $Detail = null)
    {
        $this->ID_Session = $ID_Session;
        $this->Date = $Date;
        $this->Detail = $Detail;
    }

    // Implémentation de la méthode pour enregistrer l'étudiant dans la base de données
    public function creer_Session_electorale()
    {
        // Implémentation spécifique pour enregistrer un étudiant
        require('bdd/./connexion.php');
        //verifion la validite du mail


        //verifions si le poste existe deja
        $req = $base->prepare("SELECT * FROM sessions_electorales WHERE Date=? and Detail=?");
        $req->execute(array($this->Date,$this->Detail));
        $reqexist = $req->rowCount();
        // echo $reqexist;
        if ($reqexist == 0) {
            $req = $base->prepare('INSERT INTO sessions_electorales(Date,Detail) 
                    VALUES(?)');
            $req->execute(array($this->Date,$this->Detail)) or die(print_r($base->errorInfo()));
            echo "
                <script>
                    alert('save!!');
                    var notification = alertify.notify('Session Ajouté', 'success', 5, function(){  console.log('dismissed'); });
                </script>";
        } else {
            // $afficher = "Mail déja utilisé!!";
            echo "<script>
                    alert('cet poste existe  déja!!');
                    var notification = alertify.error('cette session existe  déja!!', 'success', 5, function(){  console.log('dismissed'); });

                </script>";
        }
    }

}
