<?php

define('TITLE', "Menu | The Waakye's Spot");
include('includes/header.php');

?>

<div id="menu-items">
	
    <h1>Our Delicious Menu</h1>
    <p>Like our team, our menu is very small — but dang, does it ever pack a punch!</p><br>

    <p><em>Click any menu item to learn more about it.</em></p>

    


    
    <hr>
    
    <?php foreach ($menuItems as $dish => $food) { ?>
            <ul>

            <li><a href="dish.php?food=<?php echo $dish; ?>"><?php echo $food['title']; ?></a> <sup>₵</sup><?php echo $food['price']; ?></li>

            </ul>
    
    <?php } ?>
    
</div><!-- menu-items-->

<hr>


<?php
include('includes/footer.php');?>