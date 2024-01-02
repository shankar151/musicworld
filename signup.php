<?php
	include('inc/config.php');
	
	$msg="";
	$first="";
	$last="";
	$email="";
	$mobile="";
	$pass="";
	
	if(isset($_POST['signup']))
	{
		extract($_POST);
				
			$pic=$_FILES['user_photo']['name'];
			
			$qs="select * from signup where (email='$email' or mobile='$mobile') and password='$pass'";
			$data=mysqli_query($con,$qs);
			
			if(mysqli_num_rows($data)>0)
			{
				$msg='User Already Exist';
			}
			else if($pass!=$re_pass)
			{
				$msg="password and confirm password not match";
			}
			else
			{
				
				$qs="insert into signup(user_photo,first,last,email,mobile,dob,password)values('$pic','$first','$last','$email','$mobile','$dob','$pass')";
				
				move_uploaded_file($_FILES['user_photo']['tmp_name'],"upload/".$pic);
				
				mysqli_query($con,$qs);
				header('location:login.php');
			}
	}
	
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
		
			<link rel="stylesheet" href="dist/css/bootstrap.min.css">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Sign Up On Music Dunia</title>

			<link rel="stylesheet" href="dist/css/material-design-iconic-font.min.css">

			<link rel="stylesheet" href="dist/css/style.css">
			<meta name="robots" content="noindex, follow">
			
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
			
			<script>
				function check_mobile(data)
				{
					//alert(data);
					//alert('ffffffffff');
					
					var req = new XMLHttpRequest();
					
					req.open("GET","check-mobile.php?mob="+data, true);
					
					req.send();
					req.onreadystatechange = function() {
						
						if(req.readyState == 4 && req.status == 200)
						{
							document.getElementById("msg").innerHTML=req.responseText;
						}
					}
					
					
				}
			</script>
		</head>
	<body>
	
		<div class="main">
		
			<form method="post" enctype="multipart/form-data">
		<section class="signup">
			<div class="container">
			
			<div class="signup-content">
			<div class="signup-form">
			<h2 class="form-title">Sign up</h2>
			<?php
						echo $msg;
					?>
			
			<form method="POST" class="register-form" id="register-form">
			<div class="form-group">
			<label for="name"></label>
			<input type="text" name="first" id="first" placeholder="Your First Name" required/>
			</div>
			
			<div class="form-group">
			<label for="name"></label>
			<input type="text" name="last" id="last" placeholder="Your Last Name" />
			</div>
			
			<div class="form-group">
			<label for="email"></label>
			<input type="email" name="email" id="email" placeholder="Your Email Id" required/>
			</div>
			
			<div class="form-group">
			<label for="mobile"></label>
			<input type="text" name="mobile" id="mobile" placeholder="Your Mobile No" onblur="check_mobile(this.value)"/><span id="msg">***</span>
			</div>
			
			<div class="form-group">
			<label for="dob"></label>
			<input type="date" name="dob" id="dob" placeholder="Date of birth" required/>
			</div>
			
			<div class="form-group">
			<label for="pass"></label>
			<input type="password" name="pass" id="pass" placeholder="Password" required/>
			</div>
			<div class="form-group">
			<label for="re-pass"></i></label>
			<input type="password" name="re_pass" id="re_pass" placeholder="Confirm Your Password" required/>
			</div>
			<div class="form-group">
			<input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
			<label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
			</div>
			
			<div class="form-group form-button">
			<input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
			</div>
			<a href="login.php" class="signup-image-link"><h5><b>I am already member</b></h5></a>
			</form>
			</div>
			
			<div class="signup-image">
			
			<div class="col-xl-12">
			<div class="col-xl-12">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img id="blah" class="img-account-profile rounded-circle mb-2" src="upload/download.jpg" style="width :150px;height :130px;">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
									
										
										
                   <label class="btn btn-primary" id="set" style="margin-top:150px;margin-left:80px;"/>Upload new image<input id="imgInp" type="file" name="user_photo"/></label>
									 
									 </div>
            </div>
        </div>
			
			
			</div>
			
			</div>
			
			</div>
			
		</section>
			</form>
		
		</div>

		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="js/main.js"></script>

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-23581568-13');
		</script>
		<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039" integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g==" data-cf-beacon='{"rayId":"7ea8f99d181d338a","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.4.0","si":100}' crossorigin="anonymous"></script>
	</body>
	<script>
		imgInp.onchange=evt => {
			const [file] = imgInp.files
			if (file) {
				blah.src= URL.createObjectURL(file)
			}
		}
	</script>
	</html>