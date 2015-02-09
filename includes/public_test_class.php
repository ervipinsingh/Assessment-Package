<?php
 class public_ass extends ms_pb_ass_sql
 {
 	
function getConnectMe()
	 { 
	   $config = new msConfig();
	   $mysqli=mysqli_connect($config->hostname,$config->username,$config->password,$config->database) or die(mysqli_error());
	   return $mysqli;		    
	  }
	  
function getAsssessmentDetails($ass_id,$mysqli)
 
  {
   // echo $ass_id;
	   $assData=array();
	   $query=$this->getAssementDetailSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$ass_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$qstn_count,$created_on,$created_by,$qstn_count,$is_categorized ,$is_scholarship,$is_publish,$published_on,$publish_by,$status); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
    if($num>0)
     { 
   		$i=0;
	 while($stmt->fetch()){
	 $assData[$i]['ass_title']=$ass_title;	
	 $assData[$i]['qstn_count']=$qstn_count;	
	 $assData[$i]['is_categorized']=$is_categorized;	
	 $assData[$i]['stream_id']=$stream_id;	
     $assData[$i]['ass_details']=$ass_details;							 
	 $assData[$i]['ass_instruct']=$ass_instruct;
	 $assData[$i]['ass_time']=$ass_time;
	 $assData[$i]['ass_attempt']=$ass_attempt;	
	 $assData[$i]['qstn_count']=$qstn_count;							 
	 $assData[$i]['created_on']=$created_on;
	 $assData[$i]['created_by']=$created_by;
	 $assData[$i]['is_publish']=$is_publish;
	 $assData[$i]['published_on']=$published_on;							 
	 $assData[$i]['publish_by']=$publish_by;
	 $assData[$i]['is_public']=$is_public;
	 $assData[$i]['is_scholarship']=$is_scholarship;
	 $assData[$i]['status']=$status;
	 $assData[$i]['totalqst'] =$this->getTotalQstass($ass_id,$mysqli);	
	 $assData[$i]['totalmarks'] =$this->getTotalQstMarks($ass_id,$mysqli);		  
	 $i++;
	 }
    }  
  return $assData; 
  }
  function getTotalQstass($ass_id,$mysqli)
 {
 	$total_qstn='';
    $query=$this->getCountqstAssmntSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$ass_id);
	$result=$stmt->execute();
	$stmt->bind_result($totalqstn);
	$stmt->store_result();
	$stmt->fetch();
	$total_qstn=$totalqstn;
	return  $total_qstn;  
 
 
 }
 function getTotalQstMarks($ass_id,$mysqli)
 {
    $ass_id;//=3;
	$total_marks=0;
	$query=$this->getSumofMarksSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$ass_id);
	$result=$stmt->execute();
	$stmt->bind_result($ttlmarks); 	  
	$num=$stmt->num_rows(); 
	$stmt->store_result();	
	$stmt->fetch();
	//print_r($stmt);
	$total_marks=$ttlmarks;	
	return $total_marks;	   
 }
	  
function getPublicAssList($mysqli)
	{
	
	   $pbassData=array();
	   $query=$this->getPublicAssListSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $result=$stmt->execute();
	   $stmt->bind_result($ass_id ,$ass_title,$ass_details,$ass_instruct,$ass_time,$created_on,$created_by); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
  if($num>0)
   {
		 $i=0;
		 while($stmt->fetch()){
		 $pbassData[$i]['ass_id']=$ass_id;	
		 						 
		 $pbassData[$i]['ass_title']=$ass_title;
		 $pbassData[$i]['ass_details']=$ass_details;							 
		 $pbassData[$i]['ass_instruct']=$ass_instruct;
		 $pbassData[$i]['ass_time']=$ass_time;
		 $pbassData[$i]['created_on']=$created_on;	 	 	 			  
		 $i++;
	 }
    }  
//	print_r($pbassData);
  return $pbassData; 
	
	
	}
 
 function getAddUserDetails($post, $mysqli)
 {
 
// print_r($post);
    
	 $ass_id=$post['ass_id'];
	 $fist_name= $post['firstname'];
	 $last_name= $post['lastname'];
	 $email_id= $post['email'];
	 $phone=$post['contact_no'];
	 $creted_on=date('Y-m-d');
	 $ip_add=$_SERVER['REMOTE_ADDR'];
	 $pb_user_id=$post['pb_user_id'];
	 $pub_user_qualif=$post['qualification'];
	 if($pub_user_qualif=='Otherqual')
	 {
		 $pub_user_qualif=$post['otherqual'];
	 
	 } else {
	 
		 $pub_user_qualif=$post['qualification'];
	 
	 }
	 $pub_user_college=$post['college'];
	 $pub_user_stream=$post['stream'];
	 
	 if($pub_user_stream=='Otherstr')
	 {
	  $pub_user_stream=$post['otherstr'];
		
	 } else {
	  $pub_user_stream=$post['stream'];
		
	 }
	 $user_password=sha1($post['user_password']);
	 $pub_user_city=$post['city'];
	 $existEmail=$this->getEmailIdExist($email_id,$mysqli);
	   if($existEmail > 0)
	   {
	    $_SESSION['EMAIL_EXIST']="This Email is Already Exist, Please Login."; 
		echo "<script type='text/javascript'>window.location.href='index.php?ms=email_exist&email_id=$email_id'</script>"; 
		exit;
	   
	   
	   }
     $query=$this->getAddUserDetailsSql();   
	 $stmt = $mysqli->stmt_init();  #object Class
	 $mysqli->set_charset("utf8");	  
	 $stmt->prepare($query);
	 $stmt->bind_param('sssssssssss',$fist_name,$last_name,$email_id ,$phone,$creted_on,$ip_add,$pub_user_qualif,$pub_user_college,$pub_user_stream,$pub_user_city,$user_password);
	 $result=$stmt->execute();
	 $user_id=$stmt->insert_id;
	  $_SESSION['PB_USER_LOGIN']=$user_id; 
	// print_r($stmt);
	$assData=$this->getAsssessmentDetails($ass_id,$mysqli);
	if($assData[0]['is_categorized']=='yes')
	{
	 echo "<script type='text/javascript'>window.location.href='index.php?ms=categorize_dtl&ass_id=$ass_id&user_id=$user_id'</script>";
	exit;
	
	}
	else {
	// exit;
	 echo "<script type='text/javascript'>window.location.href='index.php?ms=test_attempt&ass_id=$ass_id&user_id=$user_id'</script>";
	exit;
	}	  
	//print_r($stmt);
 }
function getSignUpEmployer($post, $mysqli)
 {
 
// print_r($post);
    
	 
	 $pb_user_email= $post['emp_email'];
	 $pb_first_name= $post['emp_name'];
	 $pb_user_contact= $post['emp_phone'];
	 $user_password=sha1($post['emp_password']);
	 $existEmail=$this->getEmailIdExist($email_id,$mysqli);
	   if($existEmail > 0)
	   {
	    $_SESSION['EMAIL_EXIST']="This Email is Already Exist, Please Login."; 
		echo "<script type='text/javascript'>window.location.href='index.php?ms=email_exist&email_id=$email_id'</script>"; 
		exit;
	 
	   }
	   $empType='EMP';
     $query=$this->getSignUpEmployerSql();   
	 $stmt = $mysqli->stmt_init();  #object Class
	 $mysqli->set_charset("utf8");	  
	 $stmt->prepare($query);
	 $stmt->bind_param('ssss',$pb_first_name,$pb_user_email,$user_password,$pb_user_contact);
	 $result=$stmt->execute();
	 $user_id=$stmt->insert_id;
	  $_SESSION['PB_USER_LOGIN']=$user_id; 
	  $_SESSION['PB_USER_TYPE']=$empType;
	// print_r($stmt);
	//$assData=$this->getAsssessmentDetails($ass_id,$mysqli);
	echo "<script type='text/javascript'>window.location.href='index.php?ms=test_list'</script>"; 
	exit;
	//print_r($stmt);
 }
function getAssQuestionAnsList($attempt_id,$mysqli)
  {  
    /*$asg_sub_id,$submit_date, $asg_rate,$asg_eval_date,$user_name,$login_id */  
	   $qstData=array();
	   $query=$this->getAllAssQuestionListSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$attempt_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($pb_atm_hand_id,$qstn_id,$qst_opt_id,$pb_is_review,$pb_opt_on,$ass_id,$pb_attempt_on,$qstn_detail,$qstn_hint,$diff_level,$qstn_type,$qstn_time,$qstn_marks); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
  if($num>0)
   {
		 $i=0;
		 while($stmt->fetch()){
		 $qstData[$i]['pb_atm_hand_id']=$pb_atm_hand_id;	
		 $qstData[$i]['qstn_id']=$qstn_id;	
		 $qstData[$i]['qst_opt_id']=$qst_opt_id;								 
		 $qstData[$i]['pb_is_review']=$pb_is_review;
		 $qstData[$i]['pb_opt_on']=$pb_opt_on;
		 $qstData[$i]['ass_id']=$ass_id;							 
		 $qstData[$i]['pb_attempt_on']=$pb_attempt_on;
		 $qstData[$i]['qstn_detail']=$qstn_detail;
		 $qstData[$i]['qstn_hint']=$qstn_hint;
		 $qstData[$i]['diff_level']=$diff_level;
		 $qstData[$i]['qstn_type']=$qstn_type;
		 $qstData[$i]['qstn_time']=$qstn_time;
		 $qstData[$i]['qstn_marks']=$qstn_marks;
	
	// $qstData[$i]['qstoptdata']=$this->getQuestionOptions($qstData[$i]['qstn_id'],$mysqli);		 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 } 
 
 function getPreviewTestQst($ass_id,$mysqli)
 {
	   $qstData=array();
	   $query=$this->getPreviewTestSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$ass_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($qstn_id,$qstn_marks,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by,$status,$qstn_type); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
	   if($num>0)
	   { $i=0;
		 while($stmt->fetch()){
		 $qstData[$i]['qstn_id']=$qstn_id;	
		 $qstData[$i]['qstn_marks']=$qstn_marks;	
		  $qstData[$i]['qstn_detail']=$qstn_detail;								 
		 $qstData[$i]['qstn_hint']=$qstn_hint;
		 $qstData[$i]['diff_level']=$diff_level;
		 $qstData[$i]['qstn_time']=$qstn_time;							 
		 $qstData[$i]['created_on']=$created_on;
		 $qstData[$i]['created_by']=$created_by;
		 $qstData[$i]['status']=$status;
		 $qstData[$i]['qstn_type']=$qstn_type;
	
	// $qstData[$i]['qstoptdata']=$this->getQuestionOptions($qstData[$i]['qstn_id'],$mysqli);		 	 	 			  
		 $i++;
		 }
 	   }  
	  return $qstData; 
  }
 
function getQstnIdbyAssqId($assqid,$mysqli)
{
	$qstnId ='';
    $query=$this->getQstnIdbyAssqIdSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$assqid);
	$result=$stmt->execute();
	$stmt->bind_result($qstn_id );
	$stmt->store_result();
	$stmt->fetch();
	$qstnId=$qstn_id ;
	return  $qstnId;  

}
function getQuestionOptions($qstnid,$mysqli)
 { 
   $optData=array();
   $query=$this->getQuestionOptionsSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$qstnid);
   $result=$stmt->execute();
   $stmt->bind_result($qst_opt_id,$qst_opt_val,$right_flag); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $optData[$i]['qst_opt_id']=$qst_opt_id;	
	 $optData[$i]['qst_opt_val']=$qst_opt_val;							 
	 $optData[$i]['right_flag']=$right_flag;	 	 	 			  
	 $i++;
	 }
    }  
  return $optData;   
 } 
   
function getSingleQstDetailsByQstId($ass_id,$qstn_id,$mysqli)
 {
 
   $qstData=array();
   $query=$this->getSingleQstDetailsByQstIdSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_id,$qstn_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_q_id,$qstn_id,$qstn_marks,$qstn_detail,$qstn_hint,$qstn_time,$qstn_type); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['ass_q_id']=$ass_q_id;
	 $qstData[$i]['qstn_id']=$qstn_id;	
	 $qstData[$i]['qstn_marks']=$qstn_marks;	
	 $qstData[$i]['qstn_detail']=$qstn_detail;								 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['qstn_time']=$qstn_time;
	 $qstData[$i]['qstn_type']=$qstn_type;	 
	// $qstData[$i]['qstoptdata']=$this->getQuestionOptions($qstData[$i]['qstn_id'],$mysqli);		 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 
 }
function getSingleQstDetailsCat($ass_id,$qst_cat_id,$mysqli)
 {
   $qstData=array();
   $query=$this->getSingleQstDetailsCatSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_id,$qst_cat_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_q_id,$qstn_id,$qstn_marks,$qstn_detail,$qstn_hint,$qstn_time,$qstn_type); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['ass_q_id']=$ass_q_id;
	 $qstData[$i]['qstn_id']=$qstn_id;	
	 $qstData[$i]['qstn_marks']=$qstn_marks;	
	  $qstData[$i]['qstn_detail']=$qstn_detail;								 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['qstn_time']=$qstn_time;
	 $qstData[$i]['qstn_type']=$qstn_type;	 
	// $qstData[$i]['qstoptdata']=$this->getQuestionOptions($qstData[$i]['qstn_id'],$mysqli);		 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 }
 function getSingleQstDetails($ass_id,$mysqli)
 
 {
 
   $qstData=array();
   $query=$this->getSingleQstDetailsSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_q_id,$qstn_id,$qstn_marks,$qstn_detail,$qstn_hint,$qstn_time,$qstn_type); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['ass_q_id']=$ass_q_id;
	 $qstData[$i]['qstn_id']=$qstn_id;	
	 $qstData[$i]['qstn_marks']=$qstn_marks;	
	  $qstData[$i]['qstn_detail']=$qstn_detail;								 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['qstn_time']=$qstn_time;
	 $qstData[$i]['qstn_type']=$qstn_type;	 
	// $qstData[$i]['qstoptdata']=$this->getQuestionOptions($qstData[$i]['qstn_id'],$mysqli);		 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 
 
 }
 function getAssQstPaging($ass_id,$mysqli)
 {
 
   $qstData=array();
   $query=$this->getAssQstPagingSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_q_id,$qstn_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   
  if($num>0)
   {
    $i=0;
    while($stmt->fetch())
	{
	
		 $qstData[$i]['ass_q_id']=$ass_q_id;
		 $qstData[$i]['qstn_id']=$qstn_id;	
	 
	 $i++;
	 }
	 
    }  
  return $qstData; 
 
 }
 function getAssQstPagingQstCatId($ass_id,$qst_cat_id,$mysqli)
 {
 
   $qstData=array();
   $query=$this->getAssQstPagingQstCatIdSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_id,$qst_cat_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_q_id,$qstn_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   
  if($num>0)
   {
    $i=0;
    while($stmt->fetch())
	{
	
		 $qstData[$i]['ass_q_id']=$ass_q_id;
		 $qstData[$i]['qstn_id']=$qstn_id;	
	 
	 $i++;
	 }
	 
    }  
  return $qstData; 
 
 }
function getNextAssQstnId($assqid,$ass_id,$mysqli)
{
	
	$assq_id ='';
    $query=$this->getNextAssQstnIdSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ii',$assqid,$ass_id);
	$result=$stmt->execute();
	$stmt->bind_result($ass_q_id );
	$stmt->store_result();
	$stmt->fetch();
	$assq_id=$ass_q_id ;
	return  $assq_id;  
	###########################

}
function getNextAssQstnIdCat($assqid,$ass_id,$qstCatId,$mysqli)
{
	
	$assq_id ='';
    $query=$this->getNextAssQstnIdCatSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('iii',$assqid,$ass_id,$qstCatId);
	$result=$stmt->execute();
	$stmt->bind_result($ass_q_id );
	$stmt->store_result();
	$stmt->fetch();
	$assq_id=$ass_q_id ;
	return  $assq_id;  
	###########################

}
function addTestAttempt($ass_id,$pb_user_id,$mysqli)
{

	//echo $ass_id; die;
	/*$pb_user_id=$post['user_id'];
	$ass_id=$post['ass_id'];*/
	$cert_no=rand(11111111,99999999);
	$pb_ip_address=$_SERVER['REMOTE_ADDR'];
	$pb_attempt_on=date('Y-m-d');
	$pb_browser_name=$_SERVER['HTTP_USER_AGENT'];
	$query=$this->addTestAttemptSql();
	$stmt= $mysqli->stmt_init();
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('iisssi', $pb_user_id,$ass_id,$pb_ip_address,$pb_attempt_on,$pb_browser_name,$cert_no);
	$stmt->execute();
	$attempt_id=$stmt->insert_id;
	return $attempt_id;
}

function addTestAnswers($post, $mysqli)

{
		//print_r($post); 
		$ass_id=$post['ass_id'];
		$ansExplanation=$post['ansexplanation'];
		$pb_user_id=$post['user_id'];
		$nextassqsid=$post['nextassqsid'];
		$pb_as_atmid=$post['test_atmt_id'];
		$qstn_id=$post['qstn_id'];
		$pb_opt_on=date("Y-m-d");
		$qst_opt_id=$post['answers'];
		$query=$this->addTestAnswersSql();
		$stmt=$mysqli->stmt_init();
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		$stmt->bind_param('issii',$qst_opt_id,$ansExplanation,$pb_opt_on,$pb_as_atmid,$qstn_id);
		$stmt->execute();
		//print_r($stmt);
		 $qstCatId=$post['qst_cat_id']; 

if($qstCatId)
{

if($nextassqsid)
   {
   
  	 echo "<script type='text/javascript'>window.location.href='index.php?ms=test_atmt_cat&user_id=$pb_user_id&ass_id=$ass_id&nextassqsid=$nextassqsid&ass_atmt_id=$pb_as_atmid&qstCatId=$qstCatId'</script>";
		exit;
	} else {
	
	 $assCtidExist=$this->getQstCatRemain($pb_as_atmid,$mysqli);
	 
	if($assCtidExist>0 )
	{
	 echo "<script type='text/javascript'>window.location.href='index.php?ms=categorize_dtl&user_id=$pb_user_id&ass_id=$ass_id&nextassqsid=$nextassqsid&ass_atmt_id=$pb_as_atmid&qstCatId=$nextQcatId'</script>";
		exit;
	} else {
	
	//die;
	  echo "<script type='text/javascript'>window.location.href='index.php?ms=test_rep_conf&user_id=$pb_user_id&ass_id=$ass_id&nextassqsid=$nextassqsid&ass_atmt_id=$pb_as_atmid'</script>";
		exit;
		}
	}
	
	}
	else { 
	
if($nextassqsid)

   {
  	 echo "<script type='text/javascript'>window.location.href='index.php?ms=test_attempt&user_id=$pb_user_id&ass_id=$ass_id&nextassqsid=$nextassqsid&ass_atmt_id=$pb_as_atmid'</script>";
		exit;
	} else {
	
	  echo "<script type='text/javascript'>window.location.href='index.php?ms=test_rep_conf&user_id=$pb_user_id&ass_id=$ass_id&nextassqsid=$nextassqsid&ass_atmt_id=$pb_as_atmid'</script>";
		exit;
	}

	}
}

function addAssQstCate($pb_as_atmid,$qst_cat_id,$mysqli)
	{
			$query=$this->addAssQstCateSql();	
			$stmt = $mysqli->stmt_init(); 
			$mysqli->set_charset("utf8");	  
			$stmt->prepare($query);
			$stmt->bind_param('ii',$pb_as_atmid,$qst_cat_id);
			$result=$stmt->execute();
	}
function getOptIdAssreport($ass_atmt_id,$qstn_id,$mysqli)
 
	 {
		$qstoptid ='';
		$query=$this->getOptIdAssreportSql();	
		$stmt = $mysqli->stmt_init(); 
		$mysqli->set_charset("utf8");	  
		$stmt->prepare($query);
		$stmt->bind_param('ii',$ass_atmt_id,$qstn_id);
		$result=$stmt->execute();
		$stmt->bind_result($qst_opt_id );
		$stmt->store_result();
		$stmt->fetch();
		$qstoptid=$qst_opt_id ;
		return  $qstoptid;  
	 }
	 
function getAnsExplanation($ass_atmt_id,$qstn_id,$mysqli)

 {
 		$qstoptid ='';
		$query=$this->getAnsExplantionSql();	
		$stmt = $mysqli->stmt_init(); 
		$mysqli->set_charset("utf8");	  
		$stmt->prepare($query);
		$stmt->bind_param('ii',$ass_atmt_id,$qstn_id);
		$result=$stmt->execute();
		$stmt->bind_result($user_space );
		$stmt->store_result();
		$stmt->fetch();
		$qstoptid=$user_space ;
		return  $qstoptid;  
 
 }
function getAttemptAssQst($attempt_id, $mysqli)
	{
	   $usrCrsId=array();
	   $query=$this->getAttemptAssQstSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$attempt_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($pb_atm_hand_id); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
	   return $num;
	}
function getRightAssAsn($ass_atmt_id,$ass_id,$mysqli)
{
   $rightAnsData=array();
   $query=$this->getRightAssAsnSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_atmt_id,$ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($right_qstn,$marksobtn); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   
  if($num>0)
   {
    $i=0;
    while($stmt->fetch()){
	
		 $rightAnsData[$i]['right_qstn']=$right_qstn;
		 $rightAnsData[$i]['marksobtn']=$marksobtn;	
		 $i++;
	 }
    }  
  return $rightAnsData; 
 
 }
function getPublicUserDetails($user_id,$mysqli)
 {
 
   $pubUserData=array();
   $query=$this->getPublicUserDeratailSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$user_id);
   $result=$stmt->execute();
   $stmt->bind_result($pb_user_type,$pb_first_name,$pb_last_name,$pb_user_email,$pb_user_contact,$pb_crt_on,$pub_user_qualif,$pub_user_college,$pub_user_stream,$pub_user_city,$is_claimed); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   
  if($num>0)
   {
    $i=0;
    while($stmt->fetch())
	{
	   
	     $pubUserData[$i]['pb_user_type']=$pb_user_type;
		 $pubUserData[$i]['pb_first_name']=$pb_first_name;
		 $pubUserData[$i]['pb_last_name']=$pb_last_name;
		 $pubUserData[$i]['pb_user_email']=$pb_user_email;
		 $pubUserData[$i]['pb_user_contact']=$pb_user_contact;
		 $pubUserData[$i]['pb_crt_on']=$pb_crt_on;	
		 $pubUserData[$i]['pub_user_qualif']=$pub_user_qualif;	
		 $pubUserData[$i]['pub_user_college']=$pub_user_college;	
		 $pubUserData[$i]['pub_user_stream']=$pub_user_stream;	
		 $pubUserData[$i]['pub_user_city']=$pub_user_city;	
		 $pubUserData[$i]['is_claimed']=$is_claimed;	
		 $i++;
	 }
    }  
  return $pubUserData; 

 }
 
function getCertificateNo($ass_atmt_id,$mysqli)
 {
		$certno ='';
		$query=$this->getCertificateNoSql();	
		$stmt = $mysqli->stmt_init(); 
		$mysqli->set_charset("utf8");	  
		$stmt->prepare($query);
		$stmt->bind_param('i',$ass_atmt_id);
		$result=$stmt->execute();
		$stmt->bind_result($cert_no );
		$stmt->store_result();
		$stmt->fetch();
		$certno=$cert_no ;
		return  $certno;  
 }
 
function getUpdateUserDetails($post,$mysqli)
 {
       $pb_first_name= $post['firstname'];
	   $pb_last_name= $post['lastname'];
	   $pb_user_contact=$post['contact_no'];
	   $pb_user_id=$post['pb_user_id'];
	  
	   $ass_id=$post['ass_id'];
	   $pb_as_atmid=$post['ass_atmt_id'];
	   $pub_user_qualif=$post['qualification'];
	   $pub_user_college=$post['college'];
	   $pub_user_stream=$post['stream'];
	   $pub_user_city=$post['city'];
	   $is_claimed='y';
	   $query=$this->getUpdateUserDetailSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('ssssssssi',$pb_first_name,$pb_last_name,$pb_user_contact,$pub_user_qualif,$pub_user_college,$pub_user_stream,$pub_user_city,$is_claimed,$pb_user_id);
	   $result=$stmt->execute();
	   
	   $_SESSION['schl_msg']='Your Scholarship Claim has been Registered Sucessfully.';
	   echo "<script type='text/javascript'>window.location.href='index.php?ms=test_rep_conf&user_id=$pb_user_id&ass_id=$ass_id&ass_atmt_id=$pb_as_atmid'</script>";
 
 }
function getloginUser($post,$mysqli)
    { 
	
	//print_r($post);
    $status='a';
	$userId=$post['userId'];
	$password=$post['userpassword'];
	$upass=sha1($password);
	$query=$this->getloginUserSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('sss',$userId,$upass,$status);	
	$stmt->execute(); 
	$stmt->bind_result($pb_user_id,$pb_user_type,$pb_first_name);  #user_id, user_type
	$stmt->store_result();	
	//print_r($stmt);	
     $num=$stmt->num_rows();
	if($num>0)
	 {
	     $stmt->fetch();	
	    $_SESSION['PB_USER_LOGIN']=$pb_user_id;
		$userType=$this->getUserType($pb_user_id,$mysqli); 
		$_SESSION['PB_USER_TYPE']=$userType;
				 #
		/*$userType=$this->getUserType($pb_user_id,$mysqli);
		echo $_SESSION['PB_USER_TYPE']=$pb_user_type; 
		 
		 die;*/
		 if($userType=='ADM')
			 {
			echo "<script type='text/javascript'>window.location.href='index.php?ms=test_list'</script>"; 
			exit; #	adm_dash
			} else {
			
			echo "<script type='text/javascript'>window.location.href='index.php?ms=my_account'</script>"; 
			exit; #	adm_dash
			
			}	 
		
	 }
	if($num<1)
	 {
	   $stmt->fetch();	
	    $_SESSION['INVALID_ACCESS']="Invalid User Id or Password, Please try again."; 
		echo "<script type='text/javascript'>window.location.href='index.php?ms=user_login'</script>"; 
		exit;		   		  
	 }	 
 } 
  function getUserType($pb_user_id,$mysqli)
 {

   $userTp="";
	 $query=$this->getUserTypeSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$pb_user_id);
	$result=$stmt->execute();
	$stmt->bind_result($pb_user_type); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	//print_r($stmt);
	 $userTp=$pb_user_type;
	return $userTp;      
   
 
 
 } 
 function getEmailIdExist($email_id,$mysqli)
 {
 
 	$query=$this->getEmailExistSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('s',$email_id);	
	$stmt->execute(); 
	$stmt->bind_result($pb_user_id);  #user_id, user_type
	$stmt->store_result();	
	//print_r($stmt);	
    $num=$stmt->num_rows();
	
	 return $num;
 
 
 }
 function getTestAnalysis($ass_id,$mysqli)
 
 {
   $pubUserData=array();
   $query=$this->getTestAnalysisSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($pb_as_atmid ,$pb_user_id ,$pb_attempt_on,$ass_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   {
    $i=0;
    while($stmt->fetch()){
	
		 $pubUserData[$i]['pb_as_atmid']=$pb_as_atmid;
		 $pubUserData[$i]['pb_attempt_on']=$pb_attempt_on;
		 $pubUserData[$i]['pb_user_id']=$pb_user_id;
		 $pubUserData[$i]['ass_id']=$ass_id;
		 
		 $i++;
	 }
    }  
  return $pubUserData; 
 
 }
 function getQuestionCat($mysqli)
 {
 
   $pubUserData=array();
   $query=$this->getQstCalSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $result=$stmt->execute();
   $stmt->bind_result($qst_cat_id,$qst_cat_name); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   {
    $i=0;
    while($stmt->fetch()){
	
		 $pubUserData[$i]['qst_cat_id']=$qst_cat_id;
		 $pubUserData[$i]['qst_cat_name']=$qst_cat_name;
		 $i++;
	 }
    }  
  return $pubUserData; 
 }
 ########################ADD QUESTIONS START HERE######################
 function getAddQuestions($post,$mysqli)
 {
	$qst_cat_id=$post['qst_cat_id'];
	$qstn_detail=$post['questiontitle'];
	$questiontype=$post['typeofquestion'];
	$qstn_hint=$post['questhint'];
	$qstn_time=$post['duration'];
	$diff_level=$post['diff_leve'];
	$created_on=date('Y-m-d');
	$created_by=$_SESSION['PB_USER_LOGIN'];
	
	//print_r($post);
	$query=$this->getAddQuestionSql();  
 	$stmt = $mysqli->stmt_init();  
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('issssisi',$qst_cat_id,$questiontype,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by);
	$result=$stmt->execute();  
	$qst_id= $stmt->insert_id; 
	if($questiontype=='TF')
		 {
			 $qstn_id=$qst_id;
			 $right_flag=$post['truefalse'];
			 if($right_flag=='T')
			 {
			 $qst_opt_val='True';
			  $this->addQstOptions($qstn_id,$qst_opt_val,$right_flag,$mysqli);
			  $this->addQstOptions($qstn_id,'False','F',$mysqli);
			 } else {
			  $qst_opt_val='False';
			  $right_flag=='F';
			  $this->addQstOptions($qstn_id,$qst_opt_val,$right_flag,$mysqli);
			  $this->addQstOptions($qstn_id,'True','T',$mysqli);
			 }
		   
		 }else if($questiontype=='MCSA')
		 {
		 
			$singlechoice=$post['single_choice'];
			$qst_opt_val=$post['option_value'];
			$qstn_id=$qst_id;
		  
		 for($i=0; $i<count($qst_opt_val); $i++)
			 {
		 
		 if($singlechoice==$i){ $right_flag='T'; } else { $right_flag='F'; }
		 if($qst_opt_val[$i]!='')
		 		 {
		           $this->addQstOptions($qstn_id,$qst_opt_val[$i],$right_flag,$mysqli);
		 		 }
			   #exit;
			 }
		} else {
		
		$multipleopt=$post['multipleopt'];
		$qst_opt_val=$post['moption_value'];
		//print_r($multipleopt); 
		$qstn_id=$qst_id;
		for($j=0; $j<count($qst_opt_val); $j++)
			{
				if (in_array($j, $multipleopt))
				{
				$right_flag='T';
				}else {
				
				$right_flag='F';
				}			
			$this->addQstOptions($qstn_id,$qst_opt_val[$j],$right_flag,$mysqli);			
			}		
		}
		echo "<script type='text/javascript'>window.location.href='index.php?ms=qstn_list'</script>";
	exit;  
 
 }
function getEditQuestions($post,$mysqli)
 {
 	
	$qst_cat_id=$post['qst_cat_id'];
	$qstn_detail=$post['questiontitle'];
	$questiontype=$post['typeofquestion'];
	$qstn_id=$post['qstn_id'];
	$option_id=$post['option_id'];
	$qstn_hint=$post['questhint'];
	$qstn_time=$post['duration'];
	$diff_level=$post['diff_leve'];
	$created_on=date('Y-m-d');
	###########UPDATE QUESTION INFORMATION #############
	$query=$this->updateQuestionSql();  
 	$stmt = $mysqli->stmt_init();  
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('isssii',$qst_cat_id,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$qstn_id);
	$result=$stmt->execute(); 
	//print_r($stmt); die;
	#$qst_id= $stmt->insert_id; 
	#####################UPDATE QUESTION OPTIONS##############
	
	
	if($questiontype=='TF')
		 {
		 $qst_opt_val=$post['option_val_tf'];
		// print_r($qst_opt_val);
		// die;
		 $optidtf=$post['option_id'];
		 $this->getUpdateFlage($qstn_id, $mysqli);
		 $truefalse=$post['truefalse'];
		//print_r($post);
			// die;
		for($i=0; $i<count($optidtf); $i++)
		 {
		 
		    if($truefalse==$i){ $right_flag='T'; } else { $right_flag='F'; }
			
			$this->updateQstOptions($qst_opt_val[$i],$right_flag,$optidtf[$i],$qstn_id,$mysqli);
			
		  }
		  		   
		 }
		 else if($questiontype=='MCSA')
		 {
		// print_r($post);
		 
		 //die;
		 ################FOR ADD MORE OPTION
		 if($post['admoreopt']=='Y')
		 {
		 
			$singlechoice=$post['single_choice'];
			$qst_opt_val=$post['option_value'];
			$qstn_id=$qst_id;
		  
		 for($i=0; $i<count($qst_opt_val); $i++)
			 {
		 
		 if($singlechoice==$i){ $right_flag='T'; } else { $right_flag='F'; }
		 if($qst_opt_val[$i]!='')
		 		 {
		           $this->addQstOptions($qstn_id,$qst_opt_val[$i],$right_flag,$mysqli);
		 		 }
			   #exit;
			 } 
		 
		 } else {
		 ######################END ADD MORE EDIT START##############
		 	$this->getUpdateFlage($qstn_id, $mysqli);
			
			$singlechoice=$post['single_choice'];
			$qst_opt_val=$post['option_value'];
			$option_id=$post['option_id'];
			//$qstn_id=$qst_id;
		  
		 for($i=0; $i<count($option_id); $i++)
			 {
		 
		 if($singlechoice==$i){ $right_flag='T'; } else { $right_flag='F'; }
		 if($option_id[$i]!='')
		 		 {
		           $this->updateQstOptions($qst_opt_val[$i],$right_flag,$option_id[$i],$qstn_id,$mysqli);
				  
		 		 }
			   #exit;
			 }
			 
			}
		} else {
		
		##############UPDATE MULTIPLE OPT###############
				if($post['admoreopt']=='Y')
					{
		
						$multipleopt=$post['multipleopt'];
						$qst_opt_val=$post['moption_value'];
						//print_r($multipleopt); 
						$qstn_id=$qst_id;
						for($j=0; $j<count($qst_opt_val); $j++)
							{
								if (in_array($j, $multipleopt))
								{
								$right_flag='T';
								}else {
								
								$right_flag='F';
								}			
							$this->addQstOptions($qstn_id,$qst_opt_val[$j],$right_flag,$mysqli);			
							}		
				
					} else {
					
					$this->getUpdateFlage($qstn_id, $mysqli);
		#####END MULTIPLE OPT#########################
		$multipleopt=$post['multipleopt'];
		$qst_opt_val=$post['moption_value'];
		//print_r($multipleopt); 
		$option_id=$post['option_id'];
	    //	$qstn_id=$qst_id;
		for($j=0; $j<count($qst_opt_val); $j++)
			{
				if (in_array($j, $multipleopt))
				{
				$right_flag='T';
				}else {
				
				$right_flag='F';
				}			
			$this->updateQstOptions($qst_opt_val[$j],$right_flag,$option_id[$j],$qstn_id,$mysqli);	
			}
							}		
		}
		
echo "<script type='text/javascript'>window.location.href='index.php?ms=edit_qstn&qstn_id=$qstn_id'</script>";
	exit;  
 
 
 
 }
function addQstOptions($qstn_id,$qst_opt_val,$right_flag,$mysqli)
 {

 	$query=$this->getAddoptionsSql();  
 	$stmt = $mysqli->stmt_init();  
	$mysqli->set_charset("utf8");	 
	$stmt->prepare($query);
	$stmt->bind_param('iss',$qstn_id,$qst_opt_val,$right_flag);
	$result=$stmt->execute();	
	#print_r($stmt);	
 }
function updateQstOptions($qst_opt_val,$right_flag,$qst_opt_id,$qstn_id,$mysqli)
 {

 	$query=$this->updateOptionSql();  
 	$stmt = $mysqli->stmt_init();  
	$mysqli->set_charset("utf8");	 
	$stmt->prepare($query);
	$stmt->bind_param('ssii',$qst_opt_val ,$right_flag, $qst_opt_id, $qstn_id);
	$result=$stmt->execute();	
	#print_r($stmt);	
 }
function getUpdateFlage($qstn_id,$mysqli)
 {
 	$query=$this->updateOptionFlagSql();
	$stmt=$mysqli->stmt_init();
	$mysqli->set_charset("utf8"); 
	$stmt->prepare($query);
	$stmt->bind_param('i',$qstn_id);
	$stmt->execute();
 
 }
function getAllTestQuestionList($pb_user_id,$mysqli)
  { 
   
  /*$asg_sub_id,$submit_date, $asg_rate,$asg_eval_date,$user_name,$login_id */  
   $qstData=array();
    $query=$this->getAllTestQuestionListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$pb_user_id);
   $result=$stmt->execute();
   $stmt->bind_result($qstn_id,$qst_cat_id,$qstn_type,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['qstn_id']=$qstn_id;	
	  $qstData[$i]['qst_cat_id']=$qst_cat_id;	
	 $qstData[$i]['qstn_detail']=$qstn_detail;							 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['diff_level']=$diff_level;
	 $qstData[$i]['qstn_time']=$qstn_time;							 
	 $qstData[$i]['created_on']=$created_on;
	 $qstData[$i]['created_by']=$created_by;
	 $qstData[$i]['status']=$status;	 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 } 
 function getAllTestQuestionListPaging($pb_user_id,$offset,$rec_limit,$mysqli)
  { 
   
  /*$asg_sub_id,$submit_date, $asg_rate,$asg_eval_date,$user_name,$login_id */  
   $qstData=array();
   $query=$this->getAllTestQuestionListPageSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('iii',$pb_user_id,$offset,$rec_limit);
   $result=$stmt->execute();
   $stmt->bind_result($qstn_id,$qst_cat_id,$qstn_type,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['qstn_id']=$qstn_id;	
	  $qstData[$i]['qst_cat_id']=$qst_cat_id;	
	 $qstData[$i]['qstn_detail']=$qstn_detail;							 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['diff_level']=$diff_level;
	 $qstData[$i]['qstn_time']=$qstn_time;							 
	 $qstData[$i]['created_on']=$created_on;
	 $qstData[$i]['created_by']=$created_by;
	 $qstData[$i]['status']=$status;	 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 } 
 function getAllTestQuestionListByCatId($pb_user_id,$qst_cat_id,$mysqli)
  { 
   
  /*$asg_sub_id,$submit_date, $asg_rate,$asg_eval_date,$user_name,$login_id */  
   $qstData=array();
   $query=$this->getAllTestQuestionListByCatSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$pb_user_id,$qst_cat_id);
   $result=$stmt->execute();
   $stmt->bind_result($qstn_id,$qst_cat_id,$qstn_type,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qstData[$i]['qstn_id']=$qstn_id;	
	  $qstData[$i]['qst_cat_id']=$qst_cat_id;	
	 $qstData[$i]['qstn_detail']=$qstn_detail;							 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['diff_level']=$diff_level;
	 $qstData[$i]['qstn_time']=$qstn_time;							 
	 $qstData[$i]['created_on']=$created_on;
	 $qstData[$i]['created_by']=$created_by;
	 $qstData[$i]['status']=$status;	 	 	 			  
	 $i++;
	 }
    }  
  return $qstData; 
 } 
function getSingleQstDtlsById($qstnid,$mysqli)
  {  
    /*$asg_sub_id,$submit_date, $asg_rate,$asg_eval_date,$user_name,$login_id */  
   $qstData=array();
   $query=$this->getSingleQstDtlsByIdSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$qstnid);
   $result=$stmt->execute();
   $stmt->bind_result($qst_cat_id,$qstn_type,$qstn_detail,$qstn_hint,$diff_level,$qstn_time,$created_on,$created_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   {
     $i=0;
	 $stmt->fetch();
	 $qstData[$i]['qst_cat_id']=$qst_cat_id;
	 $qstData[$i]['qstn_type']=$qstn_type;
	 $qstData[$i]['qstn_detail']=$qstn_detail;							 
	 $qstData[$i]['qstn_hint']=$qstn_hint;
	 $qstData[$i]['diff_level']=$diff_level;
	 $qstData[$i]['qstn_time']=$qstn_time;							 
	 $qstData[$i]['created_on']=$created_on;
	 $qstData[$i]['created_by']=$created_by;
	 $qstData[$i]['status']=$status;	 	 	 			  
    }  
  return $qstData; 
 }
 function getForgotPass($post,$mysqli)
 {
	 $email_id=$post['fgt_user_email'];
	 $existEmail=$this->getEmailIdExist($email_id,$mysqli);
	   if($existEmail > 0)
	   {
		   $randPass=$this->randomPassword() ;
		   $new_pass_mail=$randPass;
		   $new_pass=sha1($randPass);
		   $query=$this->updatePassSql();  
		   $stmt = $mysqli->stmt_init();  #object Class
		   $mysqli->set_charset("utf8");	  
		   $stmt->prepare($query);
		   $stmt->bind_param('ss',$new_pass,$email_id);
		   $result=$stmt->execute();
	   ###############SEND MAIL#############
	   require_once('mail.inc.php');
		
			$to = array(
							'0'=> array('name' => ''.$email_id.'','email' => ''.$email_id.'')
							#'1'=> array('name' => 'Raj Trivedi','email' => 'arvind.cc@multisoftsystems.com')
							#'2'=> array('name' => 'Shweta Agrawal','email' => 'lovely.shweta@rocketmail.com')
						);
			$cc = array(
							#'0'=> array('name' => 'Dhira','email' => 'arvind.cc@multisoftsystems.com')
							#'1'=> array('name' => 'Raj Trivedi','email' => 'raj.trivedi82@yahoo.in'),
							#'2'=> array('name' => 'Shweta Agrawal','email' => 'lovely.shweta@rocketmail.com')
						);
			$bcc = array(
							#'0'=> array('name' => 'Dhiraj Kumar','email' => 'dhiraj@multisoftsystems.com'),
							#'1'=> array('name' => 'Raj Trivedi','email' => 'raj.trivedi82@yahoo.in'),
							#'2'=> array('name' => 'Shweta Agrawal','email' => 'lovely.shweta@rocketmail.com')
						);
			$read = array(
							#'0'=> array('name' => 'Raj Trivedi','email' => 'raj.ktrivedi82@gmail.com'),
						);
			$reply = array(
							#'0'=> array('name' => 'Raj Trivedi','email' => 'raj.ktrivedi82@gmail.com'),
						);	
							
			$sender = $userEmail; #'dhiraj@multisoftsystemsindia.com';
			$senderName="Multisoft Support"; #$username			
			$subject = 'Forgot Password Request';
			$message = '<p>Dear '.$email_id.', you made a forgot password request. Your new updated password is below:</p>
			<p>Password-: &nbsp; '.$new_pass_mail.'</p>
			<p>&nbsp;</p>
			<p>Thanks,</p>
			<p>Multisoft Support Team</p>';
			$obj = new sendMail($to, $sender, $subject, $message, $cc, $bcc,$senderName, $read, true, $reply, true);
			$obj->sendEmail();	
			
     #mail Ends				
		echo "<script type='text/javascript'>window.location.href='index.php?ms=user_login'</script>"; 
		exit;		   		  
	  ######################
	  
	   } else {
	   
	   $_SESSION['EMAIL_NOT_EXIST']="No Record Found."; 
		echo "<script type='text/javascript'>window.location.href='index.php?ms=user_login'</script>"; 
		exit;
	   
	   }
 
 }
 function randomPassword()
  {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 7; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
 ##################ADD QUESTION END HERE################################
function deleteQuestion($GET,$mysqli)
  { 
	$qnId=$GET['qstn_id'];
	$page=$GET['page'];
	$this->deleteQstnOption($qnId,$mysqli);
	$query=$this->deleteQuestionSql();			  
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$qnId);
	$result=$stmt->execute();  
	$_SESSION['QST_MESSAGE']="Question deleted Successfully."; 
	echo "<script type='text/javascript'>window.location.href='index.php?ms=qstn_list&page=$page'</script>";
	exit;     
 }
 
 function deleteQstnOption($qstn_id,$mysqli)
 {
	$query=$this->deleteQstnOptSql();			  
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$qnId);
	$result=$stmt->execute();  
 
 
 }
 
function getTestList($pb_user_id,$mysqli)
 {


   $assData=array();
   $query=$this->getTestListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
    $stmt->bind_param('i',$pb_user_id);
   $result=$stmt->execute();
    $stmt->bind_result($ass_id,$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$created_on,$created_by,$is_publish,$published_on,$publish_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	
	 $assData[$i]['ass_id']=$ass_id;
	 $assData[$i]['stream_id']=$stream_id;							 
	 $assData[$i]['ass_title']=$ass_title;
	 $assData[$i]['ass_details']=$ass_details;
	 $assData[$i]['ass_instruct']=$ass_instruct;							 
	 $assData[$i]['ass_time']=$ass_time;
	 $assData[$i]['ass_attempt']=$ass_attempt;	
	 $assData[$i]['created_on']=$created_on;	
	 $assData[$i]['created_by']=$created_by;	
	 $assData[$i]['is_publish']=$is_publish;	
	 $assData[$i]['published_on']=$published_on;	
	 $assData[$i]['publish_by']=$publish_by;
	  $assData[$i]['status']=$status;
	 $assData[$i]['totalMarks']=$this->getTotalQstMarks($assData[$i]['ass_id'],$mysqli);
	$assData[$i]['TotalQst']=$this->getTotalQstass($assData[$i]['ass_id'],$mysqli);						 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
   return  $assData;

  
 
 }
 function getTestListPaging($pb_user_id,$offset,$rec_limit,$mysqli)
 {


   $assData=array();
   $query=$this->getTestListPagingSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
    $stmt->bind_param('iii',$pb_user_id,$offset,$rec_limit);
   $result=$stmt->execute();
    $stmt->bind_result($ass_id,$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$created_on,$created_by,$is_publish,$published_on,$publish_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	
	 $assData[$i]['ass_id']=$ass_id;
	 $assData[$i]['stream_id']=$stream_id;							 
	 $assData[$i]['ass_title']=$ass_title;
	 $assData[$i]['ass_details']=$ass_details;
	 $assData[$i]['ass_instruct']=$ass_instruct;							 
	 $assData[$i]['ass_time']=$ass_time;
	 $assData[$i]['ass_attempt']=$ass_attempt;	
	 $assData[$i]['created_on']=$created_on;	
	 $assData[$i]['created_by']=$created_by;	
	 $assData[$i]['is_publish']=$is_publish;	
	 $assData[$i]['published_on']=$published_on;	
	 $assData[$i]['publish_by']=$publish_by;
	  $assData[$i]['status']=$status;
	 $assData[$i]['totalMarks']=$this->getTotalQstMarks($assData[$i]['ass_id'],$mysqli);
	$assData[$i]['TotalQst']=$this->getTotalQstass($assData[$i]['ass_id'],$mysqli);						 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
   return  $assData;

  
 
 }
 function getAllTestList($mysqli)
 {
   $assData=array();
   $query=$this->getAllTestListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $result=$stmt->execute();
   $stmt->bind_result($ass_id,$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$created_on,$created_by,$is_publish,$published_on,$publish_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['ass_id']=$ass_id;
	 $assData[$i]['stream_id']=$stream_id;							 
	 $assData[$i]['ass_title']=$ass_title;
	 $assData[$i]['ass_details']=$ass_details;
	 $assData[$i]['ass_instruct']=$ass_instruct;							 
	 $assData[$i]['ass_time']=$ass_time;
	 $assData[$i]['ass_attempt']=$ass_attempt;	
	 $assData[$i]['created_on']=$created_on;	
	 $assData[$i]['created_by']=$created_by;	
	 $assData[$i]['is_publish']=$is_publish;	
	 $assData[$i]['published_on']=$published_on;	
	 $assData[$i]['publish_by']=$publish_by;
	 $assData[$i]['status']=$status;
	 $assData[$i]['totalMarks']=$this->getTotalQstMarks($assData[$i]['ass_id'],$mysqli);
	 $assData[$i]['TotalQst']=$this->getTotalQstass($assData[$i]['ass_id'],$mysqli);						 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
   return  $assData;

  
 
 }
 function getAllPublishTestList($mysqli)
 {
   $assData=array();
   $query=$this->getAllPublishTestListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $result=$stmt->execute();
   $stmt->bind_result($ass_id,$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$created_on,$created_by,$is_publish,$published_on,$publish_by,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['ass_id']=$ass_id;
	 $assData[$i]['stream_id']=$stream_id;							 
	 $assData[$i]['ass_title']=$ass_title;
	 $assData[$i]['ass_details']=$ass_details;
	 $assData[$i]['ass_instruct']=$ass_instruct;							 
	 $assData[$i]['ass_time']=$ass_time;
	 $assData[$i]['ass_attempt']=$ass_attempt;	
	 $assData[$i]['created_on']=$created_on;	
	 $assData[$i]['created_by']=$created_by;	
	 $assData[$i]['is_publish']=$is_publish;	
	 $assData[$i]['published_on']=$published_on;	
	 $assData[$i]['publish_by']=$publish_by;
	 $assData[$i]['status']=$status;
	 $assData[$i]['totalMarks']=$this->getTotalQstMarks($assData[$i]['ass_id'],$mysqli);
	 $assData[$i]['TotalQst']=$this->getTotalQstass($assData[$i]['ass_id'],$mysqli);						 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
   return  $assData;

  
 
 }
 function addPublicTest($post,$mysqli)
 {
 	$is_categorized=$post['iscateorise'];
	$ass_title=$post['assessment_title'];
	$ass_details=$post['ass_description'];
	$ass_instruct=$post['ass_instruction'];
	$ass_time=$post['duration'];
	$ass_attempt=$post['noofattempts'];
	$created_on=date('Y-m-d');
	$created_by=$_SESSION['PB_USER_LOGIN'];
	$stream_id=$post['stream_id'];
	$noofqstn=$post['noofqstn'];
	$query=$this->addAssessmentSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('isssiiisis',$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$noofqstn,$created_on,$created_by,$is_categorized);
	$result=$stmt->execute();   
	 $ass_id=$stmt->insert_id;
	echo "<script type='text/javascript'>window.location.href='index.php?ms=add_test_qstn&ass_id=$ass_id'</script>";
	  
 
 }  
 function editPublicTest($post,$mysqli)
 {
 	$noofqstn=$post['noofqstn'];
	$is_categorized=$post['iscateorise'];
    $ass_id=$post['ass_id'];
    $ass_attempt=$post['noofattempts'];
	$ass_title=$post['assessment_title'];
	$ass_details=$post['ass_description'];
	$ass_instruct=$post['ass_instruction'];
	$ass_time=$post['duration'];
	$ass_attempt=$post['noofattempts'];
	$created_on=date('Y-m-d');
	$created_by=$_SESSION['PB_USER_LOGIN'];
	$stream_id=$post['stream_id'];
	$query=$this->editAssessmentSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('isssiiisisi',$stream_id,$ass_title,$ass_details,$ass_instruct,$ass_time,$ass_attempt,$noofqstn,$created_on,$created_by,$is_categorized,$ass_id);
	$result=$stmt->execute();   
	echo "<script type='text/javascript'>window.location.href='index.php?ms=add_test_qstn&ass_id=$ass_id'</script>";
	  exit;
 
 }  
function getStreamList($mysqli)
 {
 
   $assData=array();
   $query=$this->getStreamListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $result=$stmt->execute();
   $stmt->bind_result($stream_id,$stream_name); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	
	 $assData[$i]['stream_id']=$stream_id;
	 $assData[$i]['stream_name']=$stream_name;							 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
 //  $assData= $stmt->fetch(); 
   return  $assData;
 
 
 }  
 function addQuestionTest($post,$mysqli)
 {
 	$created_by=$_SESSION['PB_USER_LOGIN'];
	$ass_id=$post['ass_id'];
	$qstn_id=$post['qstn_id'];
	$qstn_marks=$post['ass_mark'];
	$qst_cat_id=$post['qst_cat_id'];
  	$query=$this->getAddQsttoAssSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('iiiii',$ass_id,$qstn_id,$qst_cat_id,$qstn_marks,$created_by);
	$result=$stmt->execute();   
	$totalmarks=$this->getTotalQstMarks($ass_id,$mysqli);
	$totalquestions=$this->getTotalQstass($ass_id,$mysqli);
	$data=$totalmarks.'^'.$totalquestions;
	echo $data;
 
 } 
 function getqstnexistassmt($qstn_id,$ass_id,$mysqli)
 {
 
 	$query=$this->getQuestionexistassSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ii',$qstn_id,$ass_id);
	$result=$stmt->execute();   
	$stmt->store_result();	
	$numrows=$stmt->num_rows();
	return $numrows;
 
 
 }   
 function getSingleQstMarks($ass_id,$qst_id,$mysqli)
 {
 	$qst_mark='';
    $query=$this->getSingleQstMarksSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ii',$ass_id,$qst_id);
	$result=$stmt->execute();
	$stmt->bind_result($qstn_marks);
	$stmt->store_result();
	$stmt->fetch();
	$qst_mark=$qstn_marks;
	return  $qst_mark;  
 
 
 }
 function getQstnCatName($qst_id,$mysqli)
 {
 
 
 $cat_name='';
    $query=$this->getQstnCatNameSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$qst_id);
	$result=$stmt->execute();
	$stmt->bind_result($qst_cat_name);
	$stmt->store_result();
	$stmt->fetch();
	$cat_name=$qst_cat_name;
	return  $cat_name;  
 
 }
 function deleteqstassmnt($post,$mysqli)
 
 {
	$ass_id=$post['ass_id'];
	$qst_id=$post['qstn_id'];
	$query=$this->deleteQstassSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ii',$ass_id,$qst_id);
	$result=$stmt->execute();  
	$totalmarks=$this->getTotalQstMarks($ass_id,$mysqli);
	$totalquestions=$this->getTotalQstass($ass_id,$mysqli);
	if($totalmarks=='')
	{
		$totalmarks=0;
	}
	$data=$totalmarks.'^'.$totalquestions;
	echo $data;
 
 } 
 function publishTest($post,$mysqli)
 {
	$ass_id=$post['ass_id'];
	$is_publish=$post['is_publish'];
	$published_on=date('Y-m-d');
	$publish_by=$_SESSION['PB_USER_LOGIN'];
	$query=$this->publishTestSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ssii',$is_publish,$published_on,$publish_by,$ass_id);
	$result=$stmt->execute();  
	echo "<script type='text/javascript'>window.location.href='index.php?ms=test_list'</script>";
	exit;
 
 
 } 
 
 function deleteTest($ass_id,$mysqli)
 {
	$query=$this->deleteTestSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$ass_id);
	$result=$stmt->execute();  
	$this-> deleteTestQstn($ass_id,$mysqli);
	echo "<script type='text/javascript'>window.location.href='index.php?ms=test_list'</script>";
	  exit;
 
 } 
 function deleteTestQstn($ass_id,$mysqli)
 {
	 $query=$this->deleteTestQstnSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$ass_id);
	$result=$stmt->execute();  
 
 }
 function getUserList($pb_user_id,$mysqli)
 {
 
   $assData=array();
   $query=$this->getUserListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$pb_user_id);
   $result=$stmt->execute();
   $stmt->bind_result($pb_user_id,$pb_first_name,$pb_last_name,$pb_user_email,$pb_user_contact,$pb_crt_on,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['pb_user_id']=$pb_user_id;
	 $assData[$i]['pb_first_name']=$pb_first_name;	
	 $assData[$i]['pb_last_name']=$pb_last_name;
	 $assData[$i]['pb_user_email']=$pb_user_email;	
	 $assData[$i]['pb_user_contact']=$pb_user_contact;
	 $assData[$i]['pb_crt_on']=$pb_crt_on;	
	 $assData[$i]['status']=$status;
							 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
 //  $assData= $stmt->fetch(); 
   return  $assData;
 
 }
 function getUserListPaging($pb_user_id,$offset,$rec_limit,$mysqli)
 {
 
   $assData=array();
   $query=$this->getUserListPagingSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('iii',$pb_user_id,$offset,$rec_limit);
   $result=$stmt->execute();
   $stmt->bind_result($pb_user_id,$pb_first_name,$pb_last_name,$pb_user_email,$pb_user_contact,$pb_crt_on,$status); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['pb_user_id']=$pb_user_id;
	 $assData[$i]['pb_first_name']=$pb_first_name;	
	 $assData[$i]['pb_last_name']=$pb_last_name;
	 $assData[$i]['pb_user_email']=$pb_user_email;	
	 $assData[$i]['pb_user_contact']=$pb_user_contact;
	 $assData[$i]['pb_crt_on']=$pb_crt_on;	
	 $assData[$i]['status']=$status;
							 
	 $i++;
	 } 	 	 	 	 	 			  
    }  
 //  $assData= $stmt->fetch(); 
   return  $assData;
 
 }
 function deletePbUser($pb_user_id,$mysqli)
 {
 
 
 	$query=$this->deletePbUserSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$pb_user_id);
	$result=$stmt->execute();  
	echo "<script type='text/javascript'>window.location.href='index.php?ms=user_list'</script>";
	  exit;
  }  
  
  function changeUserPass($post,$mysqli)
  {
 	$pb_user_id=$_SESSION['PB_USER_LOGIN'];
 	$newPass=sha1($post['userpassword']);
    $query=$this->updatePasswordSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('si',$newPass,$pb_user_id);
	$result=$stmt->execute(); 
	$_SESSION['CHNG_PASS_MSG']="Your Password Changed Successfully.";
	echo "<script type='text/javascript'>window.location.href='index.php?ms=change_pass'</script>";
	  exit; 
 
  }  
  
  function updateUserStatus($post,$mysqli)
  {
    $pb_user_id=$post['pb_user_id'];
    $status=$post['status'];
    $query=$this->updateUserStatusSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('si',$status,$pb_user_id);
	$result=$stmt->execute(); 
	//print_r($stmt);
	
  }
  function getTotalQstnIdAss($ass_id,$mysqli)
  {
	   $assData=array();
	   $query=$this->getTotalQstnIdAssSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$ass_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($qstn_id); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['qstn_id']=$qstn_id;
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $assData;
  }
  function getTotalQstnIdCatIdAss($ass_id,$qst_cat_id,$mysqli)
  {
	   $assData=array();
	$query=$this->getlQstnIdAssQstlCatIdSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('ii',$ass_id,$qst_cat_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($qstn_id); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['qstn_id']=$qstn_id;
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $assData;
  }
  function getAssIdByUserId($pb_user_id,$mysqli)
  {
   $assData=array();
   $query=$this->getAssIdByUserIdSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$pb_user_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['ass_id']=$ass_id;
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $assData; 
  
  
  }
  function getAtemptAss($ass_id,$pb_user_id,$mysqli)
  {
  $assData=array();
   $query=$this->getAtemptAssSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_id,$pb_user_id);
   $result=$stmt->execute();
   $stmt->bind_result($pb_as_atmid,$pb_attempt_on); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $assData[$i]['pb_as_atmid']=$pb_as_atmid;
	 $assData[$i]['pb_attempt_on']=$pb_attempt_on;
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $assData; 
  
  
  
  }
function addqstnHandler($atmt_id,$qstn_id,$mysqli)
  {
   
    $query=$this->addqstnHandlerSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('ii',$atmt_id,$qstn_id);
	$result=$stmt->execute(); 
  
  
  }
  function getNoOfCatAss($ass_id,$mysqli)
  {
  
  $catData=array();
   $query=$this->getNoOfCatAssSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($qst_cat_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $catData[$i]['qst_cat_id']=$qst_cat_id;
	
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $catData;
  
  }
  function getAssQstnByCatId($ass_id,$qst_cat_id,$mysqli)
  {
  
   $query=$this->getAssQstnByCatIdSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('ii',$ass_id,$qst_cat_id);
   $result=$stmt->execute();
   $stmt->bind_result($qstn_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
 	return $num; 
   }
   function getCatNameByCatId($qst_cat_id,$mysqli)
   {
  
 	$cat_name='';
    $query=$this->getCatNameByCatIdSql();	
	$stmt = $mysqli->stmt_init(); 
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$qst_cat_id);
	$result=$stmt->execute();
	$stmt->bind_result($qst_cat_name);
	$stmt->store_result();
	$stmt->fetch();
	 $cat_name=$qst_cat_name;
	return  $cat_name;  
   
   }
   function getTestAttemptedUser($ass_id,$mysqli)
   {
	   $atmtUser=array();
	   $query=$this->getTestAttemptedUserSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$ass_id);
	   $result=$stmt->execute();
	   $stmt->bind_result($pb_user_id,$pb_attempt_on); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
	   if($num>0)
	   { 
		 $i=0;
		 while($stmt->fetch()){
		 $atmtUser[$i]['pb_user_id']=$pb_user_id;
		 $atmtUser[$i]['pb_attempt_on']=$pb_attempt_on;
		 $i++;
		 } 	 	 	 	 	 			  
	   }  
 //  $assData= $stmt->fetch(); 
  	 return  $atmtUser;
  	 
   }
 function getQstCatRemain($pb_as_atmid,$mysqli)
 {
 	   $query=$this->getQstCatRemainSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('i',$pb_as_atmid);
	   $result=$stmt->execute();
	   $stmt->bind_result($ass_atmt_cat_id); 	  
	   $stmt->store_result();
	   $num=$stmt->num_rows();
	   return $num;
 
 }
function updateTesAtmtCat($pb_as_atmid,$qst_cat_id,$mysqli)
  {
	   $is_attempted='y';
	   $query=$this->updateTesAtmtCatSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('sii',$is_attempted,$pb_as_atmid,$qst_cat_id);
	   $result=$stmt->execute();
	 
 }
 function getUpdateQstnStatus($post,$mysqli)
 {
 
	   $status=$post['status'];
	   $qstn_id=$post['qstn_id'];
	   $query=$this->getUpdateQstnStatusSql();  
	   $stmt = $mysqli->stmt_init();  #object Class
	   $mysqli->set_charset("utf8");	  
	   $stmt->prepare($query);
	   $stmt->bind_param('si',$status,$qstn_id);
	   $result=$stmt->execute();
 
 
 }
function getAttemptedCat($pb_as_atmid,$mysqli)
 {
 
 $catData=array();
   $query=$this->getAttemptedCatSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$pb_as_atmid);
   $result=$stmt->execute();
   $stmt->bind_result($qst_cat_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   if($num>0)
   { 
     $i=0;
     while($stmt->fetch()){
	 $catData[$i]['qst_cat_id']=$qst_cat_id;
	
	
	 $i++;
	 } 	 	 	 	 	 			  
   }  
 //  $assData= $stmt->fetch(); 
   return  $catData;
 
 }
 }
?>
