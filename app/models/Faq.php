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
  public function connect()
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

      return $bdd;
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  /**
   * getFaq
   *
   * @return array $vue contient les elements de la faq
   */
  public function getFaq()
  {
    $bdd = Faq::connect();

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
   * @param  string $titre
   * @param  string $contenu
   * @return void
   */
  public function insertQuestion(string $titre, string $contenu)
  {
    $bdd = Faq::connect();

    $sql = "INSERT INTO faq (titre, contenu) VALUES (?,?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$titre, $contenu]);
    return $stmt;
  }

  /**
   * updateQuestion permet de mettre à jour une question de la faq
   * en fonction de son id
   *
   * @param  string $id
   * @param  string $titre
   * @param  string $contenu
   * @return void
   */
  public function updateQuestion(string $id, string $titre, string $contenu)
  {
    $bdd = Faq::connect();

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
  }

  /**
   * deleteQuestion permet de supprimer une quesiton de la faq
   *
   * @param  string $id
   * @return void
   */
  public function deleteQuestion(string $id)
  {
    $bdd = Faq::connect();

    $sql = "DELETE FROM faq WHERE idquestion = :id ";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(["id" => $id]);
  }
}
