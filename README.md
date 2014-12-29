assessment-package
==================
This is a online assessment Package.

1-User can create online assessment.
2- Add Questions in library.
3- Pull Questions to Assessment .
4- Can Create Time based Test.
5- Assign to users.
6- can see the report of Users attempted assessments

and many more.

Server Requirements

PHP version 5.2.4 or newer.
for database connection we use 

function getConnectMe()
	 { 
	   $config = new msConfig();
	   $mysqli=mysqli_connect($config->hostname,$config->username,$config->password,$config->database) or die(mysqli_error());
	   return $mysqli;		    
	  }
	  
 for fetching the data 
	 
	  
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
