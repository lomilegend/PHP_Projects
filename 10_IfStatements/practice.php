<?php
	
	// Constants
	define('TITLE','IF Statements');

	
	// Custom Variables

	$name = 'Lomi';
	$lession_num = 10;

	$a = 15;
	$b = 17.5;




	


?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP <?php echo TITLE  ?></title>
		<link href="../assets/styles.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<a href="/" title="Back to directory" id="logo">
				<img src="../assets/img/logo.png" alt="PHP">
			</a>
			
			<h1>Tutorial <?php echo $lession_num  ?>: <small><?php echo TITLE  ?></small></h1>
			<hr>
			
			<h2>Your Example</h2>
			
			<div class="sandbox">

			<?php 	
			if($b > $a) {
				echo 
				"Yep! $b is certainly greater than $a.";
				}  
				
			?>
				
			</div><!-- end sandbox -->
			
			<a href="index.php" class="button">Back to the lecture</a>
			
			<hr>
			
			<small>&copy;<?php echo date('Y');  ?> - <?php echo $name;?></small>
		</div><!-- end wrapper -->
		
		<div class="copyright-info">
			<?php include('../assets/includes/copyright.php'); ?>
		</div><!-- end copyright-info -->
	</body>
</html>
