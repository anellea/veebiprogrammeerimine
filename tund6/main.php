<?php
	require("functions.php");
	
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
	$picsDir = "../../pildid/";
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	$picFiles = [];
	
	$allFiles = array_slice(scandir($picsDir), 2);
	//var_dump($allFiles);
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
		}
	}
	
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	
	$picCount = count($picFiles);
	
	$picNum = mt_rand(0,($picCount -1));
	$picFile = $picFiles[$picNum];
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>	<?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?>
		 veebiprogemise asjad
	</title>
</head>
<body>
	<h1><?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?> heade m�tete veeb</h1>
	<p>See leht on loodud �ppet�� raames ning ei sisalda mingit t�siseltv�etavat sisu.</p>
	<p><a href="?logout=1">Logi v�lja!</a></p>
	<p><a href="usersinfo.php">Info s�steemi kasutajate kohta.</a></p>
	<p><a href="usersideas.php">Kasutajate head m�tted.</a></p>
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna �likool">
	
</body>
</html>


