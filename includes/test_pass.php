<?php
 include_once(DIR_MS_INCLUDES.FILENAME_ASS_CLASS);
 $objTestCls=new public_ass();
 $action=$_GET['action'];
 $mysqli=$objTestCls->getConnectMe();
 ### For Virtual Classes
 if($action=="usedetails")
  {
 
	$objTestCls->getAddUserDetails($_POST,$mysqli); 
  } 
  if($action=='add_score_test')
  {
  
	//  print_r($_POST);
	 // die;
	  $objTestCls->addTestAnswers($_POST, $mysqli);
	  
  }
 if($action=='editdetails')
  {
  
	//  print_r($_POST);
	 // die;
	  $objTestCls->getUpdateUserDetails($_POST, $mysqli);
	  
  }
  if($action=='do_login')
  {
   //print_r($_POST);
  $objTestCls->getloginUser($_POST,$mysqli);
  
  }
  if($action=='emp_signup')
  {
   //print_r($_POST);
		$objTestCls->getSignUpEmployer($_POST,$mysqli);
  
  }
  if($action=='logout')
  {
   unset($_SESSION['PB_USER_LOGIN']);
    unset($_SESSION['PB_USER_TYPE']);
   echo "<script type='text/javascript'>window.location.href='index.php'</script>"; 
	exit;
  
  }
  if($action=='add_test_qstn')
  {
 
  $objTestCls->getAddQuestions($_POST,$mysqli);
  
  }
  if($action=='update_qstn_status')
  {
  $objTestCls->getUpdateQstnStatus($_POST,$mysqli);
  
  }
  if($action=='edit_test_qstn')
  {
  	//print_r($_POST); die;
  	$objTestCls->getEditQuestions($_POST,$mysqli);
  
  }
  if($action=='frg_pass')
  {
 	 $objTestCls->getForgotPass($_POST,$mysqli);
  
  }
  if($action=='del_qstn')
  {
 	 $objTestCls->deleteQuestion($_GET,$mysqli);
  
  }
  if($action=='add_test')
  {
  
   $ass_id=$_POST['ass_id'];
   
   if($ass_id)
	 {
		 $objTestCls->editPublicTest($_POST,$mysqli);
 	 } 
	 else {
	 
	 	 $objTestCls->addPublicTest($_POST,$mysqli);
		 
	  }
  
  }
  if($action=='add_ass_qst_marks')
  {
  $objTestCls->addQuestionTest($_POST,$mysqli);
  
  }
  if($action=='delet_ass_qst')
  {
    $objTestCls->deleteqstassmnt($_POST,$mysqli);
  }
  if($action=='publish')
  {
  
 	 $objTestCls->publishTest($_POST,$mysqli);
  
  }
  if($action=='delete_test')
  {
  	 echo $ass_id=$_GET['ass_id'];
 	 $objTestCls->deleteTest($ass_id,$mysqli);
  
  }
  if($action=='del_user')
  {
  
   $pb_user_id=$_GET['pb_u_id'];
   $objTestCls->deletePbUser($pb_user_id,$mysqli);
  
  }
  if($action=='change_pass')
  {
 	 $objTestCls->changeUserPass($_POST,$mysqli);
  }
  if($action=='update_status')
  {
   print_r($_POST);
 	 $objTestCls->updateUserStatus($_POST,$mysqli);
  }
  
?>
