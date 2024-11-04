<?php
/**
* Dispatcher
* Permet de charger le controller en fonction de la requête utilisateur
**/
class Dispatcher{

    var $request; // Object Reques
    private $arraysPulic = ['assets','public'];      // Variables à passer à la vue

    /**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	**/
    function __construct() {
        $this->request = new Request();
        Router::parse($this->request->url,$this->request); // interprete et parse l'url reçu
        $controller = $this->loadController(); // initalise le controller selon la requette utilisateur
        $action = $this->request->action;
		if($this->request->prefix){
			$action = $this->request->prefix.'_'.$action;
		}

		$arrayUrlRequest = explode('/',$_SERVER['REQUEST_URI']);
		if(in_array($arrayUrlRequest[1], $this->arraysPulic)){
			$this->error403();
		}


        if(!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {

           // $this->error('Le controller '.$this->request->controller.' n\'a pas de methode '.$action);
		   $this->error();
			// $this->error('<strong>404 ERROR</strong><br>
			// We couldn’t find the page you were looking for<br>
			// The page details you entered may be incorrect or the page was removed.');
        }
        call_user_func_array(array($controller,$action),$this->request->params);
        $controller->render($action);
    }

    /**
	* Permet de générer une page d'erreur en cas de problème au niveau du routing (page inexistante)
	**/
    function error($message=null) {
        $controller = new Controller($this->request);
        $controller->e404($message);
    }
    
	/**
	* Permet de générer une page d'erreur 403
	**/
    function error403($message=null) {
        $controller = new Controller($this->request);
        $controller->e403($message);
    }
    
    /**
	* Permet de charger le controller en fonction de la requête utilisateur
	**/
	function loadController(){
		$name = ucfirst($this->request->controller).'Controller'; // CLASS+Controller
		$file = ROOT.DS.'controller'.DS.$name.'.php'; // Inclure le Controller
		if(!file_exists($file)){
			$this->error('Erreur'); 
		} 
		require $file; // inclure le fichier
		$controller = new $name($this->request); // Stocker l'instance
		return $controller;  
	}
}