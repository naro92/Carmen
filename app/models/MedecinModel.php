<?php
require "Database.php";
/**
 * Classe medecinModel
 *
 * Model medecin
 *
 * Permet de gerer les données des medecins
 */
class MedecinModel
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
   * connexionMedecin
   *
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionMedecin(string $email, string $password)
  {
    $query = "SELECT * FROM medecin WHERE adresse_mail=:email and mdp=:pass";
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
   * inscriptionMedecin
   *
   * @param  string $nom
   * @param  string $email
   * @param  string $password
   * @return void
   */
  public function inscriptionMedecin(
    string $name,
    string $firstname,
    string $naissance,
    string $email,
    string $codeMedecin
  ) {
    $query = "SELECT * FROM medecin WHERE adresse_mail=:email";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email]);
    $count = $statement->rowCount();
    if ($count > 0) {
      // S'il est deja utilisé on dit que la personne est deja inscrite
      return "Un utilisateur possède déjà votre adresse mail !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql =
        "INSERT INTO medecin(idmedecin, nom, prenom, date_naissance, adresse_mail, mdp, codeMedecin) VALUES (NULL,?,?,?,?,NULL,?)";
      $stmt = $this->bdd->prepare($sql);
      $exec = $stmt->execute([
        $name,
        $firstname,
        $naissance,
        $email,
        $codeMedecin,
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

  public function verificationInscription(
    string $code,
    string $email,
    string $password
  ) {
    $query =
      "SELECT * FROM medecin WHERE adresse_mail=:email AND codeMedecin=:code";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["email" => $email, "code" => $code]);
    $count = $statement->fetchAll();
    if (!$count or $count[0]["mdp"]) {
      return "Vous etes déjà incrit !";
    } else {
      // Sinon on ajoute toutes les données dans la database
      $sql =
        "UPDATE medecin SET mdp=:motdepasse WHERE adresse_mail=:email AND codeMedecin=:code";
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
    return $return;
  }

  /**
   * getPrenom
   *
   * @param  mixed $email
   * @return void
   */
  public function getPrenom(string $email)
  {
    $query = "SELECT prenom FROM medecin WHERE adresse_mail=:mail";

    $statement = $this->bdd->prepare($query);
    $statement->execute(["mail" => $email]);
    $return = $statement->fetchColumn();
    $statement->closeCursor();
    $statement = null;
    return $return;
  }

  public function searchPatient(
    string $prenom = "",
    string $nom = "",
    string $email = ""
  ) {
    $test_nom = false;
    $test_prenom = false;
    $test_email = false;

    $prenom = ucwords($prenom);
    $nom = ucwords($nom);

    if (empty($prenom) == false) {
      $test_prenom = true;
    }
    if (empty($nom) == false) {
      $test_nom = true;
    }
    if (empty($email) == false) {
      $test_email = true;
    }

    if ($test_prenom == true and $test_nom == false and $test_email == false) {
      $sql = "SELECT * from patient WHERE prenom like ?";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$prenom]);
    } elseif (
      $test_prenom == false and
      $test_nom == true and
      $test_email == false
    ) {
      $sql = "SELECT * from patient WHERE nom like ?";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$nom]);
    } elseif (
      $test_prenom == false and
      $test_nom == false and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE mail like ?";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$email]);
    } elseif (
      $test_prenom == true and
      $test_nom == true and
      $test_email == false
    ) {
      $sql = "SELECT * from patient WHERE (prenom like ? and nom like ?)";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$prenom, $nom]);
    } elseif (
      $test_prenom == true and
      $test_nom == false and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE (prenom like ? and mail like ?)";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$prenom, $email]);
    } elseif (
      $test_prenom == false and
      $test_nom == true and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE (nom like ? and mail like ?)";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$nom, $email]);
    } elseif (
      $test_prenom == true and
      $test_nom == true and
      $test_email == true
    ) {
      $sql =
        "SELECT * from patient WHERE (prenom like ? and nom like ? and mail like ?)";
      $stmt = $this->bdd->prepare($sql);
      $stmt->execute([$prenom, $nom, $email]);
    } else {
      echo "veuillez remplir des champs";
    }

    while ($obj = $stmt->fetch()) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
      ];
    }
    $stmt->closeCursor();
    $stmt = null;
    return $vue;
  }

  public function getPatient(string $email)
  {
    $vue = [];
    $sql =
      "SELECT p.* FROM patient p INNER JOIN medecin m ON p.medecin_idmedecin = m.idmedecin WHERE m.adresse_mail like ?";

    $statement = $this->bdd->prepare($sql);
    $statement->execute([$email]);
    $objets = $statement->fetchAll();

    if ($statement === false) {
      die("Erreur");
    }

    foreach ($objets as $obj) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
      ];
    }
    $statement->closeCursor();
    $statement = null;
    return $vue;
  }

  public function bilanDatabase(int $id, string $text)
  {
    $requete1 = "SELECT idfamille from famille where patient_idpatient = ?";
    $requete2 = "SELECT medecin_idmedecin FROM patient where idpatient = ?";

    $stmt1 = $this->bdd->prepare($requete1);
    $stmt1->execute([$id]);
    $resultat = $stmt1->fetch();
    $famille_idfamille = $resultat["idfamille"];

    $stmt2 = $this->bdd->prepare($requete2);
    $stmt2->execute([$id]);
    $resultat = $stmt2->fetch();
    $patient_medecin_idmedecin = $resultat["medecin_idmedecin"];

    $sql =
      "INSERT INTO rapport (texte_rapport,famille_idfamille,patient_idpatient,patient_medecin_idmedecin) VALUES(?, ?, ?, ?)";
    $stmt = $this->bdd->prepare($sql);
    $exec = $stmt->execute([
      $text,
      $famille_idfamille,
      $id,
      $patient_medecin_idmedecin,
    ]);
    if ($exec) {
      $return = "Rapport bien enregistré !";
    } else {
      $return = "Il y a une erreur !";
    }
    $stmt->closeCursor();
    $stmt = null;
    return $return;
  }

  public function bilanUpdateDatabase(int $id, string $text)
  {
    $sql = "UPDATE rapport SET texte_rapport = ? WHERE idrapport = ?";
    $stmt = $this->bdd->prepare($sql);
    $exec = $stmt->execute([$text, $id]);
    if ($exec) {
      $return = "Rapport bien enregistré !";
    } else {
      $return = "Il y a une erreur !";
    }
    $stmt->closeCursor();
    $stmt = null;
    return $return;
  }

  public function getProfil(string $email)
  {
    $sql = "SELECT * FROM medecin WHERE adresse_mail = :identification";

    $statement = $this->bdd->prepare($sql);
    $statement->execute(["identification" => $email]);

    if ($statement === false) {
      die("Erreur");
    }

    while ($obj = $statement->fetch()) {
      $vue["medecin"][] = [
        "id" => htmlspecialchars($obj["idmedecin"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "date" => htmlspecialchars($obj["date_naissance"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
      ];
    }
    $statement->closeCursor();
    $statement = null;
    return $vue;
  }

  public function modifierProfilDatabase(
    string $nom,
    string $prenom,
    string $date,
    string $email,
    string $id
  ) {
    $sql =
      "UPDATE medecin SET nom = :nom , prenom = :prenom , date_naissance = :date, adresse_mail = :email WHERE idmedecin = :id";
    $stmt = $this->bdd->prepare($sql);
    $exec = $stmt->execute([
      "nom" => $nom,
      "prenom" => $prenom,
      "date" => $date,
      "email" => $email,
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

  public function getRapporttexte(string $id)
  {
    $query = "SELECT texte_rapport from rapport WHERE idrapport = ?";
    $statement = $this->bdd->prepare($query);
    $statement->execute([$id]);
    $exec = $statement->fetchAll();
    $statement->closeCursor();
    $statement = null;
    return $exec;
  }

  public function deleteBilan(string $id)
  {
    $sql = "DELETE FROM rapport WHERE idrapport = :id ";

    $stmt = $this->bdd->prepare($sql);
    $stmt->execute(["id" => $id]);
    $stmt->closeCursor();
    $stmt = null;
  }
}
