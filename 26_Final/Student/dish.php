<?php

define('TITLE', "Dish-Menu | The Waakye's Spot");
include('includes/header.php');

?>
<?php 

	// Strip bad characters function
	function strip_bad_chars( $input ) {
		$output = preg_replace( "/[^a-zA-Z0-9_-]/", "",$input);
		return $output;
	}
	
	if(isset($_GET['food'])) {
		$menuItem = strip_bad_chars( $_GET['food'] );
		$dish = $menuItems[$menuItem];
	}

    function suggestedTip($price, $tip) {
        $totalTip = $price * $tip;
        
        echo number_format($totalTip, 2);

    }	


?>

<div id="dish">
	
    <h1><?php echo $dish["title"]; ?> <span class="price"><sup>₵</sup><?php echo $dish["price"]; ?></span></h1>
    <p><?php echo $dish["toppings"]; ?></p>
    <br>
    <p><strong>Suggested protein</strong>: <?php echo $dish['protein']; ?></p>
    <p><em>Suggested tip: <sup>₵</sup><?php suggestedTip($dish["price"], 0.01); ?></em></p>
    
</div><!-- dish -->

<hr>

<a href="menu.php" class="button previous">&laquo; Back to Menu</a>

<?php
include('includes/footer.php');?>