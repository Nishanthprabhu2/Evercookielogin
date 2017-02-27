<?php session_start(); ?>
<?php if(empty($_SESSION['userid'])){ ?>
<script>alert('Session Expired');</script>
<script>window.location.href = '../login.php';</script>
<?php }?>
<?php
//include('../redirect.php');
include('../db.php');
include('device_tag_post.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>siesta</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/grid.css" rel="stylesheet" type="text/css" />
<link href="../css/calendar.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.2.2.min.js"
			  integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
			  crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/plugin/date.js"></script>
<script type="text/javascript" src="../js/plugin/jquery.datepicker.js"></script>
<script type="text/javascript" src="../js/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="../js/sistea/sistea.js"></script>
<script type="text/javascript">
   /*$(document).ready(function() {
        $('input#inp_submit').live('click', function(){
              var sid = $('select#state').children('option:selected').val();
			  var regclass = $('select#regionclassified').children('option:selected').text();
	          var name = $('#name').val();
              var ophead = $('#ophead').val();
              var opemail = $('#ename').val();

              $('#validation').html('');
              if(name == ''){ $('#validation').html('Please Enter Name.'); return false; }
              if(sid == ''){ $('#validation').html('Please choose a state.'); return false; } 
              if(ophead == ''){ $('#validation').html('Please Enter Opearational Head.'); return false; } 
              if(opemail == ''){ $('#validation').html('Please Enter Opearational Head Email.'); return false; } 
			  if(regclass == ''){ $('#validation').html('Please choose Region Classification.'); return false; } 
              $.ajax({  
	         type: "POST",
	         url: "ajax_city.php",  
	         data: 'type=checkCityAvailability&name='+name+'&sid='+sid,
	         success: function(data){
                     if(data==1){ $('#validation').html('Error! City already exists.'); return false; 
                     }else{ $("#frm_entry").submit();
                     return false; }
                 },
                 failure: function(){}
             });return false;
        });


        $('input#inp_update').live('click', function(){

            var radio = $("input:checked[name=status]").val();

            if(radio == 0){
            var sid = $('select#state').children('option:selected').val();
	        var name = $('#name').val();
            var ophead = $('#ophead').val();
            var opemail = $('#ename').val();
            $.ajax({  
	         type: "POST",
	         url: "ajax_city.php",  
	         data: 'type=checkCityExistence&name='+name+'&sid='+sid,
	         success: function(data){
                     if(data==1){ $('#validation').html('Error! Area exists.'); return false; 
                     }else{ $("#frm_entry").submit();
                     return false; }
                 },
                 failure: function(){}
             });
             return false;
            }

        });
   });*/
</script>
</head>
<body>
  <div class="center-warpper">
   <div class="wrap">

    <div class="page-content clearfix">
      <img src="../images/logo.gif" width="94" height="100" alt="" style="float:left;" />
      <h1 class="page-heading">
        <img src="../images/page-heading.png" width="246" height="70" alt="" />
      </h1>
    </div>

    <div class="page-content clearfix">
	<?php include('../menu.php');?>
    </div>
	
    <div class="page-content clearfix">
	<form method='post' name='frm_entry' id='frm_entry' action="#">
		<?php if($mode == 'edit') { ?>
		<input type='hidden' name='map_id' value='<?php echo $map_id;?>'>
		<?php }?>
		<h3 class="from-heading">Device Mapping:</h3>
		<ul class="form-tabel">
        <li class="clearfix">
          <div class="form-label">
            Device
          </div>
          <div class="form-field ">
           <?php echo sel_device($dev_id);?>
          </div>
		  <div class="form-label">
            Transit
          </div>
          <div class="form-field ">
		  <?php echo sel_tl_transit($tid);?>
          </div>
        </li>
		
	<li class="clearfix">
          <div class="form-label">
            Status
          </div>
          <div class="form-field ">
            <input type="radio" name="status" id="status" class="status" value="1" <?php if($active == '' && $inactive == ''){?> checked <?php }else{?> <?PHP echo $active; ?> <?php }?>/>
            Active
            &nbsp;&nbsp;&nbsp;
            <input type="radio" name="status" id="inactive" class="status" value="0" <?php echo $inactive; ?>/>
            In Active
          </div>
        </li>
        <li class="clearfix city_update_add">
                <div id="validation">&nbsp;</div>
		<?php if($mode == 'edit') { ?>
		<div>			
			<input class="inputsubmit form-submit city_add" type="submit" name="inp_submit" id="inp_update" value="UPDATE">
			<a href="device_tag.php" title="Add New" class="add_new">ADD NEW</a>
			<input type='hidden' name='inp_submit' value='Update'>
		</div>	
		<?php } else { ?>
		<div>
			<input class="inputsubmit form-submit city_update" type="submit" name="inp_submit" value="SAVE" id="inp_submit">
			<input type='hidden' name='inp_submit' value='Submit'>
		</div>
		<?php } ?>
         </li>
         </ul>
	</form>	
    </div>
    <?php $qry_all_devices = mysql_query("SELECT *
FROM `tbl_device_map`
");?>
    <?php if(mysql_num_rows($qry_all_devices)>0){?>
    <div class="page-content clearfix">
		<h3 class="from-heading">List of Devices</h3>
		<div class="reservation-list-wrapper">			
			<div class="reservation-list grid"> 
				<table width="100%" cellspacing="0">
					<thead>
						<tr class="headings">
							<th>SL.NO</th>
							<th>Device ID</th>
							<th>Transit</th>
							<th class="action">Edit</th>
							<th class="action">Status</th>					
							
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;while($res = mysql_fetch_array($qry_all_devices)) {   ?>	
						<tr class="even">
							<td><?php echo $i;?></td>
							<td><?php echo $res[dev_id];?></td>	
							<td><?php echo getransitmapName($res[tid]);?></td>	
							<!--<td><?php //echo $res[short_code];?></td>	-->
							<td class="edit"><a href="device_tag.php?id=<?php echo $res[map_id];?>"><img src="../images/edit-icon.png" alt="edit"/></a></td>
							<td class="delete last"><?php if(!$res[status]){?>Disabled<?php }else{?>Enabled<?php }?></td>
						</tr>
						<?php $i++ ; } ?>
					</tbody>
				</table>
			</div>
		</div>	
    </div>
    <?php }?>
	<div class="footer"></div>
  </div>
  </div>
  </div>
</body>
</html>
<script>
/*
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
var id = getUrlParameter('id');

if(id == 'undefined' ){
	alert('id is undefined');
	alert(id+'no');
	//$("#device").prop("disabled", false);
	//$("#device").removeAttr("disabled");
	//$( "#tr" ).removeAttr('disabled');
	//$("#tr").prop("disabled", false);
	
	
}
else{
	alert('id is defined');
	alert(id+'yes');
	//$("#device").prop("disabled", true);
	//$("#tr").prop("disabled", true);
	
}
	*/
</script>