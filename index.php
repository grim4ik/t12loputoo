<?php 
	
	
	require("functions.php");
	
	// IF LOGED IN GO TO GALERRY PAGE
	if (isset($_SESSION["userId"])) {
		header("Location: gallerry.php");
		exit();
	}
	
	
	$notice = "";
	// IF WANT TO LOG IN
	if ( isset($_POST["loginEmail"]) && 
		 isset($_POST["loginPassword"]) &&
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"]) 
	) {
		
		$notice = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
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
		
		<h1>LOG IN</h1>
		
		<br>
		
		<p style="color:#FD6876;"><?=$notice;?></p>
			
			<label>E-mail</label><br>
			<input class="holder" name="loginEmail" type="email">
			
			<br><br>
			<label>Password</label><br>
			<input  class="holder" name="loginPassword" type="password">
			
			<br><br>
			
			<input name="pagebutton" type="submit" value="Log in">
			
			<br><br>
			
			<p><a href="register.php">Create new account</a></p>
			
		</form>

		
		</section>

	</body>
</html> 
