<?php
	//uhendan sessiooniga
	require("functions.php");
	
	$p = getsingleId($_GET["id"]);
	
	if(isset($_GET["delete"])){
		deleteart($_GET["id"]);
		header("Location: myprofile.php");
		exit();
	}
	
	//kas aadressireal on logout
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
		
		<img width="800" height="500" src="<?php echo $p->photo;?>">
		
		<h1>Your image url: <br>
		<textarea style="font-size:20px" rows="3" cols="45"> <?php echo $p->photo;?> </textarea>
		<br>
		<a href="?id=<?=$_GET["id"];?>&delete=true">Delete</a></h1>

</form>

		
		</section>


	</body>
</html>