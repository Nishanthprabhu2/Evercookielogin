<?php
session_start();
include('../db.php');
$uid = $_SESSION['userid'] ;
header('Content-Type: application/json');

//check to see if device already exists
if($_POST['type'] == 'check_empid'){
	$data = array();
	$status = 1;
	$empid = $_POST[emp_chk];
    $qry1= "select * from tbl_device_id where  device_id = '$empid' and status = 1";
	
	$result = mysql_query($qry1);
	$row = mysql_num_rows($result);
	if( $row>0 )
	{
      $status = 1;
    }
	else
	{
      $status = 0;             
    }
	$data[status] = $status;  
	$json = json_encode($data);
	print $json;
}


//update device details to tables
if($_POST['type'] == 'final_submit'){
	$data = array();
	$status = 0;
	$devid = $_POST[cooid];
	$make = $_POST[make];
	$macid = $_POST[mac];
	$serial = $_POST[serial];
	// check if device id exits - if yes, set status of previous record to 0
	$qry1= "select * from tbl_device_id where  device_id = '$devid' and status = 1";
	
	$result = mysql_query($qry1);
	$row = mysql_num_rows($result);
	if( $row>0 )
	{
		 $qry1= "update  tbl_device_id set status = 0 where  device_id = '$devid' and status = 1";
		$result = mysql_query($qry1);
    }
	
	
	$qry1 ="insert into tbl_device_id values ('', '$devid' ,'$make' , '$serial', '$macid', CURRENT_TIMESTAMP , 1, $uid,'')";
	
	$res= mysql_query($qry1);
	if($res){
	$status = 1;
	$data[status] = $status;  
	$json = json_encode($data);
	header('Content-Type: application/json');
	echo $json;}
	
}
?>