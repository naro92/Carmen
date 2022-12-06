<?php

/**
 * Classe Medecin
 * 
 * Classe qui se charge d'afficher les différentes pages du medecin
 */
class Medecin extends Controller {

    public function index(){
        $this->view('medecin/index');
    }

    public function error(){
        $this->view('error/404');
    }

}