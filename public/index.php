<?php
ini_set("display_errors", 0);

define(
  "ROOT_PATH",
  substr(
    str_replace("\\", "/", realpath(dirname(__FILE__))),
    strlen(str_replace("\\", "/", realpath($_SERVER["DOCUMENT_ROOT"])))
  )
);

define("HOST", "176.31.132.185");
define("PORT", "3306");
define("DBNAME", "tfqtbp_carmenws_db");
define("USERNAME", "tfqtbp_carmenws_db");
define("PASSWORD", "!5*R_Cdb9P4%hLk3");

// permet de bootstrapper tout le reste de l'application

require_once "../app/init.php";

// creation d'une nouvelle instance de la classe applicaiton pour lancer le site
$app = new App();
