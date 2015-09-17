
<footer class="container footer">
	<div class="left">Gemaakt door <a href="//hetisniels.nl">Niels van Velzen</a> voor <a href="//school.hetisniels.nl">school</a></div>
	<div class="right"><?php echo '2015' . (date('Y') !== '2015' ? ' - ' . date('Y') : ''); ?></div>
	<div class="clear"></div>
</footer>
</body>
</html>
<!--
<?php
// Windows 10 heeft problemen met output buffering en door een boel tekens neer te zetten aan het einde van het script "verhelp" je deze problemen.
for($i = 0; $i < 600; $i++)
	echo '0';