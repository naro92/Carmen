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
    $this->view("connexion/personnel", ["error" => null]);
  }

  /**
   * patient
   *
   * @return void
   */
  public function patient()
  {
    $this->view("connexion/patient", ["error" => null]);
  }

  /**
   * famille
   *
   * @return void
   */
  public function famille()
  {
    $this->view("connexion/famille", ["error" => null]);
  }

  /**
   * connexionPatient
   *
   * permet au patient de se connecter
   *
   * @return void
   */
  public function connexionPatient()
  {
    if (
      isset($_POST["email"]) &&
      !empty($_POST["email"]) &&
      (isset($_POST["password"]) && !empty($_POST["password"]))
    ) {
      $email = $_POST["email"];
      $password = hash("sha3-256", $_POST["password"]);
    }

    $patient = $this->model("PatientModel");

    $patient->connexionPatient = $patient->connexionPatient($email, $password);

    if ($patient->connexionPatient) {
      echo "Connection is successful !";
      session_start();
      $_SESSION["user"] = $email;
      $_SESSION["role"] = "patient";
      header("Location: /public/patient");
      exit();
    } else {
      $this->view("connexion/patient", [
        "error" => "Mauvais identifiants ou mot de passe !",
      ]);
    }
  }

  /**
   * connexionMedecin
   *
   * permet au medecin de se connecter
   *
   * @return void
   */
  public function connexionMedecin()
  {
    if (
      isset($_POST["email"]) &&
      !empty($_POST["email"]) &&
      (isset($_POST["password"]) && !empty($_POST["password"]))
    ) {
      $email = $_POST["email"];
      $password = hash("sha3-256", $_POST["password"]);
    }

    $medecin = $this->model("MedecinModel");

    $medecin->connexionMedecin = $medecin->connexionMedecin($email, $password);

    if ($medecin->connexionMedecin) {
      echo "Connection is successful !";
      session_start();
      $_SESSION["user"] = $email;
      $_SESSION["role"] = "medecin";
      header("Location: /public/medecin");
      exit();
    } else {
      $this->view("connexion/personnel", [
        "error" => "Mauvais identifiants ou mot de passe !",
      ]);
    }
  }

  /**
   * connexionFamille
   *
   * permet a la famille de se connecter
   *
   * @return void
   */
  public function connexionFamille()
  {
    if (
      isset($_POST["email"]) &&
      !empty($_POST["email"]) &&
      (isset($_POST["password"]) && !empty($_POST["password"]))
    ) {
      $email = $_POST["email"];
      $password = hash("sha3-256", $_POST["password"]);
    }

    $famille = $this->model("FamilleModel");

    $famille->connexionFamille = $famille->connexionFamille($email, $password);

    if ($famille->connexionFamille) {
      echo "Connection is successful !";
      session_start();
      $_SESSION["user"] = $email;
      $_SESSION["role"] = "famille";
      header("Location: /public/famille");
      exit();
    } else {
      $this->view("connexion/famille", [
        "error" => "Mauvais identifiants ou mot de passe !",
      ]);
    }
  }

  /**
   * connexionAdmin
   *
   * permet à l'administrateur de se connecter
   *
   * @return void
   */
  public function connexionAdmin()
  {
    if (
      isset($_POST["email"]) &&
      !empty($_POST["email"]) &&
      (isset($_POST["password"]) && !empty($_POST["password"]))
    ) {
      $email = $_POST["email"];
      $password = hash("sha3-256", $_POST["password"]);
    }

    $admin = $this->model("AdminModel");

    $admin->connexionAdmin = $admin->connexionAdmin($email, $password);

    if ($admin->connexionAdmin) {
      echo "Connection is successful !";
      session_start();
      $_SESSION["user"] = $email;
      $_SESSION["role"] = "admin";
      header("Location: /public/admin/dashboard");
      exit();
    } else {
      $this->view("connexion/admin", [
        "error" => "Mauvais identifiants ou mot de passe !",
      ]);
    }
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
