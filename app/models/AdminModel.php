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
  public function connexionAdmin(string $email, string $password)
  {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query =
      "SELECT * FROM administrateur WHERE adresse_mail=:email and mdp=:pass";

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
}
