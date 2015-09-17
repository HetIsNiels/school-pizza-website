<?php
require 'inc/bootstrap.php';

$page = ['title' => 'Home'];
require 'inc/tpl/header.php';
require 'inc/tpl/nav.php';

$pizza = $config->getProductsByType('pizza');
?>
	<div id="content" class="container">
		<div class="left medium">
			<section>
				<div class="product products-small horizontal-scroll">
					<?php
					shuffle($pizza);

					for($i = 0; $i < 5; $i++)
						if(isset($pizza[$i]))
							echo '<a href="order.php?add=' . rawurlencode($pizza[$i]->getName()) . '" class="pizza-showcase">
						<img src="' . $pizza[$i]->getImg() . '" alt="' . htmlentities($pizza[$i]->getName()) . '" />
						<div class="tooltip">' . htmlentities($pizza[$i]->getName()) . '</div>
					</a>';
					?>
				</div>

				<h1>Welkom bij pizzeria Sopranos!</h1>
				<p>Voor de lekkerste Italiaanse pizza bent u goed terecht. Hier bij Sopranos wordt elke pizza met liefde bereid en extra geknuffelt zodra deze in de doos zit.</p>
				<p>Kies boven in het menu wat u wilt doen, zoals bijvoorbeeld een pizza bestellen!</p>
			</section>
		</div>
		<div class="right small no-mobile">
			<section>
				<a href="pizzamaker.php"><img src="assets/img/banner_pizzamaker.png" class="banner" /></a>
			</section>
		</div>
		<div class="clear"></div>
	</div>
<?php
require 'inc/tpl/footer.php';