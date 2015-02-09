<?php
class common_function extends common_sql
   {	
	function getConnectMe()
	 { 
	   $config = new msConfig();
	   $mysqli=@mysqli_connect($config->hostname,$config->username,$config->password,$config->database) or die(mysqli_error());
	   return $mysqli;		    
	  }
	#Disconnect
	function getDisconnectMe($conObj)
	 { 
	  mysqli_close($conObj);		 
	  if($conObj){ return true;} else { return false;}
	 } 	
function getContentType($fileName)
 	  { 
	    if($fileName!="")
	      { 
		     $pathInfo=pathinfo($fileName);
			 $fileExt=$pathInfo['extension']; # Getting the File Extension Variable Here
		  } 
		  else 
		  {
		    $fileExt='txt';
		  }
	 return $fileExt;	  		  
	}
### Functionn Get User Details
function getLoggedInUserData($userid,$mysqli)
 { 
  $usrData=array();
  $query=$this->getLoggedInUserDataSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$userid);
  $result=$stmt->execute();
  $stmt->bind_result($user_name,$login_id,$user_type,$user_dir,$user_ip,$user_mobile,$user_address,
  $user_qualif,$user_univ,$user_college,$user_cv,$user_interest,$other_email,$user_skype,$user_fburl,$user_gplusurl,$user_lnurl,$user_summary,$user_photo); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	$stmt->fetch();
	 $usrData[$i]['user_name']=$user_name;							 
	 $usrData[$i]['login_id']=$login_id;
	 $usrData[$i]['user_type']=$user_type;	
	 $usrData[$i]['user_dir']=$user_dir;							 
	 $usrData[$i]['user_ip']=$user_ip;
	 $usrData[$i]['user_mobile']=$user_mobile;
	 $usrData[$i]['user_address']=$user_address;							 
	 $usrData[$i]['user_qualif']=$user_qualif;
	 $usrData[$i]['user_univ']=$user_univ;
	 $usrData[$i]['user_college']=$user_college;
	 $usrData[$i]['user_cv']=$user_cv;
	 $usrData[$i]['user_interest']=$user_interest;
	 $usrData[$i]['other_email']=$other_email;						 
	 $usrData[$i]['user_skype']=$user_skype;
	 $usrData[$i]['user_fburl']=$user_fburl;
	 $usrData[$i]['user_gplusurl']=$user_gplusurl;
	 $usrData[$i]['user_lnurl']=$user_lnurl;
	 $usrData[$i]['user_summary']=$user_summary;
	 $usrData[$i]['user_photo']=$user_photo;	 	 	 						  	 	 			  
   }  
   return $usrData;     
 }
	 
### Admin Dashboard Functionality Here
function allActiveAssignment($courseid,$status,$mysqli)
  { 
  $asgList=array();
  $query=$this->allActiveAssignmentSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('is',$courseid,$status);
  $result=$stmt->execute();
  $stmt->bind_result($asg_id,$asg_title,$asg_details); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $asgList[$i]['asg_id']=$asg_id;							 
	 $asgList[$i]['asg_title']=$asg_title;
	 $asgList[$i]['asg_details']=$asg_details;							  	 	 			  
	 $i++;
	 }
   }  
   return $asgList;     
  }	 
function allActiveAssessment($ucrsid,$status,$mysqli)
 { 
  $assList=array();
  $query=$this->allActiveAssessmentSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('is',$ucrsid,$status);
  $result=$stmt->execute();
  $stmt->bind_result($ass_id,$ass_title,$ass_details); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $assList[$i]['ass_id']=$ass_id;							 
	 $assList[$i]['ass_title']=$ass_title;
	 $assList[$i]['ass_details']=$ass_details;							  	 	 			  
	 $i++;
	 }
   }  
   return $assList;    
 }
function allUsrCrsQuestions($courseid,$mysqli)
 { 
  $qnList=array();
  $query=$this->allUsrCrsQuestionsSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$courseid);
  $result=$stmt->execute();
  $stmt->bind_result($crs_qid,$crs_q_dtl,$created_by,$created_on); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $qnList[$i]['crs_qid']=$crs_qid;							 
	 $qnList[$i]['crs_q_dtl']=$crs_q_dtl;
	 $qnList[$i]['created_by']=$created_by;	
	 $qnList[$i]['created_on']=$created_on;						  	 	 			  
	 $i++;
	 }
   }  
   return $qnList;    
 }
#
function getAnswerCount($crs_qid,$mysqli)
 { 
  $numAns=0;
  $query=$this->agetAnswerCountSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$crs_qid);
  $result=$stmt->execute();
  $stmt->bind_result($q_ans_id); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
   $numAns=$num;
   return $numAns;    
 }
# Course LIbs
function allPublicCrsLib($course_id,$status,$mysqli)
 { 
  $crsLib=array();
  $query=$this->allPublicCrsLibSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('is',$course_id,$status);
  $result=$stmt->execute();
  $stmt->bind_result($clib_id,$lib_details,$lib_file,$created_on); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsLib[$i]['clib_id']=$clib_id;							 
	 $crsLib[$i]['lib_details']=$lib_details;
	 $crsLib[$i]['lib_file']=$lib_file;	
	 $crsLib[$i]['created_on']=$created_on;						  	 	 			  
	 $i++;
	 }
   }  
   return $crsLib;    
 }
function allStudentList($course_id,$status,$mysqli)
 { 
  $crsStdn=array();
  $query=$this->allStudentListSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('is',$course_id,$status);
  $result=$stmt->execute();
  $stmt->bind_result($usr_crs_id,$user_comment,$created_by,$created_on); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsStdn[$i]['usr_crs_id']=$usr_crs_id;							 
	 $crsStdn[$i]['user_comment']=$user_comment;
	 $crsStdn[$i]['created_by']=$created_by;	
	 $crsStdn[$i]['created_on']=$created_on;						  	 	 			  
	 $i++;
	 }
   }  
   return $crsStdn;  
 }
 	 
function getOtherLibsCourses($mysqli)
 { 
  $crsList=array();
   $query=$this->getOtherLibsCoursesSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  #$stmt->bind_param('i',$userid);
  $result=$stmt->execute();
  $stmt->bind_result($course_id,$course_name); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsList[$i]['course_id']=$course_id;							 
	 $crsList[$i]['course_name']=$course_name;	 	 	 			  
	 $i++;
	 }
   }  
   return $crsList;         
 }
 

function getAsignmentUserDetails($crsAsgId,$mysqli)
 { 
	$userAsgArray=array();
	$query=$this->getAsignmentUserDetailsSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$crsAsgId);
	$result=$stmt->execute();
	$stmt->bind_result($user_name,$login_id); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$userAsgArray[0]['user_name']=$user_name;
	$userAsgArray[0]['login_id']=$login_id;	
	return $userAsgArray;     
 }
	
	 
function getPopularCoursesList($mysqli)
 { 
  $crsPData=array();
   $query=$this->getPopularCoursesListSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  #$stmt->bind_param('i',$userid);
  $result=$stmt->execute();
  $stmt->bind_result($course_id,$course_name,$course_image,$course_descr,$course_url,$course_rating,$course_dir,$client_id); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsPData[$i]['course_id']=$course_id;							 
	 $crsPData[$i]['course_name']=$course_name;
	 $crsPData[$i]['course_image']=$course_image;							 
	 $crsPData[$i]['course_descr']=$course_descr;
	 $crsPData[$i]['course_url']=$course_url;							 
	 $crsPData[$i]['course_rating']=$course_rating;
	 $crsPData[$i]['course_dir']=$course_dir;
	 $crsPData[$i]['client_id']=$client_id;	 	 			  
	 $i++;
	 }
   }  
   return $crsPData;      
 }

# Set 2

function getPopularCoursesList2($mysqli)
 { 
  $crsPData=array();
   $query=$this->getPopularCoursesListSql2();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  #$stmt->bind_param('i',$userid);
  $result=$stmt->execute();
  $stmt->bind_result($course_id,$course_name,$course_image,$course_descr,$course_url,$course_rating,$course_dir,$client_id); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsPData[$i]['course_id']=$course_id;							 
	 $crsPData[$i]['course_name']=$course_name;
	 $crsPData[$i]['course_image']=$course_image;							 
	 $crsPData[$i]['course_descr']=$course_descr;
	 $crsPData[$i]['course_url']=$course_url;							 
	 $crsPData[$i]['course_rating']=$course_rating;
	 $crsPData[$i]['course_dir']=$course_dir;
	 $crsPData[$i]['client_id']=$client_id;	 	 			  
	 $i++;
	 }
   }  
   return $crsPData;      
 }
 #
function getListOfAllOnlineClassess($courseid,$mysqli)
 { 
   $classData=array();
   $query=$this->getListOfAllOnlineClassessSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $date=date("Y-m-d");
   $stmt->bind_param('is',$courseid,$date);
   $result=$stmt->execute();
   $stmt->bind_result($crs_on_id,$training_title,$training_url,$training_details,$training_agenda,$training_date,$training_time,$training_duration); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $classData[$i]['crs_on_id']=$crs_on_id;							 
	 $classData[$i]['training_title']=$training_title;
	 $classData[$i]['training_url']=$training_url;							 
	 $classData[$i]['training_details']=$training_details;
	 $classData[$i]['training_agenda']=$training_agenda;							 
	 $classData[$i]['training_date']=$training_date;
	 $classData[$i]['training_time']=$training_time;
	 $classData[$i]['training_duration']=$training_duration;		 			  
	 $i++;
	 }
   }  
  return $classData;         
 }  
function getUserSubscrList($userid,$mysqli)
 { 
  $subsData=array();
   $query=$this->getUserSubscrListSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$userid);
  $result=$stmt->execute();
  $stmt->bind_result($usr_crs_id,$creation_date,$is_online,$user_comment,$status,$course_id,$course_name,$course_image,$course_descr,
  $course_price,$course_rating,$course_dir,$client_id);   
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $subsData[$i]['usr_crs_id']=$usr_crs_id;							 
	 $subsData[$i]['created_on']=$creation_date;
	 $subsData[$i]['is_online']=$is_online;
	 $subsData[$i]['user_comment']=$user_comment;							 
	 $subsData[$i]['status']=$status;
	 $subsData[$i]['course_id']=$course_id;							 
	 $subsData[$i]['course_name']=$course_name;	
	 $subsData[$i]['course_image']=$course_image;
	 $subsData[$i]['course_descr']=$course_descr;							 
	 $subsData[$i]['course_price']=$course_price;
	 $subsData[$i]['course_rating']=$course_rating;							 
	 $subsData[$i]['course_dir']=$course_dir;
	 $subsData[$i]['client_id']=$client_id;		  	 			  
	 $i++;
	 }
   }  
   return $subsData;        
 }	 

function getAllModListCourse($course_id,$status,$mysqli)
 { 
   $modCnt=0;
   $query=$this->getAllModListCourseSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('is',$course_id,$status);
   $result=$stmt->execute();
   $stmt->bind_result($module_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows(); 
   $modCnt=$num;
   return $modCnt; 
 }

function getAllUserCourseNotes($ucrsid,$mysqli)
 { 
   $noteCnt=0;
   $query=$this->getAllUserCourseNotesSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$ucrsid);
   $result=$stmt->execute();
   $stmt->bind_result($note_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows(); 
   $noteCnt=$num;
   return $noteCnt; 
 }

function getAllCoursesList($mysqli)
 { 
  $crsData="";
  $query=$this->getAllCoursesListSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $status='a';
  $stmt->bind_param('s',$status);
  $result=$stmt->execute();
  $stmt->bind_result($course_id,$course_name,$course_image,$course_descr,$course_price,$created_by,$course_rating,$course_dir,$client_id); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
  if($num>0)
   { $i=0;
	 while($stmt->fetch()){
	 $crsData[$i]['course_id']=$course_id;							 
	 $crsData[$i]['course_name']=$course_name;
	 $crsData[$i]['course_image']=$course_image;							 
	 $crsData[$i]['course_descr']=$course_descr;
	 $crsData[$i]['course_price']=$course_price;							 
	 $crsData[$i]['course_name']=$course_name;	
	 $crsData[$i]['created_by']=$created_by;
	 $crsData[$i]['course_rating']=$course_rating;							 
	 $crsData[$i]['course_dir']=$course_dir;
	 $crsData[$i]['client_id']=$client_id;	  	 			  
	 $i++;
	 }
   }  
   return $crsData;        
 }

function getAllCourseListUnderClient($client_id,$userid,$mysqli)
  { 
	$crsNameArray=array();
	$objCommon=new common_function();
	$userType=$objCommon->getUserTypeFromUserId($userid,$mysqli);
	$query=$this->getAllCourseListUnderClientSql(); 
	if($userType=='ADM' || $userType=='ACC'){
	 $query=$this->getAllCourseListUnderClientAdminSql();
	}
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	if($userType=='FAC'){
	$stmt->bind_param('ii',$client_id,$userid);
	}
	if($userType=='ADM' || $userType=='ACC'){
	$stmt->bind_param('i',$client_id);
	}	
	$result=$stmt->execute();
	$stmt->bind_result($course_id,$course_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	 $i=0;
	while($stmt->fetch())
	 {
	$crsNameArray[$i]['course_id']=$course_id;
	$crsNameArray[$i]['course_name']=$course_name;
	 $i++;
	 }
	return $crsNameArray;    
  }
  function getUserTypeFromUserId($userId,$mysqli)
   {    
	$userTp="";
	$query=$this->getUserTypeFromUserIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$userId);
	$result=$stmt->execute();
	$stmt->bind_result($user_type); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$userTp=$user_type;
	return $userTp;      
   }
function getUserTypeContentViewLimit($usrType,$mysqli)
 { 
    $contLn="";
	if($usrType=="STD") {$contLn=0;}
	if($usrType=="SA") {$contLn=2;}
	if($usrType=="CA") {$contLn=3;}
	if($usrType=="IA") {$contLn=3;}	 
	return $contLn;
 }
    
function getUserDataFromUserId($userid,$mysqli)
  { 
	$userArray="";
	$query=$this->getUserDataFromUserIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$userId);
	$result=$stmt->execute();
	$stmt->bind_result($user_type); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$userArray[0]['user_name']=$user_name;
	$userArray[0]['login_id']=$login_id;	
	return $userArray;  
  }   
#
 #	
   function getClientDirectoryName($clientid,$mysqli)
     { 
	$clientDir="";
	$query=$this->getClientDirectoryNameSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$clientid);
	$result=$stmt->execute();
	$stmt->bind_result($client_dir); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$clientDir=$client_dir;
	return $clientDir; 	   
	 }
#  
  function getCourseHeaderData($courseid,$mysqli)
   { 
	$crsHdArray="";
	$query=$this->getCourseHeaderDataSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$courseid);
	$result=$stmt->execute();
	$stmt->bind_result($course_name,$course_image,$course_descr,$course_url,$course_rating,$course_dir,$client_id); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$crsHdArray[0]['course_name']=$course_name;
	$crsHdArray[0]['course_image']=$course_image;
	$crsHdArray[0]['course_descr']=$course_descr;
	$crsHdArray[0]['course_url']=$course_url;
	$crsHdArray[0]['course_rating']=$course_rating;
	$crsHdArray[0]['course_dir']=$course_dir;	
	$crsHdArray[0]['client_id']=$client_id;
	return $crsHdArray;      
   } 
   function getModuleHeaderData($modId,$mysqli)
    { 
	$modHdArray="";
	$query=$this->getModuleHeaderDataSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$modId);
	$result=$stmt->execute();
	$stmt->bind_result($course_id,$module_name,$module_descr,$module_time); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$modHdArray[0]['course_id']=$course_id;
	$modHdArray[0]['module_name']=$module_name;
	$modHdArray[0]['module_descr']=$module_descr;
	$modHdArray[0]['module_time']=$module_time;
	return $modHdArray;  	  
	}      
  function getClientData($client_id,$mysqli)
  { 
	$clientArray="";
	$query=$this->getClientDataSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$client_id);
	$result=$stmt->execute();
	$stmt->bind_result($client_name,$client_image,$client_url,$client_dir); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$clientArray[0]['client_name']=$client_name;
	$clientArray[0]['client_image']=$client_image;
	$clientArray[0]['client_url']=$client_url;
	$clientArray[0]['client_dir']=$client_dir;
	return $clientArray;    
  }  

 function getUserNameFromUserId($userid,$mysqli)
  { 
	$username="Guest";
	$query=$this->getUserNameFromUserIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$userid);
	$result=$stmt->execute();
	$stmt->bind_result($pb_first_name,$pb_last_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$username=$pb_first_name.'&nbsp;'.$pb_last_name;
	return $username;	   
  }
  function getQstCatByCatId($qst_cat_id,$mysqli)
  {
  $catname="Guest";
	$query=$this->getQstCatByCatIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$qst_cat_id);
	$result=$stmt->execute();
	$stmt->bind_result($qst_cat_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$catname=$qst_cat_name;
	return $catname;	   
  
  
  }
# Group
  function getGroupNameFromGroupId($groupid,$mysqli)
  { 
	$groupname="";
	$query=$this->getGroupNameFromGroupIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$groupid);
	$result=$stmt->execute();
	$stmt->bind_result($group_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$groupname=$group_name;
	return $groupname;	   
  } 
 function getUserImageFromUserId($userid,$mysqli)
  { 
	$user_photo="";
	$query=$this->getUserImageFromUserIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$userid);
	$result=$stmt->execute();
	$stmt->bind_result($user_dir,$user_photo); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 	
	$stmt->fetch();

	//print_r($stmt);
	 if($user_photo!="")
	  {	 
		$usrPhoto=HTTP_SERVER.BROWSER_SEPERATOR.USER_DIRECTORY.BROWSER_SEPERATOR.$user_dir.BROWSER_SEPERATOR.$user_photo;
	  } else {$usrPhoto=HTTP_SERVER."/images/thumb_user.gif";}	
	
	return $usrPhoto;	   
  }  
function getCourseFolderDirectory($courseid,$mysqli)
 { 
	$folderArray="";
	$query=$this->getCourseFolderDirectorySql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$courseid);
	$result=$stmt->execute();
	$stmt->bind_result($course_dir,$client_dir); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$folderArray[0]['course_dir']=$course_dir;
	$folderArray[0]['client_dir']=$client_dir;
	return $folderArray;	   
 }
 function getCourseDetailsData($courseid,$mysqli)
  { 
	$courseArray="";
	$query=$this->getCourseDetailsDataSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$courseid);
	$result=$stmt->execute();
	$stmt->bind_result($course_name,$course_image,$course_descr,$course_url,$course_price,$status,$creation_date,
   $created_by,$course_rating,$client_name,$client_email,$client_id,$client_descr,$client_image,$client_url ); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	  if($num>0)
	   { $i=0;
		 $stmt->fetch();
		 $courseArray[$i]['course_name']=$course_name;							 
		 $courseArray[$i]['course_image']=$course_image;
		 $courseArray[$i]['course_descr']=$course_descr;							 
		 $courseArray[$i]['course_url']=$course_url;
		 $courseArray[$i]['course_price']=$course_price;
		 $courseArray[$i]['status']=$status;
		 $courseArray[$i]['creation_date']=$creation_date;							 
		 $courseArray[$i]['created_by']=$created_by;	
		 $courseArray[$i]['course_rating']=$course_rating;
		 $courseArray[$i]['client_name']=$client_name;							 
		 $courseArray[$i]['client_email']=$client_email;
		 $courseArray[$i]['client_id']=$client_id;
		 $courseArray[$i]['client_descr']=$client_descr;
		 $courseArray[$i]['client_image']=$client_image;
		 $courseArray[$i]['client_url']=$client_url;			 	 
	   }
	return $courseArray;    
  } 
  function getCourseStarRating($courseRate)
   { 
    if($courseRate==1) {$imageName="rating1.png";}
	if($courseRate==2) {$imageName="rating2.png";}
	if($courseRate==3) {$imageName="rating3.png";}
	if($courseRate==4) {$imageName="rating4.png";}
	if($courseRate==5) {$imageName="rating5.png";}
   return $imageName;
   }
  function getCourseModuleList($courseid,$mysqli)
   { 
	  $crsMod="";
	   $query=$this->getCourseModuleListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$courseid);
	  $result=$stmt->execute();
	  $stmt->bind_result($module_name,$module_id,$module_desc,$module_time); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
	  if($num>0)
	   { $i=0;
		 while($stmt->fetch()){
		 $crsMod[$i]['module_name']=$module_name;							 
		 $crsMod[$i]['module_id']=$module_id;
		 $crsMod[$i]['module_desc']=$module_desc;							 
		 $crsMod[$i]['module_time']=$module_time;	 			  
		 $i++;
		 }
	   }  
	   return $crsMod;        
   }    

 function getCourseContentList($modId,$mysqli)
  { 
	  $crsCont="";
	   $query=$this->getCourseContentListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$modId);
	  $result=$stmt->execute();
	  $stmt->bind_result($cont_id,$cont_title,$cont_descr,$cont_type,$file_path); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
	  if($num>0)
	   { $i=0;
		 while($stmt->fetch()){
		 $crsCont[$i]['cont_id']=$cont_id;							 
		 $crsCont[$i]['cont_title']=$cont_title;
		 $crsCont[$i]['cont_descr']=$cont_descr;							 
		 $crsCont[$i]['cont_type']=$cont_type;
		 $crsCont[$i]['file_path']=$file_path;	 			  
		 $i++;
		 }
	   }  
	   return $crsCont;            
  }
 
 function getCourseIdFromModId($modId,$mysqli)
  { 
	$courseid="";
	$query=$this->getCourseIdFromModIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$modId);
	$result=$stmt->execute();
	$stmt->bind_result($course_id,$module_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$moduleArray[0]['course_id']=$course_id;
	$moduleArray[0]['module_name']=$module_name;	
	return $moduleArray;    
  }
 
 function getCourseNameArray($modId,$mysqli)
  { 
	$courseid="";
	$query=$this->getCourseNameArraySql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$modId);
	$result=$stmt->execute();
	$stmt->bind_result($course_id,$course_name); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$courseArray[0]['course_id']=$course_id;
	$courseArray[0]['course_name']=$course_name;	
	return $courseArray;    
  } 
 function getContentDataArray($contId,$mysqli)
   { 	
	$query=$this->getContentDataArraySql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$contId);
	$result=$stmt->execute();
	$stmt->bind_result($cont_title,$cont_descr,$cont_type); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$contArray[0]['cont_title']=$cont_title;
	$contArray[0]['cont_descr']=$cont_descr;
	$contArray[0]['cont_type']=$cont_type;	
	return $contArray;       
   }
 function getContentDtlData($contId,$mysqli)
  { 
	$query=$this->getContentDtlDataSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$contId);
	$result=$stmt->execute();
	$stmt->bind_result($cont_title,$cont_descr,$cont_type,$file_path,$file_uid,$cont_text); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$contsArray[0]['cont_title']=$cont_title;
	$contsArray[0]['cont_descr']=$cont_descr;
	$contsArray[0]['cont_type']=$cont_type;
	$contsArray[0]['file_path']=$file_path;
	$contsArray[0]['file_uid']=$file_uid;
	$contsArray[0]['cont_text']=$cont_text;			
	return $contsArray;       
  }   
   
 function getCourseAssignmentList($ucrsId,$mysqli)
  { 
	  $ucrsId;
	  $crsAsg=array();
	  $query=$this->getCourseAssignmentListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$ucrsId);
	  $result=$stmt->execute();
	  $stmt->bind_result($crs_asg_id,$asg_comment,$asg_title,$asg_id,$submit_date); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
		$i=0;
		 while($stmt->fetch()){
		 $crsAsg[$i]['crs_asg_id']=$crs_asg_id;							 
		 $crsAsg[$i]['asg_comment']=$asg_comment;
		 $crsAsg[$i]['asg_title']=$asg_title;							 
		 $crsAsg[$i]['asg_id']=$asg_id;
		 $crsAsg[$i]['submit_date']=$submit_date; 			  
		 $i++;
		 }
	   return $crsAsg;     
  }
  
function getUserAssignmentDetailsPub($casgId,$mysqli)
 { 
  $asgData=array();
   $query=$this->getUserAssignmentDetailsPubSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$casgId);
  $result=$stmt->execute();
  $stmt->bind_result($asg_title,$asg_details,$asg_file,$created_on,$submit_date,$created_by); 	  
  $stmt->store_result();
   $num=$stmt->num_rows();
   #print_r($stmt);
  if($num>0){
     $i=0;
    $stmt->fetch();							 
	 $asgData[$i]['asg_title']=$asg_title;
	 $asgData[$i]['asg_details']=$asg_details;							 
	 $asgData[$i]['asg_file']=$asg_file;
	 $asgData[$i]['created_on']=$created_on;
	 $asgData[$i]['submit_date']=$submit_date;							 
	 $asgData[$i]['created_by']=$created_by;	 	 	 			  
   }  
  return $asgData;     
 }  
# Get Assignment Submission Details Here
 function getAssignmentSubDetails($casgId,$mysqli)
  { 
   
   $asgSData=array();
  $query=$this->getAssignmentSubDetailsSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$casgId);
   $result=$stmt->execute();
   $stmt->bind_result($asg_sub_id,$submit_date ,$asg_rate,$asg_comment,$asg_eval_date); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   #print_r($stmt);
  if($num>0){
     $j=0;
	
     $stmt->fetch();	
	  #print_r($stmt);						 
	 $asgSData[$j]['asg_sub_id']=$asg_sub_id;	
	 $asgSData[$j]['submit_date']=$submit_date;					 
	 $asgSData[$j]['asg_rate']=$asg_rate;
	 $asgSData[$j]['asg_comment']=$asg_comment;						 
	 $asgSData[$j]['asg_eval_date']=$asg_eval_date;	 	 	 			  
    }  
 return $asgSData;     
  }
  
 function getCourseUserQnList($ucrsId,$mysqli)
  { 
	  $ucrsId;
	  $crsQstn=array();
	  $query=$this->getCourseUserQnListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$ucrsId);
	  $result=$stmt->execute();
	  $stmt->bind_result($crs_qid,$crs_q_dtl,$created_on); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
		$i=0;
		 while($stmt->fetch()){
		 $crsQstn[$i]['crs_qid']=$crs_qid;							 
		 $crsQstn[$i]['crs_q_dtl']=$crs_q_dtl;							 
		 $crsQstn[$i]['created_on']=$created_on; 			  
		 $i++;
		 }
	   return $crsQstn;      
  }

function getCourseUserAssList($ucrsid,$mysqli)
 { 
	  //echo $ucrsid; 
	  $crsAss=array();
	  $query=$this->getCourseUserAssListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$ucrsid);
	  $result=$stmt->execute();
	  $stmt->bind_result($ass_id,$ass_title,$ass_details,$ass_time,$crs_ass_id); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
		$i=0;
		 while($stmt->fetch()){
		 $crsAss[$i]['ass_id']=$ass_id;							 
		 $crsAss[$i]['ass_title']=$ass_title;
		 $crsAss[$i]['ass_details']=$ass_details;							 
		 $crsAss[$i]['ass_time']=$ass_time;
		 $crsAss[$i]['crs_ass_id']=$crs_ass_id; 
		 $crsAss[$i]['totalqst'] =$this->getTotalQstass($crsAss[$i]['ass_id'],$mysqli);	
		 $crsAss[$i]['totalmarks'] =$this->getTotalQstMarks($crsAss[$i]['ass_id'],$mysqli);			  
		 $i++;
		 }
	   return $crsAss;   
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
   
 function getCourseUserNotesList($ucrsId,$mysqli)
  { 
	  $crsNote=array();
	  $query=$this->getCourseUserNotesListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  $stmt->bind_param('i',$ucrsId);
	  $result=$stmt->execute();
	  $stmt->bind_result($note_id,$note_title,$note_details,$note_rate); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
		$i=0;
		 while($stmt->fetch()){
		 $crsNote[$i]['note_id']=$note_id;							 
		 $crsNote[$i]['note_title']=$note_title;
		 $crsNote[$i]['note_details']=$note_details;							 
		 $crsNote[$i]['note_rate']=$note_rate; 			  
		 $i++;
		 }
	   return $crsNote;      
  }
   
  function getRunningCourseDataList($mysqli)
    { 	 
	  $crsData="";
	  $query=$this->getRunningCourseDataListSql();  
	  $stmt = $mysqli->stmt_init();  #object Class
	  $mysqli->set_charset("utf8");	  
	  $stmt->prepare($query);
	  #$stmt->bind_param('i',$cid);
	  $result=$stmt->execute();
	  $stmt->bind_result($course_id,$course_name); 	  
	  $stmt->store_result();
	  $num=$stmt->num_rows();
	  if($num>0)
	   { $i=0;
	     while($stmt->fetch()){
		 $crsData[$i]['course_id']=$course_id;							 
		 $crsData[$i]['course_name']=$course_name;			  
		 $i++;
		 }
	   }  
	   return $crsData;  
	}
   ###
  function getListOfAllVertical($mysqli)
	  { 
		$query=$this->getListOfAllVerticalSql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		//$stmt->bind_param('ii',$startPage,$perPage);	
		$stmt->execute(); 
		$stmt->bind_result($vertical_id,$vertical_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['vertical_id']=$vertical_id;			
			$dataArray[$i]['vertical_name']=$vertical_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;	
	  }	
   function getListOfAllCategory($mysqli)
	  { 
		$query=$this->getListOfAllCategorySql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		//$stmt->bind_param('ii',$startPage,$perPage);	
		$stmt->execute(); 
		$stmt->bind_result($cat_id,$cat_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['cat_id']=$cat_id;			
			$dataArray[$i]['cat_name']=$cat_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;	
	 }	
   function getListOfAllSubCategory($cat_id,$mysqli)
	  { 
		$query=$this->getListOfAllSubCategorySql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		$stmt->bind_param('i',$cat_id);	
		$stmt->execute(); 
		$stmt->bind_result($sub_cat_id,$sub_cat_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['sub_cat_id']=$sub_cat_id;			
			$dataArray[$i]['sub_cat_name']=$sub_cat_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;	
	 }	 
 function getAllCourseList($catId,$mysqli)	 	 
  { 
		$query=$this->getAllCourseListSql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		$stmt->bind_param('i',$catId);	
		$stmt->execute(); 
		$stmt->bind_result($course_id,$course_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['course_id']=$course_id;			
			$dataArray[$i]['course_name']=$course_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;    
   }
 function getCourseURL($crsId,$mysqli)
  { 
		$query=$this->getCourseURLSql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		$stmt->bind_param('i',$crsId);	
		$stmt->execute(); 
		$stmt->bind_result($course_alias,$course_name); 
		$stmt->store_result(); 
		$num=$stmt->num_rows();
		$url="";
		if($num>0)
		 {
			$stmt->fetch();															
			$url=HTTP_SERVER.'/course/'.$course_alias.'-'.$crsId;
		 }	
		$stmt->close();		
		return $url;    
  } 
 function getAllCourseLists($mysqli)	 	 
  { 
		$query=$this->getAllCourseListsSql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		#$stmt->bind_param('i',$scatId);	
		$stmt->execute(); 
		$stmt->bind_result($course_id,$course_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['course_id']=$course_id;			
			$dataArray[$i]['course_name']=$course_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;    
   }
 function getCourseData($crsId,$mysqli)
  { 
	$query=$this->getCourseDetailsSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('i',$crsId);	
	$stmt->execute(); 
	$stmt->bind_result($course_company,$course_profile,$course_segments,$course_name,$course_alias,$course_description,
	$course_schedule,$course_attachment,$course_fee,$course_status,$course_features,$course_banner,$course_cert_path,
	$course_cert_fee,$course_includes,$course_url,$course_meta_title,$course_meta_kwords,$course_meta_descr,$is_featured,
	$cat_name,$sub_cat_name,$sub_cat_id,$cat_id,$creation_date);   
	$stmt->store_result(); 
	 #
	$dataArray=array();
	$i=0;
	$num=$stmt->num_rows();	
	if($num>0)
	  {	 
	    $stmt->fetch();		
		$dataArray['course_company']=$course_company;
		$dataArray['course_profile']=$course_profile;
		$dataArray['course_segments']=$course_segments;					
		$dataArray['course_name']=$course_name;			
		$dataArray['course_alias']=$course_alias;						
		$dataArray['course_description']=$course_description;
		$dataArray['course_schedule']=$course_schedule;		
		$dataArray['course_attachment']=$course_attachment;		
		$dataArray['course_status']=$course_status;
		$dataArray['course_fee']=$course_fee;		
		$dataArray['course_features']=$course_features;	
		$dataArray['course_banner']=$course_banner;						
		$dataArray['course_cert_path']=$course_cert_path;
		$dataArray['course_cert_fee']=$course_cert_fee;
		$dataArray['course_includes']=$course_includes;		
		$dataArray['course_url']=$course_url;	
		$dataArray['course_meta_title']=$course_meta_title;						
		$dataArray['course_meta_kwords']=$course_meta_kwords;
		$dataArray['course_meta_descr']=$course_meta_descr;
		$dataArray['is_featured']=$is_featured;
		$dataArray['cat_name']=$cat_name;
	    $dataArray['sub_cat_name']=$sub_cat_name;
		$dataArray['sub_cat_id']=$sub_cat_id;
		$dataArray['cat_id']=$cat_id;
		$dataArray['creation_date']=$creation_date;																					
	 }
	#print_r($stmt);	
	$stmt->close();		
	return $dataArray;       
  }   
 function getOtherSimilarCourses($CatId,$crsId,$mysqli)
  { 
		$query=$this->getOtherSimilarCoursesSql(); 
		$stmt = $mysqli->stmt_init();  #object Class
		$mysqli->set_charset("utf8");
		$stmt->prepare($query);
		$stmt->bind_param('ii',$CatId,$crsId);	
		$stmt->execute(); 
		$stmt->bind_result($course_id,$course_name); 
		$stmt->store_result(); 
		$dataArray=array();
		$i=0;	
		while($stmt->fetch())
		 {			
			$dataArray[$i]['course_id']=$course_id;			
			$dataArray[$i]['course_name']=$course_name;													
			$i++;
		 }	
		$stmt->close();		
		return $dataArray;     
  }
 function getCoursePublicListSetOne($mysqli)
  { 
	$query=$this->getCoursePublicListSetOneSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	#$stmt->bind_param('i',$crsId);	
	$stmt->execute(); 
	$stmt->bind_result($course_id,$course_name); 
	$stmt->store_result(); 
	$dataArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$dataArray[$i]['course_id']=$course_id;			
		$dataArray[$i]['course_name']=$course_name;													
		$i++;
	 }	
	$stmt->close();		
	return $dataArray;        
  }
 function getCoursePublicListSetTwo($mysqli)
  { 
	$query=$this->getCoursePublicListSetTwoSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	#$stmt->bind_param('i',$crsId);	
	$stmt->execute(); 
	$stmt->bind_result($course_id,$course_name); 
	$stmt->store_result(); 
	$dataArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$dataArray[$i]['course_id']=$course_id;			
		$dataArray[$i]['course_name']=$course_name;													
		$i++;
	 }	
	$stmt->close();		
	return $dataArray;        
  }
####################### Function User Question and Libs Started...

function getUserFolderDetails($userid,$mysqli)
 { 
	$userDir="";
	$query=$this->getUserFolderDetailsSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$userid);
	$result=$stmt->execute();
	$stmt->bind_result($user_dir); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$userDir=$user_dir;
	return $userDir;     
 }  
function getCourseNameFromCourseId($courseid,$mysqli)
 { 
	$courseDatas=array();
	$query=$this->getCourseNameFromCourseIdSql();  
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");	  
	$stmt->prepare($query);
	$stmt->bind_param('i',$courseid);
	$result=$stmt->execute();
	$stmt->bind_result($course_name,$course_image,$course_descr,$course_dir,$course_rating); 	  
	$stmt->store_result();
	$num=$stmt->num_rows(); 
	$stmt->fetch();
	$i=0;
	$courseDatas[$i]['course_name']=$course_name;			
	$courseDatas[$i]['course_image']=$course_image;	
	$courseDatas[$i]['course_descr']=$course_descr;			
	$courseDatas[$i]['course_dir']=$course_dir;	
	$courseDatas[$i]['course_rating']=$course_rating;					
	return $courseDatas;     
 }  
 function getCourseLibsDataAll($courseid,$status,$mysqli)
  { 
	$query=$this->getCourseLibsDataAllSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('is',$courseid,$status);	
	$stmt->execute(); 
	$stmt->bind_result($clib_id,$lib_details,$lib_file,$created_by,$creation_date); 
	$stmt->store_result(); 
	$dataArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$dataArray[$i]['clib_id']=$clib_id;			
		$dataArray[$i]['lib_details']=$lib_details;
		$dataArray[$i]['lib_file']=$lib_file;			
		$dataArray[$i]['created_by']=$created_by;	
		$dataArray[$i]['creation_date']=$creation_date;																				
		$i++;
	 }	
	$stmt->close();		
	return $dataArray;        
  } 
function getUserLibsData($ucrsId,$mysqli)
 { 
	$query=$this->getUserLibsDataSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('i',$ucrsId);	
	$stmt->execute(); 
	$stmt->bind_result($lib_id,$lib_details,$lib_file,$status,$created_by,$creation_date); 
	$stmt->store_result(); 
	$dataArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$dataArray[$i]['lib_id']=$lib_id;			
		$dataArray[$i]['lib_details']=$lib_details;
		$dataArray[$i]['lib_file']=$lib_file;			
		$dataArray[$i]['status']=$status;
		$dataArray[$i]['created_by']=$created_by;	
		$dataArray[$i]['creation_date']=$creation_date;																				
		$i++;
	 }	
	$stmt->close();		
	return $dataArray;
 }
  
function getListOfConsultQstn($ucrsId,$mysqli)
 { 
	$query=$this->getListOfConsultQstnSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('i',$ucrsId);	
	$stmt->execute(); 
	$stmt->bind_result($qn_id,$qstn_detail,$qstn_file,$status,$posted_by,$posted_on); 
	$stmt->store_result(); 
	$dataArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$dataArray[$i]['qn_id']=$qn_id;			
		$dataArray[$i]['qstn_detail']=$qstn_detail;
		$dataArray[$i]['qstn_file']=$qstn_file;			
		$dataArray[$i]['status']=$status;
		$dataArray[$i]['posted_by']=$posted_by;	
		$dataArray[$i]['posted_on']=$posted_on;																				
		$i++;
	 }	
	$stmt->close();		
	return $dataArray;
 }   
function getListOfConsultQstnAnswer($qn_id,$mysqli)
 { 
	$query=$this->getListOfConsultQstnAnswerSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('i',$qn_id);	
	$stmt->execute(); 
	$stmt->bind_result($qans_id,$ans_details,$ans_file,$answer_by,$answer_on); 
	$stmt->store_result(); 
	$ansArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$ansArray[$i]['qans_id']=$qans_id;			
		$ansArray[$i]['ans_details']=$ans_details;
		$ansArray[$i]['ans_file']=$ans_file;			
		$ansArray[$i]['answer_by']=$answer_by;	
		$ansArray[$i]['answer_on']=$answer_on;																				
		$i++;
	 }	
	$stmt->close();		
	return $ansArray;    
 } 

### Search Result
function getSearchCoursesList($usrPost,$mysqli)
 {  
  	$query=$this->getSearchCoursesListSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$usrPost='%'.ucfirst($usrPost).'%';
	$stmt->bind_param('s',$usrPost);	
	$stmt->execute(); 
	$stmt->bind_result($course_name,$course_image,$course_descr,$course_url,$course_rating,$course_dir,$client_id,$course_id); 
	$stmt->store_result(); 
	$crsArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$crsArray[$i]['course_name']=$course_name;			
		$crsArray[$i]['course_image']=$course_image;
		$crsArray[$i]['course_descr']=$course_descr;			
		$crsArray[$i]['course_url']=$course_url;	
		$crsArray[$i]['course_rating']=$course_rating;
		$crsArray[$i]['course_dir']=$course_dir;			
		$crsArray[$i]['client_id']=$client_id;	
		$crsArray[$i]['course_id']=$course_id;																							
		$i++;
	 }	
	$stmt->close();		
	return $crsArray;  
 } 
### Function get Other Related Courses 
function getOtherRelatedCourses($userid,$mysqli)
 { 
  	$query=$this->getOtherRelatedCoursesSql(); 
	$stmt = $mysqli->stmt_init();  #object Class
	$mysqli->set_charset("utf8");
	$stmt->prepare($query);
	$stmt->bind_param('i',$userid);	
	$stmt->execute(); 
	$stmt->bind_result($course_id,$course_name,$course_image,$course_rating,$course_dir,$client_id); 
	$stmt->store_result(); 
	$relcArray=array();
	$i=0;	
	while($stmt->fetch())
	 {			
		$relcArray[$i]['course_id']=$course_id;			
		$relcArray[$i]['course_name']=$course_name;
		$relcArray[$i]['course_image']=$course_image;			
		$relcArray[$i]['course_rating']=$course_rating;	
		$relcArray[$i]['course_dir']=$course_dir;			
		$relcArray[$i]['client_id']=$client_id;																							
		$i++;
	 }	
	$stmt->close();		
	return $relcArray;   
 }
###
function getFileExtension($filename)
 { 
 $ext="";
$ext = end(explode('.', $filename));
$ext = substr(strrchr($filename, '.'), 1);
$ext = substr($filename, strrpos($filename, '.') + 1);
$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
$exts = split("[/\\.]", $filename);
$n = count($exts)-1;
$ext = strtolower($exts[$n]);
return $ext; 
 } 
  
function getTotalAssessment($courseid,$mysqli)
 {
 $numAns=0;
  $query=$this->getTotalAssessmentSql();  
  $stmt = $mysqli->stmt_init();  #object Class
  $mysqli->set_charset("utf8");	  
  $stmt->prepare($query);
  $stmt->bind_param('i',$courseid);
  $result=$stmt->execute();
  $stmt->bind_result($ass_id); 	  
  $stmt->store_result();
  $num=$stmt->num_rows();
  $numAss=$num;
  return $numAss;    
 
 }
 
 function getAssAttemptList($crs_ass_id, $mysqli)
 
 {
   $attemptData=array();
   $query=$this->getAssAttempSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
   $stmt->bind_param('i',$crs_ass_id);
   $result=$stmt->execute();
   $stmt->bind_result($ass_atmt_id); 	  
   $stmt->store_result();
   $num=$stmt->num_rows();
   
  if($num>0)
   {
    $i=0;
    while($stmt->fetch()){
	
		 $attemptData[$i]['ass_atmt_id']=$ass_atmt_id;
		
		 $i++;
	 }
    }  
  return $attemptData; 
 }
 function getUserList($mysqli)
 {
 
   $assData=array();
   $query=$this->getUserListSql();  
   $stmt = $mysqli->stmt_init();  #object Class
   $mysqli->set_charset("utf8");	  
   $stmt->prepare($query);
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
}     
?> 
