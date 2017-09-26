<?php
	$picsDir= "../../pildid/";
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	$picFiles = []; //massiiv
	
	$allFiles = array_slice(scandir($picsDir), 2); 					//vahepalaks kus asjad picsdir-iga sisse loetud (andis rohkem kui tahtsime)
	//var_dump ($allFiles);
	foreach ($allFiles as $file){
		$fileType =  pathinfo ($file, PATHINFO_EXTENSION);
		//kontrollime
		if (in_array($fileType, $picFileTypes) == true) {
			array_push($picFiles, $file);
		}
	}
	
	//$picFiles = array_slice($allFiles, 2); 				//array_slicega viskasime ära kaks punkti
	//var_dump ($picFiles);
	
	$picCount = count($picFiles);
	
	$picNum = mt_rand(0, ($picCount -1));
	$picFile = $picFiles[$picNum];
?>

<!DOCTYPE html>
<html>
<head>
           <meta charset="utf-8">
           <title>Anelle Avaste veebiprogrammeerimine</title>
</head>
<body>
    <h1>Foto</h1>
    <p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiselt võetavat sisu.</p>
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna Ülikool" > //

</body>	
</html>




















