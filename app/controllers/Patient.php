<?php

/**
 * Classe Patient
 *
 * Classe qui se charge d'afficher les différentes pages du patient
 */
class Patient extends Controller
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
    if ($_SESSION["role"] != "patient") {
      header("Location: /public/");
      exit();
    }
    $patient = $this->model("PatientModel");
    $patient = new PatientModel();

    $patient->nom = $patient->getPrenom($_SESSION["user"]);
    $this->view("patient/index", ["prenom" => $patient->nom]);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function modifierProfil()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /public/");
      exit();
    }
    $retour = "";
    $patient = $this->model("PatientModel");
    $patient = new PatientModel();

    $patient->infos = $patient->getProfil($_SESSION["user"]);
    if (isset($_POST["submit-btn"])) {
      $id = $_POST["id"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $age = $_POST["age"];
      $sexe = $_POST["sexe"];
      $telephone = $_POST["phone"];
      $adresse = $_POST["adresse"];
      $mail = $_POST["mail"];

      $patient->modifProfilAction = $patient->modifierProfilDatabase(
        $nom,
        $prenom,
        $age,
        $sexe,
        $telephone,
        $adresse,
        $mail,
        $id
      );
      if ($patient->modifProfilAction) {
        $retour = "Votre profil a été modifié !";
      } else {
        $retour = "il y a eu une erreur !";
      }
    }
    $this->view("patient/modifProfil", [
      "infos" => $patient->infos["patients"][0],
      "error" => $retour,
    ]);
  }

  public function modifierProfilAction()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /public/");
      exit();
    }
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $name = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $adresse = $_POST["adresse"];
    $mail = $_POST["mail"];
    $sexe = $_POST["sexe"];

    try {
      $sql = "UPDATE Patient SET nom = '$name', prenom= '$prenom', age= '$age', adresse_mail= '$mail', sexe= '$sexe', telephone= '$phone', adresse= '$adresse' WHERE adresse_mail= '$mail';";
      // use exec() because no results are returned
      $bdd->exec($sql);
      echo "updated data";
      exit();
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn  =  null;
  }

  public function rapports()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /public/");
      exit();
    }

    $patient = $this->model("PatientModel");

    $patient = new PatientModel();
    $patient->rapports = $patient->getAllRapports($_SESSION["user"]);
    $this->view("patient/voirBilan", ["rapports" => $patient->rapports]);
  }

  public function voirRapport()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /public/");
      exit();
    }
    $retour = "";
    if (isset($_POST["voir-btn"])) {
      $id = $_POST["id"];
      $patient = $this->model("PatientModel");

      $patient = new PatientModel();
      $patient->rapport = $patient->getRapportTexte($id);
      $retour = $patient->rapport[0]["texte_rapport"];
    }

    $this->view("patient/voirRapport", ["texteRapport" => $retour]);
  }
}
