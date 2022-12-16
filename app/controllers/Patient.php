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
      header("Location: /mvcExample/public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /mvcExample/public/");
      exit();
    }
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $query = "SELECT prenom FROM patient WHERE adresse_mail=:mail";

    $statement = $bdd->prepare($query);
    $statement->execute(["mail" => $_SESSION["user"]]);
    $return = $statement->fetchColumn();
    $this->view("patient/index", ["prenom" => $return]);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function modifierProfil()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /mvcExample/public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /mvcExample/public/");
      exit();
    }
    $this->view("patient/modifProfil");
  }

  public function modifierProfilAction()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /mvcExample/public/");
      exit();
    }
    if ($_SESSION["role"] != "patient") {
      header("Location: /mvcExample/public/");
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
}
