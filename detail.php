<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyTour | Package Details</title>
<link href="stylecss.css" rel='stylesheet' type='text/css'/>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--js--> 
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/click2zoom.css" type="text/css">
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
    <div class="cat_main_txt">
        <div style="width:100%"><h4 class="headingText">View Package</h4></div>
        <table border="0" width="600px" height="400px" align="center" >
        <?php
            $s="select * from package,category,subcategory where package.category=category.cat_id and package.subcategory=subcategory.subcatid and package.packid='" . $_GET["pid"] ."'";
            $result=mysqli_query($cn,$s);
            $r=mysqli_num_rows($result);
            //echo $r;
            $n=0;
            $data=mysqli_fetch_array($result);
            mysqli_close($cn);
        ?>
        <tr>
        <div class="iwrap">
            <td class="middletext">
                <img id="myImg" class="newImg" src="Admin/packimages/<?php echo $data[5];?>" alt="Snow" style="height:200px;width: 200px;">
            </td>

        <td class="middletext" style="padding-left:15px"><img id="myImg" class="newImg" src="Admin/packimages/<?php echo $data[6];?>" alt="Snow" style="height:200px;width: 200px;"></td>

        <td class="middletext" style="padding-left:15px"><img id="myImg" class="newImg" src="Admin/packimages/<?php echo $data[7];?>" alt="Snow" style="height:200px;width: 200px;"></td>
        </div>
    </tr>
    <tr>
        <td>
            <span><strong>Package/Location:</strong></span>
        </td>
        <td>
            <?php echo $data[1];?>
        </td>
    </tr>
        <tr>
            <td>
                <span><strong>Catagory:</strong></span> 
            </td>
            <td>
                <span class="cat_type"><?php echo $data[10];?></span>
            </td>   
        </tr>
        <tr>
            <td>
                <span><strong>Subcatagory:</strong></span> 
            </td>
            <td>
                <span class="cat_type"><?php echo $data[12];?></span>
            </td> 
        </tr>
        <tr>
            <td>
                <span><strong>Price:</strong></span> 
            </td>
            <td>
                <?php echo number_format($data[4], 0, '.', ',')." ₹";?>
                + GST(18%) inclusive*
            </td> 
        </tr>
    <tr><td colspan="3"><p><?php echo $data[8];?></p></td></tr> 
    <tr><td align="left" colspan="3" height="50px"><a href="enquiry.php?pid=<?php echo $data[0];?>"><input type="button" value="Enquiry" name="sbmt" /></a></td></tr>
    </table>
    </div>

</div>
<!-- The Modal -->
<div id="myModal" class="modal">
  <img class="modal-content" id="img01">
  <span class="close">&times;</span>
  <div id="caption">
  </div>
</div>
<div style="clear:both"></div>
<script src="js/click2zoom.js"></script>
<?php include('bottom.php'); ?>
</body>
</html>



