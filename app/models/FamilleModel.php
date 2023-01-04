<?php

/**
 * Classe familleModel
 *
 * Model famille
 *
 * Permet de gerer les données des familles
 */
class FamilleModel
{
  /**
   * connexionFamille
   *
   * @param  PDO $bdd
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionFamille(string $email, string $password)
  {
    $bdd = new PDO(
      "mysql:host=".HOST.":".PORT.";dbname=".DBNAME.";charset=utf8",
      USERNAME,
      PASSWORD,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query = "SELECT * FROM famille WHERE adresse_mail=:email and mdp=:pass";

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
   * inscriptionFamille
   *
   * @param  PDO $bdd
   * @param  string $nom
   * @param  string $email
   * @param  string $password
   * @return void
   */
  public function inscriptionFamille(
    string $nom,
    string $email,
    string $password
  ) {
    $bdd = new PDO(
      "mysql:host=".HOST.":".PORT.";dbname=".DBNAME.";charset=utf8",
      USERNAME,
      PASSWORD,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

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
}
