<?php session_start(); ?>
<?php include('redirect.php');
include('../db.php');?>

<!DOCTYPE html>
<html>
<head>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/grid.css" rel="stylesheet" type="text/css" />
<link href="../css/calendar.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<title> Dashboard</title>
<!--<script type="text/javascript" src="../evercookie/js/jquery-1.4.2.min.js"></script> -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js"
			  integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
			  crossorigin="anonymous"></script>
<style>
@import url(http://fonts.googleapis.com/css?family=Lato:400,900);  

.contentnone {
       
   background: tomato none repeat scroll 0 0;
    height: 23%;
    padding: 5%;
    position: absolute;
    width: 90%;
    
}


.bg{
    background-position:center center;
    background-repeat:no-repeat;
    background-size:cover; /* you change this to "contain" if you don't want the images to be cropped */
    color:#fff;
}





body {
    font-size:20px;
    font-family: 'Lato',verdana, sans-serif;
    color: #fff;
    background:#ECECEC;
}

.numbers{
    font-weight:900;
    font-size:100px;
}

/*@media only screen and (min-height: 1025px) and (max-width: 765px)  and (orientation: landscape)*/
/*@media (min-width:641px) {*/
	/*@import url(http://fonts.googleapis.com/css?family=Lato:400,900);   <-- Just for the demo, Yes I like pretty fonts... */

.square {
      
    bottom: 20px;
    float: left;
    margin: 3% 1.66% -28px;
    overflow: hidden;
    padding-bottom: 12%;
    position: relative;
    width: 29%;
}



.content {
       align-items: center;
    background: tomato none repeat scroll 0 0;
    border-radius: 21px;
    color: white;
    display: flex;
    font-size: 150%;
    height: 73%;
    justify-content: center;
    padding-bottom: 6%;
    padding-left: 6%;
    padding-right: 6%;
    position: absolute;
    text-align: center;
    width: 88%;
	color: white;
	line-height: 1.5;
	box-shadow: 3px 9px 8px 1px black;
}
.contentnone {
       
   background: tomato none repeat scroll 0 0;
    height: 81%;
    padding: 5%;
    position: absolute;
    width: 90%;
    
}
.contentlogo {
       
     height: 73%;
    padding-bottom: 6%;
    padding-left: 6%;
    padding-right: 6%;
    position: absolute;
    width: 88%;
   
    
}

/*  For responsive images */

.contentlogo .rs{
   height: 115%;
    margin-left: 31%;
    position: relative;
    width: auto;
}
/*  For responsive images as background */

.bg{
    background-position:center center;
    background-repeat:no-repeat;
    background-size:cover; /* you change this to "contain" if you don't want the images to be cropped */
    color:#fff;
}


/*  following just for the demo */


body {
    font-size:18px;
    font-family: 'Lato',verdana, sans-serif;
    color: #fff;
    background:#ECECEC;
}

.numbers{
    font-weight:900;
    font-size:100px;
}
.log_in_as {
    background: #ed3940 none repeat scroll 0 0;
    color: #fff;
    float: left;
    padding: 4px 8px;
	 font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
}
.nav ul#first {
    float: right;
	 font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    margin: 0;
}

@media screen and (orientation:portrait)
{
   body
   {
    
	  /* display: none;*/
   }
   .portrait{
	   display: block;
   }
}
</style>
</head>
<body>


<div class="page-content clearfix">
	<?php 
	if($_SESSION['role'] == 99){
	include('../menu-t.php');
	}
	else{
		include('../menu.php');
	}?>
    </div>
<div class= "portrait" style="display: none;"> We don't support portrait mode! Please rotate </div>
<!--<a  href="./Logout.php"><input type = "button" id= "logout" onclick= "logout.php" value= "logout"/></a>-->
<!-- 1st row verticaly centered text in the square columns -->
<div class="square">
  <a href="../checkin.php">  <div class="content">
        CHECK<br />IN
    </div> </a>
</div>
<div class="square">
 <a href="../BILLit/Advance/search_res.php">   <div class="content">
        PAY <br />ADVANCE
    </div> </a>
</div>
<div class="square">
 <a href="../BILLit/e-billing.php">   <div class="content">
		FOOD <br />BILL
    </div> </a>
</div>

<!-- 2nd row verticaly centered images in square columns -->

<div class="square">
   
</div>
<div class="square">
    <div class="contentlogo">
	
      <a href="http://www.siestahospitality.com/">  <img class="rs" src="../images/logo.gif"/> </a>       
    </div>
</div>
<div class="square">
  
     
   
</div>

<!-- 3rd row responsive images in background with centered content -->

<div class="square">
  <a href="../BILLit/e-billing-complimentry.php"> <div class="content">
        COMPLEMENTARY<br />FOOD BILL
</div> </a>
</div>
<div class="square ">
  <a href="../BILLit/e-billing-laundry.php">  <div class="content">
        LAUNDRY<br /> BILL
    </div> </a>
</div>
<div class="square ">
   <a href="../BILLit/Invoice/search_res.php"> <div class="content"> 
         CHECK<br />OUT
    </div> </a>
</div>
</body>
</html>
<script>
$(document).ready(function(){
//$('#submit_btn').hide();	

$("#contentlogo").fadeIn("slow");	
});


</script>
