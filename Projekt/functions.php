<?php
	require("../../../config.php");
	$database = "if17_grupp11";
	
	//alustan sessiooni
	session_start();
	
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		//andmebaasi ühendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM users WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime vastavust
		if ($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Sisse logimine õnnestus!";
				
				//määrame sessiooni muutujad
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume viktoriini lehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
				
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
	}
	
	//kasutaja andmebaasi salvestamine
	function signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword) {
		//andmebaasiühendus
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	//sisestuse testimise funktsioon
	function test_input($data){
		$data = trim($data);//eemaldab lõpust tühikud, TAB jne
		$data = stripcslashes($data);//eemaldab "\"
		$data = htmlspecialchars($data); //eemaldab keelatud märgid
		return $data;
	}
?>