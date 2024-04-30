<?php
// cette classe est abstraite du coup j'ai pas mis de constructeur car il ne
// peut pas être instancier
abstract class Electeur
{

    // Méthode abstraite pour voter 
    abstract public function voter();
}
?>