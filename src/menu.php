<?php
require 'inc/bootstrap.php';
require 'inc/tpl/header.php';
require 'inc/tpl/nav.php';
?>
	<div id="content" class="container">
		<div class="left medium">
			<?php
			foreach($config->getProductCategories() as $cat){
				?>
				<section>
					<h1><?php echo htmlentities($cat->getName()); ?></h1>
					<div class="products products-small horizontal-scroll">
					<?php
					foreach($cat->getProducts() as $product){
						echo '<a href="order.php?add=' . rawurlencode($product->getName()) . '" class="pizza-showcase">
						<img src="' . $product->getImg() . '" alt="' . htmlentities($product->getName()) . '" />
						<div class="tooltip">' . htmlentities($product->getName()) . '</div>
					</a>';
					} ?>
					</div>
				</section>
			<?php } ?>
		</div>
		<div class="right small no-mobile">
			<section>
				<a href="pizzamaker.php"><img src="assets/img/banner_pizzamaker.png" /></a>
			</section>
		</div>
		<div class="clear"></div>
	</div>
<?php
require 'inc/tpl/footer.php';