<!-- 
This page is to add quote to the page and to the server.

This form will be absorbed by the controller.

Authors: Jiazheng Huang
-->
<!DOCTYPE html>
<html>
<head>
<title>Add Quote</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php 
  // seesion_start()s are not needed until later, certainly not in Quotes 1
  session_start();
  
?>

<h3>Add Quote</h3>

<form autocomplete="off"  action="controller.php" method="post">
<div class="addQuoteContainer">
<input type="text" name="newQuote" class="newQuote" placeholder='Enter new quote' required>
<br>
<input type="text" name="newAuthor" placeholder='Author' required>
<br><br>
<input type="submit" value="Add Quote"> <br>
</div>

</form>