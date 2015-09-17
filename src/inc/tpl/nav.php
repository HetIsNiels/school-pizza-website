<div id="jumbo"<?php echo isset($page['jumbo']['image']) ? ' style="background-image: url(\'' . $page['jumbo']['image'] . '\');"' : ''; ?>>
	<header>
		<div class="container">
			<a href="#" id="logo">
				<img src="assets/img/logo.png" />
				<img src="assets/img/logo_print.png" class="print" />
			</a>

			<nav>
				<a href="index.php">Home</a>
				<a href="menu.php">Menukaart</a>
				<a href="order.php">Bestellen</a>
				<a href="contact.php">Contact</a>
			</nav>
		</div>
		<div class="clear"></div>
	</header>
	<h2 id="slogan" class="container">
		<?php echo isset($page['jumbo']['title']) ? $page['jumbo']['title'] : 'D&eacute; lekkerste orginele Italiaanse pizzeria.'; ?>
	</h2>
</div>