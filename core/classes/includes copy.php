<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

	include 'functions.php';
	include 'classes/PHPMailer.php';	
	include 'classes/SMTP.php';	
	include 'classes/Exception.php';
	//add your local time zone below	
	date_default_timezone_set('Asia/Karachi');
   	//autoload
	spl_autoload_register(function($class){
		require_once "classes/{$class}.php";
	});

require 'Session.php';
require 'functions.php'; 
require 'Router.php';

require ROOT.DS.'config'.DS.'conf.php'; 

require 'Request.php';
require 'Controller.php';
require 'Model.php';
require 'Dispatcher.php';


require 'Users.php';
require 'Verify.php';
require 'Validate.php';