<?php
class Model {

    static $connections = array(); 

    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';
    public $secondlyKey = 'ids';
    public $cartsItems = 'product_id';
    public $id;
    public $errors = array();
    public $form;
	public $validate = array();

	/**
	* Permet d'initialiser les variable du Model
	**/
    public function __construct() {
        	// Nom de la table
         // j'initilise qques varables
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

	/**
	* Permet de récupérer plusieurs enregistrements
	* @param $req Tableau contenant les éléments de la requête
	**/
    public function find($req = array()) {
            $sql = 'SELECT ';
    
            if(isset($req['fields'])){
                if(is_array($req['fields'])){
                    $sql .= implode(', ',$req['fields']);
                }else{
                    $sql .= $req['fields']; 
                }
            }else{
                $sql.='*';
            }
    
            $sql .= ' FROM '.$this->table.' as '.get_class($this).' ';


			// Liaison
		if(isset($req['join'])){
			foreach($req['join'] as $k=>$v){
				$sql .= 'LEFT JOIN '.$k.' ON '.$v.' '; 
			}
		}

        // Construction de la condition
        if(isset($req['conditions'])){
            $sql .= 'WHERE ';
            if(!is_array($req['conditions'])){
                $sql .= $req['conditions'];
            }else{
                $cond = array(); 
                foreach($req['conditions'] as $k=>$v){
                    if(!is_numeric($v)){
						//$v = "'".$this->db->quote($v)."'"; 
                        $v = '"'.strip_tags($v).'"';
						// $v = '"'.$this->db->quote($v).'"';
						// die($v);
                        // $v = '"'.addslashes($v).'"';
                       //$v = '"'.mysql_escape_string($v).'"';  
					}
                    $cond[] = "$k=$v";
				}
                $sql .= implode(' AND ',$cond);
            }
        }

        if(isset($req['order'])){
			$sql .= ' ORDER BY '.$req['order'];
		}


		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}

        // die($sql);
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }


	/**
	* Alias permettant de retrouver le premier enregistrement
	**/
    public function findFirst($req){
        return current($this->find($req));
    }


    /**
	* Récupère le nombre d'enregistrement
	**/
	public function findCount($conditions){
		$res = $this->findFirst(array(
			'fields' => 'COUNT('.$this->primaryKey.') as count',
			'conditions' => $conditions
			));
		return $res->count;  
	}

	public function countCart($conditions){
		$res = $this->findFirst(array(
			'fields' => 'COUNT(*) as count',
			'conditions' => $conditions
			));
		return $res->count;  
	}

	public function findAllCount($cl,$conditions){
		$res = $this->findFirst(array(
			'fields' => 'COUNT('.$cl.') as count',
			'conditions' => $conditions
			));
		return $res->count;  
	}
	public function findAllTotal($cl){
		$res = $this->findFirst(array(
			'fields' => 'COUNT('.$cl.') as count',
			));
		return $res->count;  
	}
	public function findAllTotalSum($cl){
		$res = $this->findFirst(array(
			'fields' => 'SUM('.$cl.') as count',
			));
		return $res->count;  
	}
	/**
	* Permet de récupérer un tableau indexé par primaryKey et avec name pour valeur
	**/
	function findList($req = array()){
		if(!isset($req['fields'])){
			$req['fields'] = $this->primaryKey.',name';
		}
		$d = $this->find($req); 
		$r = array(); 
		foreach($d as $k=>$v){
			$r[current($v)] = next($v); 
		}
		return $r; 
	}
    /**
	* Permet de supprimer un enregistrement
	* @param $id ID de l'enregistrement à supprimer
	**/	
	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->db->query($sql); 
	}

	    /**
	* Permet de supprimer un enregistrement
	* @param $id ID de l'enregistrement à supprimer
	**/	
	public function deletely($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->cartsItems} = $id";
		$this->db->query($sql); 
	}

    /**
	* Permet de sauvegarder des données
	* @param $data Données à enregistrer
	**/
	public function save($data){
        $key = $this->primaryKey;
        $fields =  array();
        $d = array();
        foreach($data as $k=>$v){
			if($k!=$this->primaryKey){
				$fields[] = "$k=:$k";
				$d[":$k"] = $v; 
			}elseif(!empty($v)){
				$d[":$k"] = $v; 
			}
		}        
        if(isset($data->$key) && !empty($data->$key)){
			$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key; 
			$action = 'update';
        }else{
			$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$action = 'insert'; 
		}
        $pre = $this->db->prepare($sql); 
		$pre->execute($d);
        if($action == 'insert'){
			$this->id = $this->db->lastInsertId(); 
		}
    
    }


	// Request for Customers

    /**
	* Récupère l'id d'utilisateur
	**/
	public function findId($user_id){
		$res = $this->findList(array(
			'fields' => 'email',
			'conditions' => $user_id
			));
		return $res;
		
		debug($res);
		die();
	}

	/**
	* Récupère l'id d'utilisateur
	**/
	public function findIds($conditions){
		$res = $this->findFirst(array(
			'fields' => 'user_id',
			'conditions' => $conditions
			));
		return $res;
		
		debug($res);
		die();
	}

}