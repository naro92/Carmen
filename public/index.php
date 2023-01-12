<?php
ini_set("display_errors", 0);

define(
  "ROOT_PATH",
  substr(
    str_replace("\\", "/", realpath(dirname(__FILE__))),
    strlen(str_replace("\\", "/", realpath($_SERVER["DOCUMENT_ROOT"])))
  )
);

define("HOST", "");
define("PORT", "3306");
define("DBNAME", "");
define("USERNAME", "");
define("PASSWORD", "");

// permet de bootstrapper tout le reste de l'application

require_once "../app/init.php";

// creation d'une nouvelle instance de la classe applicaiton pour lancer le site
$app = new App();
