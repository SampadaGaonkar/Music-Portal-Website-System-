<html>
<head>
	<title>Register Success!</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");
if(isset($_POST['submit'])) {	
	$name   = mysqli_real_escape_string($mysqli, $_POST['name']);
	$num      = mysqli_real_escape_string($mysqli, $_POST['num']);
	$email       = mysqli_real_escape_string($mysqli, $_POST['email']);
	$password    = mysqli_real_escape_string($mysqli, $_POST['password']);

		

			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO libraryregister(name, num, email, password) VALUES('$name','$num', '$email','$password')");
		
		//display success message
		echo '<script type="text/javascript">'; 
echo 'alert("Thank you for registering");'; 
echo 'window.location.href = "log.html";';
echo '</script>';
		
	
}
?>
</body>
</html>