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

        // echo $email;
        // echo $password;

        $patient = $this->model('Patient');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $patient->connexionPatient = $patient->connexionPatient($bdd, $email, $password);

        echo $patient->connexionPatient;
    }

}