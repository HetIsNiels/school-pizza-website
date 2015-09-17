<?php
require 'inc/bootstrap.php';

if(!isset($_COOKIE['cartData'])) {
	header('location: order.php');
	die;
}

$data = json_decode($_COOKIE['cartData'], true);

$price = 0;
$d = 0;
foreach($data['cart'] as &$item){
	$price += $item['price'];

	if($item['type'] == 'pizza'){
		$d++;

		if($d == 2){
			$d = 0;
			$price -= $item['price'] / 2;

			$item['price'] = $item['price'] / 2;
		}
	}
}

require 'inc/tpl/header.php';
require 'inc/tpl/nav.php';
?>
	<div id="content" class="container">
		<div class="big">
			<section>
				<?php if(!isset($_GET['return'])){ ?>
					<h1>Betalings opties (&euro;<?php echo number_format($price, 2); ?>)</h1>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart" />
						<input type="hidden" name="upload" value="1" />
						<input type="hidden" name="business" value="hin@live.nl" />
						<input type="hidden" name="item_name_1" value="Sopranos Bestelling" />
						<input type="hidden" name="amount_1" value="<?php echo $price; ?>" />

						<?php
						$i = 0;
						foreach($data['cart'] as $item){
							$i++;
							?>
							<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $item['name']; ?>" />
							<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $item['price']; ?>" />
						<?php } ?>

						<input type="hidden" name="no_shipping" value="0" />
						<input type="hidden" name="no_note" value="1" />
						<input type="hidden" name="currency_code" value="EUR" />
						<input type="hidden" name="lc" value="NL" />
						<input type="hidden" name="bn" value="PP-BuyNowBF" />
						<input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>?return">

						<button type="submit" id="cart-paypal-button">Betalen via PayPal</button>
					</form>
					<form method="get">
						<input type="hidden" name="return" value="freepay" />
						<button type="submit">Betalen via Sopranos free pay</button>
					</form>
					<script>
						var i = 12;

						function countDown(){
							i--;

							if(i == 0)
								document.getElementById('cart-paypal-button').click();

							if(i >= 0)
								document.getElementById('cart-paypal-button').innerHTML = 'Betalen via PayPal (' + i + ')';
						}

						window.addEventListener('load', function(){
							i++;
							countDown();
							setInterval(countDown, 1000);
						});
					</script>
				<?php
				}else{
					define('NR', "\n\r");
					$mail = 'Bestelling' . NR . NR;

					foreach($data['cart'] as $item){
						$mail .= $item['name'] . ' | ' . number_format($item['price'], 2) . NR;
					}

					$mail .= NR . 'TOTAAL | ' . number_format($price, 2) . NR;

					foreach($config->getLocations() as $location)
						if($location->getName() == $data['location'])
							$useLoc = $location;

					mail($location->getMail(), 'Nieuwe bestelling', $mail);

					$mail = 'Beste,' . NR . $mail;
					$mail = 'Bedankt voor uw bestelling bij Sopranos' . NR . $mail;
					$mail = 'Uw bestelling ziet er alsvolgt uit:' . NR . NR . $mail;
					$mail .= NR . 'Wilt u onze reclamefolder bekijken?' . NR;
					$mail .= 'Kijk nu op onze website!';

					mail($data['mail'], 'Uw Sopranos bestelling', $mail);
				?>
					<h1>Betaling geslaagd!</h1>
					<p>Uw betaling is geslaagd. Uw pizza kan binnen circa 30 minuten opgehaald worden op de door u gekozen vestiging. Controleer uw e-mail voor meer informatie.</p>
				<?php } ?>
			</section>
		</div>
	</div>
<?php
require 'inc/tpl/footer.php';