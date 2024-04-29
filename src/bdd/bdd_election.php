<?php
    try{
        $base=new PDO("mysql:host=localhost","root","");
        $base->exec("CREATE DATABASE bdd_election") or die(print_r($base->errorInfo()));
    }
    catch(PDOException $exept){
        die("Erreur: ".$exept->$getMessage());
    }
?>