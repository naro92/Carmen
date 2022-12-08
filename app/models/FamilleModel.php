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
  public function connexionFamille(PDO $bdd, string $email, string $password)
  {
    $query =
      'SELECT * FROM famille WHERE adresse_mail="' .
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
    PDO $bdd,
    string $nom,
    string $email,
    string $password
  ) {
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
