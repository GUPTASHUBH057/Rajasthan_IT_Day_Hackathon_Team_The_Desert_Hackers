<?php

session_start();

if(isset($_SESSION)){
	if(isset($_SESSION['id'])){
		header('location:dashboard.php');
	  }
}
  



$err = "";
$email = "";

$server = "localhost";
$user = "root1";
$password = "gnjgNsmJgV7S";
$db = "bot_data";

$con = mysqli_connect($server,$user,$password,$db);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strtolower($data);
  return $data;
}

if(isset($_POST['login_submit'])){

  $email = test_input($_POST['email']);
  $pass = $_POST['password'];

  $email_search = "SELECT * FROM user_data WHERE id = '$email' ";
  $query = mysqli_query($con,$email_search);

  $email_count = mysqli_num_rows($query);

  if($email_count!=1)
  {
    $err = "Email is not registered.";
  }
  else {

    $email_password = mysqli_fetch_assoc($query);

    $password = $email_password['password'];

    if($pass==$password)
    {
      $err = "Login Successful.";
      $_SESSION['id'] = $email;
      $_SESSION['designation'] = $email_password['designation'];
      $_SESSION['pincode'] = $email_password['pincode'];

		if($_SESSION['designation']=="admin"){
			header('location:admin_dashboard.php');
		}
		else{
			header('location:dashboard.php');
		}

      ?>

<script>
  document.location='dashboard.php'
</script>

      <?php
    }
    else {
      $err = "Invalid Password Entered.";
    }


  }


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
  <script>
  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }
</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" href="images/favicon.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<script data-ad-client="ca-pub-3531549638916716" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<span class="login100-form-title">
						Login to Dashboard
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" value="" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login_submit">
							Login
						</button>
					</div>

		
          <div class="error text-center p-t-12">
            <br>
            <center><p style="color:red"><?php echo $err; ?></p></center>
          </div>

				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor1/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/bootstrap/js/popper.js"></script>
	<script src="vendor1/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
