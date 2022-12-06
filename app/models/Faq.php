<?php

/**
 * Classe FAQ
 * 
 * Model FAQ
 * 
 * Permet de gerer les données liées à la FAQ
 */
class Faq {

    public function getFaq(PDO $bdd, String $table){
        $vue = array();
        $params = array();
        $query = 'SELECT * FROM ' . $table ;
        $statement = $bdd->prepare($query);
        $statement->execute($params);

        while ($obj = $statement->fetch()){
            $vue['questions'][] = array(
                'titre' => htmlspecialchars($obj['titre']),
                'contenu' => htmlspecialchars($obj['contenu'])
            );

        }
        
        return $vue;
    }

    public function insertQuestion(PDO $bdd, String $titre, String $contenu){
        $sql = "INSERT INTO faq (titre, contenu) VALUES (?,?)";
        $stmt= $bdd->prepare($sql);
        $stmt->execute([$titre, $contenu]);
        return $stmt;
    }

    public function updateQuestion(PDO $bdd, String $id, String $titre, String $contenu){
        $id = $_POST['id'];
        $newTitre = $_POST['titre'];
        $newContenu = $_POST['contenu'];

        try {

		    $bdd = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		    $sql = "UPDATE faq SET titre=:newTitre, contenu=:newContenu WHERE id=:id";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array("newTitre" => $newTitre, "contenu" => $newContenu, "id" => $id));
            echo "Le changement d'adresse mail a bien été effectué !";
            echo '</br>';
            echo "id : " . $id . " et nouveau mail : " . $newEmail;
            echo '<a href="index.php">Retour à la page d\'accueil</a>';
        }  catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

}