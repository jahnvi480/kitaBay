<?php 
	include("dbcon.php");
	if(isset($_POST['sign_up'])){
		$uname = $_POST['username'];
		$em = $_POST['email'];
		$pass1 = $_POST['password1'];
		$q = "SELECT * FROM user_details WHERE (email = '$em')";
		$qr = mysqli_query($conn,$q);
		$ar = mysqli_fetch_array($qr);
		if (count($ar)==0) {
			$query = "INSERT INTO user_details(username , email , password) VALUES ('$uname' , '$em' , '$pass1')";
			$query_run = mysqli_query($conn,$query);
			if ($query_run) {
				echo "<script> alert('Registered successfully') </script>";
				header("location: login_register.php");
			}	
		}
		else{
			echo "<script> alert('Email already exists') </script>";
		}
	}
?>
<?php 
	if(isset($_POST['sign_in']))
	{
		$em = $_POST['si_email'];
		$pass = $_POST['si_pass'];
		$q = "SELECT * FROM user_details WHERE (email = '$em' AND password = '$pass')";
		$qr = mysqli_query($conn,$q);
		$ar = mysqli_fetch_row($qr);
		$username = $ar[1];
		if (mysqli_num_rows($qr) == 1) {
			$_SESSION['email'] = $em;
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			echo "<script> alert('Session established ".$_SESSION['username']."') </script>";
			header("location: index.php");
		}
		else{
			echo "<script> alert('Please enter correct credentials') </script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login or Register</title>
	<link rel="icon" href="images/small_logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login_register.php" method="POST">
			<h1>Create Account</h1>
			<input type="text" placeholder="Name" name="username"  required="required" autocomplete="off" />
			<input type="email" placeholder="Email" name="email"  required="required" autocomplete="off" />
			<input type="password" placeholder="Password" name="password1"  required="required" id="pass" autocomplete="off" />
			<input type="password" name="password2" placeholder="Confirm Password" required="required" id="pass2" onkeyup="try1()" autocomplete="off" />
			<span id="msg"></span><br>
			<script type="text/javascript">
				function try1(){
					var p = document.getElementById('pass');
					var rp = document.getElementById('pass2');
					var m = document.getElementById('msg');
					if (p.value != rp.value) { 
						rp.style.border = "1px red solid";
						m.innerHTML = "Password does not match...Retry";
					}
					else{
						rp.style.border = "1px green solid";
						m.innerHTML = "Password Match";
					}
				}
			</script>
			<button type="submit" name="sign_up">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login_register.php" method="POST">
			<h1>Sign in</h1>
			<input type="email" placeholder="Email" name="si_email" required="required" autocomplete="off" />
			<input type="password" placeholder="Password" name="si_pass" required="required" autocomplete="off" />
			<button type="submit" name="sign_in">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
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
</body>
<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</html>
