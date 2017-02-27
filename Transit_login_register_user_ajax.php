<?php
require_once('../db.php');
// Show all errors except the notice ones
error_reporting(E_ALL ^ E_NOTICE);
// Initialize session
session_start();
header('Cache-control: private'); // IE 6 FIX

//if($_POST['action'] == 'register_user' && $_POST['type'] == 'register_user' )
if($_POST['action'] == 'register_user' )
{
	//echo 'abc';
	$name = $_POST['name'];
	$empid = $_POST['empid'];
	$mob = $_POST['mob'];
	$isactive = (int)$_POST['isactive'];
	$userid = $_POST['uid'];
    $rows = 0;
	if(empty($userid)){
		$qry_all_users = "SELECT * FROM tbl_transit_login_users where emp_id = $empid ";
		$res = mysql_query($qry_all_users);
		$row = mysql_num_rows($res);
		if( $row>0 )
		{
			$status = 0; 
		}
		else{
			//echo 'xyz';
			//8digit password 
			$alphabets = range('a','z');
			$numbers = range('0','9');
			$length = 8;
			// $additional_characters = array('_','.');
			$final_array = array_merge($alphabets,$numbers);	 
			$password = '';
			//print_r($final_array);
			while($length--)
			{
				$key = array_rand($final_array);
				$password .= $final_array[$key];
			}
			$query = "insert into tbl_transit_login_users values('', '$name', '$empid','$mob' ,'$password','$isactive','')";
			$result = mysql_query($query);
			$data[pwd] = $password;
			$status = 1; 
		}
	}
	else{
			//echo 'wyx';
			$query = "update tbl_transit_login_users set name = '$name', mob_num = '$mob', status = '$isactive' where emp_id = $userid";
			//echo $query;
			$result = mysql_query($query);
			$status = 2; 
	}
	$data[status] = $status;  
	//echo $status;
	$json = json_encode($data);
	print $json;
}

/*if($_POST['type'] == 'check_empid')
{
	//echo 'abc';
	$data = array();
	$empid = $_POST['empid'];
	$qry_all_users = "SELECT * FROM tbl_transit_login_users where emp_id = $empid ";
	$res = mysql_query($qry_all_users);
	$row = mysql_num_rows($res);
	if( $row>0 )
	{
      $status = 1;
    }
	else
	{
      $status = 0;             
    }
	$data[status] = $status;  
	//echo $status;
	$json = json_encode($data);
	print $json;
	
}*/

?>