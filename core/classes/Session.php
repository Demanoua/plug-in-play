<?php 
class Session{
	
	public function __construct(){
		if(!isset($_SESSION)){
			session_start(); 
		}

	}
	
    public function setFlash($message,$type = 'success'){
		$_SESSION['flash'] = array(
			'message' => $message,
			'type'	=> $type
		); 
	}

	
	public function flash(){
		if(isset($_SESSION['flash']['message'])){
			$html = '<div class="btn success '.$_SESSION['flash']['type'].'"><p>'.$_SESSION['flash']['message'].'</p></div>'; 

			$html2 = '<div class="d-flex">
			<div class="toast show align-items-center text-white bg-'.$_SESSION['flash']['type'].' border-0" role="alert" data-bs-autohide="false" aria-live="assertive" aria-atomic="true">
			  <div class="d-flex">
				<div class="toast-body">
				'.$_SESSION['flash']['message'].'
				</div>
				<button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			</div>
		  </div>';
			$_SESSION['flash'] = array(); 
			return $html2; 
		}
	}

	


	public function write($key,$value){
		$_SESSION[$key] = $value;
	}

	public function read($key = null){
		if($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key]; 
			}else{
				return false; 
			}
		}else{
			return $_SESSION;
		}
	}

	public function isLogged(){
		return isset($_SESSION['User']->role);
	}

	public function user($key){
		if($this->read('User')){
			if(isset($this->read('User')->$key)){
				return $this->read('User')->$key; 
			} else{
				return false;
			}
		}
		return false;
	}

	public function users($key){
		if($this->read('user_id')){
			if(isset($this->read('user_id')->$key)){
				return $this->read('user_id')->$key; 
			} else{
				return false;
			}
		}
		return false;
	}

}