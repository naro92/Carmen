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

    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $patient->inscriptionPatient = $patient->inscriptionPatient(
      $bdd,
      $nom,
      $email,
      $password
    );

    echo $patient->inscriptionPatient;
  }
}
