<?php

/**
 * Classe Medecin
 *
 * Classe qui se charge d'afficher les différentes pages du medecin
 */
class Admin extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    session_start();
    if ($_SESSION["role"] == "admin") {
      header("Location: /mvcExample/public/admin/dashboard");
      exit();
    }
    $this->view("connexion/admin", ["error" => null]);
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
   * dashboard
   *
   * permet à l'administrateur de voir son dashboard
   * si ce n'est pas un administrateur, redirige l'utilisateur vers la page d'accueil
   *
   * @return void
   */
  public function dashboard()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /mvcExample/public/");
      exit();
    }
    if ($_SESSION["role"] != "admin") {
      header("Location: /mvcExample/public/");
      exit();
    }
    $this->view("admin/index");
  }

  public function ajoutAdmin()
  {
    $this->view("admin/ajoutAdmin");
  }

  public function ajoutCapteurs()
  {
    $this->view("admin/ajoutCapteurs");
  }

  public function ajoutMedecin()
  {
    $this->view("admin/ajoutMedecin");
  }

  public function ajoutPatient()
  {
    $this->view("admin/ajoutPatient");
  }

  public function addPatientFunc()
  {
    // Generer un code patient aléatoire
    // il faudra vérifier que le code patient ne soit pas deja utilisé par un autre patient
    $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length_of_string = 7;

    $codePatient = substr(str_shuffle($str_result), 0, $length_of_string);
  }
}
