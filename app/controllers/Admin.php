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
    if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
      header("Location: /public/admin/dashboard");
      exit();
    }
    $error = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["email"]) &&
        !empty($_POST["email"]) &&
        (isset($_POST["password"]) && !empty($_POST["password"]))
      ) {
        $email = $_POST["email"];
        $password = hash("sha3-256", $_POST["password"]);
      }

      $admin = $this->model("AdminModel");
      $db_con = $this->db_con();

      $admin->connexionAdmin = $admin->connexionAdmin(
        $db_con,
        $email,
        $password
      );

      if ($admin->connexionAdmin) {
        echo "Connection is successful !";
        session_start();
        $_SESSION["user"] = $email;
        $_SESSION["role"] = "admin";
        header("Location: /public/admin/dashboard");
        exit();
      } else {
        $error = "Mauvais identifiants ou mot de passe !";
      }
    }
    $this->view("connexion/admin", ["error" => $error]);
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
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "admin") {
      header("Location: /public/");
      exit();
    }

    $patient = $this->model("PatientModel");
    $patient->nbPatient = $patient->getNbPatient();

    $medecin = $this->model("MedecinModel");
    $medecin->nbMedecin = $medecin->getNbMedecin();

    $this->view("admin/index", [
      "nbPatient" => $patient->nbPatient,
      "nbMedecin" => $medecin->nbMedecin,
    ]);
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

  public function faqModif()
  {
    $faq = $this->model("Faq");

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $faq->fetch = $faq->getFaq();

    $this->view("admin/faqAdmin", ["faq" => $faq->fetch]);
  }

  public function modifierFaqAction()
  {
    if (isset($_POST["submit-btn"])) {
      $actualId = $_POST["id"];
      $newTitre = $_POST["question"];
      $newContenu = $_POST["answer"];

      $faq = $this->model("Faq");

      $faq->updatefaq = $faq->updateQuestion($actualId, $newTitre, $newContenu);
      header("Location: /public/admin/faqModif");
    }
  }

  public function supprimerFaqAction()
  {
    if (isset($_POST["supress-btn"])) {
      $actualId = $_POST["id"];

      $faq = $this->model("Faq");

      $faq->updatefaq = $faq->deleteQuestion($actualId);
      header("Location: /public/admin/faqModif");
    }
  }

  public function addFaqAction()
  {
    if (isset($_POST["add-btn"])) {
      $titre = $_POST["question"];
      $reponse = $_POST["reponse"];

      $faq = $this->model("Faq");

      $faq->updatefaq = $faq->insertQuestion($titre, $reponse);
      header("Location: /public/admin/faqModif");
    }
  }
}
