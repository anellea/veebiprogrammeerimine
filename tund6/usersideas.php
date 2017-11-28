<?php
	require("functions.php");
	
	$notice = "";
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//v�ljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	if(isset($_POST["ideaButton"])){
		
		if(isset($_POST["idea"]) and !empty($_POST["idea"])){
			//echo $_POST["ideaColor"];
			$notice = saveIdea($_POST["idea"], $_POST["ideaColor"]);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Anelle Avaste veebiprogrammeerimine</title>
</head>
<body>
	<h1>Head m�tted</h1>
	<p>See leht on loodud �ppet�� raames ning ei sisalda mingit t�siseltv�etavat sisu.</p>
	<p><a href="?logout=1">Logi v�lja!</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Hea m�te: </label>
		<input name="idea" type="text">
		<br>
		<label>M�ttega seotud v�rv: </label>
		<input name="ideaColor" type="color">
		<br>
		<input name="ideaButton" type="submit" value="Salvesta m�te!">
		<span><?php echo $notice; ?></span>
	</form>
	<hr>
	<div style="width: 40%;">
		<?php echo listAllIdeas(); ?>
	</div>
	
</body>
</html>