<?php
	$picsDir= "../..//pildid/";
	
	$picFiles = [];
	
	$allFiles = scandir($picsDir);
	//var_dump ($allFiles);
	
	$picFiles = array_slice($allFiles, 2);
	var_dump ($picFiles);
?>

<!DOCTYPE html>
<html>
<head>
           <meta charset="utf-8">
           <title>Anelle Avaste veebiprogrammeerimine</title>
</head>
<body>
    <h1>Avaleht</h1>
    <p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiselt võetavat sisu.</p>

<body>
	<h2> Minust </h2>
	<p>Pärnust pärit infoteaduse kolmanda aasta tudeng.</p>
	<p>Mulle meeldib suhelda erinevate inimestega ja olen väga suur kassisõber. Vanemate juures elab mul 3 armsat kiisut.</p>
	<p>Olen lõbus, seltskondlik ja alati heatujuline inimene
	</p>
	<p>Meie õpime <a href="http://www.tlu.ee/">Tallinna Ülikoolis</a>.
	<p>Minu esimene PHP leht asub <a href= "../esimene.php"> siin</a>. </p>
	<p>Minu sõbra Mari lehekülg asub siin <a href="../../../~mari/veebprog17">siin</a>.
	</p>
	<p>Pilte näeb <a href="foto.php">siin</a>.</p>
</body>	
</html>




















