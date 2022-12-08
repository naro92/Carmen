<?php

/**
 * Classe familleModel
 *
 * Model famille
 *
 * Permet de gerer les données des familles
 */
class AdminModel
{
  /**
   * connexionAdmin
   *
   * @param  PDO $bdd
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionAdmin(PDO $bdd, string $email, string $password)
  {
    $query =
      'SELECT * FROM administrateur WHERE adresse_mail="' .
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
}
