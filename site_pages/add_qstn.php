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
<title>Assement Package</title>

<?php 

 $objCss=new msCommon();
 echo $objCss->getMsCommonCss();
 $objCommon=new common_function();
 $mysqli=$objCommon->getConnectMe();
 	$objPbAss = new public_ass();
	$pb_user_id= $_SESSION['PB_USER_LOGIN'];
	$userData=$objPbAss->getPublicUserDetails($pb_user_id,$mysqli);
?>

<!--<script type="text/javascript" src="js/bjqs-1.3.min.js" /></script>-->
	

<script type="text/javascript" src="<?php echo HTTP_SERVER?>js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo HTTP_SERVER?>js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor",	
    theme_advanced_buttons1 : "bold,italic,underline,image,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink,|,tiny_mce_wiris_formulaEditor,tiny_mce_wiris_CAS,|,fullscreen,jbimages",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : 'inlinepopups,tiny_mce_wiris,jbimages',
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
</script>
<script class="secret-source">
   
	
function getValidateQstForm()
 { 
   	var quest_title=ltrim($("#quest_title").val());
	if(quest_title.length<1) 
	 {
		$("#quest_title").css({color:"red"});
		$("#quest_title").focus();
		return false;	 
	 }	 
  
 }

   </script>

</head>
<body id="home">
<div class="section">
  <div class="HeaderHeight HeaderHeightinner">
	 <?php include_once(DIR_MS_INCLUDES.FILENAME_HEADER_MAIN);?>
  </div>
    <div id="features_Assessment">
    <div class="row">
	
	<div class="uiHeadpage">
       <h3><span class="propercase">Welcome, <?php echo $userData[0]['pb_first_name'].'&nbsp;'.$userData[0]['pb_last_name']; ?> </span><span class="lowercase"> (<?php echo $userData[0]['pb_user_email']; ?>)</span></h3>
      </div>
	  
     <?php 
	 include(DIR_MS_INCLUDES.FILENAME_LEFT_NAV);
	  ?>
	  
	 <div class="containershadow maincontainer">
	 
<div class="uiHead uiHeadspage">
<div class="uiHeaderaction">
<div class="uiButton uiButtonblack">
<input name="" value="« Back" onclick="window.location.href='<?php echo HTTP_SERVER?>index.php?ms=qstn_list'" type="button">
</div>
</div>

<h3><span>Create</span> a Question</h3>
</div>

<form method="post" enctype="multipart/form-data" action="<?php echo HTTP_SERVER?>index.php?ms=test_pass&action=add_test_qstn" onSubmit="return getValidateQstForm();">
<input type="hidden" name="course_id" value="6" >
<div class="formholder">
<div class="standard_form clearfix">
<ul >
<li>
<label>Question Title</label>
<div class="fieldgroup"><textarea cols="" rows="" class="mceEditor" id="quest_title" name="questiontitle"></textarea></div>
</li>
<li>
<label>Type of Question</label>
<div class="fieldgroup">
<select name="typeofquestion" class="select" onChange="showquestionotion(this.value)">
<option value="TF">True/False</option>
<option value="MCSA">Multiple choice single answer</option>
<option value="MCMA">Multiple choice multiple answer</option>
</select>

<div class="qstoption" id="box_1" >
<div class="checkbox"><input name="truefalse" type="radio" value="T" class="checkbox_btn"> <label>True</label></div>
<div class="checkbox"><input name="truefalse" type="radio" value="F" class="checkbox_btn" checked="checked"> <label>False</label></div>
</div>
<div class="qstoption qstmulti_option" id="box_2" style="display:none;" >
<div class="qstopt_list">
<div class="optionpoint"><span>Option 1</span></div>
<div class="selectoption"><input name="single_choice" type="radio" value="0" class="optradio_btn"></div>
<div class="optcontent"><textarea name="option_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 2</span></div>
<div class="selectoption"><input name="single_choice" type="radio" value="1" class="optradio_btn"></div>
<div class="optcontent"><textarea name="option_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 3</span></div>
<div class="selectoption"><input name="single_choice" type="radio" value="2" class="optradio_btn"></div>
<div class="optcontent"><textarea name="option_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 4</span></div>
<div class="selectoption"><input name="single_choice" type="radio" value="3" class="optradio_btn"></div>
<div class="optcontent"><textarea name="option_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea>
</div> 
</div>
</div>


<div class="qstoption qstmulti_option" id="box_3" style="display:none;">
<div class="qstopt_list">
<div class="optionpoint"><span>Option 1</span></div>
<div class="selectoption"><input name="multipleopt[]" type="checkbox" value="0" class="optradio_btn"></div>
<div class="optcontent"><textarea name="moption_value[]" style="width:100%;" cols="200" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 2</span></div>
<div class="selectoption"><input name="multipleopt[]" type="checkbox" value="1" class="optradio_btn"></div>
<div class="optcontent"><textarea name="moption_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 3</span></div>
<div class="selectoption"><input name="multipleopt[]" type="checkbox" value="2" class="optradio_btn"></div>
<div class="optcontent"><textarea name="moption_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>

<div class="qstopt_list">
<div class="optionpoint"><span>Option 4</span></div>
<div class="selectoption"><input name="multipleopt[]" type="checkbox" value="3" class="optradio_btn"></div>
<div class="optcontent"><textarea name="moption_value[]" style="width:100%;" cols="" rows="" placeholder="Enter Answer" class="mceEditor"></textarea></div> 
</div>
</div>
</div>
</li>


<li>
<label>Hint</label>
<div class="fieldgroup"><textarea cols="" rows="" class="mceEditor" name="questhint"></textarea></div>
</li>

<li>
<div class="uiButton rms">
<label>Time Duration</label>
<div class="fieldgroup">
<select name="duration" class="select">
<option value="1"> 1</option>
<option value="2"> 2</option>
<option value="3"> 3</option>
<option value="4"> 4</option>
<option value="5"> 5</option>
<option value="6"> 6</option>
<option value="7"> 7</option>
<option value="8"> 8</option>
<option value="9"> 9</option>
<option value="10"> 10</option>
</select>in Minute</div>
</div>
<div class="uiButton rms">
<label>Difficulty Level</label>
<div class="fieldgroup">
<select name="diff_leve" class="select">
<option value="E">Easy</option>
<option value="M" selected="selected">Medium</option>
<option value="H">Hard</option>
</select></div>
</div>
<?php

$qstCatData=$objPbAss->getQuestionCat($mysqli);
//print_r($qstCatData);


?>
<div class="uiButton">
<label>Category</label>
<div class="fieldgroup">
<select name="qst_cat_id" class="select">
<!--<option value="">Select</option>-->
<?php
for($i=0; $i<count($qstCatData); $i++)
{

?>
<option value="<?php echo $qstCatData[$i]['qst_cat_id']; ?>"><?php echo $qstCatData[$i]['qst_cat_name']; ?></option>
<?php } ?>

</select></div>
</div>

</li>

</ul>
</div>
</div>


<div class="formaction">
<div class="uiButton uiButtonred">
<input   value="Create Question" type="submit"></div> 
<div class="uiButton uiButtonblack">
<input  value="Cancel" type="button"  onclick="window.location.href='<?php echo HTTP_SERVER?>index.php?ms=qstn_list'">
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
