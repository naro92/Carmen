<?php

/**
 * Classe familleModel
 * 
 * Model famille
 * 
 * Permet de gerer les données des familles
 */
class AdminModel {

    public function connexionAdmin(PDO $bdd, String $email, String $password){
        $query = 'SELECT * FROM administrateur WHERE adresse_mail="'.$email.'" AND mdp="'.$password.'"';
        $params = array();
        $return = '';
        $statement = $bdd->prepare($query);
        $statement->execute($params);
        $count = $statement->rowCount();
        if($count > 0){
            $connectionSuccessful = 1;
        } else {
            $connectionSuccessful = 0;
        }
                     
	    return $connectionSuccessful;
    }

}