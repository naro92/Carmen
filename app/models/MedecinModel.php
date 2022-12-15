<?php

/**
 * Classe medecinModel
 *
 * Model medecin
 *
 * Permet de gerer les données des medecins
 */
class MedecinModel
{
  /**
   * connexionMedecin
   *
   * @param  PDO $bdd
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionMedecin(string $email, string $password)
  {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query = "SELECT * FROM medecin WHERE adresse_mail=:email and mdp=:pass";
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

  /**
   * inscriptionMedecin
   *
   * @param  PDO $bdd
   * @param  string $nom
   * @param  string $email
   * @param  string $password
   * @return void
   */
  public function inscriptionMedecin(
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

    $query = "SELECT * FROM patient WHERE adresse_mail=:mail";

    $statement = $bdd->prepare($query);
    $statement->execute(["mail" => $email]);
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

  public function getPrenom(string $email)
  {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query = "SELECT prenom FROM medecin WHERE adresse_mail=:mail";

    $statement = $bdd->prepare($query);
    $statement->execute(["mail" => $email]);
    $return = $statement->fetchColumn();

    return $return;
  }
}
