<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM register WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO register (username, email, contact_no, address, city, state, password)
					VALUES ('$username', '$email', '$contact_no', '$address', '$city', '$state', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
                $contact_no = "";
				$address = "";
                $city = "";
				$state = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form - Pure Coding</title>
</head>
<body>
	<div class="container">

          <h2>Registration Form</h2>
        <div class="form-container">

		<form action="" method="POST" class="login-email">
			
            <div class="input-name">
                <i class="fa fa-user email"></i>
				<input type="text" placeholder="Username" class="text-name" name="username" value="<?php echo $username; ?>" required>
			</div>


			<div class="input-name">
                <i class="fa fa-envelope email"></i>
				<input type="email" placeholder="Email" class="text-name" name="email" value="<?php echo $email; ?>" required>
			</div>


            <div class="input-name">
                <i class="fa fa-address-book email"></i>
				<input type="contact" placeholder="conatct_no"  class="text-name" name="contact_no" value="<?php echo $contact_no; ?>" required>
			</div>
             

          <!--  <div class="input-name">
                    <input type="radio" class="radio-button" class="text-name" name="gender" value="m" value="<?php echo $male; ?>" required>
                    <label style="margin-right:30px;">Male</label>
                    <input type="radio" class="radio-button" class="text-name" name="gender" value="f" value="<?php echo $female; ?>" required>
                    <label>Female</label>
            </div>-->

            <div class="input-name">
                <i class="fa fa-address-book email"></i>
				<input type="text" placeholder="address"  class="text-name" name="address" value="<?php echo $address; ?>" required>
			</div>

            <div class="input-name">
                    <i class="fa fa-address-card email" aria-hidden="true"></i>
                    <input type="city" placeholder="City" class="name" name="city" value="<?php echo $city; ?>" required>
                    <span>
                        <i class="fa-solid fa-city"></i>
                    <input type="state" placeholder="State" class="name" name="state" value="<?php echo $state; ?>" required>
                    </span>
            </div>


			<div class="input-name">
                <i class="fa fa-lock lock email"></i>
				<input type="password" placeholder="Password"  class="text-name" name="password" value="<?php echo $username; ?>" required>
            </div>


            <div class="input-name">
                <i class="fa fa-lock lock email"></i>
				<input type="password" placeholder="Confirm Password" class="text-name" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>

            
           <!-- <div class="input-name">
                    <input type="checkbox" class="check-button">
                    <label class="check">I accept the terms and conditions</label>
            </div>-->


            <div class="input-name">
                    <input type="submit" class="button" value="Register" name="Register">
            </div>

            <div class="input-name">
			     <p class="login-register-text"><b>Have an account?<b> <a href="index.php">Login Here</a>.</p>
            </div>

		</form>
	</div>
</div>
</body>
</html>