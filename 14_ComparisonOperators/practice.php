<?php
	
	// Constants
	define('TITLE','Comparison Operators');


	
	// Custom Variables

	$lession_num = 14;

	$name = 'Lomi';
	$age = 29;
	$num = 2;
	$birthCountry = 'Ghana';
	$yearsOnEarth = 29;



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
				
				<h3>Equal <code>==</code></h3>
				<?php
					if($age == 29){
						echo "Your age is equal to $age";
					}
				?>
				
				<h3>Identical <code>===</code></h3>
				<?php
					if($num === 2){
						echo "Your favourite number is a string called $num!";
					}
				?>
				
				<h3>Not Equal <code>!=</code></h3>
				<?php
					if ($birthCountry != 'Ghana') {
					
						echo " Bossu, You must not be from around here.";
						
					}
				?>
				
				<h3>Not Identical <code>!==</code></h3>
				<?php
					if ($yearsOnEarth !== 29) {
						
						echo "<p>You are not exactly the string \"$yearsOnEarth\"</p>";
						
					} else {
						
						echo "<p>You are exactly the string '$yearsOnEarth'</p>";
						
					}
				?>
				
				<h3>Less Than <code>&lt;</code></h3>
				<?php
					if ($lession_num < 15) {
						
						echo "<p>You haven't quite made it to lesson 15, yet.</p>";
						
					}
				?>
				
				<h3>Greater Than <code>&gt;</code></h3>
				<?php
					if ($lession_num> 10) {
						
						echo "<p>You've made it past lesson 10!</p>";
						
					}
				?>
				
				<h3>Less Than or Equal To <code>&lt;=</code></h3>
				<?php
					if ($lession_num<= 14) {
						
						echo "<p>$lession_num is less than or equal to 14.</p>";
						
					}
				?>
				
				<h3>Greater Than or Equal To <code>&gt;=</code></h3>
				<?php
						if ($lession_num >= 4) {
						
							echo "<p>$lession_num is greater than or equal to 4.</p>";
							
						}
				?>
				
			</div><!-- end sandbox -->
			
			<a href="index.php" class="button">Back to the lecture</a>
			
			<hr>
			
			<small>&copy;<?php echo date('Y');  ?> - <?php echo $name; ?></small>
		</div><!-- end wrapper -->
		
		<div class="copyright-info">
			<?php include('../assets/includes/copyright.php'); ?>
		</div><!-- end copyright-info -->
	</body>
</html>
