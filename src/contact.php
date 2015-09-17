<?php
require 'inc/bootstrap.php';

$page = ['title' => 'Home'];
$currentLocation = null;

if(isset($_GET['location']))
	foreach($config->getLocations() as $location)
		if($location->getName() == $_GET['location']) {
			$currentLocation = $location;
			$page['jumbo'] = [
				'title' => $currentLocation->getName(),
				'image' => 'http://maps.google.com/maps/api/staticmap?center=' . urlencode($currentLocation->getLocation()) . '&zoom=20&size=2700x400&maptype=terrain&scale=2'
			];
		}

require 'inc/tpl/header.php';
require 'inc/tpl/nav.php';
?>
	<div id="content" class="container">
		<div class="left medium">
			<?php if($currentLocation == null){ ?>
				<section>
					<h1>Contact opnemen met Sopranos</h1>
					<p>U kunt rechts klikken op de vestiging van Sopranos waarmee u contact wilt opnemen. De hoofdlocatie van Sopranos is gevestigd in Rotterdam.</p>
				</section>
			<?php }else{ ?>
				<section>
					<h1><?php echo htmlentities($currentLocation->getName()); ?></h1>
					<img id="contact-map" src="" />
					<script type="text/javascript">
						function map() {
							var map = document.getElementById('contact-map');
							var size = map.parentNode.clientWidth + 'x300';

							map.src = 'http://maps.google.com/maps/api/staticmap?center=<?php echo urlencode($currentLocation->getLocation()); ?>&zoom=20&size=' + size + '&markers=color:red%7Clabel:S%7C<?php echo urlencode($currentLocation->getLocation()); ?>&maptype=terrain';
						}

						window.addEventListener('load', map);
					</script>
					<p class="left">
						<?php echo htmlentities($currentLocation->getAdress()); ?><br />
						<?php echo htmlentities($currentLocation->getZip() . ' ' . $currentLocation->getCity()); ?>
					</p><p class="right">
						Telefoon: <?php echo htmlentities($currentLocation->getTel()); ?><br />
						E-mail: <?php echo htmlentities($currentLocation->getMail()); ?><br />
						Open van <?php echo number_format($currentLocation->getVisitingHours()[0], 2, ':', '') . ' tot ' . number_format($currentLocation->getVisitingHours()[1], 2, ':', ''); ?>
					</p>
					<div class="clear"></div>
				</section>
			<?php }?>
		</div>
		<div class="right small">
			<section class="sidebar">
				<h1>Locaties</h1>
				<?php
				foreach($config->getLocations() as $location){
					echo '<a href="?location=' . urlencode($location->getName()) . '"' . (isset($_GET['location']) && $_GET['location'] == $location->getName() ? ' class="selected"' : '') . '>' .  htmlentities($location->getName()). '</a>';
				}
				?>
			</section>
		</div>
		<div class="clear"></div>
	</div>
<?php
require 'inc/tpl/footer.php';