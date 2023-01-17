<?php
require "Database.php";
/**
 * Classe familleModel
 *
 * Model famille
 *
 * Permet de gerer les données des familles
 */
class FamilleModel
{
  protected $bdd;

  public function __construct()
  {
    $this->connect();
  }

  public function __destruct()
  {
    $this->bdd = null;
  }

  public function connect()
  {
    $db = new Database();
    $this->bdd = $db->connect();
  }

  /**
   * connexionFamille
   *
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionFamille(string $email, string $password)
  {
    $query = "SELECT * FROM famille WHERE adresse_mail=:email and mdp=:pass";

    $statement = $this->bdd->prepare($query);
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
    $statement->closeCursor();
    $statement = null;
    return $connectionSuccessful;
  }

  /**
   * inscriptionFamille
   *
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
    $query = "SELECT * FROM patient WHERE adresse_mail=:email";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email]);
    $count = $statement->rowCount();
    if ($count > 0) {
      // S'il est deja utilisé on dit que la personne est deja inscrite
      return "Un utilisateur possède déjà votre adresse mail !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql = "INSERT INTO patient(adresse_mail, nom, mdp) VALUES (?, ?, ?)";
      $stmt = $this->bdd->prepare($sql);
      $exec = $stmt->execute([$email, $nom, $password]);
      if ($exec) {
        $return = "inscription successful !";
      } else {
        $return = "Il y a une erreur";
      }
    }
    $statement->closeCursor();
    $statement = null;
    return $return;
  }

  public function getFamillePrenom(string $email)
  {
    $query = "SELECT prenom FROM famille WHERE adresse_mail=:mail";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["mail" => $email]);
    $return = $statement->fetchColumn();
    $statement->closeCursor();
    $statement = null;
    return $return;
  }
}
