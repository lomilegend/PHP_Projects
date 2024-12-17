<?php
	
	// Constants
	define("TITLE", "Simple Arguments");
	
	// Custom Variables
	$name	= 'Lomi';
	$lesson_num	= 25;
	$names =array('Accra','Takoradi','Tarkwa','Keta','Sogakope');

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
				
				<h3>One Argument</h3>
				<?php
				function one($n){
					echo "$n is nice town";
				}
					foreach($names as $i){
						one($i);
						echo "<br>";

					}
					// your code here
					
				?>
				
				<h3>Two Arguments</h3>
				<?php
				
					function add_up($a, $b){
						$result = $a + $b;

						//return $result;

						echo "The answer is $result";
					}
					add_up(5,54);
				
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
