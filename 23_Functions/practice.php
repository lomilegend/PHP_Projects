<?php
	
	// Constants
	define("TITLE", "Intro to Functions");
	
	// Custom Variables
	$name	= 'Lomi';
	$lesson_num	= 23;
	// Custom array
	$food = array("Meat", "Potatoes", "Beans", "Rice");
	$num = array(1,2,3,4,5,6,7,8,9,10);
	$pass = "Kwameelorm@prog_23"
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP <?php echo TITLE; ?></title>
		<link href="../assets/styles.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<a href="/" title="Back to directory" id="logo">
				<img src="../assets/img/logo.png" alt="PHP">
			</a>
			
			<h1>Tutorial <?php echo $lesson_num; ?>: <small><?php echo TITLE; ?></small></h1>
			<hr>
			
			<h2>Your Example</h2>
			
			<div class="sandbox">

			<?php
					
				echo "These arrays will be used for the exmaples below";

				echo "<br>";

				echo json_encode ($food); 

				echo "<br>";

				echo json_encode ($num);
					
			?>
				
				<h3>Using <code>sort()</code></h3>
				<?php
					
					sort($food);
					foreach($food as $item){
						echo $item;
						echo "<br>";
					}
					
				?>
				
				<h3>Using <code>rsort()</code></h3>
				<?php
					
					sort($num);
					foreach($num as $digit){
						echo $digit;
						echo "<br>";
					}
					
				?>
				
				<h3>Using <code>strtolower()</code></h3>
				<?php
					
					
					foreach($food as $item){
						echo strtolower($item);
						echo "<br>";
					}
					
				?>
				
				<h3>Using <code>sha1()</code></h3>
				<?php
					$result = sha1($pass);
					echo "Before : $pass";
					echo "<br>";
					echo "After:$result ";

					
				?>
				
			</div><!-- end sandbox -->
			
			<a href="index.php" class="button">Back to the lecture</a>
			
			<hr>
			
			<small>&copy;<?php echo date('Y'); ?> - <?php echo $name; ?></small>
		</div><!-- end wrapper -->
		
		<div class="copyright-info">
			<?php include('../assets/includes/copyright.php'); ?>
		</div><!-- end copyright-info -->
	</body>
</html>
