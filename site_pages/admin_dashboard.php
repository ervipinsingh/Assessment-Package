<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SRV Learning Test Screen</title>
<?php 
 $objCss=new msCommon();
 echo $objCss->getMsCommonCss();
 $objCommon=new common_function();
 $mysqli=$objCommon->getConnectMe();
 ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
	$.noConflict();
    var GB_ROOT_DIR = "plugins/greybox/";
</script>
<script type="text/javascript" src="plugins/greybox/AJS.js"></script>
<script type="text/javascript" src="plugins/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="plugins/greybox/gb_scripts.js"></script>
<link href="plugins/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">
	GB_PShow = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 1000,
        width: width || 1000,
        fullscreen: true,
        show_loading: false,
        callback_fn: callback_fn
    }
    var win = new GB_Window(options);
    return win.show(url);
}
function closeMe()
  {
       parent.parent.GB_hide();
  }
</script>
<body id="home">
<?php
	$objPbAss = new public_ass();
	$pb_user_id= $_SESSION['PB_USER_LOGIN'];
	$analysData=$objPbAss->getTestAnalysis($pb_user_id,$mysqli);
	$userData=$objPbAss->getPublicUserDetails($pb_user_id,$mysqli);
//print_r($analysData);
 ?>
<div class="section">
  <div class="HeaderHeight HeaderHeightinner">
    <?php include_once(DIR_MS_INCLUDES.FILENAME_HEADER_MAIN);?>
  </div>
  <div id="features_Assessment">
  
    <div class="row">
	<div class="uiHeadpage">
        <h3><span class="propercase">Welcome, <?php echo $userData[0]['pb_first_name'].'&nbsp;'.$userData[0]['pb_last_name']; ?> </span><span class="lowercase"> (<?php echo $userData[0]['pb_user_email']; ?>)</span></h3>
      </div>
	<?php  include(DIR_MS_INCLUDES.FILENAME_LEFT_NAV); ?>

	<div class="containershadow maincontainer">
      
      <div class="myacc_text">Your Assessment</div>
      <div class="form_container formtopgap">
        <?php for($i=0; $i<count($analysData); $i++) {  ?>
        <div class="assess_lsiting">
          <div class="uiButton assess_test"><span><strong><?php echo ($i+1); ?>. </strong></span><?php echo $analysData[$i]['ass_title']; ?></div>
		   <div class="uiButton assess_test"><?php echo $analysData[$i]['pb_attempt_on']; ?></div>
          <div class="uiButton">
		  
            <div class="read_more"><a href="javascript:void(0);" onclick="return GB_PShow('<?php echo $analysData[$i]['ass_title']; ?>','<?php echo HTTP_SERVER?>index.php?ms=test_report&courseid=<?php echo $analysData[$i]['course_id']; ?>&ass_id=<?php echo $analysData[$i]['ass_id']; ?>&user_id=<?php echo $pb_user_id;?>&ass_atmt_id=<?php echo $analysData[$i]['pb_as_atmid']; ?>');" >View Report</a></div>
			
			<div class="read_more"><a href="javascript:void(0);" onclick="return GB_PShow('<?php echo $analysData[$i]['ass_title']; ?>','<?php echo HTTP_SERVER?>index.php?ms=user_details_more&courseid=<?php echo $analysData[$i]['course_id']; ?>&ass_id=<?php echo $analysData[$i]['ass_id']; ?>&user_id=<?php echo $pb_user_id;?>&ass_atmt_id=<?php echo $analysData[$i]['pb_as_atmid']; ?>');">Claim Your Scholarship</a></div>
			
           <div class="read_more"><a href="javascript:void(0);" onclick="window.open('<?php echo HTTP_SERVER?>index.php?ms=test_certificate&courseid=<?php echo $analysData[$i]['course_id']; ?>&ass_id=<?php echo $analysData[$i]['ass_id']; ?>&user_id=<?php echo $pb_user_id;?>&ass_atmt_id=<?php echo $analysData[$i]['pb_as_atmid']; ?>','','')">Print Certificate</a></div>
	
          </div>
        </div>
        <?php } ?>
         </div>
    </div>
  </div>
	 </div>
  <div class="clear"></div>
  <!-- Footer Sec start -->
  <?php include_once(DIR_MS_INCLUDES.FILENAME_FOOTER_MAIN);?>
  <!-- Footer Sec end -->
</div>
</body>
</html>
