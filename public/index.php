<?php
ini_set('display_errors', 1);

define( 'ROOT_PATH', substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) );

// permet de bootstrapper tout le reste de l'application

require_once('../app/init.php');

// creation d'une nouvelle instance de la classe applicaiton pour lancer le site
$app = new App;