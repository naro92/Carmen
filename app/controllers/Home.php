<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

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

  public function legal()
  {
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["role"])) {
      $dashboard = $_SESSION["role"];
    } else {
      $dashboard = "Connexion";
    }
    $this->view("home/legal", ["dashboard" => $dashboard]);
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

    $faq = new Faq();

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $faq->fetch = $faq->getFaq();
    // on charge la vue avec tous les elements de la faq
    $this->view("home/faq", ["faq" => $faq->fetch, "dashboard" => $dashboard]);
    unset($faq);
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
    $status = "";
    if (isset($_POST["submit-btn"])) {
      $email = $_POST["email"];
      $name = $_POST["name"];
      $message = $_POST["message"];

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

        $mail->setFrom($email, $name); // sender's email and name

        $mail->addAddress("contact@carmen.wstr.fr", "Contact Admin"); // receiver's email and name

        $mail->Subject = "Contact - " . $name;

        $mail->Body =
          "<h1>" .
          $name .
          " tente de vous contacter</h1>" .
          "<br>" .
          "<p>" .
          $message .
          "</p>" .
          "<br>" .
          "<p>Lui répondre : <a mailto='" .
          $email .
          "'>" .
          $email .
          "</p>";

        $mail->send();

        $status = "Le message a bien été envoyé !";

        $mail->smtpClose();
      } catch (Exception $e) {
        // handle error.

        $status = "Le message n'a pas pu être envoyé !"; //, $mail->ErrorInfo;
      }
    } else {
      $status = "";
    }
    $this->view("home/contact", [
      "dashboard" => $dashboard,
      "status" => $status,
    ]);
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
