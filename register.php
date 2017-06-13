<?php 
	
	
	require("functions.php");
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: eksam.php");
		exit();
	}
	
	//var_dump($_GET);
	
	//echo "<br>";
	
	//var_dump($_POST);
	
	//MUUTUJAD
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas epost on tuhi
		if (empty ($_POST["signupEmail"])) {
			
			// on tuhi
			$signupEmailError = " Vali on kohustuslik!";
			
		} else {
			// email on olemas ja oige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
 
	
	
	$signupPasswordError = "";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = " Vali on kohustuslik!";
			
		} else {
			
			// parool ei olnud tuhi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = " Parool peab olema vahemalt 8 tahemarkki pikk!";
				
			}
			
		}
		
	} 
	
	
	if ( $signupEmailError == "" AND
		 $signupPasswordError == "" &&
		 isset($_POST["signupPassword"]) 
	  ) {
		
		//vigu ei olnud, koik on olemas	
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo $password."<br>";
		
		signup($signupEmail, $password, $signupName, $signupNimi);
		
		
	}
	

?>
 <!DOCTYPE html>
  <html>
    
  	<head>
  	<link rel="stylesheet" type="text/css" href="style.css">
  	</head>
  
  	<body>
  		
  		<section>
		
		<header> <h1 class="headertext">ITEM SALE</h1> </header>

		<br>
  		
		
		<form method="POST" >
		<br>
		<h1>NEW ACCOUNT</h1>
		<br>
			
			<label>E-mail</label><br>
			<input class="holder" name="signupEmail" type="email" value="<?=$signupEmail;?>"> 
			<p style="color:#FD6876;"><?php echo $signupEmailError; ?></p>
			
			<br>
			
			<label>Password</label><br>
			<input class="holder" name="signupPassword" type="password"> 
			<p style="color:#FD6876;"><?php echo $signupPasswordError; ?></p>
			
			<br><br>
			
			<input  name="pagebutton" type="submit" value="Loo kasutaja">
			
			<br><br>
			
			<p><a href="index.php">←Tagasi</a></p>
		
		</form>
  			
			<br>

  		
		
		</section>
  	

  	
	</body>
</html> 