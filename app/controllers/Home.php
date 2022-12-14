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
    // on Charge le model de la faq
    $faq = $this->model("Faq");
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    // on va appeler la fonction dans le model qui permet d'inserer le titre et la contenu de la faq
    $faq->insert = $faq->insertQuestion($bdd, "faq", "Contenu faq");

    $this->view("home/cgu");
  }

  /**
   * faq
   *
   * @return void
   */
  public function faq()
  {
    // on charge le model de la faq
    $faq = $this->model("Faq");
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $faq->fetch = $faq->getFaq($bdd, "faq");
    // on charge la vue avec tous les elements de la faq
    $this->view("home/faq", ["faq" => $faq->fetch]);
  }

  /**
   * contact
   *
   * FONCTION A MODIFIER
   *
   * @param  mixed $fetch
   * @return void
   */
  public function contact($fetch = "")
  {
    $test = $this->model("Test");
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mvc;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $test->fetch = $test->getAll($bdd, "users", $fetch);

    $this->view("home/contact", ["test" => $test->fetch]);
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
