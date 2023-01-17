<?php
require "Database.php";
/**
 * Classe patientModel
 *
 * Model patient
 *
 * Permet de gerer les données des patients
 */
class PatientModel
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
   * connexionPatient
   *
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionPatient(string $email, string $password)
  {
    $query = "SELECT * FROM patient WHERE adresse_mail=:email and mdp=:pass";
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

  public function inscriptionPatient(
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
      $stmt = $bdd->prepare($sql);
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

  public function getAllPatient()
  {
    $query = "SELECT * FROM patient";
    $params = [];
    $statement = $this->bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchAll();
    $statement->closeCursor();
    $statement = null;
    return $return;
  }

  public function getInformations(int $id)
  {
    $sql = "SELECT * FROM patient WHERE idpatient = :identification";

    $statement = $this->bdd->prepare($sql);
    $statement->execute(["identification" => $id]);

    if ($statement === false) {
      die("Erreur");
    }

    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "age" => htmlspecialchars($obj["age"]),
        "sexe" => htmlspecialchars($obj["sexe"]),
      ];
    }
    $statement->closeCursor();
    $statement = null;
    return $vue;
  }

  public function getConstantesPatient()
  {
    $sql =
      "SELECT valeurs_donnees FROM capteurs where idcapteurs =(select MAX(idcapteurs) from capteurs)";

    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([]);

    $row = $stmt->fetch();
    $stmt->closeCursor();
    $stmt = null;
    return $row["valeurs_donnees"];
  }
}
