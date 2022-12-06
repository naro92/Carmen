<?php
/**
 * Classe connexion
 * 
 * Classe qui se charge des différentes pages de connexion pour les différents
 * Types d'utilisateurs
 * 
 */
class Connexion extends Controller {

    public function index(){
        $this->view('connexion/index');
    }

    public function error(){
        $this->view('error/404');
    }

    public function personnel(){
        $this->view('connexion/personnel');
    }

    public function patient(){
        $this->view('connexion/patient');
    }

    public function famille(){
        $this->view('connexion/famille');
    }

    public function connexionPatient(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $patient = $this->model('PatientModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $patient->connexionPatient = $patient->connexionPatient($bdd, $email, $password);

        if($patient->connexionPatient){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "patient";
		    header('Location: /mvcExample/public/patient');
		    exit();
        } else {
            echo "There was an error !";
        }
    }

    public function connexionMedecin(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $patient = $this->model('MedecinModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $patient->connexionMedecin = $patient->connexionMedecin($bdd, $email, $password);

        if($patient->connexionMedecin){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "medecin";
		    header('Location: /mvcExample/public/medecin');
		    exit();
        } else {
            echo "There was an error !";
        }
    }

    public function connexionFamille(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $patient = $this->model('FamilleModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $patient->connexionMedecin = $patient->connexionFamille($bdd, $email, $password);

        if($patient->connexionMedecin){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "famille";
		    header('Location: /mvcExample/public/medecin');
		    exit();
        } else {
            echo "There was an error !";
        }
    }

    public function deconnexion(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /mvcExample/public');
        exit();
    }

}
