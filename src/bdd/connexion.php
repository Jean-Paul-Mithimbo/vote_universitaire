<?php
    try{
        $base=new PDO("mysql:host=localhost;dbname=bdd_election","root","");
    }
    catch(PDOException $exept){
        die("Erreur:".$exept->getMessage()); 
    }
?>