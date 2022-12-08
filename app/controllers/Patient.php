<?php

/**
 * Classe Patient
 * 
 * Classe qui se charge d'afficher les différentes pages du patient
 */
class Patient extends Controller {

    public function index(){
        session_start();
        if (!isset($_SESSION['user']) && !isset($_SESSION['role'])) {
	        header ('Location: /mvcExample/public/');
	        exit();
        }
        if ($_SESSION['role']!="patient"){
            header ('Location: /mvcExample/public/');
	        exit();
        }
        $this->view('patient/index');
    }

    public function error(){
        $this->view('error/404');
    }

}