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

</head>
<?php
 	$pb_user_id=$_SESSION['PB_USER_LOGIN'];
	$std_user_id=$_GET['user_id'];
  	$objPbAss = new public_ass();
  	$ass_id=$_GET['ass_id'];
	$ass_atmt_id=$_GET['ass_atmt_id'];
	$assdetaildata=$objPbAss->getAsssessmentDetails($ass_id,$mysqli);
 	$attemeptdQst=$objPbAss->getAttemptAssQst($ass_atmt_id,$mysqli);
	$rightansData=$objPbAss->getRightAssAsn($ass_atmt_id,$ass_id,$mysqli);
	$cntrightAns=$rightansData[0]['right_qstn'];
	$marksobtain=$rightansData[0]['marksobtn'];
	$securedPercent=round(($marksobtain/$assdetaildata[0]['totalmarks']) * 100,2);
	$atmtData=$objPbAss->getAtemptAss($ass_id,$std_user_id,$mysqli);
	//print_r($atmtData);
?>
<body id="home">
<div class="HeaderHeight HeaderHeightinner">
 <?php include_once(DIR_MS_INCLUDES.FILENAME_HEADER_MAIN);?>
  </div>
  <div id="features_Assessment">
  <div class="row">
  <div class="uiHeadpage">
      <h3><span class="propercase">Welcome, Vipin&nbsp;Singh </span><span class="lowercase"> (vipin@gmail.com)</span></h3>
      </div>
	  
  <?php  include(DIR_MS_INCLUDES.FILENAME_LEFT_NAV); ?>
  
<div class="containershadow maincontainer">

  <div class="attempt_Header">
    <div class="thumbcontent_testattempt">
      <h2><?php echo stripslashes($assdetaildata[0]['ass_title']); ?></h2>
    </div>
	  <div class="attempt_Listing">
	  
                <label class="AnalysisAttelmpt"> Analysis</label>
                <select name="Attempt_reports" class="attempt_Listing_SelectBox MarginLeft_SelectBox_reportuser" onChange="return nextAttempt(this.value);" >
                                                      
	  <?php 
			$atp=0;
			$j=count($atmtData);
			while($atmtData[$atp])
			{	
		?>
	  <option value="<?php echo $atmtData[$atp]['pb_as_atmid']; ?>" <?php if($ass_atmt_id==$atmtData[$atp]['pb_as_atmid']) { echo "selected='selected;'";  } ?> >Attempt <?php echo $j; ?> <?php echo $atmtData[$atp]['pb_attempt_on']; ?></option>
	 <?php  
		   $j--;
		   $atp ++;  } ?>
	  
	  </select>
	
				</div>
	
		
    </div>
	
<div id="divInitiator_Report" class="box-shadow">
  <table align="center" border="1" cellpadding="2" cellspacing="5" width="100%" class="lightsapphirebg">
    <tbody>
      <tr>
        <td class="sapphirebg">No of Questions</td>
        <td class="sapphirebg">Attempted Questions</td>
        <td class="sapphirebg">Right Answers</td>
        <td class="sapphirebg">Wrong Answers</td>
        <td class="sapphirebg">Unattempted</td>
        <td class="sapphirebg">Total Marks</td>
        <td class="sapphirebg">Marks Secured</td>
        <td class="sapphirebg">% Secured</td>
      </tr>
      <tr>
        <td class="data_assessment_cell"><?php echo $assdetaildata[0]['totalqst']; ?></td>
        <td class="data_assessment_cell"><?php echo $attemeptdQst; ?></td>
        <td class="data_assessment_cell"><?php echo $cntrightAns; ?></td>
        <td class="data_assessment_cell"><?php echo ($attemeptdQst-$cntrightAns); ?></td>
        <td class="data_assessment_cell"><?php echo ($assdetaildata[0]['totalqst']- $attemeptdQst); ?></td>
        <td class="data_assessment_cell"><?php echo $assdetaildata[0]['totalmarks']; ?></td>
        <td class="data_assessment_cell greencode_assessemt"><?php echo (empty($marksobtain )? 0 : $marksobtain); ?></td>
        <td class="data_assessment_cell greencode_assessemt"><?php echo $securedPercent; ?>%</td>
      </tr>
    </tbody>
  </table>
</div> 
<?php 
	 $assQstAnsData=$objPbAss->getAssQuestionAnsList($ass_atmt_id,$mysqli);  
   // print_r($assQstAnsData);
   //echo count($assQstAnsData);
?>


<div class="sectioninner_viewTest_Height">
<?php 
	if(count($assQstAnsData) >0)
	{
	$qst=0;
	while($assQstAnsData[$qst])
	{

?>

<div class="sectioninner_viewTestReoport cl">
  <div class="pls_M">
   <div><span class="testQuestionNumber testQuestionicon"><?php echo $qst+1; ?> </span></div>
    <div class="testQuestion"><span>
      <p><?php echo stripslashes($assQstAnsData[$qst]['qstn_detail']);?></p>
      </span> </div>
    <div class="testQuestion_mark">Marks <span class="testQuestionMarks"><?php echo $assQstAnsData[$qst]["qstn_marks"];?></span></div>
  </div>
  <div class="test_Listing cl">
<?php 
		 $optLst=$objPbAss->getQuestionOptions($assQstAnsData[$qst]['qstn_id'],$mysqli);
		 
		  $stdntQstoptid=$objPbAss->getOptIdAssreport($ass_atmt_id,$assQstAnsData[$qst]['qstn_id'],$mysqli);
	//	print_r($stdntQstoptid);
		 $numOptn=count($optLst);
?>  
    <ul class="marginleft">
	<?php
					 if($numOptn) { 
					 
					 $k=0;
					 while($optLst[$k]) {
					 $trufls='F';
					 
					 
					// $assQstAnsData[$qst]
					 
					 
					 
					 if($optLst[$k]['right_flag']=='T') { $optChoice="tickiconAnswers";} else {$optChoice="";}
					 
					
					 if($optLst[$k]['qst_opt_id'] == $assQstAnsData[$qst]['qst_opt_id'])
					 {
						  $checked="checked='checked'";
					 
					 } else 
					 {
						 $checked='';
						//$optChoice="";
					 
					 }
					 if($optLst[$k]['qst_opt_id'] == $assQstAnsData[$qst]['qst_opt_id'] && $optLst[$k]['right_flag']=='F' )
					 {
					 
						 $optChoice="crosscheckAnswers";
						 
					 
					 } 
					 // $stdntQstoptid;
					 if(empty($assQstAnsData[$qst]['qst_opt_id']))
					 {
					 
						 $optChoice="";
					 
					 }
			?>
      <li> <span class="radio_Button">
                  <input type="radio" class="radio1" value="66" name="<?php echo $optLst[$k]['qst_opt_id']; ?>"   disabled="disabled" <?php echo $checked; ?>>
                  </span>
                 <span class="testAnswer_testReport <?php echo $optChoice; ?>"><p><?php echo stripslashes($optLst[$k]['qst_opt_val']);?></p></span>
                </li>
                <?php 
	$k++;
	}
	} else {
?>
                <li> <span class="testAnswer_Report tickcheckAnswers">No Options Found</span> </li>
                <?php } ?>
 </ul>
  </div>
  <div class="cl"></div>
</div>
<?php 
$ansexp=$objPbAss->getAnsExplanation($ass_atmt_id,$assQstAnsData[$qst]['qstn_id'],$mysqli);
if($ansexp)
{
?>
<div><strong>Answer Explanation</strong> :  <?php echo $ansexp; ?> </div>
<?php } ?>
 <?php 
$qst ++;
	}
	
} else {

?>

<div class="no-result">No Questions Attempted </div>

<?php

}
?>
</div>

<script type="text/javascript">

function closeMe()
  {
	  
	parent.parent.GB_hide();
	parent.parent.document.location.href = '<?php echo HTTP_SERVER?>index.php?ms=user_login';  
  }
  
  function nextAttempt(attempt_id)
{
 
		//   alert(url);
window.location.href='<?php echo HTTP_SERVER?>index.php?ms=admin_test_report&ass_id=<?php echo $ass_id; ?>&user_id=<?php echo $std_user_id;?>&ass_atmt_id='+attempt_id+'';
}
  </script>
  </div>
  </div>
  </div>
  <div class="clear"></div>
   <?php include_once(DIR_MS_INCLUDES.FILENAME_FOOTER_MAIN);?>
</body>
</html>
