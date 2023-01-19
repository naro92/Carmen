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

  public function rapports()
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

    $famille = $this->model("FamilleModel");

    $famille = new FamilleModel();
    $famille->rapports = $famille->getAllRapports($_SESSION["user"]);
    $this->view("famille/voirBilan", ["rapports" => $famille->rapports]);
  }

  public function voirRapport()
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
    $retour = "";
    if (isset($_POST["voir-btn"])) {
      $id = $_POST["id"];
      $famille = $this->model("FamilleModel");

      $famille = new FamilleModel();
      $famille->rapport = $famille->getRapportTexte($id);
      $retour = $famille->rapport[0]["texte_rapport"];
    }

    $this->view("famille/voirRapport", ["texteRapport" => $retour]);
  }
}
