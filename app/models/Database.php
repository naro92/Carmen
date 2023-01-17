<?php

class Database
{
  public function connect()
  {
    $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8";
    $username = USERNAME;
    $password = PASSWORD;
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
      $conn = new PDO($dsn, $username, $password, $options);
      return $conn;
    } catch (PDOException $e) {
      // handle the error
    }
  }
}
?>
