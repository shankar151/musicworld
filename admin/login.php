<?php
	session_start();
	
		include('inc/config.php');
		
		if(isset($_POST['login']))
		{
			extract($_POST);
			$qs="select * from admin_master where admin_username='$admin_username' and admin_password='$admin_password'";
			
			$data=mysqli_query($con,$qs);
			
			if(mysqli_num_rows($data)>0)
			{
				$_SESSION['uname']=$admin_username;
				header('location:index.php');
			}
			else
			{
					echo "Invalid User Id or Password";
			}
		}
?>
<!doctype html>

	
		
	

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	
	<link type="text/css" rel="stylesheet" href="css/login.style.css"/> 
	
	<title>Login Page</title>
</head>
<body>
	<form method="post">
	<!-- Main Content -->
	<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><span class="fa fa-android"><img src="img/download.png" style="border-radius:50%;"/></span></h2></span>
				<h2 class="company_title"><center><font color="pink" face="Imprint MT Shadow">Music Dunia</font></center></h2>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
						<h2><center>Admin Log In</center></h2>
					</div>
					<div class="row">
						<form control="" class="form-group">
							<div class="row">
								<center><input type="text" name="admin_username" id="username" class="form__input" placeholder="Admin Username"></center>
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<center><input type="password" name="admin_password" id="password" class="form__input" placeholder="Admin Password"></center>
							</div>
							<div class="row">
								<center><input type="checkbox" name="remember_me" id="remember_me" class="">
								<label for="remember_me">Remember Me!</label></center>
							</div>
							<div class="row">
								<center><input type="submit" value="LOGIN" name="login" class="btn"></center>
							</div>
						</form>
					</div>
					<div class="row">
						<p align="center">Don't have an account? <a href="#">Register Here</a></p>
					</div>
						<div class="row">
						<p align="center"><a href="#">Back To Home</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="container-fluid text-center footer1">
		
	</div>
	</form>
</body>
</html>