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
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $prenomMedecin = $this->model("MedecinModel");

    $prenomMedecin = new MedecinModel();

    // on va appeler la fonction qui permet de recuperer tous les elements de la faq
    $prenomMedecin->fetch = $prenomMedecin->getPrenom($_SESSION["user"]);

    $this->view("medecin/index", ["prenom" => $prenomMedecin->fetch]);
    unset($prenomMedecin);
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function rechercher()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $this->view("medecin/rechercher");
  }

  public function choix(int $id = 0)
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $patient = $this->model("PatientModel");

    $patient = new PatientModel();

    $patient->info = $patient->getInformations($id);

    $nom = $patient->info["patients"][0]["nom"];
    $prenom = $patient->info["patients"][0]["prenom"];

    $this->view("medecin/choix", [
      "idPatient" => $id,
      "prenom" => $prenom,
      "nom" => $nom,
    ]);
  }

  public function patient()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $medecin = $this->model("MedecinModel");

    $medecin = new MedecinModel();

    $medecin->patients = $medecin->getPatient($_SESSION["user"]);

    $this->view("medecin/gestionPatient", ["data" => $medecin->patients]);
    unset($medecin);
  }

  public function constantes(int $id = 0)
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $patient = $this->model("PatientModel");

    $patient = new PatientModel();

    $patient->info = $patient->getInformations($id);

    $this->view("medecin/constantes", ["patient" => $patient->info]);
    unset($patient);
  }

  public function chat()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $this->view("medecin/chat");
    // php à rajouter
  }

  public function search()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];

    $medecin = $this->model("MedecinModel");

    $medecin = new MedecinModel();

    $medecin->recherche = $medecin->searchPatient($prenom, $nom, $email);

    $this->view("medecin/resultat", ["recherche" => $medecin->recherche]);
    unset($medecin);
  }

  public function getConstantes()
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $patient = $this->model("PatientModel");

    $patient = new PatientModel();

    $patient->constantes = $patient->getConstantesPatient();

    echo $patient->constantes;
    unset($patient);
  }

  public function ecrireBilan(int $id = 0)
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $error = "";

    if (isset($_POST["submit-btn"])) {
      if (isset($_POST["bilan"])) {
        $texte = $_POST["bilan"];

        $medecin = $this->model("MedecinModel");

        $medecin = new MedecinModel();

        $medecin->bilans = $medecin->bilanDatabase($id, $texte);
        $error = $medecin->bilans;
      }
    }

    $this->view("medecin/ecrireBilan", ["error" => $error, "idPatient" => $id]);
  }

  public function bilans(int $id = 0)
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $patient = $this->model("PatientModel");

    $patient = new patientModel();

    $patient->bilans = $patient->getAllrapportsId($id);

    $this->view("medecin/bilans", [
      "idPatient" => $id,
      "rapports" => $patient->bilans["rapports"],
    ]);
  }

  public function modifierProfil()
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    $retour = "";
    $medecin = $this->model("MedecinModel");
    $medecin = new MedecinModel();

    $medecin->infos = $medecin->getProfil($_SESSION["user"]);
    if (isset($_POST["submit-btn"])) {
      $id = $_POST["id"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $date = $_POST["dateNaissance"];
      $mail = $_POST["mail"];

      $medecin->modifProfilAction = $medecin->modifierProfilDatabase(
        $nom,
        $prenom,
        $date,
        $mail,
        $id
      );
      if ($medecin->modifProfilAction) {
        $retour = "Votre profil a été modifié !";
      } else {
        $retour = "il y a eu une erreur !";
      }
    }
    $this->view("medecin/modifProfil", [
      "infos" => $medecin->infos["medecin"][0],
      "error" => $retour,
    ]);
  }

  public function modifierBilan(int $idPatient)
  {
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $error = "";
    $id = $_POST["id"];

    if (isset($id) && isset($_POST["submit-btn"])) {
      if (isset($_POST["bilan"])) {
        $id = $_POST["id"];
        $texte = $_POST["bilan"];

        $medecin = $this->model("MedecinModel");

        $medecin = new MedecinModel();

        $medecin->bilans = $medecin->bilanUpdateDatabase($id, $texte);
        $error = $medecin->bilans;

        $patient = "";

        $medecin->texte = $medecin->getRapporttexte($id);
      } else {
        $patient = $this->model("PatientModel");

        $patient = new PatientModel();

        $patient->texte = $patient->getRapporttexte($id);
      }
    }

    $this->view("medecin/modifierBilan", [
      "error" => $error,
      "idPatient" => $idPatient,
      "text" => isset($patient->texte)
        ? $patient->texte[0]["texte_rapport"]
        : $medecin->texte[0]["texte_rapport"],
      "idRapport" => $id,
    ]);
  }

  public function supprimerBilanAction(int $idPatient)
  {
    session_start();
    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }
    if (isset($_POST["supress-btn"])) {
      $actualId = $_POST["id"];

      $medecin = $this->model("MedecinModel");

      $medecin = new MedecinModel();

      $medecin->deleteBilan = $medecin->deleteBilan($actualId);
      header("Location: /public/medecin/bilans/" . $idPatient);
      unset($faq);
    }
  }
}
