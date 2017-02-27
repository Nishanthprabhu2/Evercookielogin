<?php
require_once('../db.php');
 session_start();
if($_POST['action'] == 'savepass') {

	$empid = $_POST['empid'];
	$pwd = $_POST['password'];
	$cookie = $_POST['cookie'];
	
		
	$qry_all_users = mysql_query("SELECT * FROM tbl_transit_login_users where emp_id= $empid and password = '$pwd' and status = 1 ");
	//echo $qry_all_users;
    
	if(mysql_num_rows($qry_all_users) >=1){
		$res= mysql_fetch_array($qry_all_users);
		$empname = $res['name'];
		//echo $empname;
		//header("Location: https://tr.siestaindia.com/Transit_login_dashboard.php");
		//echo '<script type="text/javascript">
           //window.location = "https://tr.siestaindia.com/Transit_login_dashboard.php"
     // </script>';
	  $status=1;
	  $_SESSION['userid'] = $empid;
	  $_SESSION['role'] = 99;
	  $_SESSION['email'] = '';
	  $_SESSION['empname'] = $empname;
	  $_SESSION['deviceid'] = $cookie;
	  
	  
	}
	else{
		
	//header("Location: http://tr.siestaindia.com/Transit_login.php");
	$status=0;
	}
	$data[status] = $status;  
	
	$json = json_encode($data);
	print $json;
}
?>