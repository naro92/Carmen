<?php

class Test
{
  public $test;

  public function getAll(PDO $bdd, string $table, string $name)
  {
    if ($name == null) {
      $query = "SELECT * FROM " . $table;
      $params = [];
    } else {
      $query = "SELECT * FROM " . $table . " WHERE username LIKE ?";
      $params = ["%" . $name . "%"];
    }
    $statement = $bdd->prepare($query);
    $statement->execute($params);
    $return = $statement->fetchAll();
    return $return;
  }
}
