<?php

/**
 * Classe patientModel
 *
 * Model patient
 *
 * Permet de gerer les données des patients
 */
class PatientModel
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
   * connexionPatient
   *
   * @param  string $email
   * @param  string $password
   * @return bool $connectionSuccessful
   */
  public function connexionPatient(string $email, string $password)
  {
    $bdd = PatientModel::connect();

    $query = "SELECT * FROM patient WHERE adresse_mail=:email and mdp=:pass";
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

  public function inscriptionPatient(
    string $nom,
    string $email,
    string $password
  ) {
    $bdd = PatientModel::connect();

    $query = "SELECT * FROM patient WHERE adresse_mail=:email";

    $statement = $bdd->prepare($query);
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

    return $return;
  }

  public function getAllPatient()
  {
    $bdd = PatientModel::connect();

    $query = "SELECT * FROM patient";
    $params = [];
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchAll();
    return $return;
  }

  public function getNbPatient()
  {
    $bdd = PatientModel::connect();
    $query = "SELECT COUNT(*) FROM patient";
    $params = [];
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchColumn();
    return $return;
  }

  public function getInformations(int $id)
  {
    $bdd = PatientModel::connect();
    $sql = "SELECT * FROM patient WHERE idpatient = :identification";

    $statement = $bdd->prepare($sql);
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

    return $vue;
  }

  public function getConstantesPatient()
  {
    $bdd = PatientModel::connect();
    $sql =
      "SELECT valeurs_donnees FROM capteurs where idcapteurs =(select MAX(idcapteurs) from capteurs)";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([]);

    $row = $stmt->fetch();
    return $row["valeurs_donnees"];
  }
}
