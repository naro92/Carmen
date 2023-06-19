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
    $error = "";

    $medecin = $this->model("MedecinModel");

    $medecin = new MedecinModel();

    $medecin->patients = $medecin->getPatient($_SESSION["user"]);

    if (isset($_POST["supress-btn"])) {
      $idPatient = $_POST["id"];

      $error = $medecin->deleteLink = $medecin->deleteLink(
        $idPatient,
        $_SESSION["user"]
      );
    }

    $this->view("medecin/gestionPatient", [
      "data" => $medecin->patients,
      "error" => $error,
    ]);
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

    $this->view("medecin/constantes", [
      "patient" => $patient->info,
      "id" => $id,
    ]);
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

    $retour = "";

    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];

    $medecin = $this->model("MedecinModel");

    $medecin = new MedecinModel();

    $medecin->recherche = $medecin->searchPatient($prenom, $nom, $email);

    $this->view("medecin/resultat", [
      "recherche" => $medecin->recherche,
      "error" => $retour,
    ]);
    unset($medecin);
  }

  public function addLink()
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
    if (isset($_POST["add-btn"])) {
      $idPatient = $_POST["id"];

      $error = $medecin->addLink = $medecin->addLink(
        $idPatient,
        $_SESSION["user"]
      );
    }
    header("Location: /public/medecin/patient");
    exit();
  }

  public function getConstantesCardiaque()
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

    $patient->constantes = $patient->getConstantesPatientCardiaque();

    echo $patient->constantes;
    unset($patient);
  }

  public function getConstantesTemp()
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

    $patient->constantes = $patient->getConstantesPatientTemp();

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

  public function chambres()
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
    $admin = $this->model("AdminModel");

    $admin = new AdminModel();

    $admin->chambres = $admin->getChambres();

    $admin->donnees = $admin->getDonneesChambres();

    $pasok = [];

    foreach ($admin->donnees as $key => $donnee) {
      foreach ($donnee[0] as $capteur => $data) {
        if ($capteur == "cardiaque" && $data > 80) {
          array_push($pasok, $key);
        } elseif ($capteur == "thermique" && $data > 37.5) {
          array_push($pasok, $key);
        } elseif ($capteur == "lumiere" && $data > 40) {
          array_push($pasok, $key);
        } elseif ($capteur == "sonore" && $data > 50) {
          array_push($pasok, $key);
        }
      }
    }

    $this->view("medecin/chambres", [
      "chambres" => $admin->chambres,
      "pasok" => $pasok,
    ]);
  }

  public function getDonneesChambres()
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

    $admin = $this->model("AdminModel");

    $admin = new AdminModel();

    $admin->chambres = $admin->getChambres();

    $admin->donnees = $admin->getDonneesChambres();

    $pasoktable = [];
    $pasok = "";

    foreach ($admin->chambres["capteurs"] as $row) {
      foreach ($admin->donnees as $key => $donnee) {
        if ($row["numero"] == $key) {
          //echo $row["numero"] . " " . $key;
          foreach ($donnee[0] as $capteur => $data) {
            //echo $capteur . " " . $data;
            if ($capteur == "cardiaque" && $data > 80) {
              array_push($pasoktable, $key);
              //$pasok = "probleme";
            } elseif ($capteur == "thermique" && $data > 37.5) {
              array_push($pasoktable, $key);
              //$pasok = "probleme";
            } elseif ($capteur == "lumiere" && $data > 40) {
              array_push($pasoktable, $key);
              //$pasok = "probleme";
            } elseif ($capteur == "sonore" && $data > 50) {
              array_push($pasoktable, $key);
              //$pasok = "probleme";
            }
          }
        } else {
          $pasok = "";
        }
      }
    }
    foreach ($admin->chambres["capteurs"] as $row) {
      if (in_array($row["numero"], $pasoktable)) {
        $pasok = "probleme";
        $tooltip = "";
        foreach ($admin->donnees[$row["numero"]] as $probleme) {
          foreach ($probleme as $type => $data) {
            if (!empty($data)) {
              $tooltip .= $type . " : " . $data . "<br>";
            }
          }
        }

        //print_r($admin->donnees[$row["numero"]]);
      } else {
        $pasok = "ok";
        $tooltip = "Aucun problème !";
      }
      echo '<div class="child ' . $pasok . '">';
      echo '<span class="tooltiptext">' . $tooltip . "</span>";
      echo "Chambre " . $row["numero"];
      echo "</div>";
    }

    /* $ch = curl_init();
    curl_setopt(
      $ch,
      CURLOPT_URL,
      "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=003E");
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $data = curl_exec($ch);
      curl_close($ch);

    $data_tab = str_split($data,33);
    echo "Tabular Data:<br />";
    for($i=0, $size=count($data_tab); $i<$size; $i++){
      echo "Trame $i: $data_tab[$i]<br />";
    }

    $trame = $data_tab[1];
    // décodage avec des substring
    $t = substr($trame,0,1);
    $o = substr($trame,1,4);
    $r = substr($trame,5,1);
    $c = substr($trame,6,1);
    $n = substr($trame,7,2);
    $v = substr($trame,9,4);
    $a = substr($trame,13,4);
    $x = substr($trame,17,2);
    $year = substr($trame,19,4);
    $month = substr($trame,23,2);
    $day = substr($trame,25,2);
    $hour = substr($trame,27,2);
    $min = substr($trame,29,2);
    $sec = substr($trame,31,2); 
    // …
    // décodage avec sscanf
    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
    sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    echo("equipe :" . $o . ", type de capteur :" . $c . ", numéro :" . $n . ", valeur : " . $v); */



  }

  public function updateDonneesChambres(){
    session_start();

    if (!isset($_SESSION["user"]) && !isset($_SESSION["role"])) {
      header("Location: /public/");
      exit();
    }
    if ($_SESSION["role"] != "medecin") {
      header("Location: /public/");
      exit();
    }

    $admin = $this->model("Sensors");

    $admin = new Sensors();

    $admin->donnes = $admin->getLogs();

  }
}
