<?php
    try{
        $pdo=new PDO("mysql:host=localhost;dbname=gestion_etudiants","root","");
    }catch(Excecption $e){
        die('Erreur de connexion: '.$e->getMessage());
    }
    

?>