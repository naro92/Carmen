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

  public function inscriptionFamille(
    string $name,
    string $firstname,
    string $email,
    string $codeFamille,
    string $idpatient
  ) {
    $query = "SELECT * FROM famille WHERE adresse_mail=:email";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email]);
    $count = $statement->rowCount();
    if ($count > 0) {
      // S'il est deja utilisé on dit que la personne est deja inscrite
      $return = "Un utilisateur possède déjà votre adresse mail !";
      return $return;
    } else {
      // Sinon on ajoute toutes les données dans la database
      $query1 = "SELECT medecin_idmedecin from patient where idpatient = ?";
      $state = $this->bdd->prepare($query1);
      $state->execute([$idpatient]);
      $idmedecin = $state->fetchColumn();
      $state->closeCursor();
      $state = null;
      $sql =
        "INSERT INTO famille(idfamille, nom, prenom, adresse_mail, mdp, medecin_idmedecin, patient_idpatient, patient_medecin_idmedecin, codefamille) VALUES (NULL, ?, ?, ?, NULL, ?, ?, ?, ?)";
      $stmt = $this->bdd->prepare($sql);
      $exec = $stmt->execute([
        $name,
        $firstname,
        $email,
        $idmedecin,
        $idpatient,
        $idmedecin,
        $codeFamille,
      ]);
      if ($exec) {
        $return = "inscription réussie !";
      } else {
        $return = "Il y a une erreur !";
      }
    }
    $statement->closeCursor();
    $statement = null;
    $stmt->closeCursor();
    $stmt = null;
    return $return;
  }

  public function verificationInscriptionFamille(
    string $code,
    string $email,
    string $password
  ) {
    $query =
      "SELECT * FROM famille WHERE adresse_mail=:email AND codefamille=:code";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email, "code" => $code]);
    $count = $statement->fetchAll();
    if (!$count or $count[0]["mdp"]) {
      return "Vous etes déjà incrit !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql =
        "UPDATE famille SET mdp=:motdepasse WHERE adresse_mail=:email AND codefamille=:code";
      $stmt = $this->bdd->prepare($sql);
      $exec = $stmt->execute([
        "motdepasse" => $password,
        "email" => $email,
        "code" => $code,
      ]);
      if ($exec) {
        $return = "Vous vous êtes bien inscrit !";
      } else {
        $return = "Il y a une erreur !";
      }
    }
    $statement->closeCursor();
    $statement = null;
    $stmt->closeCursor();
    $stmtt = null;
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

  public function getAllrapports(string $email)
  {
    $vue = [];
    $query =
      "SELECT * from rapport WHERE famille_idfamille = (SELECT idfamille from famille WHERE adresse_mail = ?) ORDER BY date_rapport DESC";
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

  public function getAllPatient()
  {
    $vue = [];
    $query = "SELECT * FROM patient";
    $params = [];
    $statement = $this->bdd->prepare($query);
    $statement->execute($params);
    //$return = $statement->fetchAll();
    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
      ];
    }
    $statement->closeCursor();
    $statement = null;
    return $vue;
  }
}
