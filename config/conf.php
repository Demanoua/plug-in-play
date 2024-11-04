<?php
class Conf{
	
	public static $debug = 1; 

	public static $databases = array(

		// LOCAL
		'default' => array(
			'host'		=> 'localhost',
			'database'	=> 'arrivagekdo',
			'login'		=> 'root',
			'password'	=> 'r_root'
		)
		
		// PRODUCTION
		// 'default' => array(
		// 	'host'		=> 'sql211.infinityfree.com',
		// 	'database'	=> 'if0_35305429_youth',
		// 	'login'		=> 'if0_35305429',
		// 	'password'	=> 'Ipi4D6b7KXN0mHP'
		// )
	);
}
setlocale(LC_TIME, 'fr_FR');
// setlocale(LC_TIME, 'fr_FR.UTF-8');

ini_set('display_errors', '1');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define("CURRENCY", "frs");
define("JWT_TOKEN", "SKJKJJSKSJHFUUQNDHDNQJSPAZIDNVDH§Seeksl");

define("APP_NAME", "Tepmplate Plug-in play");
define("MY_HOST", $_SERVER['HTTP_HOST']);
define("APP_NAMES", "Tepmplate Plug-in play");
define("APP_MAIL", "");
define("APP_CONTACT", ""); 
define("APP_NAME_YEARS", date('Y'));
define("DESCRIPTION_OPEN", "...");
define("DESCRIPTION_WEB", "");

// ERROR HANDLER
define("APP_ERROR_TITLE", "La page que vous rechercher est introuvable");
define("APP_ERROR_MSG", "Soyez sur que l'addresse que vous avez saisir est correct et quelle n'a pas été supprimer. Si vous pensez que c'est dur à une erreur, SVP veuillez <a href='mailto:".APP_MAIL."'>nous contacter</a>");


// EMAIL HANDLER
define("APP_ADDRESSE", "");
define("BASE_URLs", Router::url());
define("APP_SUPPORT_LINK", Router::url());
define("APP_TERMES_LINK", Router::url());
define("LOGO_LINK", Router::webroot('assets/areas/img/icons/spot-illustrations/corner-3.png'));
define("LOGO_LINKs", Router::webroot('assets/img/illustrations/falcon.png'));
define("BARNNER_LINK", Router::webroot('assets/img/generic/about.jpg'));
define("BARNNER_COURS", Router::webroot('assets/img/banners/banner.jpg'));
define("BARNNER_COURSES", Router::webroot('assets/img/generic/blog-3.jpg'));
define("ASK_ICON", Router::webroot('assets/img/generic/signe-de-question.png'));

define("APP_NAME_LLC", APP_NAME.' ONG');
define("ACCOUNT_VERIFY_EMAIL", file_get_contents(ROOT.DS.'view'.DS.'layouts'.DS.'mails'.DS.'e-mail_confirmation.html'));
define("ACCOUNT_VERIFY_FORGET", file_get_contents(ROOT.DS.'view'.DS.'layouts'.DS.'mails'.DS.'e-mail_forget_paswd.html'));
define("WELCOME_MAIL", file_get_contents(ROOT.DS.'view'.DS.'layouts'.DS.'mails'.DS.'Welcome_Mail.html'));


define("EMAIL_PASSWORD_FORGET_ADMIN", file_get_contents(ROOT.DS.'view'.DS.'layouts'.DS.'mails'.DS.'admin_password_forget.html'));
define("DELAY_EMAIL_EXPIRE_TIME", 300);				// 5 minutes	
define("DELAY_DONATE_CONGRAT_EXPIRE_TIME", 600);	// 10 m	

define("PAY_PER_HOURS", 3000);
define("ADMIN_HOOK", 'dashboard');		
define("COMMUNITY_HOOK", 'community');			

//SMTP
define("M_HOST", 'localhost');					// smtp.gmail.com
define("M_USERNAME", ''); 						// YourEmail@gmail.com
define("M_PASSWORD", '');						// YourEmailPassword
define("M_SMTPSECURE", '');						// ssl
define("M_PORT", "1025");						// 465


define("KKIAPAY_KEY", 'f52e0970a95611ed84eb8bf4616359f3');			
define("KKIAPAY_SANDBOX", true);			
define("KKIAPAY_THEME", 'orange');			
define("KKIAPAY_POSITION", 'center');			


// HOOKS
Router::prefix(ADMIN_HOOK,'admin');
Router::prefix(COMMUNITY_HOOK,'comm');

Router::connect('','home');
Router::connect('home/*','home/*');

// ADMIN URL
Router::connect(ADMIN_HOOK, ADMIN_HOOK.'/youthadmin');
Router::connect(ADMIN_HOOK.'/shop/products', ADMIN_HOOK.'/youthadmin/products');
Router::connect(ADMIN_HOOK.'/shop/orders', ADMIN_HOOK.'/youthadmin/orders');
Router::connect(ADMIN_HOOK.'/shop/categories', ADMIN_HOOK.'/youthadmin/categories');
Router::connect(ADMIN_HOOK.'/*', ADMIN_HOOK.'/youthadmin/*');

// CUMMUNAUTY URL
Router::connect(COMMUNITY_HOOK, COMMUNITY_HOOK.'/communityy'); 
Router::connect(COMMUNITY_HOOK.'/*', COMMUNITY_HOOK.'/communityy/*'); 

// PAGES URL
Router::connect('youth-exit-academy', 'pages/youth_exit');
Router::connect('blog/:id-:slug','pages/youth_blog_post/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('boutique/categories/:slug','boutique/categories/slug:([a-z0-9\-]+)');
Router::connect('boutique/produits/:slug','boutique/produits/slug:([a-z0-9\-]+)');