<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login/Signup</title>
  <?php include "links.php";
  include "assets/dbcon.php";
  include "assets/ajax.php";
  ?>

</head>
<body>
	
<?php
// include "assets/nav.php";
?>
<!-- partial:index.partial.html -->
<div class="containers container mt-5" id="container">
	<div class="form-container sign-up-container" id="sign-up-container">
		<form class="form_bg" action="functions.php" method="POST">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			
			<input type="text" name="username" placeholder="Name" required/>
			<input type="email" name="email" placeholder="Email" required/>
			<input type="password" name="password" placeholder="Password"  required/>
			<input type="password" name="cpassword" placeholder="Confirm Password"  required/>
			<button name="signup">Sign Up</button>
			<a id="prev" >Already a Member, Sign In <u>click here</u></a>
		</form>

	</div>
	<div class="form-container sign-in-container" id="sign-in-container">
	<button class="btn"><i class="fa-solid fa-arrow-left m-2"onclick="goBack()"> </i></button>
		<form action="functions.php" method="POST">
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" name="email" placeholder="Email" required/>
			<input type="password" name="password" placeholder="Password" required />
			<a href="forgot.php">Forgot your password?</a>
			<button name="signin" >Sign In</button>
			<a id="next" >Don't Have an Account No Worries <u>click here</u></a>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<button class="btn"><i   class="z-5 fa-solid fa-arrow-left m-2"onclick="goBack()"> </i></button>
			<div class="overlay-panel overlay-left">

				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<?php 
//    include "assets/footer.php";
   ?>
<!-- partial -->
  <script  src="move.js"></script>

</body>
</html>
