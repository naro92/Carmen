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

      $admin = new AdminModel();

      $admin->connexionAdmin = $admin->connexionAdmin($email, $password);

      if ($admin->connexionAdmin) {
        echo "Connection is successful !";
        session_start();
        $_SESSION["user"] = $email;
        $_SESSION["role"] = "admin";
        header("Location: /public/admin/dashboard");
        unset($admin);
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

    $admin = $this->model("AdminModel");
    $admin = new AdminModel();

    $admin->nombres = $admin->getNb();

    $this->view("admin/index", [
      "nbPatient" => $admin->nombres[0]["patients"],
      "nbMedecin" => $admin->nombres[0]["medecins"],
    ]);
    unset($admin);
  }

  public function ajoutAdmin()
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
    $retour = "";
    if ($_POST["submit-btn"]) {
      if (
        isset($_POST["name"]) &&
        isset($_POST["firstname"]) &&
        isset($_POST["naissance"]) &&
        isset($_POST["sexe"]) &&
        isset($_POST["address"]) &&
        isset($_POST["mail"]) &&
        isset($_POST["password"])
      ) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $naissance = $_POST["naissance"];
        $sexe = $_POST["sexe"];
        $address = $_POST["address"];
        $email = $_POST["mail"];
        $password = hash("sha3-256", $_POST["password"]);

        $admin = $this->model("AdminModel");

        $admin = new AdminModel();

        $admin->inscription = $admin->inscriptionAdmin(
          $name,
          $firstname,
          $naissance,
          $sexe,
          $address,
          $email,
          $password
        );

        $retour = $admin->inscription;
      }
    }
    $this->view("admin/ajoutAdmin", ["error" => $retour]);
  }

  public function ajoutCapteurs()
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
    $this->view("admin/ajoutCapteurs");
  }

  public function ajoutMedecin()
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
    $retour = "";
    if ($_POST["submit-btn"]) {
      if (
        isset($_POST["name"]) &&
        isset($_POST["firstname"]) &&
        isset($_POST["naissance"]) &&
        isset($_POST["mail"])
      ) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $naissance = $_POST["naissance"];
        $email = $_POST["mail"];

        $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length_of_string = 7;

        $codeMedecin = substr(str_shuffle($str_result), 0, $length_of_string);

        $medecin = $this->model("MedecinModel");

        $medecin = new MedecinModel();

        $medecin->inscription = $medecin->inscriptionMedecin(
          $name,
          $firstname,
          $naissance,
          $email,
          $codeMedecin
        );

        $retour = $medecin->inscription;
      }
    }
    $this->view("admin/ajoutMedecin", ["error" => $retour]);
  }

  public function ajoutPatient()
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
    $this->view("admin/ajoutPatient");
  }

  public function addPatientFunc()
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
    // Generer un code patient aléatoire
    // il faudra vérifier que le code patient ne soit pas deja utilisé par un autre patient
    $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length_of_string = 7;

    $codePatient = substr(str_shuffle($str_result), 0, $length_of_string);
  }

  public function addMedecinFunc()
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

    $retour = "";
    if ($_POST["submit-btn"]) {
      if (
        isset($_POST["name"]) &&
        isset($_POST["firstname"]) &&
        isset($_POST["naissance"]) &&
        isset($_POST["mail"])
      ) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $naissance = $_POST["naissance"];
        $email = $_POST["mail"];

        $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length_of_string = 7;

        $codeMedecin = substr(str_shuffle($str_result), 0, $length_of_string);

        $medecin = $this->model("MedecinModel");

        $medecin = new MedecinModel();

        $medecin->inscription = $medecin->inscriptionMedecin(
          $name,
          $firstname,
          $naissance,
          $email,
          $codeMedecin
        );

        echo $medecin->inscription;

        //echo $retour;
      }
    }
  }

  public function faqModif()
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
    $faq = $this->model("Faq");

    $faq = new Faq();

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $faq->fetch = $faq->getFaq();

    $this->view("admin/faqAdmin", ["faq" => $faq->fetch]);
  }

  public function modifierFaqAction()
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
    if (isset($_POST["submit-btn"])) {
      $actualId = $_POST["id"];
      $newTitre = $_POST["question"];
      $newContenu = $_POST["answer"];

      $faq = $this->model("Faq");

      $faq = new Faq();

      $faq->updatefaq = $faq->updateQuestion($actualId, $newTitre, $newContenu);
      header("Location: /public/admin/faqModif");
      unset($faq);
    }
  }

  public function supprimerFaqAction()
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
    if (isset($_POST["supress-btn"])) {
      $actualId = $_POST["id"];

      $faq = $this->model("Faq");

      $faq = new Faq();

      $faq->updatefaq = $faq->deleteQuestion($actualId);
      header("Location: /public/admin/faqModif");
      unset($faq);
    }
  }

  public function addFaqAction()
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
    if (isset($_POST["add-btn"])) {
      $titre = $_POST["question"];
      $reponse = $_POST["reponse"];

      $faq = $this->model("Faq");

      $faq = new Faq();

      $faq->updatefaq = $faq->insertQuestion($titre, $reponse);
      header("Location: /public/admin/faqModif");
      unset($faq);
      exit();
    }
  }
}
