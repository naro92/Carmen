<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

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
    if (isset($_POST["submit-btn"])) {
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
    $status = "";
    if (isset($_POST["submit-btn"])) {
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
        if ($retour == "inscription réussie !") {
          try {
            $mail = new PHPMailer(true);
            //Enable verbose debug output
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "contact.carmen.app@gmail.com"; //Adresse email à utiliser
            $mail->Password = "lpobpflmrecwwhkn"; //Mot de passe de l'adresse email à utiliser

            //Enable SSL encryption;
            $mail->SMTPSecure = "ssl";

            $mail->Port = 465; // port for ssl

            $mail->isHTML(true);
            $mail->CharSet = "utf-8";

            $mail->setFrom("contact@carmen.wstr.fr", "Contact Admin"); // sender's email and name

            $mail->addAddress($email, $name); // receiver's email and name

            $mail->Subject = "Inscription";

            $mail->Body =
              "<h1>Voici le code pour vous inscrire :</h1>" .
              "<br>" .
              "<p>" .
              $codeMedecin .
              "</p>" .
              "<br>" .
              "<p>Cliquez sur ce lien pour finaliser votre inscription : <a href='carmen.wstr.fr/public/connexion/personnel'>Terminer votre inscription</a>";

            $mail->send();

            $status = "Le message a bien été envoyé !";
            echo $status;

            $mail->smtpClose();
          } catch (Exception $e) {
            // handle error.

            $status = "Le message n'a pas pu être envoyé !"; //, $mail->ErrorInfo;
          }
        }
      }
    }
    $this->view("admin/ajoutMedecin", [
      "error" => $retour,
      "status" => $status,
    ]);
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
    $retour = "";
    $status = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["name"]) &&
        isset($_POST["firstname"]) &&
        isset($_POST["naissance"]) &&
        isset($_POST["sexe"]) &&
        isset($_POST["adresse"]) &&
        isset($_POST["telephone"]) &&
        isset($_POST["mail"])
      ) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $naissance = $_POST["naissance"];
        $email = $_POST["mail"];
        $sexe = $_POST["sexe"];
        $adresse = $_POST["adresse"];
        $tel = $_POST["telephone"];

        $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length_of_string = 7;

        $codePatient = substr(str_shuffle($str_result), 0, $length_of_string);

        $patient = $this->model("PatientModel");

        $patient = new PatientModel();

        $patient->inscription = $patient->inscriptionPatient(
          $name,
          $firstname,
          $naissance,
          $email,
          $codePatient,
          $sexe,
          $adresse,
          $tel
        );

        $retour = $patient->inscription;
        if ($retour == "inscription réussie !") {
          try {
            $mail = new PHPMailer(true);
            //Enable verbose debug output
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "contact.carmen.app@gmail.com"; //Adresse email à utiliser
            $mail->Password = "lpobpflmrecwwhkn"; //Mot de passe de l'adresse email à utiliser

            //Enable SSL encryption;
            $mail->SMTPSecure = "ssl";

            $mail->Port = 465; // port for ssl

            $mail->isHTML(true);
            $mail->CharSet = "utf-8";

            $mail->setFrom("contact@carmen.wstr.fr", "Contact Admin"); // sender's email and name

            $mail->addAddress($email, $name); // receiver's email and name

            $mail->Subject = "Inscription";

            $mail->Body =
              "<h1>Voici le code pour vous inscrire :</h1>" .
              "<br>" .
              "<p>" .
              $codePatient .
              "</p>" .
              "<br>" .
              "<p>Cliquez sur ce lien pour finaliser votre inscription : <a href='carmen.wstr.fr/public/inscription/patient'>Terminer votre inscription</a>";

            $mail->send();

            $status = "Le message a bien été envoyé !";
            echo $status;

            $mail->smtpClose();
          } catch (Exception $e) {
            // handle error.

            $status = "Le message n'a pas pu être envoyé !"; //, $mail->ErrorInfo;
          }
        }
      }
    }
    $this->view("admin/ajoutPatient", [
      "status" => $status,
      "error" => $retour,
    ]);
  }

  public function ajoutFamille()
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
    $famille = $this->model("FamilleModel");

    $famille = new FamilleModel();

    $famille->ids = $famille->getAllPatient();
    $retour = "";
    $status = "";
    if (isset($_POST["submit-btn"])) {
      if (
        isset($_POST["name"]) &&
        isset($_POST["firstname"]) &&
        isset($_POST["idpatient"]) &&
        isset($_POST["mail"])
      ) {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $email = $_POST["mail"];
        $idpatient = $_POST["idpatient"];

        $str_result = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $length_of_string = 7;

        $codeFamille = substr(str_shuffle($str_result), 0, $length_of_string);

        $famille->inscription = $famille->inscriptionFamille(
          $name,
          $firstname,
          $email,
          $codeFamille,
          $idpatient
        );

        $retour = $famille->inscription;
        if ($retour == "inscription réussie !") {
          try {
            $mail = new PHPMailer(true);
            //Enable verbose debug output
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "contact.carmen.app@gmail.com"; //Adresse email à utiliser
            $mail->Password = "lpobpflmrecwwhkn"; //Mot de passe de l'adresse email à utiliser

            //Enable SSL encryption;
            $mail->SMTPSecure = "ssl";

            $mail->Port = 465; // port for ssl

            $mail->isHTML(true);
            $mail->CharSet = "utf-8";

            $mail->setFrom("contact@carmen.wstr.fr", "Contact Admin"); // sender's email and name

            $mail->addAddress($email, $name); // receiver's email and name

            $mail->Subject = "Inscription";

            $mail->Body =
              "<h1>Voici le code pour vous inscrire :</h1>" .
              "<br>" .
              "<p>" .
              $codeFamille .
              "</p>" .
              "<br>" .
              "<p>Cliquez sur ce lien pour finaliser votre inscription : <a href='carmen.wstr.fr/public/inscription/famille'>Terminer votre inscription</a>";

            $mail->send();

            $status = "Le message a bien été envoyé !";
            echo $status;

            $mail->smtpClose();
          } catch (Exception $e) {
            // handle error.

            $status = "Le message n'a pas pu être envoyé !"; //, $mail->ErrorInfo;
          }
        }
      }
    }
    $this->view("admin/ajoutFamille", [
      "status" => $status,
      "error" => $retour,
      "patients" => $famille->ids,
    ]);
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

  public function gererCapteurs()
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

    $admin->capteurs = $admin->getCapteurs();

    $admin->medecins = $admin->getMedecins();

    $admin->chambres = $admin->getChambres();

    $this->view("admin/gestionCapteurs", [
      "capteurs" => $admin->capteurs,
      "medecins" => $admin->medecins,
      "chambres" => $admin->chambres,
    ]);
  }

  public function addCapteurAction()
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
      $type = $_POST["select_type"];
      $chambre = $_POST["chambre"];
      $idmedecin = $_POST["id_medecin"];

      // echo $type;
      // echo $chambre;
      // echo $idmedecin;

      $admin = $this->model("AdminModel");

      $admin = new AdminModel();

      $admin->add = $admin->addCapteur($type, $chambre, $idmedecin);
      header("Location: /public/admin/gererCapteurs");
      exit();
    }
  }

  public function supprimerCapteurAction()
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

      $admin = $this->model("AdminModel");

      $admin = new AdminModel();

      $admin->delete = $admin->deleteCapteur($actualId);
      header("Location: /public/admin/gererCapteurs");
      unset($faq);
      exit();
    }
  }

  public function gererChambres()
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

    $admin->capteurs = $admin->getChambres();

    $this->view("admin/gererChambres", ["capteurs" => $admin->capteurs]);
  }

  public function supprimerChambreAction()
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
      $actualNumero = $_POST["id"];

      $admin = $this->model("AdminModel");

      $admin = new AdminModel();

      $admin->delete = $admin->deleteChambre($actualNumero);
      header("Location: /public/admin/gererChambres");
      unset($faq);
      exit();
    }
  }

  public function addChambreAction()
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
      $chambre = $_POST["chambre"];

      $admin = $this->model("AdminModel");

      $admin = new AdminModel();

      $admin->add = $admin->addChambre($chambre);
      header("Location: /public/admin/gererChambres");
      exit();
    }
  }
}
