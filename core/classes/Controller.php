<?php
class Controller {

    public $request;                    // Objet Request 
    private $vars       = array();      // Variables à passer à la vue
    public $layout      = 'default';    // Layout à utiliser pour rendre la vue
    private $rendered   = false;        // Si le rendu a été fait ou pas ?

	public $Session;
	public $Users;
	public $Verify;
	public $jwt;
    /**
	* Constructeur
	* @param $request Objet request de notre application
	**/
    function __construct($request = null){
		$this->Session = new Session(); 
		$this->Users = new Users($this); 
		$this->Verify = new Verify($this); 
		$this->jwt = new JWT(); 
        if($request){	
            $this->request = $request;  // On stock la request dans l'instance
			require ROOT.DS.'config'.DS.'hook.php'; 	
		}
    }

    /**
	* Permet de rendre une vue
	* @param $view Fichier à rendre (chemin depuis view ou nom de la vue) 
	**/
    public function render($view) {
        if($this->rendered){return false;}  // Si le rendu a été fait ?
        extract($this->vars);
        if(strpos($view,'/')===0) { // Si il ya un Slash en avant de la chaine $view
            $view = ROOT.DS.'view'.$view.'.php';
        }else {
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        ob_start(); // Si je fais du contenu qui s'affiche tu le Stock
        require($view);
        $CONTENT_FOR_LAYOUT = ob_get_clean(); //  je recupère le contenu ici
        require ROOT.DS.'view'.DS.'layouts'.DS.$this->layout.'.php'; // j'inclus le template
        $this->rendered = true;  // Si le rendu n'a pas été fait?
    }

    /**
	* Permet de passer une ou plusieurs variable à la vue
	* @param $key string de la variable OU tableau de variables
	* @param $value array de la variable
	**/
    public function set($key,$value=null) {
        if(is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }
    }

    /**
	* Permet de charger un model
	**/
	public function loadModel($name){
		if(!isset($this->$name)){
			$file = ROOT.DS.'model'.DS.$name.'.php'; 
			require_once($file);
			$this->$name = new $name();
		}

	}

    /**
	* Permet de gérer les erreurs 404
	**/
	function e404($message){	
		header("HTTP/1.0 404 Not Found");
		$this->set('message',$message); 
		$this->layout = 'e404'; 
		$this->render('/errors/404');
		die();
	}
	/**
	* Permet de gérer les erreurs 403
	**/
	function e403($message){	
		header("HTTP/1.0 403 Forbidden");
		$this->set('message',$message); 
		$this->layout = 'e404'; 
		$this->render('/errors/403');
		die();
	}
	
    /**
	* Permet d'appeller un controller depuis une vue
	**/
	function request($controller,$action){
		$controller .= 'Controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action(); 
	}

    /**
	* Redirect
	**/
	function redirect($url,$code = null){
		if($code == 301){
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".Router::url($url)); 

	}

}