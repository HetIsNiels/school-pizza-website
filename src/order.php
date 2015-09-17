<?php
require 'inc/bootstrap.php';
require 'inc/tpl/header.php';
require 'inc/tpl/nav.php';

$hour = intval(date('G'));
$productToAdd = null;

if(isset($_GET['add']))
	foreach($config->getAllProducts() as $product)
		if($product->getName() == $_GET['add'])
			$productToAdd = $product;

if($productToAdd != null){
?>
	<script>
		window.addEventListener('load', function(){
			addToCart('<?php echo htmlentities($productToAdd->getName()); ?>', '<?php echo htmlentities($productToAdd->getPrice()); ?>', '<?php echo htmlentities($productToAdd->getType()); ?>');
		});
	</script>
<?php } ?>
	<div id="content" class="container">
		<div class="left medium">
			<?php
			$scrollDir = [];

			foreach($config->getProductCategories() as $cat){
				$scrollDir[] = $cat->getName();
				?>
				<a name="<?php echo rawurlencode($cat->getName()); ?>"></a>
				<section class="products">
					<h1><?php echo htmlentities($cat->getName()); ?></h1>
					<?php
					foreach($cat->getProducts() as $product){
						?>
						<div class="product">
							<div class="left">
								<img src="<?php echo $product->getImg(); ?>" />
							</div>
							<div class="left info">
								<h2>
									<?php echo htmlentities($product->getName()); ?>
									<span class="right">&euro;<?php echo number_format($product->getPrice(), 2); ?></span>
								</h2>

								<?php
								if(strlen($product->getDesc()) > 0)
									echo '<em>' . htmlentities($product->getDesc()) . '</em>';
								?>
								<table>
									<tr>
										<td>
											<button data-cart-action="add" data-cart-name="<?php echo htmlentities($product->getName()); ?>" data-cart-price="<?php echo number_format($product->getPrice(), 2); ?>" data-cart-type="<?php echo htmlentities($product->getType()); ?>">Normaal</button>
										</td>
										<?php
										foreach($product->getExtra() as $extra){
											echo '<td><button data-cart-action="add" data-cart-name="' . htmlentities($product->getName() . ' ' . $extra->getName()) . '" data-cart-price="' . number_format($product->getPrice() + $extra->getPrice(), 2) . '" data-cart-type="' . htmlentities($product->getType()) . '">' . htmlentities(ucfirst($extra->getName())) . ($extra->getPrice() > 0 ? ' +&euro;' . number_format($extra->getPrice(), 2) : '') . '</button></td>';
										}
										?>
									</tr>
								</table>
							</div>
							<div class="clear"></div>
						</div>
					<?php } ?>
				</section>
			<?php } ?>
		</div>
		<div class="right small" id="order-fixed-scroll">
			<section class="no-mobile">
				<h1>Categorie&euml;n</h1>
				<?php
				foreach($scrollDir as $cat){
					echo '<a href="#' . rawurlencode($cat) . '" class="button arrow">' . htmlentities($cat) . '</a>';
				}
				?>
			</section>
			<section id="cart"></section>
			<?php if($hour < 10 || $hour > 23){ ?>
				<section class="notif error">
					<strong>Let op</strong><br />
					Alle Sopranos vestigingen zijn op dit moment gesloten.<br />
					U kunt op de <a href="contact.php">contact pagina</a> de openingstijden per vestiging bekijken.
				</section>
			<?php }else{?>
				<section class="noborder">
					<select title="Kies uw vestiging" id="cart-select-location">
						<option selected="selected" disabled="disabled">Kies een vestiging</option>
						<?php foreach($config->getLocations() as $location){ ?>
							<option value="<?php echo urlencode($location->getName()); ?>"><?php echo htmlentities($location->getName()); ?></option>
						<?php } ?>
					</select>
					<button data-cart-action="order" disabled="disabled" id="cart-order-button">Afrekenen</button>
				</section>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
<?php
require 'inc/tpl/footer.php';