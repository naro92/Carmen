<?php

class Database {

    public PDO $bdd;

    public function __construct(){
        
        try{
            $bdd = new PDO('mysql:host=localhost:3306;dbname=mvc;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

}