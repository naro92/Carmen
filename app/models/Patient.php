<?php

/**
 * Classe patient
 *
 * Model patient
 *
 * Permet de gerer les données des patients
 */
class Patient
{
  public function connexionPatient(string $email, string $password)
  {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query =
      'SELECT * FROM patient WHERE adresse_mail="' .
      $email .
      '" AND mdp="' .
      $password .
      '"';
    $params = [];
    $return = "";
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $count = $statement->rowCount();
    if ($count > 0) {
      $return = "connection successful !";
    } else {
      $return = "not connected !";
    }

    return $return;
  }

  public function inscriptionPatient(
    string $nom,
    string $email,
    string $password
  ) {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query = 'SELECT * FROM patient WHERE adresse_mail="' . $email . '" ';

    $params = [];
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $count = $statement->rowCount();
    if ($count > 0) {
      // S'il est deja utilisé on dit que la personne est deja inscrite
      return "Un utilisateur possède déjà votre adresse mail !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql = "INSERT INTO patient(adresse_mail, nom, mdp) VALUES (?, ?, ?)";
      $stmt = $bdd->prepare($sql);
      $exec = $stmt->execute([$email, $nom, $password]);
      if ($exec) {
        $return = "inscription successful !";
      } else {
        $return = "Il y a une erreur";
      }
    }

    return $return;
  }
}
