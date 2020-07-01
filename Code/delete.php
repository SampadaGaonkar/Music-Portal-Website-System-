<?php



include('config.php');



// check if the 'id' variable is set in URL, and check that it is valid

if (isset($_GET['email']))

{

// get id value

$email = $_GET['email'];



// delete the entry

$query = "DELETE FROM libraryregister  WHERE email='$email' ";
$result = mysqli_query($mysqli, $query)
or die(mysqli_error($mysqli));



// redirect back to the view page

echo '<script type="text/javascript">'; 
echo 'alert("Your account has been deleted.We hope you enjoyed your time in our community :)");'; 
echo 'window.location.href = "index.html";';
echo '</script>';




}

?>