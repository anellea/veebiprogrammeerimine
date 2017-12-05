<?php
	require("functions.php");
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1 style="border: 2px solid Tomato;">Viktoriin</h1>
<p style="border: 2px solid MediumSeaGreen;">Siin lehel saad lahendada viktoriini, vaadata oma tulemusi, võrrelda neid teistega ning lisada uusi küsimusi.</p>

</body>
</html>