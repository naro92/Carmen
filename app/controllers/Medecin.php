<?php

/**
 * Classe Medecin
 *
 * Classe qui se charge d'afficher les différentes pages du medecin
 */
class Medecin extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $prenomMedecin = $this->model("MedecinModel");

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $prenomMedecin->fetch = $prenomMedecin->getPrenom($_SESSION["user"]);

    $this->view("medecin/index", ["prenom" => $prenomMedecin->fetch]);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function rechercher()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $this->view("medecin/rechercher");
  }

  public function choix(int $id = 0)
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $this->view("medecin/choix", ["idPatient" => $id]);
  }

  public function patient()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $host = HOST;
    $dbname = DBNAME;
    $username = USERNAME;
    $password = PASSWORD;

    $dsn = "mysql:host=$host;dbname=$dbname";
    // récupérer tous les utilisateurs
    $sql =
      "SELECT p.*
    FROM patient p
    INNER JOIN medecin m ON p.medecin_idmedecin = m.idmedecin
    WHERE m.adresse_mail like '" .
      $_SESSION["user"] .
      "'";

    try {
      $pdo = new PDO($dsn, $username, $password);
      $statement = $pdo->prepare($sql);
      $statement->execute([]);

      if ($statement === false) {
        die("Erreur");
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "id" => htmlspecialchars($obj["idpatient"]),
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "email" => htmlspecialchars($obj["adresse_mail"]),
      ];
    }

    $this->view("medecin/gestionPatient", ["data" => $vue]);
  }

  public function constantes(int $id = 0)
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $host = HOST;
    $dbname = DBNAME;
    $username = USERNAME;
    $password = PASSWORD;

    $dsn = "mysql:host=$host;dbname=$dbname";
    // récupérer tous les utilisateurs
    $sql = "SELECT * FROM patient WHERE idpatient = $id";

    try {
      $pdo = new PDO($dsn, $username, $password);
      $statement = $pdo->prepare($sql);
      $statement->execute([]);

      if ($statement === false) {
        die("Erreur");
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    while ($obj = $statement->fetch()) {
      $vue["patients"][] = [
        "nom" => htmlspecialchars($obj["nom"]),
        "prenom" => htmlspecialchars($obj["prenom"]),
        "age" => htmlspecialchars($obj["age"]),
        "sexe" => htmlspecialchars($obj["sexe"]),
      ];
    }

    $this->view("medecin/constantes", ["patient" => $vue]);
  }

  public function chat()
  {
    session_start();
    $this->view("medecin/chat");
    // php à rajouter
  }

  public function search()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $test_nom = false;
    $test_prenom = false;
    $test_email = false;
    try {
      $bdd = new PDO("mysql:host=localhost;dbname=mydb", "root", "root");
    } catch (Exception $e) {
      //en cas d'erreur on affiche un message et on arrete tout
      die("Erreur : " . $e->getMessage());
    }

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];

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

    $this->view("medecin/resultat", ["recherche" => $vue]);
  }

  public function getConstantes()
  {
    $host = HOST;
    $dbname = DBNAME;
    $username = USERNAME;
    $password = PASSWORD;

    $dsn = "mysql:host=$host;dbname=$dbname";
    // récupérer tous les utilisateurs
    $sql =
      "SELECT valeurs_donnees FROM capteurs where idcapteurs =(select MAX(idcapteurs) from capteurs)";

    try {
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->query($sql);

      if ($stmt === false) {
        die("Erreur");
      }

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      print_r($row["valeurs_donnees"]);
      return $row["valeurs_donnees"];
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
