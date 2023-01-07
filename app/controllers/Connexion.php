<?php
/**
 * Classe connexion
 *
 * Classe qui se charge des différentes pages de connexion pour les différents
 * Types d'utilisateurs
 *
 */
class Connexion extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    $this->view("connexion/index");
  }

  /**
   * error
   *
   * @return void
   */
  public function error()
  {
    $this->view("error/404");
  }

  /**
   * personnel
   *
   * @return void
   */
  public function personnel()
  {
    $error = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["email"]) &&
        !empty($_POST["email"]) &&
        (isset($_POST["password"]) && !empty($_POST["password"]))
      ) {
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
      }

      $medecin = $this->model("MedecinModel");

      $medecin->connexionMedecin = $medecin->connexionMedecin(
        $email,
        $password
      );

      if ($medecin->connexionMedecin) {
        echo "Connection is successful !";
        session_start();
        $_SESSION["user"] = $email;
        $_SESSION["role"] = "medecin";
        header("Location: /public/medecin");
        exit();
      } else {
        $error = "Mauvais identifiant ou mot de passe !";
        $this->view("connexion/personnel", ["error" => $error]);
      }
    } else {
      $this->view("connexion/personnel", ["error" => $error]);
    }
  }

  /**
   * patient
   *
   * @return void
   */
  public function patient()
  {
    $error = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["email"]) &&
        !empty($_POST["email"]) &&
        (isset($_POST["password"]) && !empty($_POST["password"]))
      ) {
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
      }

      $patient = $this->model("PatientModel");

      $patient->connexionPatient = $patient->connexionPatient(
        $email,
        $password
      );

      if ($patient->connexionPatient) {
        echo "Connection is successful !";
        session_start();
        $_SESSION["user"] = $email;
        $_SESSION["role"] = "patient";
        header("Location: /public/patient");
        exit();
      } else {
        $error = "Mauvais identifiants ou mot de passe !";
      }
    }
    $this->view("connexion/patient", ["error" => $error]);
  }

  /**
   * famille
   *
   * @return void
   */
  public function famille()
  {
    $error = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["email"]) &&
        !empty($_POST["email"]) &&
        (isset($_POST["password"]) && !empty($_POST["password"]))
      ) {
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
      }

      $famille = $this->model("FamilleModel");

      $famille->connexionFamille = $famille->connexionFamille(
        $email,
        $password
      );

      if ($famille->connexionFamille) {
        echo "Connection is successful !";
        session_start();
        $_SESSION["user"] = $email;
        $_SESSION["role"] = "famille";
        header("Location: /public/famille");
        exit();
      } else {
        $error = "Mauvais identifiants ou mot de passe !";
      }
    }
    $this->view("connexion/famille", ["error" => $error]);
  }

  /**
   * deconnexion
   *
   * deconnecte l'utilisateur et le renvoie vers la page d'accueil
   *
   * @return void
   */
  public function deconnexion()
  {
    session_start();
    session_unset();
    session_destroy();
    header("Location: /public");
    exit();
  }
}
