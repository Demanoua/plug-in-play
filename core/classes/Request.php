<?php
class Request{

    public $url;           		// URL appelé par l'utilisateur
	public $prefix = false; 	// Prefixage des urls /prefix/url
	public $data = false; 		// Données envoyé dans le formulaire
	public $dataq = false; 		// Données envoyé dans la query
	public $controller;
	public $action;
	public $params;
	public $mail;
	public $verify;

    function __construct() {
		$this->url = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';

		// Si des données sont passé en paramettre ont les entre dans dataq
		if(!empty($_GET)){
			$this->dataq = new stdClass(); 
			foreach($_GET as $k=>$v){
				$this->dataq->$k=$v;
			}
		}

        // Si on a une mail dans l'url on la rentre dans $this->mail
		if(isset($_GET['mail'])){
			$this->mail = $_GET['mail']; 
		}

		// Si on a une verify dans l'url on la rentre dans $this->verify
		if(isset($_GET['verify'])){
			$this->verify = $_GET['verify'];
		}


		// Si des données ont été postées ont les entre dans data
		if(!empty($_POST)){
			$this->data = new stdClass(); 
			foreach($_POST as $k=>$v){
				$this->data->$k=$v;
			}
		}
		
    }
}