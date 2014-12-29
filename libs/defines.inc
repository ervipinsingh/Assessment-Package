<?php	
define("HTTP_SERVER","localhost/test/");

define("HTTP_HOST",$_SERVER['HTTP_HOST']);
define("DIR_PERM",octdec("0755"));	
 #define('FPATH_BASE', dirname(__FILE__) );	   	 
define("BROWSER_SEPERATOR","/");
define('ROOTDOCUMENT', $_SERVER['DOCUMENT_ROOT']); 
define('PROJECTNAME','/test'); 	 		 
define("START_YEAR",1971);
define("LIBRARIES","libs"); 
define('MODULES','ms_module');	
define("COURSES_PUB_DIR","course/");
define("CSS_FOLDER","css");
define("JS_FOLDER","js");
define("CLIENT_DIRECTORY","client_folder");

define("USER_DIRECTORY","user_folder");
 
define('SPATH_BASE',$_SERVER['DOCUMENT_ROOT'].PROJECTNAME); 	
define("JSPATH",SPATH_BASE.BROWSER_SEPERATOR."js"); 
define("STYLEPATH",SPATH_BASE.BROWSER_SEPERATOR."css/");
define('DIR_MS_INCLUDES',SPATH_BASE.BROWSER_SEPERATOR.'include/');
define('PLUGIN_FOLDER','plugins');
define('DIR_WS_APP_HOME',SPATH_BASE.BROWSER_SEPERATOR.'site_pages/');	
define("IMAGEPATH", HTTP_SERVER.BROWSER_SEPERATOR."images/");
define('DIR_MS_SITE_HOME',SPATH_BASE.BROWSER_SEPERATOR.'site_pages'.BROWSER_SEPERATOR);
define('DIR_MS_IMAGE_CAPTCHA',SPATH_BASE.BROWSER_SEPERATOR.PLUGIN_FOLDER.BROWSER_SEPERATOR.'captcha'.BROWSER_SEPERATOR);
define('CROCO_KEY_WORKING',false);
?>
