<?php session_start();?>
<?php if(empty($_SESSION['userid'])){ ?>
<script>alert('Session Expired');</script>
<script>window.location.href = '../login.php';</script>
<?php }?>
<?php 
//include('../redirect.php');
include('../db.php');
if(isset($_GET['id'])) {
$uuid = $_GET['id'];
$qry_users = mysql_query("SELECT * FROM tbl_transit_login_users where emp_id = '".$_GET['id']."'");
$res_res = mysql_fetch_assoc($qry_users);
$name = $res_res[name];
$empid = $res_res[emp_id];
$mob  = $res_res[mob_num];
$status = $res_res[status];
$mode='edit';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Siesta - Register User</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/grid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="..//jquery.min.js"></script>
<script type="text/javascript" src="..//evercookie/js/jquery-1.4.2.min.js"></script> 
<script>

$(document).ready(function(){
		$('select#user_companies').css({ 'display':'none'});
		$('#show_access').css({ 'display':'none'});
		$("#submit_btn").bind('click',function(){  									  
				var name = $('#name').val();
				var empid = $('#empid').val();
				var mob = $('#mob').val();
				//var val = number.value
				if (/^\d{10}$/.test(mob)) {
					// value is ok, use it
					$( "#mob" ).css({
				"border": "1px solid #eed9ba"
				});
					
				} else {
					alert("Invalid number; must be ten digits")
					$("#mob").focus();
					$( "#mob" ).css({
				"border": "1px solid red"
				});
					return false
				}
				if( name != '' && empid != '' && mob != ''){
					
						var hasError = false;
						var validation = '';
						validation = 'Processing....';
						$('#validation').html(validation);
						// Hide 'Submit' Button
						$('#submit_btn').hide();		
						// 'this' refers to the current submitted form  
						var str = $('#createuser').serialize(); 
						// -- Start AJAX Call --
						$.ajax({  
							type: "POST",
							url: "Transit_login_register_user_ajax.php", // Send the login info to this page
							//data: 'type=register_user&str='+str, 
							data: str, 							
							dataType : "json",
							success: function(data){  
								$("#shopping-cart-table").ajaxComplete(function(event, request, settings){ 
								//alert (data);
								//alert (data.status);
								//alert(data.pwd);
								 if(data)
									{  	
										if(data.status == 1)
										{			
											$('#validation').html('User Reistration Success....');
											var password = data.pwd;
											alert('User added.  The Password is : '   +password);	
											alert('send sms');// Refers to 'status'
											window.location.href = 'Transit_login_users.php?t=s';
										}
										else if(data.status == 2){
											alert('Details updated');
											window.location.href = 'Transit_login_users.php?t=s';
										}
										else
										{
											$('#submit_btn').show();
											//$('#validation').html(data.msg);
											$('#validation').html('User Registration failure....');
											$("#empid").focus();
											alert('Employee ID already exists');
											//data.status =0;
											// Refers to 'status'
											//window.location.href = 'Transit_login_users.php';
										}
									}  
									else 
									 {  
										 $('#submit_btn').show();
										 $('#validation').html('error proccessing form');
									 } 					 
									  
								});  
									  
								  } 
								  // -- End AJAX Call --
								//return false;
									
							});
				}
		});
		});
		// end submit event

							/*var selidx = $('select#role').children('option:selected').val();
							if(selidx == 2 || selidx == 7 ){$('#show_access').css({ 'display':'block'});}	
								$('select#role').live('change', function(){
									  $('select#user_companies').css({ 'display':'none'});
									  $('#show_access').css({ 'display':'none'});
									  var idx = $(this).children('option:selected').val();
									  if(idx == 5){ $('select#user_companies').css({ 'display':'block'}); }
									  if(idx == 2 || idx == 7 ){$('#show_access').css({ 'display':'block'});}*/
									  
		

	

</script>

<style>
.form-field{ float: none !important; }
.showaccess{
	border: 1px solid #BEBCB7;
    position: absolute;
    top: 80px;
	left: 500px;
}
</style>
</head>
<body>

<div class="center-warpper">
<div class="wrap">
    <div class="page-content clearfix">
      <img src="images/logo.gif" width="94" height="100" alt="" style="float:left;" />
      <h1 class="page-heading">
        <img src="images/page-heading.png" width="246" height="70" alt="" />
      </h1>
    </div>

    <div class="page-content clearfix">
	<?php include('../menu.php');?>
    </div>
    <div class="page-content clearfix">
	<h3 class="from-heading">Create User</h3>	
	<div class="block_wrap">
	<form onsubmit="return false;" id="createuser" name="createuser">
	<input type="hidden" name="action" value="register_user"/> 
          <table class="data-table cart-table data-table3" id="shopping-cart-table">
          <colgroup>
          <col width="1">
          <col width="1">
          </colgroup>
	      <tfoot>
            <tr class="first last">
              <td class="a-right last" colspan="20">
			<div class="category-field" id="validation">
				<?php 
					if($_GET['t'] == 'e')
						{ echo "Registration failed";}
					elseif
						($_GET['t'] == 's')
							{ echo "Registration success";}
						else
							{?>&nbsp;<?php }
				?>
			</div>
			<input type="hidden" value="<?php echo $uuid;?>" name="uid"/>
			<button class="button btn-update inputsubmit" id="submit_btn" title="Submit" type="submit"><span><span>
			<?php if(!isset($uuid)){?>Create User<?php }else{?>Update User<?php }?>
			</span></span></button></td>
				</tr>
          </tfoot>

          <tbody>
	     <tr class="first last odd form-field">        	
        	<td class="a-center">Name:</td>
        	<td class="a-center"><input type="text" name="name" id="name" required value="<?php if(isset($name)) echo $name;?>"/></td>
            </tr>
			
			 <tr class="first last odd form-field">        	
        	<td class="a-center">Empid:</td>
        	<td class="a-center"><input type="text" name="empid" required id="empid" value="<?php if(isset($empid)) echo $empid;?>" <?php if(isset($empid)){ echo 'disabled';}else{'';}?> /></td>
            </tr>

	     <tr class="first last odd form-field">        	
        	<td class="a-center">Mobile number:</td>
        	<td class="a-center"><input type="text" name="mob"  required id="mob" value="<?php if(isset($mob)) echo $mob;?>" /></td>
			
            </tr>
            <tr class="first last odd">        	
        	<td class="a-center">Active:</td>
        	<td class="a-center"><input type="checkbox" name="isactive" id="isactive" value="1" <?php if(isset($status) && $status == 1){?>checked <?php }elseif(!isset($status)){ ?>checked<?php }?> /></td>
            </tr>
          </tbody>
        </table>
		


	</form>
	</div>
    </div>
    <?php $qry_all_users = mysql_query("SELECT * FROM tbl_transit_login_users");?>
    <?php if(mysql_num_rows($qry_all_users)>0){?>
    <div class="page-content">
		<h3 class="from-heading">List of Users</h3>
		<div class="reservation-list-wrapper">			
			<div class="reservation-list grid">
				<table width="100%" cellspacing="0">
 <thead>
						<tr class="headings">
							
							<th width="35%">Name</th>
                            <th width="10%">Empid</th>
						
							<th width="10%">Mobile number</th>					
							<th width="10%">Status</th>
							<th width="10%">Edit</th>
							
							<!--<th width="35%">Password</th>pattern="\d{3}[\-]\d{3}[\-]\d{4}"-->
						</tr>
					</thead>
					<tbody>
					<?php while($result= mysql_fetch_array($qry_all_users)) {?>
						<tr class="even">
						
							<td><?php echo $result[name];?><p/> </td>
							<td><?php echo $result[emp_id];?></td>	
                            <td><?php echo $result[mob_num];?></td>	
							<td class=" last"><?php if($result[status] == 1){?>Active<?php }else{ ?>Inactive<?php }?></a></td>							
							<td><a href="Transit_login_users.php?id=<?php echo $result[emp_id];?>"><img src="../images/edit-icon.png" alt="edit"/></a></td>
							
							<!--<td class=" last"><?php
							    /* $trim =preg_replace('/\s+/', '', $res[username]);
								$name_shuff = str_shuffle($trim);
								$rand = mt_rand(1,999);
								$pwd= $name_shuff ."". $rand; echo $pwd;?>
								
									$alphabets = range('A','Z');
									$numbers = range('0','9');
									$length = 8;
									 // $additional_characters = array('_','.');
									$final_array = array_merge($alphabets,$numbers);
										 
									$password = '';
								  //print_r($final_array);
									while($length--) {
									  $key = array_rand($final_array);
									  $password .= $final_array[$key];
									}
									echo $password;*/
								   //echo $result[password];
									 
									?>
								</a></td>-->
						
						</tr>
						<?php }?>	
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>	
    </div>
    <?php //} ?>
	<div class="footer"></div>
  </div>
  </div>
</div>
</body>
</html>
<script>
/*$("#mob").click(function(){
		var empid = $('#empid').val();
		$.ajax({  
			type: "POST",
			url: "Transit_login_register_user_ajax.php", // Send the login info to this page
			data: 'type=check_empid&empid='+empid,  
			dataType : 'json',
			success:function(data){
				if(data.status == 1){
							//$('#equery').append(data.content);
							alert('Employee ID already exists');
							$("#empid").focus();
								$( "#empid" ).css({
					  "border": "1px solid red"
					  
					});
						}
						else{
							
							$("#mob").focus();
							$( "#empid" ).css({
	  "border": "1px solid #eed9ba"
	  
	});
						}
					}	
	});
	});*/
	</script>