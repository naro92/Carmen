<?php

/**
 * Classe medecinModel
 * 
 * Model medecin
 * 
 * Permet de gerer les données des medecins
 */
class MedecinModel {

    public function connexionMedecin(PDO $bdd, String $email, String $password){
        $query = 'SELECT * FROM medecin WHERE adresse_mail="'.$email.'" AND mdp="'.$password.'"';
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

    public function inscriptionMedecin(PDO $bdd, String $nom, String $email, String $password){
        $query = 'SELECT * FROM patient WHERE adresse_mail="'.$email.'" ';

		$params = array();
        $statement = $bdd->prepare($query);
        $statement->execute($params);
        $count = $statement->rowCount();
        if($count > 0){
			// S'il est deja utilisé on dit que la personne est deja inscrite
            return "Un utilisateur possède déjà votre adresse mail !";
        } else {
			// Sinon on ajoute toutes les données dans la database
			$sql = "INSERT INTO patient(adresse_mail, nom, mdp) VALUES (?, ?, ?)";
			$stmt= $bdd->prepare($sql);
        	$exec = $stmt->execute([$email, $nom, $password]);
            if($exec){
                $return = "inscription successful !";
            } else {
                $return = "Il y a une erreur";
            }
		}

        return $return;
    }
}