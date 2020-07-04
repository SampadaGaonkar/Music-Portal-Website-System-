<?php  
 require('config.php');


if (isset($_POST['email']) and isset($_POST['password'])){
   
// Assigning POST values to variables.
$email= $_POST['email'];
$password = $_POST['password'];

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM libraryregister  WHERE email='$email' and password='$password'";

 
$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
$count = mysqli_num_rows($result);

if ($count == 1){

//echo "Login Credentials verified";
echo '<script type="text/javascript">'; 
echo 'alert("Welcome");'; 
echo 'window.location.href = "index2.html";';
echo '</script>';

}else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials.....Go Back!')</script>";

}
}
?>