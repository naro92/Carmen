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

  public function getProfil(string $email)
  {
    $sql = "SELECT * FROM patient WHERE adresse_mail = :identification";

    $statement = $this->bdd->prepare($sql);
    $statement->execute(["identification" => $email]);

    if ($statement === false) {
      die("Erreur");
    }

    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "age" => htmlspecialchars($obj["age"]),
        "sexe" => htmlspecialchars($obj["sexe"]),
        "telephone" => htmlspecialchars($obj["telephone"]),
        "adresse" => htmlspecialchars($obj["adresse"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
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

  public function getPrenom($email)
  {
    $query = "SELECT prenom FROM patient WHERE adresse_mail=:mail";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["mail" => $email]);
    $return = $statement->fetchColumn();
    return $return;
  }

  public function modifierProfilDatabase(
    string $nom,
    string $prenom,
    string $age,
    string $sexe,
    string $telephone,
    string $adresse,
    string $mail,
    string $id
  ) {
    $sql =
      "UPDATE patient SET nom=:nom,age=:age,sexe=:sexe,adresse=:adresse,telephone=:phone,prenom=:prenom,adresse_mail= :mail WHERE idpatient = :id";
    $stmt = $this->bdd->prepare($sql);
    $exec = $stmt->execute([
      "nom" => $nom,
      "age" => $age,
      "sexe" => $sexe,
      "adresse" => $adresse,
      "phone" => $telephone,
      "prenom" => $prenom,
      "mail" => $mail,
      "id" => $id,
    ]);
    if ($exec) {
      $stmt->closeCursor();
      $stmt = null;
      return true;
    } else {
      $stmt->closeCursor();
      $stmt = null;
      return false;
    }
    echo "Record updated";
  }

  public function getAllrapports(string $email)
  {
    $vue = [];
    $query =
      "SELECT * from rapport WHERE famille_idfamille = (SELECT idpatient from patient WHERE adresse_mail = ?) ORDER BY date_rapport DESC";
    $statement = $this->bdd->prepare($query);
    $statement->execute([$email]);

    while ($obj = $statement->fetch()) {
      $vue["rapports"][] = [
        "id" => htmlspecialchars($obj["idrapport"]),
        "date" => htmlspecialchars($obj["date_rapport"]),
      ];
    }
    return $vue;
  }

  public function getRapporttexte(string $id)
  {
    $query = "SELECT texte_rapport from rapport WHERE idrapport = ?";
    $statement = $this->bdd->prepare($query);
    $statement->execute([$id]);
    $exec = $statement->fetchAll();
    return $exec;
  }
}
