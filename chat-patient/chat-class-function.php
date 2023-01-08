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
		$pdo = new PDO('mysql:host=localhost;dbname=chat;charset=utf8','root','woaiai123');	// 连接数据库Connexion à la base de données
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
	function insertlts($say,$userID,$time,$medecinID){   

		if(self::$cennct->exec("insert into `chat` (`medecinID`,`patientID`,`contenu`,`time`) values('$medecinID','$userID','$say','$time')")){

		return true;}	//成功返回ture  Retour réussi à la ture
		else{
			return false; } //失败返回false  L'échec renvoie un faux

	}

	function getuserid($user){  //根据病人的名字查找ID   Trouver l'ID par le nom du patient
		$sql = "select `ID` from `patientnom` where `nom` = '$user'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['ID'];
	  }
	  
	  function getmid($user){   //根据病人的ID查找医生  Trouver un médecin par identifiant de patient
		$sql = "SELECT `medecinID` from `patient` where `patientID` = '$user'";
		$tmp = self::$cennct->query($sql); 
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
		return $data['medecinID'];
	  }



	/**
	 * 读取聊天内容
	 * Lis le contenu du chat
	 */
	function getlts($pi,$mi){   //读取病人ID，时间，内容 Lire l'ID du patient, l'heure, le contenu
		$tmp = self::$cennct->query("select count(time) as num from `chat` where `patientID` = '$pi' and `medecinID` = '$mi'");
		$num = $tmp->Fetch(PDO::FETCH_ASSOC);
		$sql = "select `patientID`,`time`,`contenu` from `chat` where `patientID` = '$pi' and `medecinID` = '$mi' order by `time` asc;";
		if($num['num']>100)
			$sql .= " limit ".($num['num']-100).",10";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	function getnom($pi){		//读取病人名字 Lire les noms des patients
		$sql = "SELECT `nom` FROM `patientnom` WHERE `ID` = '$pi'";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->Fetch(PDO::FETCH_ASSOC);
	 	return $data['nom'];
	 }


	function  getpatientID($nom){   //从网页获取病人ID Obtiens l'ID du patient à partir de la page Web
		 $sql = "SELECT `ID` from `patientnom` where `nom` = '$nom'";
		 $tmp = self::$cennct->query($sql); 
		 $data = $tmp->Fetch(PDO::FETCH_ASSOC);
		 $data = (int)$data;
		 return $data;
		//return '1';
}

	function getpatientnom(){   //从网页获取病人名字  Récupère le nom du patient à partir de la page Web
		//return '$data["prenom"]'
		return 'x';
	}

function getmedecinID($pi){		//通过病人ID查询对应医生ID  Recherche par ID de patient pour l'ID de médecin correspondant
    $sql = "SELECT `medecinID` from `patient` where `patientID` = '$pi'";
    $tmp = self::$cennct->query($sql);	
    $data = $tmp->Fetch(PDO::FETCH_ASSOC);
    return $data['medecinID'];
}


}


?>