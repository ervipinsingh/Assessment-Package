<?php 
if($_SESSION['PB_USER_LOGIN']=="")
 { 
	echo "<script type='text/javascript'>window.location.href='index.php?ms=user_login'</script>"; 
	exit; 
 }
 ?>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<script type="text/javascript">

function closeMe()
  {
       parent.parent.GB_hide();
  }

</script>
<body id="home">
<?php 
 //   print_r($_GET); 
	//exit;	
	$objPbAss = new public_ass();
	$ass_id=$_GET['ass_id'];
	$assdata=$objPbAss->getAsssessmentDetails($ass_id,$mysqli);
	$pb_user_id=$_SESSION['PB_USER_LOGIN'];
	$catDstnData=$objPbAss->getNoOfCatAss($ass_id,$mysqli);
	$pb_as_atmid=$_GET['ass_atmt_id'];
	
	
	//print_r($catDstnData);
//	$mode = next($catDstnData);  
	//echo $mode['qst_cat_id'];
	//echo "<br >";
	//$mode = next($catDstnData);  
	//echo $mode['qst_cat_id'];
	//echo "<br >";
	//$mode = next($catDstnData);  
	//echo $mode['qst_cat_id'].'this is end';
	/*$alreadyUsedCat = array( [0] => array ( ['qst_cat_id'] => 4 ) [1] => array( ['qst_cat_id'] => 3 )  ) ;
	$result = array_diff($catDstnData, $alreadyUsedCat);
	print_r($result);*/
?>
<div class="section">
  <div id="features_Assessment">
    <form name="form1" id="form1" method="post" action="<?php echo HTTP_SERVER?>index.php?ms=test_atmt_cat" onsubmit="return validateCheck();" >
      <div class="row">
        <div class="uiHeadpage"> </div>
        <div id="error_msg" class="alert-box error_cat" style="display:none;"><span>error: </span>Please Select Category.</div>
        <div class="carousel_Assessment border-radius4 box-shadow cat_minHeight">
          <div class="Assessment-details-row pls_M">
            <div class="assess_instruction">
              <div class="AdvanceTest">Scholarship Test consist of <?php echo count($catDstnData); ?> sections</div>
              <div class="test_Assessment">
                <div class="testListing_sec">
                  <div id="atAnswers">
                    <?php //echo $assdata[0]['ass_instruct']; 
	$atmtCatData=$objPbAss->getAttemptedCat($pb_as_atmid,$mysqli);
	
foreach($catDstnData as $val)
{

if(in_array($val, $atmtCatData))
	{
	  	$displaydiv="activeBG";
		$displaylev="actived";
		$disable="disabled='disabled'";
	
	} else {

		$displaydiv="";
		$displaylev="";
		$disable='';
}
//echo $display;

?>
                    <div data-i="1" class="item dot">
                      <div class="">
                        <div class="inner <?php echo $displaydiv; ?>">
                          <input type="radio" name="qstCatId" id="radio<?php echo $val['qst_cat_id']; ?>" class="css-checkbox" value="<?php echo $val['qst_cat_id']; ?>" <?php echo $disable; ?>  />
                          <label for="radio<?php echo $val['qst_cat_id']; ?>" class="css-label <?php echo $displaylev; ?>"><?php echo $objPbAss->getCatNameByCatId($val['qst_cat_id'],$mysqli); ?> (<?php echo $objPbAss->getAssQstnByCatId($ass_id,$val['qst_cat_id'],$mysqli); ?>)</label>
                        </div>
                      </div>
                    </div>
                    <?php

} 
?>
                  </div>
                </div>
                <div class="clear"></div>
                <p>Each sections contains multiple choice questions with minimum 4 options, and 1 or more are corrects. After the completion of test, user can see the detailed report and can print the certificate too.</p>
              </div>
            </div>
          </div>
        </div>
        <div>
          <input type="hidden" name="ass_id" value="<?php echo $ass_id; ?>"  />
          <input type="hidden" name="user_id" value="<?php echo $pb_user_id; ?>"  />
          <input type="hidden" name="ass_atmt_id" value="<?php echo $pb_as_atmid; ?>"  />
          <!--onclick="window.location.href='<?php echo HTTP_SERVER?>index.php?ms=test_atmt_cat&ass_id=<?php echo $ass_id; ?>&user_id=<?php echo $pb_user_id; ?>'"-->
          <input type="submit" value="Proceed" class="button medium-buttonAssess Blue tms" >
		  <input type="button" value="Cancel" onclick="closeMe();" class="button medium-buttonAssess red tms" >
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<div class="clear"></div>
<script type="text/javascript">

function validateCheck()
 {
	
if($('input[name=qstCatId]:checked').length<=0)
{
    $('#error_msg').show();
// alert("No radio checked")
return false;
} 
else {

	document.getElementById('form1').submit();

}
  
 }

</script>
<!-- Footer Sec start -->
<?php //include_once(DIR_MS_INCLUDES.FILENAME_FOOTER_MAIN);?>
<!-- Footer Sec end -->
</div>
</body>
</html>
