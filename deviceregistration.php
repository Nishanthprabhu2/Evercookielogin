<?php session_start(); ?>
<?php if(empty($_SESSION['userid'])){ ?>
<script>alert('Session Expired');</script>
<script>window.location.href = '../login.php';</script>
<?php }?>
<?php 

include('../db.php'); 
//include('../redirect.php'); 
//require_once('../includes/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>siesta</title>
<link href="<?php// echo ROOT;?>../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php //echo ROOT;?>../css/grid.css" rel="stylesheet" type="text/css" />
<link href="<?php// echo ROOT;?>../css/basic.css" rel="stylesheet" type="text/css" />
<link href="<?php// echo ROOT;?>../css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../evercookie/js/jquery-1.4.2.min.js"></script> 
<!--<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>-->
<script src="../evercookie/js/swfobject-2.2.min.js"></script>
<script type="text/javascript" src="../evercookie/js/evercookie.js"></script>
<script type="text/javascript" src="../jquery.min.js"></script>
<script type="text/javascript" src="../evercookie/js/jquery-1.4.2.min.js"></script> 
<style>
.search-field label {
   
 float: none;
}
.search-field label {
    clear: both;
    margin: 2px 0;
    position: relative;
    text-align: left;
    width: 290px;
}
img {
    border: 0 none;
    float: right;
}

.search-field input {
    float: unset;
}
#coo_span {
	display: none;
    color: green;
    left: 15%;
    position: absolute;
    top: 75px;
    width: 96px;
	display: none;
	color: green;
}
.coMast{ clear: none !important; padding:0 20px; width: 272px !important;}
#coo_id:focus{border:1px solid green;}
#make:focus{border:1px solid green;}
#serial:focus{border:1px solid green;}
</style>
</head>
<body>
<div class="center-warpper">
<div class="wrap">
	<div class="page-content clearfix">
	<!--<a href="http://www.siestahospitality.com" class="top-logo">
			<img width="220" height="65" alt="" class="logo_set" src="../images/page-heading.png" alt="Siesta Hospitality">
		</a>
      <img src="images/logo.gif" width="94" height="100" alt="" style="float:left;" />-->
		  <h1 class="page-heading">
			<img src="../images/page-heading.png" width="246" height="70" alt="" />
		  </h1>
    </div>
    <div class="page-content clearfix">
		<?php include('../menu.php');?>
    </div>
	<!--<div id = "everid" style="display: none;">-->
		<div id = "everid"">
		<b>Device:</b> <i>uid</i> = <span id='idtag'>currently not set</span>
	</div>
	<div class="page-content clearfix">
		<div class="reservation-list-wrapper">
			<form method='post' name='searchForm' id ="searchForm" >
				<h3 class="from-heading-first">Device Registration</h3>
					<div class="search-field">
						<label class="coMast"> Device ID : <input type="text" name="coo_id" id="coo_id" placeholder="Enter numeric value"/></label>
						<span id = 'coo_span'>Enter numeric value only!</span>
						<label class="coMast">Make: <input type="text" name="make" id="make" placeholder="make"/></label>
						<label class="coMast">serial number: <input type="text" name="serial" id="serial" placeholder="Enter serial number"/></label>
						<label class="coMast">Mac Id: <input type="text" name="mac" id="mac" placeholder="Enter Mac Id"/></label>
					</div>
					<div class="submitWrap">
						<input class="inputsubmit form-submit area_add" type="submit" name="inp_submit" id="submit_btn" value="CREATE">
						<input type='hidden' name='inp_submit' value='Submit'>
					</div>
				<div id="loading" style="display:none"></div>	
			</form>	
		</div>
	</div>
  <div class="footer"></div>	
 </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    $("#coo_id").focus(function(){
		$("#coo_span").css("display", "inline").fadeOut(2000);
    });
//$("#make").click(function(){
	$("#coo_id").focusout(function() {
	var emp_chk = $('#coo_id').val();
	if (emp_chk == '')
	{
	//$("#coo_span").css("display", "inline","color","red").fadeOut(2000);	
	$( "#coo_span" ).css({
	  "display": "inline",
	  "color": "red"
	}).fadeOut(6000);
	return false;
	$("#coo_id").focus();
	}	
	else{
		$("#make").focus();
		$.ajax({ 
				type: 'POST',
				url: 'ajax_evercookie.php',
				data: 'type=check_empid&emp_chk='+emp_chk,
				dataType:'json',
				success:function(data){
					if(data.status == 1){
						//$('#equery').append(data.content);
							
						  var proceed = confirm("This device is already registered. Are you sure to continue");
						  if(proceed){
							// disable button while server is posting back
							$("#make").focus();
						  }
						  else{
							  $("#coo_id").val('');
							  $("#coo_id").focus();
						  }
						
						
					}
					else{
						//alert ('fail');
						$("#make").focus();
					}
				}
		//alert(emp_chk);
		
					
			});
		}
	});
});
	

var ec = new evercookie({
	/* Options */
});
var val = '' + Math.floor(Math.random()*1000);
getC(0);

function getC(dont)
{
	ec.get("uid", function(best, all) {
		document.getElementById('idtag').innerHTML = best;
		if (!dont)
			getC(1);
	}, dont);
}

jQuery('#submit_btn').live('click',function(){
	$("#submit_btn").hide();
	document.getElementById('idtag').innerHTML = '*creating*';
	//val = jQuery('#coo_id').val();
	var val = $('#coo_id').val();
	ec.set('uid', val);
	setTimeout(getC, 1000, 1);
	
	setTimeout(function() {
      // var coovali = jQuery('#everid span').val();
      //  alert(coovali);
	  //var Empid = $('#empid').val();
		var eid = $('#everid span').val();
		var cooid = $('#coo_id').val();
		var make = $('#make').val();
		var serial = $('#serial').val();
		var mac = $('#mac').val();
		//$('#ever_val').html(eid);
		 
		$.ajax({
			type: 'POST',
			url: 'ajax_evercookie.php',
			data: 'type=final_submit&cooid='+cooid+'&make='+make+'&serial='+serial+'&mac='+mac,
			dataType:'json',
			success:function(data){
				if(data.status == 1){
			 		//$('#equery').append(data.content);
					alert('Device successfully registered');
					window.location.href = 'deviceregistration.php';
				}
			}
		});
		
    }, 5000);
	return false;
});

</script>
<script type="text/javascript">
	jQuery.getScript('../evercookie/js/getscript.js');
</script>
<!-- external js file (async) -->
<script type="text/javascript">
	(function() {
		function async_load(){
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'http://samy.pl/evercookie/async_js.js';
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		}
		if (window.attachEvent)
			window.attachEvent('onload', async_load);
		else
			window.addEventListener('load', async_load, false);
	})();
</script>
<script>document.execCommand('ClearAuthenticationCache', 'false');</script>