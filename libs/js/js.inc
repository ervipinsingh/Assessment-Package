<?php 
class msJsCommon
 { 	  	  
 function getMsCommonJquery()
	{
	 $libJs = HTTP_SERVER.JS_FOLDER.BROWSER_SEPERATOR.'jquery.js';				
   ?>
		<script type="text/javascript" src="<?php echo $libJs; ?>"></script>
<?php	  
 		 }
function getTestJs()
{

$libJs = HTTP_SERVER.JS_FOLDER.BROWSER_SEPERATOR.'test.js';	
?>
<script type="text/javascript" src="<?php echo $libJs; ?>"></script>

<?php
}  
	  }
?>
