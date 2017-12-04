<?php
//küsimuste kuvamise funktsioon
	require("../../../config.php");
	$database = "if17_grupp11";
	//alustan sessiooni
	session_start();
		
	function getQuestion($questionId) {
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $mysqli->set_charset("utf8");
        $stmt = $mysqli->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->bind_param("i", $questionId);
        $stmt->bind_result($id, $question, $option1, $option2, $option3, $option4, $answer);
        $stmt->execute();
        $questionObject = new Stdclass ();
        if($stmt->fetch()) {
            $questionObject->id = $id;
            $questionObject->question = $question;
            $questionObject->option1 = $option1;
            $questionObject->option2 = $option2;
            $questionObject->option3 = $option3;
            $questionObject->option4 = $option4;
            $questionObject->answer = $answer;
        } else {
            //kui sellist kysimust ei leitud
            echo "Sellist küsimust ei leitud";
            exit;
        }
	
	$stmt->close();
	$mysqli->close();
	
	return $questionObject;
}
?>