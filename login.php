<?php
	$msg="";
	
	session_start();
	
		include('inc/config.php');
		
		$u_email="";
		$u_pass="";
		
		if(isset($_COOKIE['email']))
		{
			$u_email=$_COOKIE['email'];
			$u_pass=$_COOKIE['pass'];
		}
		
		if(isset($_POST['signin']))
		{
			extract($_POST);
			$qs="select * from signup where (email='$email' or mobile='$email') and password='$your_pass'";
			
			$data=mysqli_query($con,$qs);
			
			if(mysqli_num_rows($data)>0)
			{
				$row=mysqli_fetch_array($data,MYSQLI_BOTH);
				$_SESSION['uname']=$row['first']." ".$row['last'];
				$_SESSION['user_id']=$row['user_id'];
				
				if(isset($_POST['rem']))
				{
					setcookie("email",$email,time()+86400);
					setcookie("pass",$your_pass,time()+86400);
				}
				header('location:index.php');
			}
			else
			{
					$msg="Invalid User Id or Password";
			}
		}
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Sign Up Form by Colorlib</title>

			<link rel="stylesheet" href="dist/css/material-design-iconic-font.min.css">

			<link rel="stylesheet" href="dist/css/style.css">
			<meta name="robots" content="noindex, follow">
			<script nonce="fb92b986-cdbe-4e2c-92e3-5036e84b6cbb">
			(function(w,d){!function(a,b,c,d){a[c]=a[c]||{};a[c].executed=[];a.zaraz={deferred:[],listeners:[]};a.zaraz.q=[];a.zaraz._f=function(e){return function(){var f=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:f})}};for(const g of["track","set","debug"])a.zaraz[g]=a.zaraz._f(g);a.zaraz.init=()=>{var h=b.getElementsByTagName(d)[0],i=b.createElement(d),j=b.getElementsByTagName("title")[0];j&&(a[c].t=b.getElementsByTagName("title")[0].text);a[c].x=Math.random();a[c].w=a.screen.width;a[c].h=a.screen.height;a[c].j=a.innerHeight;a[c].e=a.innerWidth;a[c].l=a.location.href;a[c].r=b.referrer;a[c].k=a.screen.colorDepth;a[c].n=b.characterSet;a[c].o=(new Date).getTimezoneOffset();if(a.dataLayer)for(const n of Object.entries(Object.entries(dataLayer).reduce(((o,p)=>({...o[1],...p[1]})),{})))zaraz.set(n[0],n[1],{scope:"page"});a[c].q=[];for(;a.zaraz.q.length;){const q=a.zaraz.q.shift();a[c].q.push(q)}i.defer=!0;for(const r of[localStorage,sessionStorage])Object.keys(r||{}).filter((t=>t.startsWith("_zaraz_"))).forEach((s=>{try{a[c]["z_"+s.slice(7)]=JSON.parse(r.getItem(s))}catch{a[c]["z_"+s.slice(7)]=r.getItem(s)}}));i.referrerPolicy="origin";i.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a[c])));h.parentNode.insertBefore(i,h)};["complete","interactive"].includes(b.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document);
			</script>
		</head>
	<body>
		<form method="post">
		<div class="main">
		<section class="sign-in">
		<div class="container">
		<div class="signin-content">
		<div class="signin-image">
		<figure><img src="signin-image.jpg" alt="sing up image"></figure>
		<a href="signup.php" class="signup-image-link">Create an account</a>
		</div>
		<div class="signin-form">
		<h2 class="form-title">Sign In</h2>
		
		<form method="POST" class="register-form" id="login-form">
		
		<div class="form-group">
		
		<label for="your_name"><i class="icon-name-10.jpg"></i></label>
		<input type="text" name="email" id="your_name" placeholder="Email Id or Mobile" value="<?php echo $u_email; ?>"/>
		</div>
		<div class="form-group">
		<label for="your_pass"></label>
		<input type="password" name="your_pass" id="your_pass" placeholder="Password" value="<?php echo $u_pass; ?>"/>
		</div>
		<div class="form-group">
		<input type="checkbox" name="rem" id="remember-me" class="agree-term" />
		<label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
		</div>
		<div class="form-group form-button">
		<input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
		</div>
		
		<div class="form-group">
		<label for="remember-me" class="label-agree-term"><h3><?php echo $msg; ?></h3></label>
		</div>
		<div>
			<label></label>
		</div>
		</form>
		<div class="social-login">
		<span class="social-label">Or login with</span>
		<ul class="socials">
		<li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
		<li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
		<li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
		</ul>
		</div>
		</div>
		</div>
		</div>
		</section>
		</div>
			</form>
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
	</html>