<?php

$patientID = isset($_GET['patientID'])?$_GET['patientID']:'';

class db {
	private static $cennct = null;	// 记录PDO连接方法Documenter les méthodes de connexion PDO
	private static $pd = null;	// 记录实例后的类Enregistre la classe après l'instance
	private function __construct(){}	// 禁用new直接实例本类Désactive les instances directes de cette classe avec les nouveaux

	/**
	 *  数据库连接方法
	 * Méthodes de connexion aux bases de données
	 */
	private function conn(){
		$pdo = new PDO('mysql:host=localhost:3306;dbname=mydb;charset=utf8','root','root');	// 连接数据库Connexion à la base de données
		$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);		// 存储过程设置Paramètres de la procédure
		return $pdo;								// 返回Dos
	}

	/**
	 * 单例实现方法
	 * 外部直接调用此方法
	 * db::getdb()
	 * Méthode de mise en œuvre à instance unique
	 * Appelle cette méthode directement de l'extérieur
	 * db::getdb()
	 */
	static function getdb(){
		if(self::$pd == null) //检查pd是否为null   Vérifie si pd est nul
            		self::$pd = new db();  //如果为空就创造一个新的pd  Si c'est vide, crée un nouveau pd
		
		if(self::$cennct  == null ) //检查cennct是否为null  Vérifie si cennct est nul
			self::$cennct  = self::$pd->conn();	//如果为空就调用conn（），并将值返给cennct  Si elle est vide, appelle conn() et renvoie la valeur à cennct

        	return self::$pd;//返回pd Retour au pd
	}
	
	/**
	 * 聊天内容插入
	 * Insertion de chat
	 */
	function insertlts($say,$userID,$time,$patientID,$famillID){   
		
		if(self::$cennct->exec("insert into `chat` (`idmedecin`,`idpatient`,`idfamille`,`contenu`,`time`) values('$userID','$patientID','$famillID','$say','$time')")){

		return true;}	//成功返回ture  Retour réussi à la ture
		else{
			return false; } //失败返回false  L'échec renvoie un faux

	}

	function getuserid($user){  //根据医生的名字查找ID   Trouver l'ID par le nom du medecin
		$sql = "select `idmedecin` from `medecin` where `prenom` = '$user'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		$data = (int)$data;
		return $data;
	  }
	  
	  function getpid(){   //根据医生的ID查找病人ID  Trouver un patient ID par identifiant de medecin
		$patientID = isset($_GET['patientID'])?$_GET['patientID']:'';
		return $patientID;
	  }

	  function getfamailleID(){   //根据病人的ID查找家庭id  Trouver un famillid par identifiant de patient
		$idPatient = $this->getpatientID();
        //var_dump($idPatient);
		//$idPatient = '1';
		$sql = "SELECT `idfamille` from `famille` where `patient_idpatient` = '$idPatient'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['idfamille'];
	  }


	/**
	 * 读取聊天内容
	 * Lis le contenu du chat
	 */
	function getlts($pi,$mi){   //读取病人ID，时间，内容 Lire l'ID du patient, l'heure, le contenu
		$tmp = self::$cennct->query("select count(time) as num from `chat` where `idpatient` = '$pi' and `idmedecin` = '$mi'");
		$num = $tmp->Fetch(PDO::FETCH_ASSOC);
		$sql = "select `idpatient`,`time`,`contenu` from `chat` where `idpatient` = '$pi' and `idmedecin` = '$mi' order by `time` asc;";
		if($num['num']>100)
			$sql .= " limit ".($num['num']-100).",10";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	function getnom($mi){		//读取医生名字 Lire les noms des medecin
		$sql = "SELECT `nom` FROM `medecin` WHERE `idmedecin` = '$mi'";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
	 	return $data['nom'];
	 }



	function  getmedecinID($nom){   //从网页获取医生ID Obtiens l'ID du medecin à partir de la page Web
		 $sql = "SELECT `idmedecin` from `medecin` where `prenom` = '$nom'";
		 $tmp = self::$cennct->query($sql); 
		 $data = $tmp->Fetch(PDO::FETCH_ASSOC);
		 $data = (int)$data;
		 return $data;
		//return '1';
    }

	static function getmedecinnom(){   //从网页获取医生名字  Récupère le nom du medecin à partir de la page Web
		//return '$data["Nom"]';
		//echo $_GET['user'];
		//return 'medecin1';
		//echo "$data";
		$user = isset($_GET['user'])?$_GET['user']:'';
		// var_dump($user);
		return $user;
		//return "Michel";
	}

	function  getpatientnom($pi){   //从网页获取病人ID Obtiens l'ID du patient à partir de la page Web
		$sql = "SELECT `nom` from `patient` where `idpatient` = '$pi'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		
		return $data['nom'];
	   //return '1';
    }

    function getpatientID(){		//  通过上一页的选择获取病人ID
        $patientID = isset($_GET['patientID'])?$_GET['patientID']:'';
        return $patientID;
    }


}


?>


