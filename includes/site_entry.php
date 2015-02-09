<?php
 class accessPage
   { 
     function pageAccess($ms)
	   { 
	if($ms)
	   {		
	switch($ms)
		{		
			case "test_pass":include(DIR_MS_INCLUDES.FILENAME_TEST_PASS);								
			break;	
			
			case "test_details":include(DIR_WS_APP_HOME.FILENAME_PUBLIC_TEST_DETAILS);
			break;
			
			case "test_attempt" :include(DIR_WS_APP_HOME.FILENAME_TEST_ATTEMPT) ;
			break;
			
			case "user_details" : include(DIR_WS_APP_HOME.FILENAME_TEST_USER_DETAIL);
			break;
			
			case "test_rep_conf":include(DIR_WS_APP_HOME.FILENAME_TEST_REP_CONF);
			break;
			
			case "test_report" : include(DIR_WS_APP_HOME.FILENAME_TEST_REPORT);
			break;
			
			case "test_certificate" : include(DIR_WS_APP_HOME.FILENAME_TEST_CERTIFICATE);
			break;
			
			case "user_details_more" : include(DIR_WS_APP_HOME.FILENAME_TEST_UDETAIS_MORE);
			break;
			case "user_login" : include(DIR_WS_APP_HOME.FILENAME_TEST_SIGN_IN);
			break;
			case "my_account" : include(DIR_WS_APP_HOME.FILENAME_TEST_MY_ACCOUNT);
			break;
			case "email_exist" : include(DIR_WS_APP_HOME.FILENAME_TEST_EMAIL_EXIST);
			break;
			
			###############Admin Setting Start Here###################
			
			case "qstn_list" : include(DIR_WS_APP_HOME.FILENAME_TEST_QUESTION_LIST);
			break;
			case "add_qstn" : include(DIR_WS_APP_HOME.FILENAME_TEST_ADD_QSTN);
			break;
			case "edit_qstn" : include(DIR_WS_APP_HOME.FILENAME_TEST_EDIT_QSTN);
			break;
			case "test_list" : include(DIR_WS_APP_HOME.FILENAME_TEST_LIST);
			break;
			case "add_test" : include(DIR_WS_APP_HOME.FILENAME_ADD_TEST);
			break;
			case "add_test_qstn" : include(DIR_WS_APP_HOME.FILENAME_ADD_TEST_QSTN);
			break;
			case "preview_test" : include(DIR_WS_APP_HOME.FILENAME_PREVIEW_TEST);
			break;
			case "qstn_details" : include(DIR_WS_APP_HOME.FILENAME_QUESTION_DETAILS);
			break;
			case "add_pb_test_qstn" : include(DIR_WS_APP_HOME.FILENAME_ADD_PB_TEST_QUESTION);
			break;
			case "question_preview" : include(DIR_WS_APP_HOME.FILENAME_TEST_QUESTION_PREVIEW);
			break;
			case "test_preview" : include(DIR_WS_APP_HOME.FILENAME_TEST_PREVIEW);
			break;
			case "edit_test" : include(DIR_WS_APP_HOME.FILENAME_EDIT_TEST);
			break;
			case "test_publish" : include(DIR_WS_APP_HOME.FILENAME_TEST_PUBLISH);
			break;
			case "test_info" : include(DIR_WS_APP_HOME.FILENAME_TEST_INFO);
			break;
			case "user_list" : include(DIR_WS_APP_HOME.FILENAME_TEST_USER_LIST);
			break;
			case "change_pass" : include(DIR_WS_APP_HOME.FILENAME_TEST_CHANEG_PASS);
			break;
			case "other_test" : include(DIR_WS_APP_HOME.FILENAME_TEST_OTHERS);
			break;
			case "user_test_dtl" : include(DIR_WS_APP_HOME.FILENAME_USER_TEST);
			break;
			case "dashboard" : include(DIR_WS_APP_HOME.FILENAME_USER_DASHBOARD);
			break;
			case "categorize_dtl" : include(DIR_WS_APP_HOME.FILENAME_IS_CATEGORYIZE);
			break;
			case "admin_test_report" : include(DIR_WS_APP_HOME.FILENAME_ADMIN_REPORT);
			break;
			case "test_atmt_cat" : include(DIR_WS_APP_HOME.FILENAME_TEST_QST_CAT);
			break;
		
			
			###################Admin End ######################
			
		}

			}
			else { 
			include("site_pages/main.php");
			   }
		}
}
?>
