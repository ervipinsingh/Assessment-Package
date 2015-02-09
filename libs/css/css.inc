<?php
 /*CSS Library Class File:::13-Feb-2012*/
 class msFavIcon
   { 
     function getFeviconIcon()
	   { 
	     $favIcon = IMAGEPATH.'favicon.ico';	
	    ?>
        <meta http-equiv="X-UA-Compatible" content="IE=9, IE=8, IE=7, IE=EDGE" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favIcon?>" />		 
		<?php  
	   }	   
   }
 class msCommon extends msFavIcon
   { 	  	 	
     function getMsCommonCss() 
	    { 	
		 $this->getFeviconIcon();		
		# $master = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'mslms.css';
		 $stylemain = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'style.css';	 
		?>          
		<link href="<?php echo $stylemain;?>" type="text/css" rel="stylesheet" />		
	<?php  }
     public function getMsMenuCss() 
	    { 
		$contact = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'contact.css';
		$dcverticalmegamenu = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'dcverticalmegamenu.css';	 
		?>          
		<link href="<?php echo $contact;?>" type="text/css" rel="stylesheet" />
		<link href="<?php echo $dcverticalmegamenu;?>" type="text/css" rel="stylesheet" /> 
	<?php  }
     function getMsLoginCss() 
	    { 	
		$logincss = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'logincss.css';	 
		?>          
		<link href="<?php echo $logincss;?>" type="text/css" rel="stylesheet" /> 
	<?php  }	
     function getMsSliderCss() 
	    { 	
		$slider = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'slider.css';	 
		?>          
		<link href="<?php echo $slider;?>" type="text/css" rel="stylesheet" /> 
	<?php  }	
      function getMsTabContentCss() 
	    { 	
		$tabcontent = HTTP_SERVER.BROWSER_SEPERATOR.CSS_FOLDER.BROWSER_SEPERATOR.'tabcontent.css';	 
		?>          
		<link href="<?php echo $tabcontent;?>" type="text/css" rel="stylesheet" /> 
	<?php  }				
	
   } #Class Closing
          
?>
