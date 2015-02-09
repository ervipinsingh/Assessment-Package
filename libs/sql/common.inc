<?php
/*common sql file*/
class common_sql
  { 
/*All Functions*/
# Online Trainings Sql
function getListOfAllOnlineClassessSql()
 { 
   $query="select crs_on_id,training_title,training_url,training_details,training_agenda,date_format(training_date,'%d/%m/%Y') as training_date,training_time,training_duration 
   from tb_lms_course_classess where course_id=? and training_date=? and status='a'";
   return $query;     
 }
#Get Search Result
function getGroupNameFromGroupIdSql()
 { 
   $query="select group_name from tb_lms_course_group where group_id=?";
   return $query;    
 }
function getSearchCoursesListSql()
 { 
   $query="select course_name,course_image,course_descr,course_url,course_rating,course_dir,client_id,course_id from tb_lms_course where course_name like ? order by course_name ASC";
   return $query;     
 }
### Related Courses 

function getOtherRelatedCoursesSql()
 { 
 $query="select course_id,course_name,course_image,course_rating,course_dir,client_id from  tb_lms_course 
 where course_id not in (select course_id from tb_lms_user_crs where user_id=?) order by rand() limit 0,4";
 return $query;
 }
######Question Category By CatId
function getQstCatByCatIdSql()
{

	$sql="SELECT qst_cat_name FROM tb_pb_lms_qstn_category WHERE qst_cat_id=? AND status='a'";
	return $sql;

}

#User Functions 
function getLoggedInUserDataSql()
 { 
   $query="select user_name,login_id,user_type,user_dir,user_ip,user_mobile,user_address,user_qualif,user_univ,user_college,user_cv,user_interest,other_email
    ,user_skype,user_fburl,user_gplusurl,user_lnurl,user_summary,user_photo from tb_lms_user where user_id=?";
   return $query; 
 }
function getUserImageFromUserIdSql()
 { 
   $query="select user_dir,user_photo from tb_lms_user where user_id=?";
   return $query;    
 }
 	
####User DashBoard Functionality 
function allActiveAssignmentSql()
 { 
   $query="select asg_id,asg_title,asg_details from tb_lms_course_asg where course_id=? and status=?";
   return $query;   
 }
function allActiveAssessmentSql()
 { 
   $query="select a.ass_id,a.ass_title,a.ass_details from tb_lms_course_ass a,tb_lms_user_crs_ass b where b.usr_crs_id=? and a.ass_id=b.ass_id and a.status=?";
   return $query;     
 }
function allUsrCrsQuestionsSql()
 { 
   $query="select crs_qid,crs_q_dtl,created_by,date_format(created_on,'%d/%m/%Y') as created_on from tb_lms_usr_crs_qstn where usr_crs_id in (select usr_crs_id from tb_lms_user_crs where course_id=?) order by created_on DESC";
   return $query;  
 }
function agetAnswerCountSql()
 { 
   $query="select q_ans_id from tb_lms_usr_crs_qstn_ans where crs_qid=?";
   return $query;     
 }
function allPublicCrsLibSql()
 { 
   $query="select clib_id,lib_details,lib_file,created_by,date_format(created_on,'%d/%m/%Y') as created_on from tb_lms_course_lib where course_id=? and status=?";
   return $query;    
 }
 
function allStudentListSql()
 { 
   $query="select usr_crs_id,user_comment,created_by,date_format(created_on,'%d/%m/%Y') as created_on from tb_lms_user_crs where course_id=? and status=?";
   return $query;     
 } 
   
 function getUserDataFromUserIdSql()
  { 
   $query="select user_name,login_id from  tb_lms_user where user_id=?";
   return $query;	    
  } 
 function getOtherLibsCoursesSql()
  { 
   $query="select course_id,course_name from tb_lms_course where status='a' order by course_name ASC";
   return $query;     
  }  
  
 function getPopularCoursesListSql()
   { 
   $query="select course_id,course_name,course_image,course_descr,course_url,course_rating,course_dir,client_id from tb_lms_course where status='a' limit 0,3";
   return $query;        
   }
 function getPopularCoursesListSql2()
   { 
   $query="select course_id,course_name,course_image,course_descr,course_url,course_rating,course_dir,client_id from tb_lms_course where status='a' limit 3,5";
   return $query;        
   }   
    #
 function getUserSubscrListSql()
  { 
	   $query="select a.usr_crs_id,date_format(a.created_on,'%d/%m/%Y') as creation_date,a.is_online,a.user_comment,a.status,b.course_id,b.course_name,
	   b.course_image,b.course_descr,b.course_price,b.course_rating,b.course_dir,b.client_id
	   from tb_lms_user_crs a, tb_lms_course b  where a.user_id=? and a.course_id=b.course_id order by a.created_on DESC";
	   return $query;    
  }	
function getAllModListCourseSql()
 {
   $query="select module_id from tb_lms_crs_module where course_id=? and status=?";
   return $query;   
 } 
function getAllUserCourseNotesSql()
 { 
   $query="select note_id from  tb_lms_user_crs_notes where usr_crs_id=?";
   return $query;    
 } 
  
function getAllCourseListUnderClientSql()
 { 
   $query="select course_id,course_name from tb_lms_course where client_id=? and created_by=? order by course_name ASC";
   return $query;	   
 } 
 
function getAllCourseListUnderClientAdminSql()
 { 
   $query="select course_id,course_name from tb_lms_course where client_id=? order by course_name ASC";
   return $query;	   
 }  
 
function getUserTypeFromUserIdSql()
 { 
   $query="select user_type from tb_lms_user where user_id=?";
   return $query;   
 }  
function getCourseHeaderDataSql()
 { 
   $query="select course_name,course_image,course_descr,course_url,course_rating,course_dir,client_id from tb_lms_course where course_id=?";
   return $query;   
 }
 
function getClientDirectoryNameSql()
 { 
   $query="select client_dir from tb_lms_client where client_id=?";
   return $query;   
 } 
  
function getClientDataSql()
 { 
   $query="select client_name,client_image,client_url,client_dir from tb_lms_client where client_id=?";
   return $query;	   
 } 
function getModuleHeaderDataSql()
 { 
   $query="select course_id,module_name,module_descr,module_time from tb_lms_crs_module where module_id=?";
   return $query;   
 } 

function getAllCountryListDataSql()
  { 
   $query="select country_id,short_name from tb_country where status='a' order by short_name ASC";
   return $query;	    
  }
 function getUserNameFromUserIdSql()
  { 
   $query="select pb_first_name,pb_last_name from  tb_pb_lms_user where pb_user_id=? and status='a'";
   return $query;   
  }  
 
 function getAllCoursesListSql()
  { 
   $query="select course_id,course_name,course_image,course_descr,course_price,created_by,course_rating,course_dir,client_id  from  tb_lms_course
    where status=? order by course_name ASC";
   return $query;   
  }
  
 function getCourseFolderDirectorySql()
  { 
   $query="select a.course_dir, b.client_dir from tb_lms_course a,  tb_lms_client b where a.course_id=? and a.client_id=b.client_id";
   return $query;       
  }
function getCourseDetailsDataSql() 
  { 
   $query="select a.course_name , a.course_image,a.course_descr,a.course_url,a.course_price,a.status,date_format(a.created_on,'%d/%m/%Y') as creation_date,
   a.created_by,a.course_rating,b.client_name,b.client_email,b.client_id,b.client_descr,b.client_image,b.client_url 
   from tb_lms_course a,  tb_lms_client b where a.course_id=? and a.client_id=b.client_id";
   return $query;    
  }

function getCourseModuleListSql()
 { 
   $query="select a.module_name,a.module_id,a.module_descr,a.module_time from  tb_lms_crs_module a where a.course_id=? and a.status='a'";
   return $query;     
 }
function getCourseIdFromModIdSql()
 { 
   $query="select a.course_id,a.module_name from tb_lms_crs_module a where a.module_id=?";
   return $query;    
 }
 
function getContentDtlDataSql()
 { 
   $query="select a.cont_title,a.cont_descr,a.cont_type,a.file_path,a.file_uid,a.cont_text from tb_lms_mod_content a where a.cont_id=?";
   return $query;   
 } 
 
function getCourseNameArraySql()
 { 
   $query="select a.course_id,b.course_name from  tb_lms_crs_module a, tb_lms_course b where a.module_id=? and a.course_id=b.course_id";
   return $query;   
 } 
function getContentDataArraySql()
 { 
   $query="select a.cont_title,a.cont_descr,a.cont_type from  tb_lms_mod_content a where a.cont_id=?";
   return $query;    
 }
  
function getCourseContentListSql()
 { 
   $query="select a.cont_id,a.cont_title,a.cont_descr,a.cont_type,a.file_path from tb_lms_mod_content a where a.module_id=? and a.status='a'";
   return $query;    
 } 
function getUserAssignmentDetailsPubSql()
 { 
$query="SELECT b.asg_title,b.asg_details,b.asg_file,date_format(b.created_on,'%d/%m/%Y') as created_on,date_format(a.submit_date,'%d/%m/%Y') as submit_date,b.created_by
FROM tb_lms_user_crs_asg a, tb_lms_course_asg b where a.crs_asg_id=? and a.asg_id=b.asg_id"; 
 return $query;    
 } 

function getAssignmentSubDetailsSql()
 { 
   $query="select a.asg_sub_id,date_format(a.submit_date ,'%d/%m/%Y') as submit_date,a.asg_rate,a.asg_comment,date_format(a.asg_eval_date,'%d/%m/%Y') as asg_eval_date 
   from tb_lms_user_crs_asg_sub a where a.crs_asg_id=?";
   return $query;    
 } 

function getCourseAssignmentListSql()
{
   $query="select a.crs_asg_id,a.asg_comment,b.asg_title,b.asg_id, date_format(a.submit_date,'%d/%m/%Y') as submit_date
   from tb_lms_user_crs_asg a,tb_lms_course_asg b,tb_lms_course_asg c where a.usr_crs_id=? and a.asg_id=b.asg_id and b.asg_id=c.asg_id and c.status='a'";
   return $query;   
 } 	
function getAsignmentUserDetailsSql()
 { 
   $query="select c.user_name,c.login_id from tb_lms_user_crs_asg a, tb_lms_user_crs b,tb_lms_user c where a.crs_asg_id=? and a.usr_crs_id=b.usr_crs_id and b.user_id=c.user_id";
   return $query;   
 }
 
function getCourseUserQnListSql() 
  { 
   $query="select a.crs_qid,a.crs_q_dtl,a.created_on 
   from tb_lms_usr_crs_qstn a where a.usr_crs_id=?";
   return $query;      
  } 
function getCourseUserAssListSql()
 { 
   $query="select a.ass_id,a.ass_title,a.ass_details,a.ass_time,b.crs_ass_id 
   from  tb_lms_course_ass a,tb_lms_user_crs_ass b where b.usr_crs_id=? and b.ass_id=a.ass_id and b.status='a'";
   return $query;    
 } 
 
 function getCourseUserNotesListSql()
  { 
   $query="select a.note_id,a.note_title,a.note_details,a.note_rate 
   from tb_lms_user_crs_notes a where a.usr_crs_id=?";
   return $query;     
  }
  function getSumofMarksSql()
 {
  $query="select sum(qstn_marks) as ttlmarks from tb_lms_course_ass_qstn where `ass_id`=?";
  return $query;
 }
 ############
function getCountqstAssmntSql()
 {
  $query="select count(qstn_id) as totalqstn from tb_lms_course_ass_qstn where ass_id=?";
  return $query;
 }
 
 
 
 
 
 
 
 
 
 
 
 
 























  
    function insertPaymentDataSql()
	 { 
	   $query="insert into tb_payments(order_id,pay_name,pay_email,pay_course,pay_amount,pay_contact,pay_city,pay_state,pay_country,pay_address
	   ,pay_ip,pay_date) values(?,?,?,?,?,?,?,?,?,?,?,?)"; //ssssssssssss
	   return $query;		   
	 }	
    function getRunningCourseDataListSql()
	 { 
	   $query="select course_id,course_name from tb_course where course_status='a' order by course_name ASC";
	   return $query;
	 }
    function getListOfAllVerticalSql()
	 { 
	   $query="select vertical_id,vertical_name from tb_vertical where vertical_status='a' order by vertical_name ASC";
	   return $query;	  
	 } 	
    function getListOfAllCategorySql()
	 { 
	   $query="select cat_id,cat_name from tb_category where cat_status='a' order by cat_id ASC";
	   return $query;	  
	 }	
 function getListOfAllSubCategorySql()
   { 
   $query="select sub_cat_id,sub_cat_name from tb_sub_category where cat_id=? and sub_cat_status='a' order by sub_cat_name ASC";
   return $query;       
   }
 function getAllCourseListSql()
  { 
   $query="select course_id,course_name from tb_course where cat_id=? and course_status='a' order by course_name ASC";
   return $query;      
  } 
 function getCourseURLSql()
  { 
   $query="select course_alias,course_name from tb_course where course_id=?";
   return $query;     
   } 
 function getAllCourseListsSql()
  { 
   $query="select course_id,course_name from tb_course where course_status='a' order by course_name ASC";
   return $query;     
  } 
function getCourseDetailsSql()
 { 
  $query="select a.course_company,a.course_profile,a.course_segments,a.course_name,a.course_alias,a.course_description,a.course_schedule,course_attachment,
  a.course_fee,a.course_status,a.course_features,a.course_banner,a.course_cert_path,a.course_cert_fee,a.course_includes,a.course_url,
  a.course_meta_title,a.course_meta_kwords,a.course_meta_descr,a.is_featured,b.cat_name,c.sub_cat_name,a.sub_cat_id,a.cat_id,
  date_format(a.created_on,'%d-%m-%Y %H:%i:%s') as creation_date from tb_course a, tb_category b,tb_sub_category c
   where a.cat_id=b.cat_id and a.sub_cat_id=c.sub_cat_id and a.course_id=?";
  return $query;    
 }  
 function getOtherSimilarCoursesSql()
  {
   $query="select course_id,course_name from tb_course where course_status='a' and cat_id=? and course_id not in(?) order by course_name DESC";
   return $query; 	    
  } 
 function getCoursePublicListSetOneSql()
  { 
   $query="select course_id,course_name from tb_course where course_status='a' order by course_name DESC limit 0,10";
   return $query;       
  } 
 function getCoursePublicListSetTwoSql()
  { 
   $query="select course_id,course_name from tb_course where course_status='a' order by course_name DESC limit 10,10";
   return $query;      
  }   
function getCoursePublicListSetThreeSql()
 { 
   $query="select course_id,course_name from tb_course where course_status='a' order by course_name DESC limit 20,10";
   return $query;          
 }  
function getCoursePublicListSetFourSql()
 { 
   $query="select course_id,course_name from tb_course where course_status='a' order by course_name DESC limit 30,10";
   return $query;          
 } 
####Online Virtual Started here

function getOnlineVirtualListingSql()
 { 
   $query="select on_cat_id,on_cat_name,image_name from tb_on_course_cat where status='a' order by orders ASC";
   return $query;    
 } 
function getOnlineCatNameSql()
 { 
   $query="select on_cat_name,image_name from tb_on_course_cat where on_cat_id=?";
   return $query;    
 } 
function getAllCourseListsAllSql()
 { 
   $query="select a.on_course_name,a.on_course_alias,b.course_duration,b.on_course_id,b.on_crs_det_id,b.course_price 
   from tb_on_courses a, tb_on_course_details b where a.on_cat_id=? and a.on_course_id=b.on_course_id";
   return $query;      
 }
 
function getCourseDetailsScheduleSql()
 { 
   $query="select a.on_course_name,a.on_course_alias,b.course_duration,b.course_start_date,b.course_end_date,b.course_overview,b.on_course_id,b.on_crs_det_id from tb_on_courses a, tb_on_course_details b where a.on_course_id=? and a.on_course_id=b.on_course_id";
   return $query;     
 }
function getOnlineCourseNameAndPriceSql()
 { 
   $query="select a.on_course_name,a.on_course_alias,b.course_price from tb_on_courses a, tb_on_course_details b 
   where a.on_course_id=? and a.on_course_id=b.on_course_id";
   return $query;    
 } 
function getOnlineCourseDataSql()
 { 
   $query="select a.on_course_id,a.reason_title,a.course_reason,a.course_overview,a.course_content,a.course_schedule,a.course_objective,a.course_includes
   ,a.course_prereq,a.course_benifits,a.course_spl_offer,a.course_video,a.course_duration,a.course_start_date,a.course_end_date,a.course_price,
   a.course_discount,a.on_course_image,b.on_course_name,b.on_cat_id from tb_on_course_details a, tb_on_courses b where a.on_crs_det_id=? 
   and a.on_course_id=b.on_course_id";
   return $query;     
 } 
#### User Course LIbs

function getUserFolderDetailsSql() 
  {  
   $query="select user_dir from tb_lms_user where user_id=?";
   return $query;    
  } 
function getCourseNameFromCourseIdSql()
 { 
   $query="select course_name,course_image,course_descr,course_dir,course_rating from tb_lms_course where course_id=?";
   return $query; 
  }  
function getCourseLibsDataAllSql()
 { 
   $query="select clib_id,lib_details,lib_file,created_by, date_format(created_on,'%d/%m/%Y') as creation_date from  tb_lms_course_lib where course_id=? and status=?";
   return $query;  
 } 
function getUserLibsDataSql()
 { 
   $query="select lib_id,lib_details,lib_file,status,created_by, date_format(created_on,'%d/%m/%Y') as creation_date from tb_lms_my_libs 
   where usr_crs_id=? order by created_on DESC";
   return $query;     
 } 
function getListOfConsultQstnSql()
 { 
   $query="select qn_id,qstn_detail,qstn_file,status,posted_by, date_format(posted_on,'%d/%m/%Y') as posted_on from tb_lms_ask_trainer 
   where usr_crs_id=? order by posted_on DESC";
   return $query;    
 }  
function getListOfConsultQstnAnswerSql()
 { 
   $query="select qans_id,ans_details,ans_file,answer_by, date_format(answer_on,'%d/%m/%Y') as answer_on from tb_lms_ask_trainer_ans 
   where qn_id=? order by answer_on DESC";
   return $query;    
 }  
 function getTotalAssessmentSql()
 {
  	$query="select ass_id from tb_lms_course_ass where course_id=?";
	return $query;
 
 }
 function getAssAttempSql()
	{
		$query= "select ass_atmt_id from tb_lms_user_crs_ass_atmt where crs_ass_id=? order by ass_atmt_id DESC ";
		return $query;
	}
function getCourseIdByAssIdSql()
{
 	$sql="SELECT course_id 	FROM tb_lms_course_ass WHERE ass_id = ?";
	return $sql;
}
function getUserListSql()
{
	$sql="SELECT pb_user_id,pb_first_name,pb_last_name,pb_user_email,pb_user_contact,date_format(pb_crt_on,'%d/%m/%Y') as pb_crt_on,status FROM tb_pb_lms_user WHERE  pb_user_type='STD'";
	return $sql;

}
function getAllTestListSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass ORDER BY published_on DESC ";
		return $query;
	} 
function getAllTestQuestionListSql()
 {
 	$sql="SELECT qstn_id,qst_cat_id,qstn_type,qstn_detail,qstn_hint,diff_level,qstn_time,date_format(created_on,'%d/%m/%Y') AS created_on,created_by,status FROM tb_pb_lms_public_qstn WHERE  	created_by=? ";
	return $sql;
 
 }
function getAllPublishTestListSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass WHERE is_publish='y' AND is_scholarship=2 ORDER BY published_on DESC ";
		return $query;
	} 
}
?>
