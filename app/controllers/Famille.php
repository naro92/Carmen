<?php

/**
 * Classe Famille
 *
 * Classe qui se charge d'afficher les différentes pages de la famille
 */
class Famille extends Controller
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
    if ($_SESSION["role"] != "famille") {
      header("Location: /public/");
      exit();
    }

    $prenomFamille = $this->model("FamilleModel");

    $prenomFamille = new FamilleModel();

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $prenomFamille->fetch = $prenomFamille->getFamillePrenom($_SESSION["user"]);
    $this->view("famille/index", ["prenom" => $prenomFamille->fetch]);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function chat()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "famille") {
      header("Location: /public/");
      exit();
    }
    $this->view("famille/chat");
    // php à rajouter
  }
}
