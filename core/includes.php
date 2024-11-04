<?php

include 'functions.php';
include 'classes/PHPMailer.php';	
include 'classes/SMTP.php';	
include 'classes/Exception.php';

//autoload
spl_autoload_register(function($class){
    require_once "classes/{$class}.php";
});

require ROOT.DS.'config'.DS.'conf.php'; 