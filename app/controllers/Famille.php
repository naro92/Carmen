<?php

/**
 * Classe Famille
 *
 * Classe qui se charge d'afficher les différentes pages de la famille
 */
class Famille extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    $this->view("famille/index");
  }

  public function error()
  {
    $this->view("error/404");
  }

  public function chat()
  {
    $this->view("famille/chat");
    // php à rajouter
  }
}
