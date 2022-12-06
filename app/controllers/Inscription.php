<?php

/**
 * Classe inscription
 * 
 * Classe qui se charge de l'inscription pour les différents types d'utilisateurs
 */
class Inscription extends Controller {

    public function index(){
        $this->view('inscription/index');
    }

    public function error(){
        $this->view('error/404');
    }

    public function personnel(){
        $this->view('inscription/personnel');
    }

    public function patient(){
        $this->view('inscription/patient');
    }

    public function famille(){
        $this->view('inscription/famille');
    }

    public function inscriptionPatient(){
        if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $password = hash('sha3-256', $_POST['password']);
        }

        // echo $email;
        // echo $password;

        $patient = $this->model('Patient');

        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $patient->inscriptionPatient = $patient->inscriptionPatient($bdd, $nom, $email, $password);

        echo $patient->inscriptionPatient;
    }

}