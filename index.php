<?php
 session_start();	
 ini_set('memory_limit', '128M');
 ob_start('ob_gzhandler');  
 define('FPATH_BASE', dirname(__FILE__) );  
 define('DS', DIRECTORY_SEPARATOR );
 require_once (FPATH_BASE.'/libs/all_libs.php');  
 $siteEntry = new accessPage();
 #Default Time Zone Set
 date_default_timezone_set("Asia/Calcutta");
 date_default_timezone_get();
 @$siteEntry->pageAccess($_REQUEST['ap']); 	
?>
