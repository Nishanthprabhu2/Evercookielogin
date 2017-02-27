<?php
require_once('../db.php');

if($_POST['type'] == 'get_status')
{
	$data = array();
	$status = 0;
	$eid = $_POST[eid];
	$qry1= "select * from tbl_device_id where  device_id = '$eid' and status = 1";
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
?>