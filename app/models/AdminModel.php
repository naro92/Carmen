<?php
require "Database.php";
/**
 * Classe familleModel
 *
 * Model famille
 *
 * Permet de gerer les données des familles
 */
class AdminModel
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
   * connexionAdmin
   *
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionAdmin(string $email, string $password)
  {
    $query =
      "SELECT * FROM administrateur WHERE adresse_mail=:email and mdp=:pass";

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

  public function inscriptionAdmin(
    string $name,
    string $firstname,
    string $naissance,
    string $sexe,
    string $adresse,
    string $email,
    string $password
  ) {
    $query = "SELECT * FROM administrateur WHERE adresse_mail=:email";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email]);
    $count = $statement->rowCount();
    if ($count > 0) {
      // S'il est deja utilisé on dit que la personne est deja inscrite
      return "Un utilisateur possède déjà votre adresse mail !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql =
        "INSERT INTO administrateur(idadministrateur, nom, prenom, date_naissance, sexe, mdp, adresse, adresse_mail) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->bdd->prepare($sql);
      $exec = $stmt->execute([
        $name,
        $firstname,
        $naissance,
        $sexe,
        $password,
        $adresse,
        $email,
      ]);
      if ($exec) {
        $return = "inscription réussie !";
      } else {
        $return = "Il y a une erreur !";
      }
    }
    $statement->closeCursor();
    $statement = null;
    return $return;
  }

  public function getNb()
  {
    $query =
      "SELECT (SELECT COUNT(*) FROM medecin) as 'medecins', (SELECT COUNT(*) FROM patient) as 'patients';";
    $statement = $this->bdd->prepare($query);
    $statement->execute([]);
    $return = $statement->fetchAll();
    return $return;
  }
}
