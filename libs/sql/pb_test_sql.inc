<?php 
class ms_pb_ass_sql
 {
 
 function getPublicAssListSql()
 {
 	 $sql="SELECT ass_id ,ass_title,ass_details,ass_instruct,ass_time,created_on,created_by FROM tb_pb_lms_public_ass WHERE is_publish ='y' AND is_public='yes'";
	 return $sql;
  }
 #############
function getAssementDetailSql()
 	{
	$query="select stream_id,ass_title,ass_details,ass_instruct,ass_time,ass_attempt, qstn_count ,date_format(created_on,'%d/%m/%Y') as created_on,created_by,qstn_count,is_categorized ,is_scholarship,is_publish,published_on,publish_by,status from tb_pb_lms_public_ass  where ass_id=? ";
	return $query;
 	}
 function getQstnCatNameSql()
 {
	 $sql="SELECT a.qst_cat_name FROM tb_pb_lms_qstn_category a,tb_pb_lms_public_qstn b WHERE b.qst_cat_id =a.qst_cat_id AND b.qstn_id=?";
	 return $sql;
 }
###########
  function getSignUpEmployerSql()
  {
	  $sql="INSERT INTO tb_pb_lms_user SET pb_user_type='EMP', pb_first_name=?,pb_user_email=?,user_password=?,pb_user_contact=?";
	  return $sql;
  }
function getSumofMarksSql()
 {
	  $query="select sum(qstn_marks) as ttlmarks from tb_pb_lms_public_ass_qstn where `ass_id`=?";
	  return $query;
 }
 ############
function getCountqstAssmntSql()
 {
	  $query="select count(qstn_id) as totalqstn from tb_pb_lms_public_ass_qstn where ass_id=?";
	  return $query;
 }
 ############
 
function getAddUserDetailsSql()
 {
 
 	$query="INSERT INTO tb_pb_lms_user(pb_first_name,pb_last_name,pb_user_email,pb_user_contact,pb_crt_on,ip_address,pub_user_qualif, pub_user_college,pub_user_stream,pub_user_city,user_password ) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
	return $query;
 }
 
function getSingleQstDetailsCatSql()
 { 
   $query="SELECT a.ass_q_id, a.qstn_id, a.qstn_marks, b.qstn_detail, b.qstn_hint, b.qstn_time, b.qstn_type
FROM tb_pb_lms_public_ass_qstn a, tb_pb_lms_public_qstn b
WHERE a.ass_id =? AND a.qst_cat_id=?  AND a.qstn_id = b.qstn_id  order by a.ass_q_id ASC LIMIT 0 , 1";
   return $query;     
 }
 function getSingleQstDetailsSql()
 { 
   $query="SELECT a.ass_q_id, a.qstn_id, a.qstn_marks, b.qstn_detail, b.qstn_hint, b.qstn_time, b.qstn_type
FROM tb_pb_lms_public_ass_qstn a, tb_pb_lms_public_qstn b
WHERE a.ass_id =?   AND a.qstn_id = b.qstn_id order by a.ass_q_id ASC LIMIT 0 , 1";
   return $query;     
 }
function getSingleQstDetailsByQstIdSql()
 { 
   $query="SELECT a.ass_q_id, a.qstn_id, a.qstn_marks, b.qstn_detail, b.qstn_hint, b.qstn_time, b.qstn_type
FROM tb_pb_lms_public_ass_qstn a, tb_pb_lms_public_qstn b
WHERE a.ass_id =?  AND a.qstn_id= ? and a.qstn_id = b.qstn_id order by a.ass_q_id ASC LIMIT 0 , 1";
   return $query;     
 }
function getQstnIdbyAssqIdSql()
{
	$query="select qstn_id from tb_pb_lms_public_ass_qstn where ass_q_id=?";
	return $query;
}
 ###########
function getQuestionOptionsSql()
 { 
  	$query="select a.qst_opt_id,a.qst_opt_val,a.right_flag from tb_pb_lms_public_qstn_optn a where a.qstn_id=?";
    return $query;     
 } 
 ###########
function getAllAssQuestionListSql()
 { 
   $query="select
a.pb_atm_hand_id,a.qstn_id, a.qst_opt_id, a.pb_is_review, a.pb_opt_on, b.ass_id, b.pb_attempt_on,
d.qstn_detail,d.qstn_hint,d.diff_level,d.qstn_type,d.qstn_time,
e.qstn_marks
from
tb_pb_lms_user_ass_atmt_hand a,
tb_pb_lms_user_ass_atmt b,
tb_pb_lms_public_ass c,
tb_pb_lms_public_qstn d,
tb_pb_lms_public_ass_qstn e
where
a.pb_as_atmid=? and a.pb_as_atmid=b.pb_as_atmid and b.ass_id=c.ass_id
and a.qstn_id=d.qstn_id and b.ass_id=e.ass_id and a.qstn_id=e.qstn_id
";
   return $query;     
 }
 function getPreviewTestSql()
 { 
   $query="select b.qstn_id,b.qstn_marks,a.qstn_detail,a.qstn_hint,
a.diff_level,a.qstn_time,date_format(a.created_on,'%d/%m/%Y') as created_on,
 a.created_by,a.status,a.qstn_type
from tb_pb_lms_public_ass_qstn b, tb_pb_lms_public_qstn a where b.qstn_id = a.qstn_id  and  b.ass_id=? ";
   return $query;     
 }
function getAssQstPagingSql()
 {
 
	 $query="select ass_q_id,qstn_id from tb_pb_lms_public_ass_qstn where ass_id=?";
	 return $query;
 
 }
 function getAssQstPagingQstCatIdSql()
 {
 
	 $query="select ass_q_id,qstn_id from tb_pb_lms_public_ass_qstn where ass_id=? AND qst_cat_id=?";
	 return $query;
 
 }
function getNextAssQstnIdSql()
{
	$query="select ass_q_id from tb_pb_lms_public_ass_qstn where ass_q_id > ? and ass_id=? limit 0,1";
	return $query;
}
function getNextAssQstnIdCatSql()
{
	$query="select ass_q_id from tb_pb_lms_public_ass_qstn where ass_q_id > ? and ass_id=? and qst_cat_id= ?  limit 0,1";
	return $query;
}
function addTestAttemptSql()
{

	$sql="INSERT INTO tb_pb_lms_user_ass_atmt (pb_user_id,ass_id,pb_ip_address,pb_attempt_on,pb_browser_name,cert_no) VALUES(?,?,?,?,?,?)";
	return $sql;

}
function addTestAnswersSql()
{

	$sql="UPDATE tb_pb_lms_user_ass_atmt_hand SET qst_opt_id=?,user_space=?,pb_opt_on=? WHERE  pb_as_atmid= ? AND qstn_id= ? ";
	return $sql;
}
function getOptIdAssreportSql()
	{
		$query="select qst_opt_id from tb_pb_lms_user_ass_atmt_hand where pb_as_atmid =? and  qstn_id=?";
		return $query;
	}
function getAnsExplantionSql()
{
	$query="select user_space from tb_pb_lms_user_ass_atmt_hand where pb_as_atmid =? and  qstn_id=?";
	return $query;
}
function getAttemptAssQstSql()
{
	$query="SELECT pb_atm_hand_id FROM tb_pb_lms_user_ass_atmt_hand WHERE  	pb_as_atmid=? AND qst_opt_id IS NOT NULL";
	return $query;
}
function getRightAssAsnSql()
{
	$query="select  count(a.qstn_id) as right_qstn ,sum(c.qstn_marks) as marksobtn from tb_pb_lms_user_ass_atmt_hand a,tb_pb_lms_public_qstn_optn b,tb_pb_lms_public_ass_qstn c where a.pb_as_atmid=? and c.ass_id=? and a.qstn_id=c.qstn_id and b.right_flag='T' and a.qst_opt_id=b.qst_opt_id
and a.qstn_id=b.qstn_id  and a.qst_opt_id IS NOT NULL";
	return $query;
}

function getPublicUserDeratailSql()
{

 	$sql="SELECT pb_user_type,pb_first_name,pb_last_name,pb_user_email,pb_user_contact,date_format(pb_crt_on,'%d-%m-%Y') as pb_crt_on,pub_user_qualif,pub_user_college,pub_user_stream,pub_user_city,is_claimed FROM tb_pb_lms_user WHERE pb_user_id=?";
	return $sql;

}
function getCertificateNoSql()
{

	$sql= "SELECT cert_no FROM tb_pb_lms_user_ass_atmt WHERE pb_as_atmid=?";
	return $sql;
}
function getUpdateUserDetailSql()
{
		
	$sql="UPDATE tb_pb_lms_user SET pb_first_name=?,pb_last_name=?,pb_user_contact=?, pub_user_qualif=?, pub_user_college=?,pub_user_stream=?,pub_user_city=?,is_claimed=? WHERE pb_user_id=?	";
	return $sql;

}
function getloginUserSql()
{
 	$query="select pb_user_id,pb_user_type,pb_first_name from tb_pb_lms_user where pb_user_email=? and user_password=? and status=?";
	 return $query;        
 
}
function getEmailExistSql()
{
	$query="select pb_user_id from tb_pb_lms_user where pb_user_email=? ";
	 return $query;    

}
function getTestAnalysisSql()
{
	$sql="SELECT a.pb_as_atmid ,a.pb_user_id ,date_format(a.pb_attempt_on,'%d-%m-%Y')as pb_attempt_on,a.ass_id 	FROM tb_pb_lms_user_ass_atmt a,tb_pb_lms_public_ass b WHERE a.ass_id=? ORDER BY a.pb_attempt_on DESC ";
	return $sql;
}
function getQstCalSql()
{

$sql="SELECT qst_cat_id,qst_cat_name  FROM  tb_pb_lms_qstn_category WHERE  	status='a' ";
return $sql;

}
function getAddQuestionSql()
{
	$query="INSERT INTO tb_pb_lms_public_qstn (qst_cat_id,qstn_type,qstn_detail,qstn_hint,diff_level,qstn_time,created_on,created_by) VALUES(?,?,?,?,?,?,?,?)";
	return $query;

}  
function getAddoptionsSql()
 {
	 $query= "INSERT INTO tb_pb_lms_public_qstn_optn(qstn_id,qst_opt_val,right_flag) VALUE( ?,?,? )";
 	 return $query;
 }  
 function getAllTestQuestionListSql()
 {
 	$sql="SELECT qstn_id,qst_cat_id,qstn_type,qstn_detail,qstn_hint,diff_level,qstn_time,date_format(created_on,'%d/%m/%Y') AS created_on,created_by,status FROM tb_pb_lms_public_qstn WHERE created_by=?";
	return $sql;
 
 }
 function getAllTestQuestionListPageSql()
 {
 	$sql="SELECT qstn_id,qst_cat_id,qstn_type,qstn_detail,qstn_hint,diff_level,qstn_time,date_format(created_on,'%d/%m/%Y') AS created_on,created_by,status FROM tb_pb_lms_public_qstn WHERE  	created_by=? LIMIT ?,?";
	return $sql;
 
 }
 function getAllTestQuestionListByCatSql()
 {
 	$sql="SELECT qstn_id,qst_cat_id,qstn_type,qstn_detail,qstn_hint,diff_level,qstn_time,date_format(created_on,'%d/%m/%Y') AS created_on,created_by,status FROM tb_pb_lms_public_qstn WHERE  	created_by=?  AND qst_cat_id=? AND status='a'";
	return $sql;
 
 }
 function getSingleQstDtlsByIdSql() 
 { 
   $query="select a. 	qst_cat_id,a.qstn_type,a.qstn_detail,a.qstn_hint,a.diff_level,a.qstn_time,date_format(a.created_on,'%d/%m/%Y') as created_on, a.created_by,a.status
   from tb_pb_lms_public_qstn a where a.qstn_id=?";
   return $query;  
 } 
 function updateQuestionSql()
 {
 	$query="UPDATE  tb_pb_lms_public_qstn SET qst_cat_id=? ,qstn_detail=? ,qstn_hint=?,diff_level=?,qstn_time=? WHERE qstn_id=? ";
	return $query;
 }

 function updateOptionSql()
 {
 	$query="UPDATE  tb_pb_lms_public_qstn_optn SET qst_opt_val=? ,right_flag=?  WHERE qst_opt_id=? AND qstn_id=? ";
	return $query;
 
 }
 function updateOptionFlagSql()
 {
 	$query="UPDATE tb_pb_lms_public_qstn_optn SET right_flag='F' WHERE qstn_id=?  ";
	return $query;
 
 }
 function updatePassSql()
 {
	 $query="UPDATE tb_pb_lms_user SET user_password=? WHERE pb_user_email=?";
	 return $query;
 }
 function deleteQuestionSql()
 {
 	$query="DELETE FROM tb_pb_lms_public_qstn WHERE qstn_id=?";
	return $query;
 
 }
 function deleteQstnOptSql()
 {
 	$query="DELETE FROM tb_pb_lms_public_qstn_optn WHERE qstn_id=?";
	return $query;
 
 
 }
 function getUserTypeSql()
{
	$sql="SELECT pb_user_type FROM  tb_pb_lms_user WHERE pb_user_id= ?";
	return $sql;
}
function getTestListSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass where created_by= ? ";
		return $query;
	} 
	function getTestListPagingSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass where created_by= ? LIMIT ?,?";
		return $query;
	} 
function getAllTestListSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass ORDER BY published_on DESC ";
		return $query;
	} 
function getAllPublishTestListSql()
	{
		$query="select ass_id,stream_id,ass_title,ass_details, 	ass_instruct,ass_time,ass_attempt,date_format(created_on,'%d/%m/%Y') as created_on,created_by,is_publish,
		date_format(published_on,'%d/%m/%Y') as published_on,publish_by ,status from  tb_pb_lms_public_ass WHERE is_publish='y' AND  	is_scholarship=2 ORDER BY published_on DESC ";
		return $query;
	} 
function getStreamListSql()
{

	$sql="SELECT stream_id,stream_name FROM tb_pb_lms_ass_stream WHERE status='a'";
	return $sql;

}
function editAssessmentSql()
	 { 
		$query="UPDATE tb_pb_lms_public_ass SET stream_id=?,ass_title=?,ass_details=?,ass_instruct=?,ass_time=?,ass_attempt=?, qstn_count=?, created_on=?,created_by=?, is_categorized=? WHERE ass_id=?";	
		return $query;
	 }
 function addAssessmentSql()
	 { 
		$query="INSERT INTO tb_pb_lms_public_ass SET stream_id=?,ass_title=?,ass_details=?,ass_instruct=?,ass_time=?,ass_attempt=?,qstn_count=?, created_on=?,created_by=? ,is_categorized=? ";	
		return $query;
	 }
 function getAddQsttoAssSql()
 {
	 $query="insert into tb_pb_lms_public_ass_qstn(ass_id,qstn_id,qst_cat_id,qstn_marks,created_by) values(?,?,?,?,?)"; 
	 return $query;
 }
 function getQuestionexistassSql()
 {
 	$query="select ass_q_id  from tb_pb_lms_public_ass_qstn where qstn_id=? and ass_id= ?";
	return $query;
 }
 function getSingleQstMarksSql()
 {
	$query="select qstn_marks from tb_pb_lms_public_ass_qstn where ass_id= ? and qstn_id =? ";
	return $query;
 }
 function deleteQstassSql()
 {
	  $query="delete from tb_pb_lms_public_ass_qstn where ass_id=? and qstn_id=?";
	  return $query;
 }
function publishTestSql()
{

	$sql="UPDATE tb_pb_lms_public_ass SET is_publish=?,published_on=?,publish_by=? WHERE ass_id=?";
	return $sql;

}
function deleteTestSql()
{
	$sql="DELETE FROM tb_pb_lms_public_ass WHERE ass_id=?";
	return $sql;
}
function deleteTestQstnSql()
{
	$sql="DELETE FROM tb_pb_lms_public_ass_qstn WHERE ass_id=?";
	return $sql;
}
function getUserListSql()
{
	$sql="select pb_user_id,pb_first_name,pb_last_name,pb_user_email,pb_user_contact,date_format(pb_crt_on,'%d/%m/%Y') as pb_crt_on,status from tb_pb_lms_user where pb_user_id in (select pb_user_id from tb_pb_lms_user_ass_atmt a join tb_pb_lms_public_ass b on a.ass_id=b.ass_id where b.created_by=?)";
	return $sql;

}
function getUserListPagingSql()
{
	$sql="select pb_user_id,pb_first_name,pb_last_name,pb_user_email,pb_user_contact,date_format(pb_crt_on,'%d/%m/%Y') as pb_crt_on,status from tb_pb_lms_user where pb_user_id in (select pb_user_id from tb_pb_lms_user_ass_atmt a join tb_pb_lms_public_ass b on a.ass_id=b.ass_id where b.created_by=?)  LIMIT ?,?";
	return $sql;

}
function deletePbUserSql()
{
	$query="DELETE FROM tb_pb_lms_user WHERE pb_user_id=?";
	return $query;
}
function updatePasswordSql()
{
	$sql="UPDATE tb_pb_lms_user SET user_password= ? WHERE 	pb_user_id=?";
	return $sql;
}
function updateUserStatusSql()
{
	$sql="UPDATE tb_pb_lms_user SET status=? WHERE pb_user_id=?";
	return $sql;
}
############ Attempt ASSESSMENT PROCESS ############
function getNoOfCatAssSql()
{
	$sql="SELECT DISTINCT qst_cat_id FROM tb_pb_lms_public_ass_qstn WHERE ass_id=? ORDER BY qst_cat_id ASC";
	return $sql;
}
function getTotalQstnIdAssSql()
{
	$sql="SELECT qstn_id FROM tb_pb_lms_public_ass_qstn WHERE ass_id =?";
	return $sql;
}
function getlQstnIdAssQstlCatIdSql()
{
	$sql="SELECT qstn_id FROM tb_pb_lms_public_ass_qstn WHERE ass_id =? AND qst_cat_id=?";
	return $sql;
}
function addqstnHandlerSql()
{
	$sql="INSERT INTO tb_pb_lms_user_ass_atmt_hand SET pb_as_atmid=?, qstn_id=? ";
	return $sql;
}
function getAssIdByUserIdSql()
{
	$sql="SELECT DISTINCT ass_id FROM tb_pb_lms_user_ass_atmt WHERE pb_user_id=?";
	return $sql;
}
function getAtemptAssSql()
{
	$sql="SELECT pb_as_atmid , date_format(pb_attempt_on,'%d/%m/%Y') as pb_attempt_on FROM tb_pb_lms_user_ass_atmt WHERE ass_id =? AND pb_user_id=? ";
	return $sql;

}
function getAssQstnByCatIdSql()
{
	$sql="SELECT qstn_id FROM tb_pb_lms_public_ass_qstn WHERE ass_id=? AND qst_cat_id=?";
	return $sql;
}
function getCatNameByCatIdSql()
{
	$sql="SELECT qst_cat_name FROM tb_pb_lms_qstn_category WHERE  qst_cat_id=?";
	return $sql;
}
function getTestAttemptedUserSql()
{
	 $sql="SELECT DISTINCT `pb_user_id`,date_format(`pb_attempt_on`,'%d/%m/%Y') AS pb_attempt_on FROM   tb_pb_lms_user_ass_atmt  WHERE `ass_id`=? GROUP BY pb_user_id";
	 return $sql;

}
function addAssQstCateSql()
{
	$sql= "INSERT INTO tb_pb_lms_ass_atmt_cat SET pb_as_atmid=? , qst_cat_id=? ";
	return $sql;
}
function getQstCatRemainSql()
{
	$sql="SELECT ass_atmt_cat_id FROM tb_pb_lms_ass_atmt_cat WHERE pb_as_atmid=? AND is_attempted='n'";
	return $sql;
}
function updateTesAtmtCatSql()
{
	$sql="UPDATE tb_pb_lms_ass_atmt_cat SET is_attempted=? WHERE pb_as_atmid=? AND qst_cat_id=?";
	return $sql;
}
function getAttemptedCatSql()
{
	$sql="SELECT qst_cat_id  FROM tb_pb_lms_ass_atmt_cat WHERE pb_as_atmid=? AND is_attempted='y'";
	return $sql;
}
function getUpdateQstnStatusSql()
{
	$sql="UPDATE tb_pb_lms_public_qstn SET status=? WHERE qstn_id=?";
	return $sql;
}
 }
 ?>
