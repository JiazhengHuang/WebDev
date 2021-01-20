<!-- 
This page is a login page, which a user can login with their username and password.

This form will be absorbed by the controller.

Authors: Jiazheng Huang
-->
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php 
  // seesion_start()s are not needed until later, certainly not in Quotes 1
  session_start();
  
?>

<h3>Login</h3>
<form autocomplete="off"  action="controller.php" method="post">
<div class="loginContainer">
<input type="text" name="LoginUsername" placeholder="Username" required>
<br>
<input type="text" name="LoginPassword" placeholder="Password" required>
<?php
// $loginUser = '<input type="text" name="LoginUsername" placeholder="Username" required>';
// echo htmlspecialchars($loginUser);
// echo '<br>';
// $loginPS = '<input type="text" name="LoginPassword" placeholder="Password" required>';
// echo htmlspecialchars($loginPS);
?>
<br><br>
<input type="submit" value="Login"> <br>

<?php 
// This is not needed in Quotations 1.  This code will be needed to show
// errors later in a multi-page website when an account nme already exists.
if( isset($_SESSION ['loginError']))
  echo '<span class="Error">' . $_SESSION ['loginError'] . '</span>'; 
unset($_SESSION ['loginError']);
?>

</div>

</form>