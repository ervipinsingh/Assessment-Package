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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$.noConflict();
    var GB_ROOT_DIR = "plugins/greybox/";
</script>
<script type="text/javascript" src="plugins/greybox/AJS.js"></script>
<script type="text/javascript" src="plugins/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="plugins/greybox/gb_scripts.js"></script>
<link href="plugins/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

</head>
<?php  

	$objPbAss = new public_ass();
	$pb_user_id= $_SESSION['PB_USER_LOGIN'];
	//print_r($qstnData);
	$ass_id=$_GET['ass_id'];
	$testData=$objPbAss->getAsssessmentDetails($ass_id,$mysqli);
	//print_r($testData);
 	$qst_cat_id=$_GET['qstCatId'];
	$userData=$objPbAss->getPublicUserDetails($pb_user_id,$mysqli);
?>
<body id="home">

<input type="hidden" id="base_url" value="<?php echo HTTP_SERVER; ?>"  />
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
	<div class="uiHeadsTitle pls_M bms"><?php echo $testData[0]['ass_title']; ?> </div>
	<div class="stepholder">
<div class="stepcontainer pts">
<ol>
<li class="firsttab active"><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test&ass_id=<?php echo $ass_id; ?>">1</a></li> 
<li class="midtab"><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test_qstn&ass_id=<?php echo $ass_id; ?>">2</a></li>
<li class="lasttab"><a href="<?php echo HTTP_SERVER?>/index.php?ms=test_publish&ass_id=<?php echo $ass_id; ?>">3</a></li>
</ol>
</div>
<div class="steptext">
<ul>
<li><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test&ass_id=<?php echo $ass_id; ?>">Create Assessment</a></li>
<li><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test_qstn&ass_id=<?php echo $ass_id; ?>">Add Question</a></li>
<li><a href="<?php echo HTTP_SERVER?>/index.php?ms=test_publish&ass_id=<?php echo $ass_id; ?>">Publish</a></li>
</ul>
</div>
</div>

 <div class="UItable">
<div class="uiHead">
<div class="uiHeadsTitle" style="display:none;" ><?php echo $testData[0]['ass_title']; ?> </div>
<?php $qstCatData=$objPbAss->getQuestionCat($mysqli);  ?>
<div class="uiHeadsTitle uiHeadsTitle_Select">
<select  class="select" name="typeofquestion" onchange="return getqstbycatList(this.value);">
<option value="">All Category</option>
<?php

for($i=0; $i<count($qstCatData); $i++)
{
?>

<option value="<?php echo $qstCatData[$i]['qst_cat_id']; ?>" <?php if( $qst_cat_id== $qstCatData[$i]['qst_cat_id'] ) { echo "selected='selected;'" ; } ?>><?php echo $qstCatData[$i]['qst_cat_name']; ?></option>
<?php } ?>
</select>
</div>

<ul class="uitab close_Right">
<li> <strong class="pls"> Duaraion</strong><a href="javascript:void(0);">  <?php echo $testData[0]['ass_time']; ?></a></li>
  
<li> <span id="total_qst"><?php echo ($testData[0]['totalqst'] ? $testData[0]['totalqst'] : 0 ); ?></span> Question Added  </li>
<li><span id="total_marks"><?php  echo  ($testData[0]['totalmarks']? $testData[0]['totalmarks'] : 0 ); ?></span> Marks </li>
<li><a href="<?php echo HTTP_SERVER?>/index.php?ms=test_preview&ass_id=<?php echo $ass_id; ?>" rel="gb_page_center[640, 480];"> Preview (<span id="total_qst_1"><?php echo ($testData[0]['totalqst']? $testData[0]['totalqst'] : 0); ?></span> Question)</a></li>

</ul>

</div>

<div class="UItableinner">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<input type="hidden" name="assesment_id" id="ass_id" value="<?php echo $ass_id; ?>" class="input">
<?php 
if($qst_cat_id)
	{
	
		$qstnData=$objPbAss->getAllTestQuestionListByCatId($pb_user_id,$qst_cat_id,$mysqli);
	
	} else {
	
		$qstnData=$objPbAss->getAllTestQuestionList($pb_user_id,$mysqli);
	}
	if(count($qstnData) >0 )
	{
for($i=0; $i<count($qstnData); $i++)
{
	 $qustexist=$objPbAss->getqstnexistassmt($qstnData[$i]['qstn_id'],$ass_id,$mysqli);
	 $singleqstmark=$objPbAss->getSingleQstMarks($ass_id,$qstnData[$i]['qstn_id'],$mysqli);
?>
<tr>
<td width="2%" class="odd"><span class="num"><?php echo ($i+1); ?></span></td>
<td width="66%" class="odd"><div class="coursename coursenamequswidth"><a href="<?php echo HTTP_SERVER?>/index.php?ms=question_preview&qstn_id=<?php echo $qstnData[$i]['qstn_id']; ?>" rel="gb_page_center[640, 480];"><p><?php echo stripslashes($qstnData[$i]['qstn_detail']); ?> </p></a></div></td>
<td width="32%" class="odd" align="right"><div class="action"><?php echo $objPbAss->getQstnCatName($qstnData[$i]['qstn_id'],$mysqli); ?>.
<div class="assignmarks" id="submitqst_<?php echo $i; ?>" style="display:none;">
<input name="marks" onKeyPress="return isNumberKey(event);" maxlength="2" id="qst_mark<?php echo $i; ?>" type="text" class="inputmarks input" placeholder="Enter Marks" value=""> 
<input type="hidden" id="question_id_<?php echo $i; ?>" class="input" value="<?php echo $qstnData[$i]['qstn_id']; ?>" >
<input type="hidden" id="streem_id_<?php echo $i; ?>" value="<?php echo $qstnData[$i]['qst_cat_id']; ?>"  />

<div class="uiButton uibuttonblacklink" ><a href="javascript:void(0);" id="submitmark" onClick="return add_questionto_assmt(<?php echo $i; ?>);">Submit</a></div> 
</div>
<?php  if($qustexist > 0) { ?>
<span id="removeqst_<?php echo $i; ?>"  ><span id="marksass<?php echo  $i; ?>"><?php echo $singleqstmark; ?> Marks</span><a href="javascript:void(0);" onClick="deleteqstassmnt(<?php echo $qstnData[$i]['qstn_id']; ?>,<?php echo $i; ?>)">Remove</a></span>
<?php } else {  ?>
<span id="addqst_<?php echo $i; ?>"><a href="javascript:void(0);" onClick="return addqst(<?php echo $i; ?>);">Add</a></span> 
<?php } ?>
<span id="addqst_<?php echo $i; ?>" style="display:none;"><a href="javascript:void(0);" onClick="return addqst(<?php echo $i; ?>);">Add</a></span> 
<span id="removeqst_<?php echo $i; ?>" style="display:none;"  ><span id="marksass<?php echo $i; ?>"></span><a href="javascript:void(0);" onClick="deleteqstassmnt(<?php echo $qstnData[$i]['qstn_id']; ?>,<?php echo $i; ?>)">Remove</a></span>
</div>
</td>
</tr>
<?php }  }  else { ?>
<tr>
<td>No Questions in this Category. </td>
</tr>
<?php } ?>

</table>
</div>
</div>

<div class="formaction">
<div class="uiButton uiButtonblack">
<input  value="&laquo; Previous" type="submit" onClick="window.location.href='<?php echo HTTP_SERVER?>/index.php?ms=edit_test&ass_id=<?php echo  $ass_id; ?>'"></div> 
<div class="uiButton uiButtonred">
<input  value="Next &raquo;" type="button" onClick="window.location.href='<?php echo HTTP_SERVER?>/index.php?ms=test_publish&ass_id=<?php echo  $ass_id; ?> '">
</div>
</div>


	</div>

	  
    </div>
  </div>
  <div class="clear"></div>
  <!-- Footer Sec start -->
  <?php include_once(DIR_MS_INCLUDES.FILENAME_FOOTER_MAIN);?>
  <!-- Footer Sec end -->
  
  <script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">
function addqst(id)
{
$('#addqst_'+id).hide();
$('#submitqst_'+id).show();
}
function deleteqstassmnt(qst_id,id)
{
//alert(id);


var base_url =$('#base_url').val();

	var assess_id= $('#ass_id').val();
 $.ajax({
        type: 'post',
        url: base_url+'/index.php?ms=test_pass&action=delet_ass_qst',
        data: {
           
            ass_id: assess_id,
			qstn_id:qst_id
			
        },
        success: function( data ) {
		//alert(data)
		var qsmdata = data.split("^");
		$('#total_marks').html(qsmdata[0]);
		$('#total_qst').html(qsmdata[1]);
		$('#total_qst_1').html(qsmdata[1]);
		$('#marksass'+id).html('');
		$('#addqst_'+id).show();
		$('#submitqst_'+id).hide();
		$('#removeqst_'+id).hide();
		
            console.log( data );
        }
    });
}
function add_questionto_assmt(id)
{
//alert(id);
var base_url =$('#base_url').val();
var assmark= $('#qst_mark'+id).val();

if(isNaN(parseInt(assmark)))
{
	$("#qst_mark"+id).css({color:"red"});
	$( "#qst_mark"+id ).focus();
	return false;

}

var qst_id=$('#question_id_'+id).val();
var qst_cat_id=$('#streem_id_'+id).val();
var assess_id= $('#ass_id').val();
//alert(assess_id);
//alert(qst_cat_id);
    $.ajax({
        type: 'post',
        url: base_url+'/index.php?ms=test_pass&action=add_ass_qst_marks',
        data: {
            ass_mark: assmark,
            ass_id: assess_id,
			qstn_id:qst_id,
			qst_cat_id:qst_cat_id
			
        },
        success: function( data ) {
		//alert(data);
		var qsmdata = data.split("^");
		$('#total_marks').html(qsmdata[0]);
		$('#total_qst').html(qsmdata[1]);
		$('#total_qst_1').html(qsmdata[1]);
		$('#marksass'+id).html(assmark + '&nbsp;Marks');
		$('#addqst_'+id).hide();
		$('#submitqst_'+id).hide();
		$('#removeqst_'+id).show();
	    console.log( data );
        }
    });
}
function isNumberKey(evt)
   {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
    }
	 return true;
   }  
function closeMe()
  {
	  parent.parent.GB_hide();

  }

function getqstbycatList(qstCatId)
{
window.location.href='<?php echo HTTP_SERVER?>index.php?ms=add_test_qstn&ass_id=<?php echo $ass_id; ?>&qstCatId='+qstCatId+'';


}

</script>
</div>
</body>
</html>
