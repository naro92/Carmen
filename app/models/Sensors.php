<?php
require "Database.php";
/**
 * Classe Sensors
 *
 * Model Sensors
 *
 * Permet de gerer les données liées aux capteurs
 */
class Sensors
{
  protected $bdd;
  const TEAM_NUMBER = "0G3E";

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

  public function getLogs()
    {

        try {
            $logs = file_get_contents("http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=" . self::TEAM_NUMBER);
        } catch (Exception $e) {
            echo "Failed to fetch data from ISEP server : " . $e->getMessage() . ". Please check that ISEP correctly opened port 22 👀👀", 1, true;
        }

        if (!$logs) {
            echo "Failed to fetch data from ISEP server. Please check that ISEP correctly opened port 22 👀👀", 1, true;
        }

        // The frame size is inconsistent, therefore the provided code from ISEP is not reliable. We need to identify the pattern where each frame begins with the number 1 followed by our team number. By utilizing this pattern, we can effectively locate the desired frame.
        $pattern = '/1' . self::TEAM_NUMBER . '.*?(?=1' . self::TEAM_NUMBER . '|$)/s';
        preg_match_all($pattern, $logs, $matches);
        $foundFrames = $matches[0];

        print_r($foundFrames);

        foreach ($foundFrames as $frame) {
            $sensorInfos = $this->processFrame($frame);
            if ($sensorInfos) {
                //echo $sensorInfos[0] . " " . $sensorInfos[1] . " " . $sensorInfos[2] . " " . $sensorInfos[3]->format('Y-m-d H:i:s') . "<br>";
                $this->insertInfosInDb($sensorInfos[0], $sensorInfos[1], $sensorInfos[2], $sensorInfos[3]->format('Y-m-d H:i:s'));
            }
        }

    }

    private function processFrame($frame)
    {
        $data = sscanf($frame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
        print_r($data);
        $sensorValue = $data[5];
        $sensorType = $data[3];
        $sensorNumber = $data[4];

        if ($data[0] != "1" && $data[0] != "2") {
            return null;
        }

        if ($data[1] != self::TEAM_NUMBER) {
            return null;
        }

        if ($data[2] != "1") {
            return null;
        }
        

        if ($this->isDateCorrect($data[8], $data[9], $data[10], $data[11], $data[12], $data[13])) {
            $date = date_create($data[8] . "-" . $data[9] . "-" . $data[10] . " " . $data[11] . ":" . $data[12] . ":" . $data[13]);
        } else {
            $date = new DateTime();
        }

        if ($sensorValue <= 0) {
            return null;
        }

        return [$sensorType, $sensorNumber, $sensorValue, $date];
    }

    private function insertInfosInDb($sensorType, $sensorNumber, $value, $date)
    {

        //transform sensorNUmber from 01 to 1
        $sensorNumber = intval($sensorNumber);

        $SENSORS_TYPES = [1 => "sonore", 2 => "cardiaque", 3 => "humidite", 4 => "thermique", 5 => "thermique"];
        $stmt = $this->bdd->prepare("SELECT * FROM capteurs WHERE idcapteurs = :sensorID");
        $stmt->bindParam(':sensorID', $sensorNumber, PDO::PARAM_INT);
        $stmt->execute();

        //print the result of the query
        print_r($stmt->fetchAll());

        $sensorTypeName = $SENSORS_TYPES[$sensorType];


        // check if the data in the database is already up to date, that means that if the date from the database is more recent than the date from the frame, we don't update the database
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $dateFromDb = new DateTime($row['date_mesures']);
            echo $dateFromDb->format('Y-m-d H:i:s') . "<br>";
            echo $date;
            if ($dateFromDb->format('Y-m-d H:i:s') > $date) {
                echo "not updated";
                return;
            } else {
            // update the value if it already exists
            $stmt = $this->bdd->prepare("UPDATE capteurs SET valeurs_donnees = :value_data, date_mesures = :date WHERE idcapteurs = :sensorID");
            $stmt->bindParam(':sensorID', $sensorNumber, PDO::PARAM_INT);
            $stmt->bindParam(':value_data', $value, PDO::PARAM_INT);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            echo "updated";
            }
        } else {
            $stmt = $this->bdd->prepare("INSERT INTO capteurs (idcapteurs, type, chambre_numero,  valeurs_donnees, date_mesures) VALUES (:sensorID, 17, :sensorType, :value, :date)");
            $stmt->bindParam(':sensorID', $sensorNumber, PDO::PARAM_INT);
            $stmt->bindParam(':value', $value, PDO::PARAM_INT);
            $stmt->bindParam(':sensorType', $sensorTypeName, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            echo "inserted";
        }

        
        $stmt->closeCursor();
    }

    private function isDateCorrect($year, $month, $day, $hours, $min, $seconds)
    {
        if ($year === null || $month === null || $day === null || $hours === null || $min === null || $seconds === null) {
            return false; // At least one value is null
        }

        if (!checkdate($month, $day, $year)) {
            return false; // Invalid date
        }


        if ($hours < 0 || $hours > 23 || $min < 0 || $min > 59 || $seconds < 0 || $seconds > 59) {
            return false; 
        }

        return true; 
    }

  
}
