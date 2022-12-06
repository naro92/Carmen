<?php

/**
 * App
 * 
 * Permet de faire le routing de l'applicaiton en fonction de l'url passer par l'utilisateur
 * 
 *  url : mon.site/controller/method/params
 */
class App {

    // creation des controleurs, methodes et parametres par défauts
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    // methode qui sera executee à l'instanciation de la classe
    public function __construct(){
        $url = $this->parseUrl();

        // si la premiere valeur du tableau est un fichier qui existe
        if(isset($url[0])){
            if(file_exists('../app/controllers/' . $url[0] . '.php')){
                $this->controller = $url[0];
                unset($url[0]);
            } else { // si le controlleur demandé n'existe pas
                $this->controller = 'home'; //on va sur le controlleur home
                unset($url[0]);
                $this->method = 'error'; // on charge la methode error pour afficher la page 404
                unset($url[1]);
            }
        }
        
        // on l'appele
        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        // si la deuxieme valeur du tableau est une methode qui existe
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            } else { // si la methode n'existe pas
                $this->method = 'error'; // on charge la methode error pour afficher la page 404
                unset($url[1]);
            }
        }

        // s'il y a des parametres
        $this->params = $url ? array_values($url) : [];

        // on lance la methode de la classe voulue avec les bons parametres
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // methode pour recuperer l'url et son contenu sous forme d'un tableau
    // le tableau est fait en splittant le contenu au niveau des slashs
    public function parseUrl(){
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}