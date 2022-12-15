<?php

class Test
{
  public $test;

  public function getAll(string $table, string $name)
  {
    $bdd = new PDO(
      "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
      "root",
      "root",
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

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
