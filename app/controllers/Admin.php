<?php

/**
 * Classe Admin
 * 
 * Classe qui se charge d'afficher les différentes pages de l'administration
 */
class Admin extends Controller {

    public function index(){
        $this->view('connexion/admin', ['error' => NULL]);
    }

    public function error(){
        $this->view('error/404');
    }

    public function dashboard(){
        session_start();
        if (!isset($_SESSION['user']) && !isset($_SESSION['role']) ) {
	        header ('Location: /mvcExample/public/');
	        exit();
        }
        if ($_SESSION['role']!="admin"){
            header ('Location: /mvcExample/public/');
	        exit();
        }
        $this->view('admin/index');
    }

}
