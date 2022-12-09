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
    $this->view("medecin/index");
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function choix()
  {
    $this->view("medecin/choix");
  }
}
