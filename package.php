<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyTour | Packages</title>
<link href="stylecss.css" rel='stylesheet' type='text/css'/>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--js--> 
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
<?php include('top.php'); ?>
<!--/sticky-->
<?php include('slider.php'); ?>
<div style="height:50px"></div>
<div style="width:1000px; margin:auto" >
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

	<div class="cat_main_txt">
		<div style="width:100%"><h4 class="headingText">Package</h4></div>
		<?php
		$s="select * from package where package.subcategory='" . $_GET["subcatid"] ."'";
		$result=mysqli_query($cn,$s);
		$r=mysqli_num_rows($result);
		//echo $r;
		$n=0;
		while($data=mysqli_fetch_array($result))
		{
			
			if($n%3==0)
			{
			?>
		<!-- <tr> -->
		<?php

			}?>
		<div class="cat_card">
			<div class="cat_card-body">
				<div class="cat_card-header">
					<p><?php echo $data[1];?></p>
				</div>
				<div class="cat_card-content">
					<img src="Admin/packimages/<?php echo $data[5]; ?>" width="250px" height="200px">
				</div>
				<div class="cat_card-footer">
					<p><a href="detail.php?pid=<?php echo $data[0];?>">View Details</a></p>
				</div>
			</div>
		</div>
			<?php

			if($n%3==2)
			{
			?>
			</tr>

			<?php
			}
			$n=$n+1;
			}
			mysqli_close($cn);
			?>
	</div>
</div>

<div style="clear:both"></div>

<?php include('bottom.php'); ?>
</body>
</html>