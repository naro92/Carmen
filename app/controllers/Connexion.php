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
        $this->view('connexion/personnel', ['error' => NULL]);
    }

    public function patient(){
        $this->view('connexion/patient', ['error' => NULL]);
    }

    public function famille(){
        $this->view('connexion/famille', ['error' => NULL]);
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
            $this->view('connexion/patient', ['error' => 'Mauvais identifiants ou mot de passe !']);
        }
    }

    public function connexionMedecin(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $medecin = $this->model('MedecinModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $medecin->connexionMedecin = $medecin->connexionMedecin($bdd, $email, $password);

        if($medecin->connexionMedecin){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "medecin";
		    header('Location: /mvcExample/public/medecin');
		    exit();
        } else {
            $this->view('connexion/personnel', ['error' => 'Mauvais identifiants ou mot de passe !']);
        }
    }

    public function connexionFamille(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $famille = $this->model('FamilleModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $famille->connexionFamille = $famille->connexionFamille($bdd, $email, $password);

        if($famille->connexionfamille){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "famille";
		    header('Location: /mvcExample/public/medecin');
		    exit();
        } else {
            $this->view('connexion/famille', ['error' => 'Mauvais identifiants ou mot de passe !']);
        }
    }

    public function connexionAdmin(){

        if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        $admin = $this->model('AdminModel');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $admin->connexionAdmin = $admin->connexionAdmin($bdd, $email, $password);

        if($admin->connexionAdmin){
            echo "Connection is successful !";
            session_start();
		    $_SESSION['user'] = $email;
            $_SESSION['role'] = "admin";
		    header('Location: /mvcExample/public/admin/dashboard');
		    exit();
        } else {
            $this->view('connexion/admin', ['error' => 'Mauvais identifiants ou mot de passe !']);
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