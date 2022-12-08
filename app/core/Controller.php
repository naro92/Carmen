<?php

/**
 * Classe Controller
 *
 * permet de charger les modeles en fonction de ce qu'on lui demande
 * retourne un objet modele
 */
class Controller
{
  // fonction qui permet de gérer les modeles
  public function model($model)
  {
    require_once "../app/models/" . $model . ".php";
    return new $model();
  }

  // fonction qui permet de charger les views et de leur passer des données en parametres
  public function view($view, $data = [])
  {
    require_once "../app/views/" . $view . ".php";
  }
}
