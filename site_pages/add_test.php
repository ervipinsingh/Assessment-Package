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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor",	
    theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : 'inlinepopups',
    setup : function(ed) {
        // Add a custom button
        ed.addButton('mybutton', {
            title : 'My button',
            image : 'img/example.gif',
            onclick : function() {
                // Add you own code to execute something on click
                ed.focus();
                ed.selection.setContent('Hello world!');
            }
        });
    }
});
function isNumberKey(evt)
   {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
      }
	 return true;
   }  
function showquestionotion(divid)
	{
		//alert(divid);
		if(divid=='TF')
		{
		var div_id=1;
		}else if(divid=='MCSA')
		{
		var div_id=2;
		}else {
		
		var div_id=3;
		}
		for (var i = 0, limit = 4; i < limit; i++) {
		
		$('#box_'+i).hide();
		}
		$('#box_'+div_id).show();
	}
	function showhidedurattion()
{


$( "#duraion_div" ).toggle();

}

function getValidateAssForm()
  { 
 
    //var rege1 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	 var rege1 = /^[a-zA-Z0-9._-]/;
	 
	 var iscategorise=ltrim($("#iscategorise").val());
	 if(iscategorise.length<1) 
	 {
		$("#iscategorise").css({color:"red"});
		$("#iscategorise").focus();
		return false;	 
	 }	
   	var assTitle=ltrim($("#assessment_title").val());
	 
	if(assTitle.length<1) 
	 {
		$("#assessment_title").css({color:"red"});
		$("#assessment_title").focus();
		return false;	 
	 }	
	 
	
	 var assinstruct= ltrim($("#assInstuction").val());
	 if(assinstruct.length<1) 
	 {
		$("#assInstuction").css({color:"red"});
		$("#assInstuction").focus();
		return false;	 
	 }	
	 var assDetail= ltrim($("#assdescription").val());
	 if(assDetail.length<1) 
	 {
		$("#assdescription").css({color:"red"});
		$("#assdescription").focus();
		return false;	 
	 }	
    var noofqstn=ltrim($("#noofqstn").val());
	if(noofqstn.length<1) 
	 {
		$("#noofqstn").css({color:"red"});
		$("#noofqstn").focus();
		return false;	 
	 }	
	  var stream_id=ltrim($("#stream_id").val());
	if(stream_id.length<1) 
	 {
		$("#stream_id").css({color:"red"});
		$("#stream_id").focus();
		return false;	 
	 }	
   
  //crsPrice  
  } 
  function ltrim(argvalue)
{
while(1)
{if(argvalue.substring(0,1)!=" ")
break;argvalue=argvalue.substring(1,argvalue.length);}
return argvalue;
}
</script>



</head>

<body id="home">
<?php 
	$objPbAss = new public_ass();
	$pb_user_id= $_SESSION['PB_USER_LOGIN'];
	$ass_id=$_GET['ass_id'];
	
	
?>
<?php
	if($ass_id)
	 {
		$assdata=$objPbAss->getAsssessmentDetails($ass_id,$mysqli);
		
		 $addqsturl=HTTP_SERVER."/index.php?ms=add_test_qstn&ass_id=$ass_id";
	
	 } else
	  {
		 $addqsturl='javascript:void(0);';
	 
	 }
  ?>
<div class="section">
  <div class="HeaderHeight HeaderHeightinner">
	 <?php include_once(DIR_MS_INCLUDES.FILENAME_HEADER_MAIN);?>
  </div>
  
  <div id="features_Assessment">
    <div class="row">
		<div class="uiHeadpage">
        <h3><span class="propercase">Welcome, govind&nbsp;singh </span><span class="lowercase"> (govind@multisoftsystems.com)</span></h3>
      </div>
     <?php  include(DIR_MS_INCLUDES.FILENAME_LEFT_NAV); ?>
	  
	 <div class="containershadow maincontainer">
	<div class="stepholder">
<div class="stepcontainer">
<ol>
<li class="firsttab active"><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test&ass_id=<?php echo $ass_id; ?>">1</a></li> 
<li class="midtab"><a href="<?php echo $addqsturl; ?>">2</a></li>
<li class="lasttab"><a href="javascript:void(0);">3</a></li>
</ol>
</div>
<div class="steptext">
<ul>
<li><a href="<?php echo HTTP_SERVER?>/index.php?ms=add_test&ass_id=<?php echo $ass_id; ?>">Create Assessment</a></li>
<li><a href="<?php echo $addqsturl; ?>">Add Question</a></li>
<li><a href="javascript:void(0);">Publish</a></li>
</ul>
</div>
</div>

 <form method="post" enctype="multipart/form-data" action="<?php echo HTTP_SERVER?>/index.php?ms=test_pass&action=add_test" onSubmit="return getValidateAssForm();">
<input type="hidden" name="ass_id" value="<?php echo $ass_id;?>"  />
<div class="formholder">
<div class="standard_form clearfix">
<ul >
<li>

<label>Is Categorised </label>
<div class="fieldgroup"><select name="iscateorise" id="iscategorise" class="select selectWidth"><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option> </select></div>
</li>
<li>
<label>Assessment Title</label>
<div class="fieldgroup"><input value="<?php echo $assdata[0]['ass_title']; ?>" id="assessment_title" name="assessment_title" type="text" class="input"></div>
</li>
<li>
<label>Instruction</label>
<div class="fieldgroup"><textarea name="ass_instruction" id="assInstuction" cols="" rows="" class="mceEditor"><?php echo $assdata[0]['ass_instruct']; ?></textarea></div>
</li>
<li>
<label>Description</label>
<div class="fieldgroup"><textarea  name="ass_description" id="assdescription" cols="" rows="" class="mceEditor"><?php echo $assdata[0]['ass_details']; ?></textarea></div>
</li>

<li>
<div class="formrow formfixed">
<div class="formcolm_CRT_AssessMent">
<label>No of Attempts</label>
<div class="fieldgroup">
<select name="noofattempts" class="select selectWidth">
<?php for ($i=1; $i<11; $i++)
{  ?>
<option value="<?php echo $i; ?>" <?php if($assdata[0]['ass_attempt']==$i) { echo 'selected="selected"';  }?> ><?php echo $i; ?></option>
<?php } ?>
</select>
</div>
</div>
<?php
if($assdata[0]['ass_time'])
{
$checked='checked="checked"';
$dispay='';

} else {

$checked='';
$dispay='style="display:none;"';

}


?>
<div class="formcolm_CRT_AssessMent formcolms_CRT_crateAssess" id="clickme" style="float:left;">
<label>Time Based</label>
<div class="fieldgroup"><input  name="timebased" <?php echo $checked; ?>   value="1" type="checkbox" onClick="showhidedurattion();" class="inputstext"></div>
</div>
<div class="formcolm_CRT_AssessMent" <?php echo $dispay; ?> id="duraion_div">
<label>Time Duration</label>
<div class="fieldgroup"><input  name="duration" value="<?php echo $assdata[0]['ass_time']; ?>" onKeyPress="return isNumberKey(event);" type="text" maxlength="3" class="inputstext"> in Minute</div>
</div>
<div class="formcolm_CRT_AssessMent"  >
<label>No. of Questions</label>
<div class="fieldgroup"><input  name="noofqstn" id="noofqstn" value="<?php echo $assdata[0]['qstn_count']; ?>" onKeyPress="return isNumberKey(event);" type="text" maxlength="3" class="inputstext"></div>
</div>


<div class="formcolm_CRT_AssessMent"  >
<label>Stream List</label>
<?php 
$streamData=$objPbAss->getStreamList($mysqli);
//print_r($streamData);
 ?>
<div class="fieldgroup"><select name="stream_id" id="stream_id"  class="select" >
<option value="">Select</option>
<?php for($i=0; $i<count($streamData); $i++) { ?>
<option value="<?php echo $streamData[$i]['stream_id']; ?>"  <?php if($streamData[$i]['stream_id']==$assdata[0]['stream_id']){  echo 'selected="selected"';  } ?>><?php echo $streamData[$i]['stream_name']; ?></option>
<?php } ?>

</select></div>
</div>
</div>
</li>
</ul>
</div>
</div>
<div class="formaction">
<div class="uiButton uiButtonred">
<input value="Create" name="submitform1" id="submitform" type="submit"></div> 
<div class="uiButton uiButtonred">
<input  value="Cancel " type="button" 
onClick="window.location.href='<?php echo HTTP_SERVER?>index.php?ms=test_list'">
</div>
</div>
</form>


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
