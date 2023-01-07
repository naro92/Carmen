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
  public function getFaq()
  {
    $bdd = new PDO(
      "mysql:host=" . HOST . ":" . PORT . ";dbname=" . DBNAME . ";charset=utf8",
      USERNAME,
      PASSWORD,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $vue = [];
    $params = [];
    $query = "SELECT * FROM faq";
    $statement = $bdd->prepare($query);
    $statement->execute($params);

    while ($obj = $statement->fetch()) {
      $vue["questions"][] = [
        "id" => htmlspecialchars($obj["idquestion"]),
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
  public function insertQuestion(string $titre, string $contenu)
  {
    $bdd = new PDO(
      "mysql:host=" . HOST . ":" . PORT . ";dbname=" . DBNAME . ";charset=utf8",
      USERNAME,
      PASSWORD,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $sql = "INSERT INTO faq (titre, contenu) VALUES (?,?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$titre, $contenu]);
    return $stmt;
  }

  /**
   * updateQuestion permet de mettre à jour une question de la faq
   * en fonction de son id
   *
   * @return void
   */
  public function updateQuestion(string $id, string $titre, string $contenu)
  {
    try {
      $bdd = new PDO(
        "mysql:host=" .
          HOST .
          ":" .
          PORT .
          ";dbname=" .
          DBNAME .
          ";charset=utf8",
        USERNAME,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      $sql =
        "UPDATE faq SET titre=:newTitre, contenu=:newContenu WHERE idquestion=:id";
      $stmt = $bdd->prepare($sql);
      $stmt->execute([
        "newTitre" => $titre,
        "newContenu" => $contenu,
        "id" => $id,
      ]);
      echo "Faq updated!";
      echo "</br>";
      echo "id : " . $id . " et nouveau titre : " . $titre;
      echo '<a href="index.php">Retour à la page d\'accueil</a>';
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  /**
   * deleteQuestion permet de supprimer une quesiton de la faq
   *
   * @param  string $id
   * @return void
   */
  public function deleteQuestion(string $id)
  {
    try {
      $bdd = new PDO(
        "mysql:host=" .
          HOST .
          ":" .
          PORT .
          ";dbname=" .
          DBNAME .
          ";charset=utf8",
        USERNAME,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      $sql = "DELETE FROM faq WHERE idquestion = :id ";

      $stmt = $bdd->prepare($sql);
      $stmt->execute(["id" => $id]);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}
