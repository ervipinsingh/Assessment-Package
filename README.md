Online Test Software (Sravan Technologies)
==================
This Reprository is useful for Companies, Colleges, Doctors, Non Profit Organization.
This is a  assessment Package Which is Useful for conducting online test for any domain,The test package is usful for Organizations to conduct recruitment Test. There are 4 Types of question an User can add 

1-Multiple Choice Single Answer.
2- Multiple Choice Multiple Answer
3-True/ False
4-Mathematicle Questions

An Admin can Following type of Assessment :-

1- Categorized / Uncategorized Assessment
2- Time Based Assessment 
3- Question Based Assessment
4- Public Assessment
5- Private Assessment 
6- Assign The assessment to specific User.
7- Attempt Base Assessment.
8- Categorized Question Library



Server Requirements
==================
PHP version 5.2.4 or newer.
for database connection we use 

function getConnectMe()

	 { 
	 
	   $config = new msConfig();
	   $mysqli=mysqli_connect($config->hostname,$config->username,$config->password,$config->database) or die(mysqli_error());
	   return $mysqli;		    
	 
	  }
	  
 
	 

