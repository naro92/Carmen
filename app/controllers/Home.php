<?php

/**
 * Classe Home
 * 
 * Prend aussi en compte toutes les methodes de la classe Controller
 * 
 * Classe qui se chargera par défaut lors du chargement sans aucune methode
 * Elle va charger le modele 'User'
 * 
 * Elle va afficher le nom inclu dans le modele
 */
class Home extends Controller{

    public function index($name = ''){
        // on charge le modele 'User'
        $user = $this->model('Test');
        $user->name = $name;

        // on va charger la vue et lui envoyer les données que l'on veut lui envoyer
        $this->view('home/index', ['name' => $user->name]);
    }

    public function cgu(){
        // on Charge le model de la faq
        $faq = $this->model('Faq');
        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // on va appeler la fonction dans le model qui permet d'inserer le titre et la contenu de la faq
        $faq->insert = $faq->insertQuestion($bdd, 'faq', 'Contenu faq');

        $this->view('home/cgu');
    }

    public function faq(){
        // on charge le model de la faq
        $faq = $this->model('Faq');
        $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // on va appeler la fonction qui permet de recuperer tous les elements de la faq 
        $faq->fetch = $faq->getFaq($bdd, 'faq');
        // on charge la vue avec tous les elements de la faq
        $this->view('home/faq', ['faq' => $faq->fetch]);
    }

    public function contact($fetch = ""){
        $test = $this->model('Test');
        $bdd = new PDO('mysql:host=localhost:3306;dbname=mvc;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $test->fetch = $test->getAll($bdd, 'users', $fetch);

        $this->view('home/contact', ['test' => $test->fetch]);
    }

    public function error(){
        $this->view('error/404');
    }
}