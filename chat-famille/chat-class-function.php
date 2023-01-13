<?php



class db {
	private static $cennct = null;	// 记录PDO连接方法Documenter les méthodes de connexion PDO
	private static $pd = null;	// 记录实例后的类Enregistre la classe après l'instance
	private function __construct(){}	// 禁用new直接实例本类Désactive les instances directes de cette classe avec les nouveaux



	/**
	 *  数据库连接方法
	 * Méthodes de connexion aux bases de données
	 */
	private function conn(){
		$pdo = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8','root','woaiai123');	// 连接数据库Connexion à la base de données
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
	function insertlts($say,$userID,$time,$medecinID,$patientID){   

		if(self::$cennct->exec("insert into `chat` (`Médecin_idMédecin`,`Patient_idPatient`,`Famille_idFamille`,`contenu`,`time`) values('$medecinID','$patientID','$userID','$say','$time')")){

		return true;}	//成功返回ture  Retour réussi à la ture
		else{
			return false; } //失败返回false  L'échec renvoie un faux

	}

	function getuserid($user){  //根据家人的名字查找ID   Trouver l'ID par le nom du famille
		$sql = "select `idFamille` from `famille` where `Nom` = '$user'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['idFamille'];
	  }
	  
	  function getmid($userID){   //根据家人的ID查找医生ID  Trouver un medecin ID par identifiant de patient
		$sql = "SELECT `Médecin_idMédecin` from `famille` where `idFamille` = '$userID'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['Médecin_idMédecin'];
	  }

	  function getpID($userID){   //根据家人的ID查找病人id  Trouver un patient id par id de famille
		$sql = "SELECT `Patient_idPatient` from `famille` where `idFamille` = '$userID'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['Patient_idPatient'];
	  }


	/**
	 * 读取聊天内容
	 * Lis le contenu du chat
	 */
	function getlts($fi,$mi){   //读取病人ID，时间，内容 Lire l'ID du patient, l'heure, le contenu
		$tmp = self::$cennct->query("select count(time) as num from `chat` where `Famille_idFamille` = '$fi' and `Médecin_idMédecin` = '$mi'");
		$num = $tmp->Fetch(PDO::FETCH_ASSOC);
		$sql = "select `Patient_idPatient`,`time`,`contenu` from `chat` where `Famille_idFamille` = '$fi' and `Médecin_idMédecin` = '$mi' order by `time` asc;";
		if($num['num']>100)
			$sql .= " limit ".($num['num']-100).",10";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}


	function  getfamilleID($nom){   //从网页获取家人ID Obtiens l'ID du famille à partir de la page Web
		 $sql = "SELECT `idFamille` from `famille` where `Nom` = '$nom'";
		 $tmp = self::$cennct->query($sql); 
		 $data = $tmp->Fetch(PDO::FETCH_ASSOC);
		 $data = (int)$data;
		 return $data;
		//return '1';
}

	function getfamillenom(){   //从网页获取家人名字  Récupère le nom du famille à partir de la page Web
		//return '$data["Nom"]';
		return 'q';
	}

function getmedecinID($fi){		//通过家人ID查询对应医生ID  Recherche par ID de famille pour l'ID de médecin correspondant
    $sql = "SELECT `Médecin_idMédecin` from `famille` where `idFamille` = '$fi'";
    $tmp = self::$cennct->query($sql);	
    $data = $tmp->Fetch(PDO::FETCH_ASSOC);
    return $data['Médecin_idMédecin'];
}

function getmedecinnom($mi){		//通过医生ID查询对应医生名字 Recherche par ID de medecin pour le nom de médecin correspondant
    $sql = "SELECT `Nom` from `médecin` where `idMédecin` = '$mi'";
    $tmp = self::$cennct->query($sql);	
    $data = $tmp->Fetch(PDO::FETCH_ASSOC);
    return $data['Nom'];
}

function getpatientid($fi){		//通过家人id查找病人id Recherche par ID de patient pour le id de famille correspondant
    $sql = "SELECT `Patient_idPatient` from `famille` where `idFamille` = '$fi'";
    $tmp = self::$cennct->query($sql);	
    $data = $tmp->Fetch(PDO::FETCH_ASSOC);
    return $data['Patient_idPatient'];
}

function getpatientnom($pi){		//通过病人id查找病人名字 Recherche par ID de patinet pour le nom de patient correspondant
    $sql = "SELECT `Nom` from `patient` where `idPatient` = '$pi'";
    $tmp = self::$cennct->query($sql);	
    $data = $tmp->Fetch(PDO::FETCH_ASSOC);
    return $data['Nom'];
}
}


?>
