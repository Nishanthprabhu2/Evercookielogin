<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=1"/>	
<title> Transit Login </title>
<style>
.logo_set{
	position: absolute;
    right: 8px;
}
#InsideContent2 {
    color: #3D3E40;
    font: 400 14px/125% "myriad-pro",sans-serif;
    margin: 0 auto;
    min-height: 260px;
    padding: 0 0 25px 25px;
    width: 965px;
}

#validation, #notification_error{ color:#ff0000; }
#loadingtext.show
{
    background-color: white;
    background-repeat: no-repeat;
    bottom: 0;
    display: block;
    font-size: 59px;
    left: 0;
    line-height: 800%;
    opacity: 100;
    position: fixed;
    right: 0;
    text-align: center;
    top: 0;
    vertical-align: middle;
    z-index: 100;
	color: red;
}
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/mobile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.raty.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.2.min.js"
			  integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
			  crossorigin="anonymous"></script>
</head>
<body class="page page-id-24 page-child parent-pageid-6 page-template-default">	
<div class="center-warpper">
<div id= "loadingtext">Identifying device..... </div>
  <div class="wrap">
	<div class="page-content clearfix">
	<a href="http://www.siestahospitality.com" class="top-logo">
			<img width="220" height="65" alt="" class="logo_set" src="../images/page-heading.png" alt="Siesta Hospitality">
		</a>
		<h3 class="from-heading">Enter your Employee ID and Password</h3>
		<form action="#" method="post" onsubmit="return false;" id="passenter">
		
			<input type="hidden" name="action" value="savepass"/>
			<ul class="category-box">
				<li class="clearfix">
					 <div class="category-field">
						Employee ID
					 </div>
					  <div class="category-rate">
						<div id="reservation" style="width: 120px; cursor: pointer;"><input type="text" name="empid" id="empid" required /></div>
					  </div>
				</li>
				<li class="clearfix odd">
					 <div class="category-field">
						Password
					 </div>
					 <div class="category-rate">
						<div id="reservation" style="width: 120px; cursor: pointer;"><input type="password" name="password" id="password"  /></div>
					 </div>
					</li> 
					<li class="clearfix">
						<div class="category-field" id="validation">&nbsp;</div>
						<div ><input class="inputsubmit" type="submit" name="submit_btn" id="submit_btn" value="Login" /></div>
					</li>
			</ul>	
		</form>
	</div>
	<input type= "hidden"  id="idtag" />
	<input type= "hidden" id="ever_val" name = "ever_val" />

</div>
<script type="text/javascript" src="../evercookie/js/jquery-1.4.2.min.js"></script> 
<script src="../evercookie/js/swfobject-2.2.min.js"></script>
<script type="text/javascript" src="../evercookie/js/evercookie.js"></script>
<script type="text/javascript" src="../js/jquery.raty.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.2.min.js"
			  integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
			  crossorigin="anonymous"></script>
</body>
</html>
<script>
$(document).ready(function(){
//$('#submit_btn').hide();	
$("div#loadingtext").addClass('show');	
});

$(document).on('click','#submit_btn',function(){
	var str = $('#passenter').serialize();
	var Empid = $('#empid').val();
	var cookie = $('#idtag').html();
	$.ajax({  
			type: "POST",
			url: "Transit_login_parser.php",  // Send the login info to this page
			data: 'cookie='+cookie+'&Empid='+Empid+'&'+str , 
			dataType : "json",
			success: function(data){ 
					if(data)
					 {  	
						if(data.status == 1){				
							$('#validation').html('Login Success....'); // Refers to 'status'
							window.location.href = 'billingdashboard.php';
						}else{
							$('#checkpass').show();
							$('#validation').html('Login failure....'); // Refers to 'status'
							
						}
					 }
			}
	});
});
</script>  
<!-- external js file (async) -->
<script type="text/javascript">
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
	
    setTimeout(function() {
      // var coovali = jQuery('#everid span').val();
      //  alert(coovali);
		var eid = $('#idtag').html();
		//call ajax to check if device is enabled or disabled
		$.ajax({
			type: 'POST',
			url: 'ajax_device_status.php',
			data: 'type=get_status&eid='+eid,
			dataType:'json',
			success:function(data){
					if (eid == '' || eid == 'undefined' || eid == 'currently not set' || data.status == 0){
			alert('This device is not authorized for billing. Please contact CSM');
			//window.location.href = 'booking.siestaindia.com';
			//location.href= "http://booking.siestaindia.com";
			 var url = "http://booking.siestaindia.com";
			$(location).attr('href',url);						
					}
				else{
			$("div#loadingtext").hide();
			$("#empid").focus();
		 $('#ever_val').html(eid);
		
		$('#submit_btn').show();
		$.ajax({
			type: 'POST',
			url: 'ajax_evercookie_testing.php',
			data: 'type=get_qry&eid='+eid,
			dataType:'json',
			success:function(data){
				if(data.status>0){
					$('#equery').append(data.content);
				}
			}
		});
	}		
			}
		});
		
    }, 5000);

	

</script>
