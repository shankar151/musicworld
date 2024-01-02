<?php
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		header('location:index.php');
	}
	
	include('inc/config.php');
	
		$y=$_SESSION['user_id'];
		$msg2="";
		$user_photo="";
		
		//For update the profile details//
		
		if(isset($_POST['update']))
		{
			extract($_POST);
			$user_photo=$_FILES['user_photo']['name'];
			if($user_photo!="")
			{
			move_uploaded_file($_FILES['user_photo']['tmp_name'],"upload/".$user_photo);
				$qs="update signup set first='$first', last='$last', email='$email', mobile='$mobile', dob='$dob', user_photo='$user_photo' where user_id='$y'";
			
				mysqli_query($con,$qs) or die(mysqli_error($con));
			}
			else{
				$qs="update signup set first='$first', last='$last', email='$email', mobile='$mobile', dob='$dob' where user_id='$y'";
			
				mysqli_query($con,$qs) or die(mysqli_error($con));
			}
		}
		
		//For update the password//
		
		if(isset($_POST['update_password']))
		{
			extract($_POST);
			
			$qs="select * from signup where user_id='$y' and password='$o_pass'";
			
			$data=mysqli_query($con,$qs);
			
			if(mysqli_num_rows($data)>0)
			{
					if($n_pass==$c_pass)
					{
						echo $qs="update signup set password='$n_pass' where user_id='$y'";
						
						mysqli_query($con,$qs);
						$msg2="Password Successfully Changed";
					}
					else
					{
						$msg2=$n_pass."--".$c_pass."Password not matched";
					}
			}
			else
			{
				echo $msg2="Invalid Current Password";
			}
		}
		
		$qs="select * from signup where user_id='$y'";
		
		$data=mysqli_query($con,$qs);
		$row=mysqli_fetch_array($data);
		
		$first=$row['first'];
		$last=$row['last'];
		$email=$row['email'];
		$mobile=$row['mobile'];
		$dob=$row['dob'];
		$user_photo=$row['user_photo'];
	
?>

<!doctype html>
	<html>
		<head>
			<title></title>
			<link rel="stylesheet" href="dist/css/bootstrap.min.css">
			
			<style>
						body{margin-top:20px;
					background-color:#f2f6fc;
					color:#69707a;
					}
					.img-account-profile {
							height: 10rem;
					}
					.rounded-circle {
							border-radius: 50% !important;
					}
					.card {
							box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
					}
					.card .card-header {
							font-weight: 500;
					}
					.card-header:first-child {
							border-radius: 0.35rem 0.35rem 0 0;
					}
					.card-header {
							padding: 1rem 1.35rem;
							margin-bottom: 0;
							background-color: rgba(33, 40, 50, 0.03);
							border-bottom: 1px solid rgba(33, 40, 50, 0.125);
					}
					.form-control, .dataTable-input {
							display: block;
							width: 100%;
							padding: 0.875rem 1.125rem;
							font-size: 0.875rem;
							font-weight: 400;
							line-height: 1;
							color: #69707a;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #c5ccd6;
							-webkit-appearance: none;
							-moz-appearance: none;
							appearance: none;
							border-radius: 0.35rem;
							transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
					}

					.nav-borders .nav-link.active {
							color: #0061f2;
							border-bottom-color: #0061f2;
					}
					.nav-borders .nav-link {
							color: #69707a;
							border-bottom-width: 0.125rem;
							border-bottom-style: solid;
							border-bottom-color: transparent;
							padding-top: 0.5rem;
							padding-bottom: 0.5rem;
							padding-left: 0;
							padding-right: 0;
							margin-left: 1rem;
							margin-right: 1rem;
					}

					body{margin-top:20px;
					background-color:#f2f6fc;
					color:#69707a;
					}
					.img-account-profile {
							height: 10rem;
					}
					.rounded-circle {
							border-radius: 50% !important;
					}
					.card {
							box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
					}
					.card .card-header {
							font-weight: 500;
					}
					.card-header:first-child {
							border-radius: 0.35rem 0.35rem 0 0;
					}
					.card-header {
							padding: 1rem 1.35rem;
							margin-bottom: 0;
							background-color: rgba(33, 40, 50, 0.03);
							border-bottom: 1px solid rgba(33, 40, 50, 0.125);
					}
					.form-control, .dataTable-input {
							display: block;
							width: 100%;
							padding: 0.875rem 1.125rem;
							font-size: 0.875rem;
							font-weight: 400;
							line-height: 1;
							color: #69707a;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #c5ccd6;
							-webkit-appearance: none;
							-moz-appearance: none;
							appearance: none;
							border-radius: 0.35rem;
							transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
					}

					.nav-borders .nav-link.active {
							color: #0061f2;
							border-bottom-color: #0061f2;
					}
					.nav-borders .nav-link {
							color: #69707a;
							border-bottom-width: 0.125rem;
							border-bottom-style: solid;
							border-bottom-color: transparent;
							padding-top: 0.5rem;
							padding-bottom: 0.5rem;
							padding-left: 0;
							padding-right: 0;
							margin-left: 1rem;
							margin-right: 1rem;
					}

					.btn-danger-soft {
							color: #000;
							background-color: #f1e0e3;
							border-color: #f1e0e3;
					}
							</style>

	<style>
					#set{
						padding:5px;
						background:magenta;
						display:table;
						color:#fff;
						border-radius:20px;
					}
					input[type='file']
					{
						display:none;
					}
					#set:hover
					{
						background:green;
					}
			</style>
			
			
			
		</head>
		<body>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
		
		<?php
			include('inc/header.php');
		?>
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="profile.php" target="__blank">Profile</a>
        
    </nav>
    <hr class="mt-0 mb-4">
		<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
								<?php
									echo $row['user_photo'];
								?>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
										
                    <img id="blah" alt="your image" style="width:150px;height:150px" class="img-account-profile rounded-circle mb-2" src="upload/<?php echo $row['user_photo']; ?>">
										
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
									
										
										
                   <label class="btn btn-primary" id="set" style="margin-top:50px;margin-left:80px;"/>Upload new image<input id="imgInp" type="file" name="user_photo"/></label>
									 
									 </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                           
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="first" value="<?php echo $first; ?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="last" value="<?php echo $last; ?>">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                               
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                               
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" name="email" value="<?php echo $email; ?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Mobile Number</label>
                                <input class="form-control" id="inputPhone" type="mobile" placeholder="Enter your mobile number" name="mobile" value="<?php echo $mobile; ?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Date Of Birth</label>
                                <input class="form-control" id="inputBirthday" type="date" name="dob" placeholder="Enter your date of birth" name="dob" value="<?php echo $dob; ?>">
                            </div>
														 <br/><br/><br/><br/>
														 <div class="col-md-3" >
															<label></label>
															<button class="btn btn-primary" type="submit" name="update">Update Details</button>
														 </div>
                        </div>
                        <!-- Save changes button-->
                        
                    
                </div>
            </div>
        </div>
    </div>
		</form>
</div>

<div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
				<form method="post">
        <nav class="nav nav-borders">
       
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Change password card-->
								<?php
									echo $msg2;
								?>
                <div class="card mb-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword">Old Password</label>
                                <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password" name="o_pass">
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="newPassword">New Password</label>
                                <input class="form-control" id="newPassword" type="password" placeholder="Enter new password" name="n_pass">
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password" name="c_pass">
                            </div>
                            <button class="btn btn-primary" type="submit" name="update_password">Update Password</button>
                        </form>
                    </div>
                </div>
                <!-- Security preferences card-->
                <div class="card mb-4">
                    
                    
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Two factor authentication card-->
                <div class="card mb-4">
                    <img src="a.jpg" />
                    
                </div>
                <!-- Delete account card-->
                <div class="card mb-4">
                    
                </div>
            </div>
        </div>
				</form>
    </div>
		</body>
		<script>
			imgInp.onchange = evt => {
				const [file] = imgInp.files
				if (file) {
					blah.src = URL.createObjectURL(file)
				}
			}
		</script>
	</html>