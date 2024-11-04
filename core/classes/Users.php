<?php 
	class Users{

		static $connections = array(); 

		public $conf = 'default';
		protected $db;
		public $table = false;
		public $Session;

		public function __construct() {

			if($this->table === false){
				$this->table = strtolower(get_class($this)).'s';
			}
			// Je me connecte à la base
			// Connection à la base ou récupération de la précédente connection
			$conf = Conf::$databases[$this->conf];
			if(isset(Model::$connections[$this->conf])){
				$this->db = Model::$connections[$this->conf];
				return true; 
			}
			try{
				$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';'
					,$conf['login'],
					$conf['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

				Model::$connections[$this->conf] = $pdo; 
				$this->db = $pdo; 
			}catch(PDOException $e){
				if(Conf::$debug >= 1){
					die($e->getMessage()); 
				}else{
					die('Errors'); 
				}
			}
		}


		// LA FONCTION QUI PERMERT D'EFFECTUEE DES REQUETTES PREPAREES A LA BASE DE DONNEE
		public function get($table, $fields = array()){
			$columns = implode(', ', array_keys($fields));
			//sql query
			$sql = "SELECT * FROM `{$table}` WHERE `{$columns}` = :{$columns}";
			//check if sql query is set $smt = declaration
			if($stmt = $this->db->prepare($sql)){
				foreach ($fields as $key => $value) {
					//bind columns
					$stmt->bindValue(":{$key}", $value);
				}
				//execute the query
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_OBJ);
			}
		}

		public function insert($table, $fields = array()){
			$columns = implode(", ", array_keys($fields));
			$values  = ":".implode(", :", array_keys($fields));
			//sql query
			$sql = "INSERT INTO {$table} ({$columns}) VALUES({$values})";
			//check if sql is prepared
			if($stmt = $this->db->prepare($sql)){
				//bind values to placeholders
				foreach ($fields as $key => $value) {
					$stmt->bindValue(":{$key}", $value);
				}
				//execute
				$stmt->execute();
				//return user_id
				return $this->db->lastInsertId();
			}
		}

		public function update($table, $fields, $condition){
			$columns  = '';
			$where    = " WHERE ";
			$i        = 1;
			//create columns
			foreach($fields as $name => $value){
				$columns .= "`{$name}` = :{$name}";
				if($i < count($fields)){
					$columns .= ", ";
				}
				$i++;
			}
			//create sql query
			$sql = "UPDATE {$table} SET {$columns}";
			//adding where condition to sql query
			foreach($condition as $name => $value){
				$sql .= "{$where} `{$name}` = :{$name}";
				$where = " AND ";
			}
			//check if sql query is prepared
			if($stmt = $this->db->prepare($sql)){
				foreach ($fields as $key => $value) {
					//bind columns to sql query
					$stmt->bindValue(":{$key}", $value);
					foreach ($condition as $key => $value) {
						# bind where conditions to sql query
						$stmt->bindValue(":{$key}", $value);
					}
				}
				//execute the query
				$stmt->execute();
			}
		}

		// public function findFirsts($req){
		// 	return current($this->query($req));
		// }


        public function hash($password){
			return password_hash($password, PASSWORD_BCRYPT);
		}
	
        public function userData($user_id){
			return $this->get('profiles', array('user_id' => $user_id));
		}  	

		public function donateData($donate_id){
			return $this->get('donates', array('id' => $donate_id));
		}  	

        public function mastersUserData($user_id){
			return $this->get('users', array('id' => $user_id));
		}      

		public function userVerify($code){
			return $this->get('verifications', array('code' => $code));
		}

		public function emailExist($email){
			$email = $this->get('profiles', array('email' => $email));
			return ((!empty($email))) ? $email : false;
		}

		public function mastersEmailExist($email){
			$email = $this->get('users', array('email' => $email));
			return ((!empty($email))) ? $email : false;
		}		

		public function mastersEmailTrue($id){
			$id = $this->get('users', array('id' => $id));
			return ((!empty($id))) ? $id : false;
		}

		public function usernameExist($username){
			$username = $this->get('profiles', array('username' => $username));
			return ((!empty($username))) ? $username : false;
		}

		public function phoneExist($number){
			$number = $this->get('profiles', array('phone' => $number));
			return ((!empty($number))) ? $number : false;
		}

		public function mastersPhoneExist($number){
			$number = $this->get('users', array('phone' => $number));
			return ((!empty($number))) ? $number : false;
		}

		public function redirect($url,$code = null){
			if($code == 301){
				header("HTTP/1.1 301 Moved Permanently");
			}
			header("Location: ".Router::url($url));
		}

        public function isLoggedIn(){
			return ((isset($_SESSION['user_id']))) ? true : false;
		}

		public function mastersIsLoggedIn(){ 
			return ((isset($_SESSION['User']))) ? true : false;
		}

}