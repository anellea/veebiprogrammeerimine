<?php
	$picsDir= "../../pildid/";
	
	$picFiles = [];
	
	$allFiles = scandir($picsDir);
	//var_dump ($allFiles);
	
	$picFiles = array_slice($allFiles, 2);
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
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna Ülikool" >

</body>	
</html>




















