<?php

/**
 * Classe patientModel
 *
 * Model patient
 *
 * Permet de gerer les données des patients
 */
class PatientModel
{
  /**
   * connexionPatient
   *
   * @param  PDO $bdd
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionPatient(PDO $bdd, string $email, string $password)
  {
    $query = "SELECT * FROM patient WHERE adresse_mail=:email and mdp=:pass";
    $statement = $bdd->prepare($query);
    $statement->execute([
      "email" => $email,
      "pass" => $password,
    ]);
    $count = $statement->rowCount();
    if ($count > 0) {
      $connectionSuccessful = 1;
    } else {
      $connectionSuccessful = 0;
    }

    return $connectionSuccessful;
  }

  public function inscriptionPatient(
    PDO $bdd,
    string $nom,
    string $email,
    string $password
  ) {
    $query = "SELECT * FROM patient WHERE adresse_mail=:email";

    $statement = $bdd->prepare($query);
    $statement->execute(["email" => $email]);
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

  public function getAllPatient(PDO $bdd)
  {
    $query = "SELECT * FROM patient";
    $params = [];
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchAll();
    return $return;
  }
}
