<?php
$uid = 12345;
if($_POST['inp_submit'] == 'Submit') {
	$dev_id = $_POST[device];
	$tid = $_POST[tr];
	$selected_radio = $_POST[status];
	$uid = 12345;
	if($selected_radio == "1") {
		$status = "1";
	}else{
		$status = "0";
	}
	//INSERT INTO `trs_sales`.`tbl_device_map` (`map_id`, `dev_id`, `tid`, `status`, `uid`, `time_stamp`, `extra`) VALUES 
	//(NULL, '2', '35', '1', '123445', CURRENT_TIMESTAMP, '');
	$ins_qry = "INSERT into `tbl_device_map` values ('','$dev_id',$tid, $status,$uid,CURRENT_TIMESTAMP, '')";
	//echo $ins_qry;
	//exit;
	$sql_insert = mysql_query($ins_qry);
	
	//$insert_id = mysql_insert_id();
	
	echo "<script type='text/javascript'>alert('Device Mapped');location = 'device_tag.php';</script>";	
	
	
}


if($_POST['inp_submit'] == 'Update') {
	//include('../db.php');
	$map_id = $_POST['map_id'];
	$dev_id = $_POST[device];
	$tid = $_POST[tr];
	$selected_radio = $_POST[status];
	if($selected_radio == 1) {
		$status = (int)1;
	}else{
		$status = (int)0;
	}
	//UPDATE `tbl_device_map` SET dev_id = '$dev_id' `tid` = '$tid', status = '$status'
   //`time_stamp` = CURRENT_TIMESTAMP WHERE `tbl_device_map`.`map_id` = '$id' ;
	$qry = "UPDATE `tbl_device_map` SET  status = '$status',
   `time_stamp` = CURRENT_TIMESTAMP WHERE `map_id` = $map_id ";
   //echo $qry;
  //exit;
  //echo $qry; 
   //exit;
	$sql_insert = mysql_query($qry);
	
	echo "<script type='text/javascript'>alert('Device Mapping Updated.');location = 'device_tag.php';</script>";
}

if(isset($_GET['id'])) {
include_once('../db.php');
$map_id= $_GET['id'];
$qry_up = "SELECT * FROM `tbl_device_map` WHERE map_id = $map_id";
//echo $qry_up;	
//exit;
$qry_mapid = mysql_query($qry_up);
$res_res = mysql_fetch_array($qry_mapid);
$dev_id = $res_res[dev_id];
$tid = $res_res[tid];
$id  = $res_res[id];
//$id  = $res_res[id];
$selected_radio = $res_res[status];
if($selected_radio == "1") {
	$active = "checked";
}

if($selected_radio == "0"){
	$inactive = "checked";
}

$mode='edit';
}
?>