<?php
	include('inc/config.php');
	
	$mobile = $_GET['mob'];
	
	$qs = "select * from signup where mobile='$mobile'";
	
	$data = mysqli_query($con,$qs);
	
	if(mysqli_num_rows($data)>0)
	{
		echo "Already Registered";
	}
	else
	{
		echo "OK";
	}
?>