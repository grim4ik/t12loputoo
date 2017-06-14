<?php 
	require("../../config.php");
	
	session_start();
	
	$database = "if16_kirikotk_4";
	
	function signup($email, $password, $name, $nimi) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO lp_users (email, password) VALUE (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password);
		
		if ( $stmt->execute() ) {
			echo "";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created
			FROM lp_users
			WHERE email = ?
		");
		
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//rea kohta tulba väärtus
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult SELECT'i puhul
		if($stmt->fetch()) {
			// oli olemas, rida käes
			//kasutaja sisestas sisselogimiseks
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb) {
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				//echo "ERROR";
				
				header("Location: gallerry.php");
				
			} else {
				$notice = "wrong password";
			}
			
			
		} else {
			
			//ei olnud ühtegi rida
			$notice = "Can't found this ".$email." email ";
		}
		
		
		$stmt->close();
		$mysqli->close();
		
		return $notice;
		
	
	}

	function saveEvent($title, $descrip, $photo) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO lp_andm (title, descrip, photo, email) VALUE (?, ?, ?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ssss", $title, $descrip, $photo, $_SESSION["userEmail"]);
		
		if ( $stmt->execute() ) {
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function getAllPeople() {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		SELECT id, title, descrip, photo, email
		FROM lp_andm
		");
		$stmt->bind_result($id, $title, $descrip, $photo, $email);
		$stmt->execute();
		
		$results = array();
		
		while($stmt->fetch()) {
			
			$human = new StdClass();
			$human->id = $id;
			$human->title = $title;
			$human->descrip = $descrip;
			$human->photo = $photo;
			$human->email = $email;
			
			array_push($results, $human);
			
		}
		return $results;
		
	}
	
	function getUserInfo() {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		SELECT id, title, descrip, photo, email
		FROM lp_andm
		WHERE email = ?
		");
		
		$stmt->bind_param("s", $_SESSION["userEmail"]);
		$stmt->bind_result($id, $title, $descrip, $photo, $email);
		$stmt->execute();
		$results = array();
		
		while($stmt->fetch()) {	
			$user = new StdClass();
			$user->id = $id;
			$user->title = $title;
			$user->descrip = $descrip;
			$user->photo = $photo;
			$user->email = $email;
			
			array_push($results, $user);	
		}
		return $results;	
	}
	
	
	function deleteart($id){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);		
		
		$stmt = $mysqli->prepare("
		DELETE from lp_andm WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
		}
		$stmt->close();	
	}
	
	function getsingleId($show_id){
			
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			
			$stmt = $mysqli->prepare("
			SELECT photo
			FROM lp_andm 
			WHERE id = ?");
			
			$stmt->bind_param("i", $show_id);
			$stmt->bind_result($photo);
			$stmt->execute();
			$singleId = new Stdclass();
			
			if($stmt->fetch()){
				$singleId->photo = $photo;
			}else{
				header("Location: delete.php");
				exit();
			}
			$stmt->close();
			return $singleId;
		}
	
	function cleanInput($input) {
		
		$input = trim($input);

		$input = stripslashes($input);

		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
?>
