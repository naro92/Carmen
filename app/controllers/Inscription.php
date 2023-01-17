<?php

/**
 * Classe inscription
 *
 * Classe qui se charge de l'inscription pour les différents types d'utilisateurs
 */
class Inscription extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    $this->view("inscription/index");
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
    $this->view("inscription/personnel");
  }

  /**
   * patient
   *
   * @return void
   */
  public function patient()
  {
    $this->view("inscription/patient");
  }

  /**
   * famille
   *
   * @return void
   */
  public function famille()
  {
    $this->view("inscription/famille");
  }

  /**
   * inscriptionPatient
   *
   * Permet au patient de s'inscrire'
   *
   * @return void
   */
  public function inscriptionPatient()
  {
    if (
      isset($_POST["nom"]) &&
      !empty($_POST["nom"]) &&
      (isset($_POST["email"]) && !empty($_POST["email"])) &&
      (isset($_POST["password"]) && !empty($_POST["password"]))
    ) {
      $nom = $_POST["nom"];
      $email = $_POST["email"];
      $password = hash("sha3-256", $_POST["password"]);
    }

    $patient = $this->model("Patient");

    $patient->inscriptionPatient = $patient->inscriptionPatient(
      $nom,
      $email,
      $password
    );

    echo $patient->inscriptionPatient;
  }

  public function inscriptionMedecin()
  {
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["code"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["passwordRepeat"]) &&
        $_POST["password"] == $_POST["passwordRepeat"]
      ) {
        $codeMedecin = $_POST["code"];
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
        $medecin = $this->model("MedecinModel");
        $medecin = new MedecinModel();

        $medecin->inscription = $medecin->verificationInscription(
          $codeMedecin,
          $email,
          $password
        );

        echo $medecin->inscription;
      }
    }
  }
}
