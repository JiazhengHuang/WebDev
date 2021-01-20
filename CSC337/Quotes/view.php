<!-- 
This is the home page for Final Project, Quotation Service. 
It is a PHP file because later on you will add PHP code to this file.

File name quotes.php 
    
Authors: Rick Mercer and Jiazheng Huang
-->

<!DOCTYPE html>
<html>
<head>
<title>Quotation Service</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="showQuotes()">

<?php 
    require_once './DatabaseAdaptor.php';
  // seesion_start()s are not needed until later, certainly not in Quotes 1
    session_start();
    
    echo '<h1 class="title">Quotation Service</h1>';
    
    echo '<div class="menu">';
    if (isset ( $_SESSION ['user'] )){
        echo '<button onclick="document.location=\'addQuote.php\'">Add Quote</button><br>';
        
        echo '<form action="controller.php" method="POST">';
        echo '<input type="submit" name="logout" value="Logout"></form>';
    }
    else {
        echo '<button onclick="document.location=\'register.php\'">Register</button><br>';
        echo '<button onclick="document.location=\'login.php\'">Login</button>';
    }
    echo '</div>';
?>

<div id="quotes"></div>

<script>
var element = document.getElementById("quotes");
function showQuotes() {
	//alert('view.php under construction');

	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?todo=getQuotes", true);
	ajax.send();
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			document.getElementById('quotes').innerHTML = ajax.responseText;
		}
	}
}
</script>

</body>
</html>