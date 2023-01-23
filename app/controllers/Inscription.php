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
    $return = "";
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

        $return = $medecin->inscription;
      }
    }
    $this->view("inscription/personnel", ["error" => $return]);
  }

  /**
   * patient
   *
   * @return void
   */
  public function patient()
  {
    $return = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["code"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["passwordRepeat"]) &&
        $_POST["password"] == $_POST["passwordRepeat"]
      ) {
        $codePatient = $_POST["code"];
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
        $patient = $this->model("PatientModel");
        $patient = new PatientModel();

        $patient->inscription = $patient->verificationInscriptionPatient(
          $codePatient,
          $email,
          $password
        );

        $return = $patient->inscription;
      }
    }
    $this->view("inscription/patient", ["error" => $return]);
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
