<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="pl" />
	<meta name="Author" content="Jakub Adamkiewicz" />
	<script src="js/kolorujtlo.js" type="text/javascript"></script>
	<script src="js/timedate.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="./css/index.css" />

</head>
<body onload="startclock()">﻿

<div class="clock" id="zegarek"></div>
<div class="data" id="data"></div>


	<nav>
        <ul class="menu">
            <li>
				<a href="#">Menu</a>
				<ul class="submenu">
					<li><a href="index.php">Strona główna</a></li>
					<li><a href="?idp=2">Pionierzy Kosmosu</a></li>
					<li><a href="?idp=3">Misje Historyczne</a></li>
					<li><a href="?idp=4">Technologia i Statki Kosmiczne</a></li>
					<li><a href="?idp=5">Nauka w Kosmosie</a></li>
					<li><a href="?idp=6">Przyszłość Eksploracji Kosmicznej</a></li>
					<li><a href="?idp=7">Filmy</a></li>
				</ul>
            </li>
        </ul>
    </nav>
	
	<nav class="menu2">
        <ul class="menu">
            <li>
				<a href="#">Pomoc</a>
				<ul class="submenu">
					<li><a href="./admin/admin.php">Admin</a></li>
					<li><a href="./html/contact.html">Kontakt</a></li>
					<li><a href="koszyk.php">Sklep</a></li>	
				</ul>
            </li>
        </ul>
    </nav>
	
<?php
	include 'cfg.php';
	include 'showpage.php';
	if (isset($_GET['idp'])) {
		echo PokazPodstrone($_GET['idp']);
	}
	else {
		echo PokazPodstrone(1);
	}
?>


<p>
<?php

$nr_indeksu = '167357';
$nrGrupy = '1 ISI';

echo 'Jakub Adamkiewicz '.$nr_indeksu.' grupa '.$nrGrupy.'<br/><br/>';

?>
</p>


</body>
</html>
