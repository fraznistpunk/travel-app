<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyTour | Contact</title>
<link href="stylecss.css" rel='stylesheet' type='text/css'/>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--js--> 
<style>
	textarea {resize: none;}
	form input[type="text"], form input[type="email"], form input[type="number"], textarea { 
		display: block;
		margin:  15px 0px;
		width: 100%;
		padding: 0.375rem 0.75rem;
		font-size: 1em;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
</style>
<script src="js/jquery.min.js"></script>

<!--/js-->
<!--animated-css-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
</head>

<body>
<?php include('function.php'); ?>
<?php
if(isset($_POST["sbmt"]))
{
	$cn=makeconnection();
	$s="insert into enquiry(Packageid,Name,Gender,Mobileno,Email,NoofDays,Child,Adults,Message,Statusfield) values('" . $_REQUEST["pid"] ."','" . $_POST["t1"] ."','" . $_POST["r1"] ."','" . $_POST["t2"] ."','" . $_POST["t3"] ."','" . $_POST["t4"] ."','" . $_POST["t5"] ."','" . $_POST["t6"] ."','" . $_POST["t7"] ."','Pending')";	
	
	
		mysqli_query($cn,$s);
	
	echo "<script>alert('Thanks for contacting us, we'll get back to you soon.);</script>";
}
?>

<?php include('top.php'); ?>
<!--/sticky-->
<?php include('slider.php'); ?>
<div style="height:50px"></div>
<div style="width:1000px; margin:auto"  >
	<div class="cat_main_clist">

        <table cellpadding="0" cellspacing="0" width="1000px">
        <tr><td style="font-size:20px;color:#70b8e8"><b>Category</b></td></tr>
        <?php

        $s="select * from category";
        $result=mysqli_query($cn,$s);
        $r=mysqli_num_rows($result);
        //echo $r;

        while($data=mysqli_fetch_array($result))
        {
            
                echo "<tr><td style=' padding:5px;'><b><a href='subcat.php?catid=$data[0]'>$data[1]</a></b></td></tr>";

        }

        ?>

        </table>
    </div>
<div div class="cat_main_txt">
	<div style="width:100%"><h4 class="headingText">Enquiry</h4></div>
	<?php
	$s="select * from package,category,subcategory where package.category=category.cat_id and package.subcategory=subcategory.subcatid and package.packid='" . $_GET["pid"] ."'";

	$result=mysqli_query($cn,$s);
	$r=mysqli_num_rows($result);
	//echo $r;
	$n=0;
	$data=mysqli_fetch_array($result);
	mysqli_close($cn);
	?>
	<div>
		<p><span><strong>Package id:</strong></span>
        <?php echo "#".$data[0];?></p>
        <p><span><strong>Package name:</strong></span>
        <?php echo $data[1];?></p>
	</div>
	<form class="enq_form" method="post" enctype="multipart/form-data">

	<input type="text" placeholder="Name" name="t1" required pattern="[a-zA-z1 _]{3,50}" title="Maximum 50 characters allowed."/>
	<div>
		<input type="radio" name="r1" value="Male" checked="checked" />Male
		<input type="radio" name="r1"  value="Female"/>Female
	</div>

	<input placeholder="Phone no" type="text" name="t2" required pattern="[0-9]{10,12}" title="Please enter only numbers between 10 to 12"/>
	<input placeholder="Email" type="email" name="t3" required />

	<input placeholder="No. of days" type="number" name="t4" required pattern="[1 _]{1,20}" title="Please enter only numbers between 1 to 20 for No. oF Days"/>

	<input placeholder="Children (if any)" type="number" name="t5" required pattern="[1 _]{1,10}" title="Maximum 10 allowed"/>

	<input type="number" placeholder="Adults" name="t6" required pattern="[1 _]{1,20}" title="Maximum 20 allowed"/>

	<textarea placeholder="Query/Concern" name="t7" required="required"/></textarea>
	<input type="submit" value="Submit" name="sbmt" />
</form>
</div>

</div>

<div style="clear:both"></div>

<?php include('bottom.php'); ?>
</body>
</html>

