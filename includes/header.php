<div id="header">
        <div class="row">
            <div id="menu-bar">
            	<div class="logo left">
    <a href="<?php echo HTTP_SERVER?>" title=""><img src="images/logo.png" alt=""></a>
</div>

<div class="main-nav right">
    <ul class="nav right"> 
	<?php if($_SESSION['PB_USER_LOGIN'])
 { 
	?>
	 <li class="log-out"><a href="<?php echo HTTP_SERVER?>index.php?ms=test_pass&action=logout">Logout</a></li>
	 <?php 
	
 } else { ?>
            <li class="sign-in"><a href="<?php echo HTTP_SERVER?>index.php?ms=user_login">Sign In</a></li>
			<?php } ?>
                        
    </ul>
</div>
<div class="clear"></div>

        </div>
		
		
        </div><!-- end .row-->
        </div>
   
