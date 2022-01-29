<?php
function makeconnection()
{
	$cn=mysqli_connect("localhost","root","","travel");
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to mysqli:".mysqli_connect_error();
	}
	return $cn;
}
$cn = mysqli_connect("localhost","root","","travel");
?>