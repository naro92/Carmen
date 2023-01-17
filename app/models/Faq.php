<?php
require "Database.php";
/**
 * Classe FAQ
 *
 * Model FAQ
 *
 * Permet de gerer les données liées à la FAQ
 */
class Faq
{
  protected $bdd;

  public function __construct()
  {
    $this->connect();
  }

  public function __destruct()
  {
    $this->bdd = null;
  }

  public function connect()
  {
    $db = new Database();
    $this->bdd = $db->connect();
  }

  /**
   * getFaq
   *
   * @return array $vue contient les elements de la faq
   */
  public function getFaq()
  {
    $vue = [];
    $params = [];
    $query = "SELECT * FROM faq";
    $statement = $this->bdd->prepare($query);
    $statement->execute($params);

    while ($obj = $statement->fetch()) {
      $vue["questions"][] = [
        "id" => htmlspecialchars($obj["idquestion"]),
        "titre" => htmlspecialchars($obj["titre"]),
        "contenu" => htmlspecialchars($obj["contenu"]),
      ];
    }

    $statement->closeCursor();
    $statement = null;

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
    $sql = "INSERT INTO faq (titre, contenu) VALUES (?,?)";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([$titre, $contenu]);
    $stmt->closeCursor();
    $stmt = null;
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
    $sql =
      "UPDATE faq SET titre=:newTitre, contenu=:newContenu WHERE idquestion=:id";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      "newTitre" => $titre,
      "newContenu" => $contenu,
      "id" => $id,
    ]);
    $stmt->closeCursor();
    $stmt = null;
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
    $sql = "DELETE FROM faq WHERE idquestion = :id ";

    $stmt = $this->bdd->prepare($sql);
    $stmt->execute(["id" => $id]);
    $stmt->closeCursor();
    $stmt = null;
  }
}
