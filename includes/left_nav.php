<?php
 	$userType =$_SESSION['PB_USER_TYPE'];
	$mod=$_GET['ms'];
if($mod=='test_list' || $mod=='test_info' || $mod=='edit_test' || $mod=='add_test_qstn' || $mod=='test_publish' || $mod=='add_test' )
{
	$assSel="class='selected';";

}
if($mod=='qstn_list' || $mod=='qstn_details' || $mod=='add_qstn' || $mod=='edit_qstn')
{
	$qstSel="class='selected';";
}
if($mod=='user_list')
{
	$userSel="class='selected';";
} if($mod=='my_account')
{
$myacSel="class='selected';";

} if($mod=='other_test' || $mod=='test_info')
{
	$otheSel="class='selected';";

} if($mod=='change_pass')
{
	$chngSel="class='selected';";

}
if($mod=='dashboard')
{
	$dasSel="class='selected';";

}
$userData=$objPbAss->getUserList($pb_user_id,$mysqli);
$cntUser=count($userData);
$alltestData=$objPbAss->getTestList($pb_user_id,$mysqli); 
$cnttest=count($alltestData);
$qstnCData=$objCommon->getAllTestQuestionList($pb_user_id,$mysqli);
$cntQstn=count($qstnCData);
$otherTestData=$objCommon->getAllPublishTestList($mysqli);
$cntOther=count($otherTestData);
$assIdData=$objPbAss->getAssIdByUserId($pb_user_id,$mysqli);  
$cntMyac=count($assIdData);
?>

<div class="asidenavigation">
        <div class="asidenavinner">
          <div class="asideheading">Navigation</div>
          <ul>
		  <?php if($userType=='ADM') {  ?>
		   <li <?php echo $assSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=test_list">Assessment (<?php echo $cnttest; ?>)</a></li>
		   <li <?php echo $qstSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=qstn_list">Question Library (<?php echo $cntQstn; ?>)</a></li> 
           <li <?php echo $userSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=user_list">Users (<?php echo $cntUser; ?>)</a></li>
			<?php }
			else if($userType=='EMP') 	 { ?>
			
			<li <?php echo $assSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=test_list">Assessment (<?php echo $cnttest; ?>)</a></li>
		   <li <?php echo $qstSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=qstn_list">Question Library (<?php echo $cntQstn; ?>)</a></li> 
            <li <?php echo $userSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=user_list">Users (<?php echo $cntUser; ?>)</a></li>
            <?php } else { ?>
			<li <?php echo $dasSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=dashboard">Dashboard</a></li>
			<li <?php echo $myacSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=my_account">My Account (<?php echo $cntMyac; ?>)</a></li>
			<li <?php echo $otheSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=other_test">Other Assessment (<?php echo $cntOther; ?>)</a></li>
			<?php } ?>
			<li <?php echo $chngSel; ?>><a href="<?php echo HTTP_SERVER ?>index.php?ms=change_pass">Change Password</a></li>
			<li><a href="<?php echo HTTP_SERVER ?>index.php?ms=test_pass&action=logout">Logout</a></li>
           </li>
          </ul>
        </div>
      </div>
