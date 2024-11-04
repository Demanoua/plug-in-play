<?php 
	class Verify extends Users{

		static $connections = array(); 

		public $conf = 'default';
		public $user;
		public $Controller;
		public $Cart;
		public $Users;
		protected $db;

		public function __construct() {

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

        public static function generateLink(){
			return str_shuffle(substr(md5(time().mt_rand().time()), 0, 150));
		}

		public static function str_random($length){
			$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
			return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
		}

		public static function VerifyQuery($length){
			$strings = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
			return substr(str_shuffle(str_repeat($strings.md5(time().mt_rand().time()), $length)), 0, $length);
		}
		
        public static function generateCode(){
			return mb_strtoupper(substr(md5(mt_rand().time()), 0, 5));
		}

        public function verifyCode($code){
			return $this->get('verifications', array('code' => $code));
		}

        public function newAdmin($code){
			return $this->get('queryaddadmins', array('code' => $code));
		}

		public function verifyResetCode($code){
			return $this->get('recoveries', array('code' => $code));
		}

		public function donate_status_ref($code){
			return $this->get('donates', array('donate_ref' => $code));
		}

		public function countCartItem(){

			$ip_add = getenv("REMOTE_ADDR");
	
			if (isset($_SESSION["user_id_cart"])) {
			
				$stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM `carts` WHERE `user_id` = :user_id");
				$stmt->bindParam(":user_id", $_SESSION["user_id_cart"], PDO::PARAM_STR);
				$stmt->execute();
				$total_cart_items = $stmt->fetch(PDO::FETCH_OBJ);

			}else{
				$stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM `carts` WHERE `add_ip` = :add_ip AND  user_id < 0");
				$stmt->bindParam(":add_ip", $ip_add, PDO::PARAM_STR_CHAR);
				$stmt->execute();
				$total_cart_items = $stmt->fetch(PDO::FETCH_OBJ);
			}
			return $total_cart_items->count;
		}

		public function query($sql, $data = array()){
			$req = $this->db->prepare($sql);
			foreach ($data as $key => $value) {
				$req->bindValue(":{$key}", $value);
			}
			$req->execute($data);
			return $req->fetchAll(PDO::FETCH_OBJ);
		}	

		public function navCartItem(){

			$ip_add = getenv("REMOTE_ADDR");

			if (isset($_SESSION["user_id_cart"])) {
				//When user is logged in this query will execute
				$product = $this->query("SELECT a.id as productId,a.productTitle,a.productPriceReduction,a.productImage,a.productSlug, b.id, b.qty FROM products a, carts b WHERE a.id=b.id AND b.user_id = :user_id", array('user_id' => $_SESSION["user_id_cart"]));
			}else{
				//When user is not logged in this query will execute
				$product = $this->query("SELECT a.id as productId,a.productTitle,a.productPriceReduction,a.productImage,a.productSlug, b.product_id, b.qty FROM products a, carts b WHERE a.id = b.product_id AND b.add_ip=:ip_add AND b.user_id < 0", array('ip_add' => $ip_add));
			}
			return $product;
		}

        public function authOnly(){

			if(!$this->isLoggedIn()){
				$this->redirect('professeurs/connexion'); 
			}

			$user_id = $_SESSION['user_id'] !== 'Undefined' ? $_SESSION['user_id'] : NULL;

			if($user_id){
				$stmt = $this->db->prepare("SELECT * FROM `verifications` WHERE `user_id` = :user_id ORDER BY `createdAt` DESC");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_OBJ);
				$files = array('verification');


				$user_ids = $_SESSION['user_id'];
				$users    = $this->userData($user_ids);

				if(!empty($user)){
					if($user->status === '0' && !in_array(basename($_SERVER['PATH_INFO']), $files)){
						$this->redirect('professeurs/verification');
					}
	
					if($user->status === '1' && in_array(basename($_SERVER['PATH_INFO']), $files)){

						$_SESSION['LoginMSg'] = 'Hello cher <strong>'.ucfirst($users->firstName).' '. ucfirst($users->lastName).'</strong> nous sommes content de vous voir parmi nous. Merci pour votre inscription';
						$_SESSION['LoginMSgStartTime'] = date('d-m-Y H:i:s');
						$_SESSION['LoginMSgTitle'] = 'Inscription Reussie';

						$this->redirect('professeurs');
					}
				}else if (!in_array(basename($_SERVER['PATH_INFO']), $files)){
					$this->redirect('professeurs/verification');
				}
			}

		}

		public function auths(){

			$user_id  = $_SESSION['User']->id;

			if(!empty($user_id)){ 
				$stmt = $this->db->prepare("SELECT * FROM `verifications` WHERE `id` = :user_id ORDER BY `createdAt` DESC");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_OBJ);
		
				$files = array('verification');
		
				if(!empty($user)){
					if($user->status === '0' && !in_array(basename($_SERVER['PATH_INFO']), $files)){
						$this->redirect('office/verification');
					}
		
					if($user->status === '1' && in_array(basename($_SERVER['PATH_INFO']), $files)){

						$this->redirect(ADMIN_HOOK);
					}
				}else if (!in_array(basename($_SERVER['PATH_INFO']), $files)){
					$this->redirect('office/verification');
				}
			}
		}

        public function mastersAuthOnly(){

			$user_id  = $_SESSION['User']->id;
			$users    = $this->mastersUserData($user_id);

			if($user_id){
				$stmt = $this->db->prepare("SELECT * FROM `verifications` WHERE `id` = :user_id ORDER BY `createdAt` DESC");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_OBJ);

				$files = array('verification');


				if(!empty($user)){
					if($user->status === '0' && !in_array(basename($_SERVER['PATH_INFO']), $files)){
						$this->redirect('office/verification');
					}
	
					if($user->status === '1' && in_array(basename($_SERVER['PATH_INFO']), $files)){

						$_SESSION['LoginMSg'] = 'Hello cher <strong>'.ucfirst($users->firstName).' '. ucfirst($users->lastName).'</strong> nous sommes content de vous voir parmi nous. Merci pour votre inscription';
						$_SESSION['LoginMSgStartTime'] = date('d-m-Y H:i:s');
						$_SESSION['LoginMSgTitle'] = 'Inscription Reussie';

						$this->redirect(ADMIN_HOOK);
					}
				}else if (!in_array(basename($_SERVER['PATH_INFO']), $files)){
					$this->redirect('office/verification');
				}
			}

		}

		public function verifyMastersAuthOnly(){

			$user_id  = $_SESSION['User']->id;
			$users    = $this->mastersUserData($user_id);

			if($user_id){
				$stmt = $this->db->prepare("SELECT * FROM `verifications` WHERE `id` = :user_id ORDER BY `createdAt` DESC");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_OBJ);

				if(!empty($user)){
					if($user->status === '1'){
						$this->redirect(ADMIN_HOOK);
						return true;
					}
				}
			}else{
				$this->redirect('office/connexion');

			}

		}

		public function ccookie(){

			if(isset($_COOKIE['remember']) && !isset($_SESSION['user_id']) ){

				$remember_token = $_COOKIE['remember'];
				$parts = explode('//', $remember_token);
				$user_id = $parts[0];

				$req = $this->db->prepare("SELECT * FROM profils WHERE user_id = ?");
				$req->execute([$user_id]);
				$user = $req->fetch(PDO::FETCH_OBJ);

				if($user){
					$expected = $user_id . '//' . $user->remember_token . sha1($user_id . 'lifeSchedioLeger');
					if($expected == $remember_token){
						$_SESSION['user_id'] = $user->user_id;
						setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
						$this->user->redirect('profils');

					} else{
						setcookie('remember', null, -1);
					}
				}else{
					setcookie('remember', null, -1);
				}
			}
		}

        public function sendToMail($email, $message, $subject){
			$mail  = new PHPMailer\PHPMailer\PHPMailer(true);
			$mail->isHTML();
			$mail->isSMTP();
			$mail->SMTPAuth   = true;
			$mail->SMTPDebug  = 0;
			$mail->Host       = M_HOST;
			$mail->Username   = M_USERNAME;
			$mail->Password   = M_PASSWORD;
			$mail->SMTPSecure = M_SMTPSECURE;
			$mail->Port       = M_PORT;

			if(!empty($email)){
				$mail->From     = APP_MAIL;
				$mail->FromName = APP_NAMES;
				$mail->addReplyTo(APP_MAIL);
				$mail->addAddress($email);

				$mail->Subject = $subject;
				$mail->Body    = $message;
				$mail->AltBody = $message;

				if(!$mail->send()){
					return false;
				}else{
					return true;
				}
			}
		}

		public function sendemail($to, $from, $fromName, $body, $attachement) {
			
			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			$mail->isHTML();
			$mail->isSMTP();
			$mail->SMTPAuth   = true;
			$mail->SMTPDebug  = 0;
			$mail->Host       = M_HOST;
			$mail->Username   = M_USERNAME;
			$mail->Password   = M_PASSWORD;
			$mail->SMTPSecure = M_SMTPSECURE;
			$mail->Port       = M_PORT;

			$mail->setFrom($from, $fromName);
			$mail->addAddress($to);
			$mail->addAttachment($attachement);
			$mail->Subject = 'DEVIS LIFESCHEDIO';
			$mail->Body = $body;


			if(!$mail->send()){
				return false;
			}else{
				unlink($attachement);
				return true;
			}
			// return $mail->send();
		}

		public function sendemailw($to, $from, $fromName, $body) {
			
			$mail = new PHPMailer\PHPMailer\PHPMailer(true);
			$mail->isHTML();
			$mail->isSMTP();
			$mail->SMTPAuth   = true;
			$mail->SMTPDebug  = 0;
			$mail->Host       = M_HOST;
			$mail->Username   = M_USERNAME;
			$mail->Password   = M_PASSWORD;
			$mail->SMTPSecure = M_SMTPSECURE;
			$mail->Port       = M_PORT;

			$mail->setFrom($from, $fromName);
			$mail->addAddress($to);
			$mail->Subject = 'DEVIS LIFESCHEDIO';
			$mail->Body = $body;

			return $mail->send();
		}

        public function sendToPhone($number, $message){
			$username = "api_email_adresse@dommain.com";
			$apiHash  = "9c2894c1761f234c8ef9cbdc82654823309054e93050591cfa9b00f9e448637f";
			$apiUrl   = "https://api.txtlocal.com/send/";
			$test     = '0';
			$data     = "username={$username}&hash={$apiHash}&message={$message}&numbers={$number}&test={$test}";

			if(!empty($number)){
				$ch = curl_init($apiUrl);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$respone = curl_exec($ch);

				$result = json_decode($respone);

                //var_dump($respone);
                debug($respone);

				if($result->status === 'success'){
					return true;
				}else{
					return false;
				}
			}
		}
    }