<?php

/**
 * Classe medecinModel
 *
 * Model medecin
 *
 * Permet de gerer les données des medecins
 */
class MedecinModel
{
  public function connect()
  {
    try {
      $bdd = new PDO(
        "mysql:host=" .
          HOST .
          ":" .
          PORT .
          ";dbname=" .
          DBNAME .
          ";charset=utf8",
        USERNAME,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      return $bdd;
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
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
    $bdd = MedecinModel::connect();

    $query = "SELECT * FROM medecin WHERE adresse_mail=:email and mdp=:pass";
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
   * inscriptionMedecin
   *
   * @param  string $nom
   * @param  string $email
   * @param  string $password
   * @return void
   */
  public function inscriptionMedecin(
    string $nom,
    string $email,
    string $password
  ) {
    $bdd = MedecinModel::connect();

    $query = "SELECT * FROM patient WHERE adresse_mail=:mail";

    $statement = $bdd->prepare($query);
    $statement->execute(["mail" => $email]);
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

  /**
   * getPrenom
   *
   * @param  mixed $email
   * @return void
   */
  public function getPrenom(string $email)
  {
    $bdd = MedecinModel::connect();

    $query = "SELECT prenom FROM medecin WHERE adresse_mail=:mail";

    $statement = $bdd->prepare($query);
    $statement->execute(["mail" => $email]);
    $return = $statement->fetchColumn();

    return $return;
  }

  /**
   * getNbMedecin : recupere le nombre de medecins actuels
   *
   * @return void
   */
  public function getNbMedecin()
  {
    $bdd = MedecinModel::connect();
    $query = "SELECT COUNT(*) FROM medecin";
    $params = [];
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchColumn();
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

    $bdd = MedecinModel::connect();

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
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$prenom]);
    } elseif (
      $test_prenom == false and
      $test_nom == true and
      $test_email == false
    ) {
      $sql = "SELECT * from patient WHERE nom like ?";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$nom]);
    } elseif (
      $test_prenom == false and
      $test_nom == false and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE mail like ?";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$email]);
    } elseif (
      $test_prenom == true and
      $test_nom == true and
      $test_email == false
    ) {
      $sql = "SELECT * from patient WHERE (prenom like ? and nom like ?)";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$prenom, $nom]);
    } elseif (
      $test_prenom == true and
      $test_nom == false and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE (prenom like ? and mail like ?)";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$prenom, $email]);
    } elseif (
      $test_prenom == false and
      $test_nom == true and
      $test_email == true
    ) {
      $sql = "SELECT * from patient WHERE (nom like ? and mail like ?)";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([$nom, $email]);
    } elseif (
      $test_prenom == true and
      $test_nom == true and
      $test_email == true
    ) {
      $sql =
        "SELECT * from patient WHERE (prenom like ? and nom like ? and mail like ?)";
      $stmt = $bdd->prepare($sql);
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

    return $vue;
  }

  public function getPatient(string $email)
  {
    $bdd = MedecinModel::connect();
    $sql =
      "SELECT p.* FROM patient p INNER JOIN medecin m ON p.medecin_idmedecin = m.idmedecin WHERE m.adresse_mail like '" .
      $email .
      "'";

    $statement = $bdd->prepare($sql);
    $statement->execute([]);

    if ($statement === false) {
      die("Erreur");
    }

    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
      ];
    }

    return $vue;
  }
}
