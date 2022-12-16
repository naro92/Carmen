<?php

/**
 * Classe Home
 *
 * Prend aussi en compte toutes les methodes de la classe Controller
 *
 * Classe qui se chargera par défaut lors du chargement sans aucune methode
 *
 */
class Home extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["role"])) {
      $dashboard = $_SESSION["role"];
    } else {
      $dashboard = "Connexion";
    }

    // on va charger la vue et lui envoyer les données que l'on veut lui envoyer
    $this->view("home/index", ["dashboard" => $dashboard]);
  }

  /**
   * cgu
   *
   * @return void
   */
  public function cgu()
  {
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["role"])) {
      $dashboard = $_SESSION["role"];
    } else {
      $dashboard = "Connexion";
    }
    $this->view("home/cgu", ["dashboard" => $dashboard]);
  }

  /**
   * faq
   *
   * @return void
   */
  public function faq()
  {
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["role"])) {
      $dashboard = $_SESSION["role"];
    } else {
      $dashboard = "Connexion";
    }
    // on charge le model de la faq
    $faq = $this->model("Faq");

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $faq->fetch = $faq->getFaq();
    // on charge la vue avec tous les elements de la faq
    $this->view("home/faq", ["faq" => $faq->fetch, "dashboard" => $dashboard]);
  }

  /**
   * contact
   *
   * FONCTION A MODIFIER
   *
   * @param  mixed $fetch
   * @return void
   */
  public function contact()
  {
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["role"])) {
      $dashboard = $_SESSION["role"];
    } else {
      $dashboard = "Connexion";
    }
    $this->view("home/contact", ["dashboard" => $dashboard]);
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
}
