<?php

/**
 * Classe FAQ
 *
 * Model FAQ
 *
 * Permet de gerer les données liées à la FAQ
 */
class Faq
{
  /**
   * getFaq
   *
   * @param  PDO $bdd
   * @param  string $table
   * @return array $vue contient les elements de la faq
   */
  public function getFaq(PDO $bdd, string $table)
  {
    $vue = [];
    $params = [];
    $query = "SELECT * FROM " . $table;
    $statement = $bdd->prepare($query);
    $statement->execute($params);

    while ($obj = $statement->fetch()) {
      $vue["questions"][] = [
        "titre" => htmlspecialchars($obj["titre"]),
        "contenu" => htmlspecialchars($obj["contenu"]),
      ];
    }

    return $vue;
  }

  /**
   * insertQuestion
   *
   * @param  PDO $bdd
   * @param  string $titre
   * @param  string $contenu
   * @return void
   */
  public function insertQuestion(PDO $bdd, string $titre, string $contenu)
  {
    $sql = "INSERT INTO faq (titre, contenu) VALUES (?,?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$titre, $contenu]);
    return $stmt;
  }

  /**
   * updateQuestion
   *
   * FONCTION A MODIFIER
   *
   * @return void
   */
  public function updateQuestion(
    PDO $bdd,
    string $id,
    string $titre,
    string $contenu
  ) {
    $id = $_POST["id"];
    $newTitre = $_POST["titre"];
    $newContenu = $_POST["contenu"];

    try {
      $bdd = new PDO(
        "mysql:host=localhost:3306;dbname=mydb;charset=utf8",
        "root",
        "root",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      $sql = "UPDATE faq SET titre=:newTitre, contenu=:newContenu WHERE id=:id";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([
        "newTitre" => $newTitre,
        "contenu" => $newContenu,
        "id" => $id,
      ]);
      echo "Le changement d'adresse mail a bien été effectué !";
      echo "</br>";
      echo "id : " . $id . " et nouveau mail : " . $newEmail;
      echo '<a href="index.php">Retour à la page d\'accueil</a>';
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}
