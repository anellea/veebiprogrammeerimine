<?php
	require("../../../config.php");
	require("functions.php");
	
	//kui on sisselogitud, siis otse pealehele
	if(isset($_SESSION["userId"])){
		header("Location: main.php");
		exit();
	}
	
	//echo $serverHost;
	$signupFirstName = "";
	$signupFamilyName = "";
	$gender = "";
	$signupEmail = "";
	$signupBirthDay = null;
	$signupBirthMonth = null;
	$signupBirthYear = null;
	$signupBirthDate = "";
	
	$loginEmail = "";
	$notice = "";
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
	$loginEmailError ="";
	
	if(isset($_POST["signinButton"])){
	//kas on kasutajanimi sisestatud
	if (isset ($_POST["loginEmail"])){
		if (empty ($_POST["loginEmail"])){
			$loginEmailError ="NB! Sisselogimiseks on vajalik kasutajatunnus (e-posti aadress)!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	if(!empty($loginEmail) and !empty($_POST["loginPassword"])){
		//echo "Hakkan sisse logima!";
		$notice = signIn($loginEmail, $_POST["loginPassword"]);
	}
	
	}//kas vajutati "logi sisse" nuppu
	
	if(isset($_POST["signupButton"])){
	
	//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! V�li on kohustuslik!";
		} else {
			$signupFirstName = test_input($_POST["signupFirstName"]);
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["signupFamilyName"])){
		if (empty($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! V�li on kohustuslik!";
		} else {
			$signupFamilyName = test_input($_POST["signupFamilyName"]);
		}
	}
	
	
	//kas s�nnikuup�ev on sisestatud
	if (isset($_POST["signupBirthDay"])){
		$signupBirthDay = $_POST["signupBirthDay"];
		//echo $signupBirthDay;
	} else {
		$signupBirthDayError = "Kuup�eva pole sisestatud!";
	}
	
	//kas s�nnikuu on sisestatud
	if ( isset($_POST["signupBirthMonth"]) ){
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	} else {
		$signupBirthDayError .= " Kuu pole sisestatud!";
	}
	
	//kas s�nniaasta on sisestatud
	if (isset($_POST["signupBirthYear"])){
		$signupBirthYear = $_POST["signupBirthYear"];
		//echo $signupBirthYear;
	} else {
		$signupBirthDayError .= " Aasta pole sisestatud!";
	}
	
	//kui s�nnikuup�ev on sisestatud, siis kontrollima, kas valiidne
	if (isset($_POST["signupBirthDay"]) and isset($_POST["signupBirthMonth"]) and isset($_POST["signupBirthYear"])){
		if (checkdate(intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]), intval($_POST["signupBirthYear"]))){
			$birthDate = date_create($_POST["signupBirthMonth"] ."/" .$_POST["signupBirthDay"] ."/" .$_POST["signupBirthYear"]);
			$signupBirthDate = date_format($birthDate, "Y-m-d");
		} else {
			$signupBirthDayError .= " Pole korrektne kuup�ev!";
		}
	} 
	
	//kontrollime, kas kirjutati kasutajanimeks email
	if (isset($_POST["signupEmail"])){
		if (empty($_POST["signupEmail"])){
			$signupEmailError ="NB! V�li on kohustuslik!";
		} else {
			$signupEmail = test_input($_POST["signupEmail"]);
			$signupEmail = filter_var($signupEmail, FILTER_SANITIZE_EMAIL);
			if(!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)){
				$signupEmailError = "Sisestatud e-postiaadress pole n�utud kujul!";
			}
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			$signupPasswordError = "NB! V�li on kohustuslik!";
		} else {
			//polnud t�hi
			if (strlen($_POST["signupPassword"]) < 8){
				$signupPasswordError = "NB! Liiga l�hike salas�na, vaja v�hemalt 8 t�hem�rki!";
			}
		}
	}
	
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on m��ratud ja pole t�hi
			$gender = intval($_POST["gender"]);
		} else {
			$signupGenderError = " (Palun vali sobiv!) M��ramata!";
	}
	
	//UUE KASUTAJA ANDMEBAASI KIRJUTAMINE, kui k�ik on olemas	
	if (empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($signupBirthDayError) and empty($signupGenderError) and empty($signupEmailError) and empty($signupPasswordError)){
		echo "Hakkan salvestama!";
		//kr�pteerin parooli
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		//echo "\n Parooli " .$_POST["signupPassword"] ." r�si on: " .$signupPassword;
		signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
	}
	
	}//kas vajutati "Loo kasutaja" nuppu
	
	//Tekitame kuup�eva valiku
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>p�ev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++){
		if($i == $signupBirthDay){
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$signupDaySelectHTML.= "</select> \n";
	
	//Tekitame s�nnikuu valiku
	$signupMonthSelectHTML = "";
	$monthNamesEt = ["jaanuar", "veebruar", "m�rts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML .= '<select name="signupBirthMonth">' ."\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>kuu</option>' ."\n";
	foreach ($monthNamesEt as $key=>$month){
		if ($key + 1 === $signupBirthMonth){
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' .$month .'</option>' ."\n";
		} else {
		$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month .'</option>' ."\n";
		}
	}
	$signupMonthSelectHTML .= "</select> \n";
	
	//Tekitame aasta valiku
	$signupYearSelectHTML = "";
	$signupYearSelectHTML .= '<select name="signupBirthYear">' ."\n";
	$signupYearSelectHTML .= '<option value="" selected disabled>aasta</option>' ."\n";
	$yearNow = date("Y");
	for ($i = $yearNow; $i > 1900; $i --){
		if($i == $signupBirthYear){
			$signupYearSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupYearSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupYearSelectHTML.= "</select> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Sisselogimine v�i uue kasutaja loomine</title>
</head>
<body>
	<h1>Logi sisse!</h1>
	<p>Siin harjutame sisselogimise funktsionaalsust.</p>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Kasutajanimi (E-post): </label>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>"><span><?php echo $loginEmailError; ?></span>
		<br><br>
		<input name="loginPassword" placeholder="Salas�na" type="password"><span></span>
		<br><br>
		<input name="signinButton" type="submit" value="Logi sisse"><span><?php echo $notice; ?></span>
	</form>
	
	<h1>Loo kasutaja</h1>
	<p>Kui pole veel kasutajat....</p>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Eesnimi </label>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>">
		<span><?php echo $signupFirstNameError; ?></span>
		<br>
		<label>Perekonnanimi </label>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>">
		<span><?php echo $signupFamilyNameError; ?></span>
		<br>
		<label>Sisesta oma s�nnikuup�ev</label>
		<?php
			echo $signupDaySelectHTML .$signupMonthSelectHTML .$signupYearSelectHTML;
		?>
		<span><?php echo $signupBirthDayError; ?></span>
		
		<br><br>
		<label>Sugu</label>
		<br>
		<input type="radio" name="gender" value="1" <?php if ($gender == "1") {echo 'checked';} ?>><label>Mees</label> <!-- K�ik l�bi POST'i on string!!! -->
		<input type="radio" name="gender" value="2" <?php if ($gender == "2") {echo 'checked';} ?>><label>Naine</label><span><?php echo $signupGenderError; ?></span>
		<br><br>
		
		<label>Kasutajanimi (E-post)</label>
		<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>">
		<span><?php echo $signupEmailError; ?></span>
		<br><br>
		<input name="signupPassword" placeholder="Salas�na" type="password">
		<span><?php echo $signupPasswordError; ?></span>
		<br><br>
		
		<input name="signupButton" type="submit" value="Loo kasutaja">
	</form>
		
</body>
</html>