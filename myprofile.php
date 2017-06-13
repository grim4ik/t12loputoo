<?php
	//uhendan sessiooniga
	require("functions.php");
	
	$people = getUserInfo();

	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: index.php");	
	}
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
			
		<br><!--SPACE BETWEEN HEAD MENU AND PAINTER -->
<?php

	$html = "<table class='table1'>";
		
		$html .= "<tr>";
			$html .= "<th>Title</th>";
			$html .= "<th>Description</th>";
			$html .= "<th>Email</th>";
			$html .= "<th>Picture</th>";
			$html .= "<th> *** </th>";
		$html .= "</tr>";
		
		// iga liikme kohta massiivis
		foreach ($people as $p) {
		
		$html .= "<tr>";
			$html .= "<td>".$p->title."</td>";
			$html .= "<td>".$p->descrip."</td>";
			$html .= "<td>".$_SESSION["userEmail"]."</td>";
			$html .= "<td><img width='700px' height='400px' src='".$p->photo."'/></td>";
			$html .= "<td><a href='delete.php?id=".$p->id."'>See full/Delete</a></td>";
		$html .= "</tr>";
		
		}
	
	$html .= "</table>";
	echo $html;


?>
		</section>
  

	</body>
</html>