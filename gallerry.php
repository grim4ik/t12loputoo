<?php 
	//uhendan sessiooniga
	require("functions.php");
	
	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: index.php");
		exit();
	}
	
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: index.php");
		
	}
	
	
	if ( isset($_POST["title"]) && 
		 isset($_POST["descrip"]) &&
		 isset($_POST["photo"]) &&
		 !empty($_POST["title"]) &&
		 !empty($_POST["descrip"]) &&
		 !empty($_POST["photo"]) 
	) {
		
		$title = cleanInput($_POST["title"]);
		$descrip = cleanInput($_POST["descrip"]);
		$photo = cleanInput($_POST["photo"]);
		
		

		saveEvent(cleanInput($_POST["title"]), $descrip, $photo);
		
	}
	
	$people = getAllPeople();
	

	
?>
<!DOCTYPE html>
  <html>
    
  	<head>
  	<link rel="stylesheet" type="text/css" href="style.css">
  	</head>
  
  	<body>
  		
  		<section>
		
		<!--HEADER-->
		<header> <h1 class="headertext">ITEM SALE</h1> </header>
			<!--UNDER HEADER MENU -->
			<div class="menustyle">
				<table>
					<th><a href="gallerry.php">HOME</a></th>
					<th><a href="myprofile.php">MY ADS</th>
					<th><a href="?logout=1">SIGN OUT</a></th>
				</table>
			</div>
			
<h1 >Add your ads</h1>
<form method="POST" >
	
	<label>Title</label><br>
	<input class="holder" name="title" type="test">
	
	<br><br>
	
	<label>Description</label><br>
	<input class="holder" name="descrip" type="text">
	
	<br><br>
	
	<label>Picture 700px/400px </label><br>
	<input class="holder" name="photo" type="url">
	
	<br><br>
	
	<input name="pagebutton" type="submit" value="Save">
	<br><br>

</form>

<h2>ADS</h2>

<?php

	$html = "<table class=table1>";
		
		$html .= "<tr>";

			$html .= "<th>Title</th>";
			$html .= "<th>Description</th>";
			$html .= "<th>Email</th>";
			$html .= "<th>Picture</th>";

		$html .= "</tr>";
		
		// iga liikme kohta massiivis
		foreach ($people as $p) {
		
		$html .= "<tr>";
		$html .= "<td>".$p->title."</td>";
		$html .= "<td>".$p->descrip."</td>";
		$html .= "<td>".$_SESSION["userEmail"]."</td>";
		$html .= "<td><img width='700px' height='400px' src='".$p->photo."'/></td>";
		$html .= "</tr>";
		
		}
	
	$html .= "</table>";
	echo $html;


?>

  			
	
		</section>
  	

  	
	</body>
</html>