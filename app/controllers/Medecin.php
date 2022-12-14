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
      header("Location: /mvcExample/public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /mvcExample/public/");
      exit();
    }

    $prenomMedecin = $this->model("MedecinModel");
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $prenomMedecin->fetch = $prenomMedecin->getPrenom($bdd, $_SESSION["user"]);

    $this->view("medecin/index", ["prenom" => $prenomMedecin->fetch]);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function choix()
  {
    $this->view("medecin/choix");
  }

  public function patient()
  {
    $this->view("medecin/gestionPatient");
  }

  public function constantes(){
     $this->view("medecin/constantes");
  }
}
