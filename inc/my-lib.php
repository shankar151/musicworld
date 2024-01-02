<?php
function check_wish($con,$user_id,$item_id,$cat)
{
	$qs="select * from wishlist where wish_user_id='$user_id' and wish_item_id='$item_id' and wish_cat='$cat'";
	
	$data=mysqli_query($con,$qs) or die(mysqli_error($con));
	if(mysqli_num_rows($data)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
?>