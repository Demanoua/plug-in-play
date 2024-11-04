<?php
$debut = microtime(true); 
// Donne moi l'url du FICHIER
define('WEBROOT',dirname(__FILE__)); 

define('ROOT',dirname(WEBROOT));

define('DS',DIRECTORY_SEPARATOR);

define('CORE',ROOT.DS.'core'); 

// L'url Racine
// define('BASE_URL','http://localhost');
define("BASE_URL", ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? 'http://localhost' : '');
// define('BASE_URL',(dirname($_SERVER['SCRIPT_NAME'])));

date_default_timezone_set('Africa/Abidjan'); 

require CORE.DS.'includes.php'; 
// debugDie(http_response_code());

new Dispatcher(); 
// error_log(date("Y/m/d H:i:s") . ' METHODE / VERB : ' . $_SERVER['REQUEST_METHOD'] . PHP_EOL . PHP_EOL, 3, "log.log");
?>
<div style="position:fixed;bottom:0; background:#900; color:#FFF; line-height:30px; height:30px; left:0; right:0; padding-left:10px; ">
<?php 
echo 'Page générée en '. round(microtime(true) - $debut,5).' secondes'; 
?>
</div>