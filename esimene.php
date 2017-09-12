<?php
	//see on kommentaar, järgmisena paar muutujat
	$myName = "Anelle";
	$myFamilyName = "Avaste";
	//Vaatame, mis kell on ja määrame päeva osa
	$hourNow = date("H");
	//echo $hourNow;
	$partOfDay = "";
	if ($hourNow < 8){	//	<	>	<=	>=	!=	
		$partOfDay = "varajane hommik";
	}
	if ($hourNow >= 8 and $hourNow <16){
		$partOfDay = "koolipäev";
	}
	if ($hourNow <16){
		$partOfDay = "vabaaeg";
	}
	//echo $partOfDay;
	
	//vaatame, kaua on koolipäeva lõpuni aega jäänud
	$timeNow = strtotime(date("d.m.Y H:i:s"));
	//echo $timeNow;
	$schoolDayEnd = strtotime(date("d.m.Y" ." " ."15:45"));
	//echo $schoolDayEnd;
	$toTheEnd = $schoolDayEnd - $timeNow;
	echo $toTheEnd;
?>

<!DOCTYPE html>
<html>
<head>
           <meta charset="utf-8">
           <title>Anelle Avaste veebiprogrammeerimine</title>
</head>
<body>
    <h1>
	<?php
		echo $myName ." ".$myFamilyName;
	?>
	veebiprogrammeerimine</h1>
    <p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiselt võetavat sisu.</p>

<body>
	<h2> Minust </h2>
	<p>Pärnust pärit infoteaduse kolmanda aasta tudeng.</p>
	<p>Mulle meeldib suhelda erinevate inimestega ja olen väga suur kassisõber. Vanemate juures elab mul 3 armsat kiisut.</p>
	<p>Olen lõbus, seltskondlik ja alati heatujuline inimene</p>

	<?php
		echo "<p>See on esimene jupp PHP abil väljastatud teksti!</p>"; 
		echo "<p>Täna on ";
		echo date("d.m.Y") .", kell lehe avamisel oli" . date("H:i:s");
		echo ", käes on " . $partOfDay.".</p>";
	?>
</body>	
</html>