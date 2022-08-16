<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
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

	<title>Login Form - Pure Coding</title>
</head>
<body>
	<div class="container">
        <h2>Login</h2>
		<form action="" method="POST" class="login-email">
			<div class="input-name">
            <i class="fa fa-user email"></i>
				<input type="email" placeholder="Email"class="text-name" name="email" value="<?php echo $email; ?>" required>
			</div>

			<div class="input-name">
                <i class="fa fa-lock lock email"></i>
                <input type="password" placeholder="Password"class="text-name" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>

            <div class="input-name">
		    <label class="form-label">Select User Type:</label>
		  <select class="form-select "name="role"  aria-label="Default select example">
			  <option selected value="user">User</option>
			  <option value="admin">Admin</option>
		  </select>
          </div>

            <div class="input-name">
                    <button name="submit" class="btn">Login</button>
            </div>

            <div class="input-name">
                   <p class="login-register-text"><b>Don't have an account?<b> <a href="register.php">Register Here</a>.</p>
            </div>

		</form>
	</div>
</body>
</html>