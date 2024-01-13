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

	<div class="head">
		<a href="index.php">Strona główna</a>
		<a href="?idp=2">Loty na marsa</a>
		<a href="?idp=3">Loty na ksiezyc</a>
		<a href="?idp=4">Loty na orbite</a>
		<a href="?idp=5">Nieudane loty</a>
		<a href="?idp=6">Takie ooo</a>
		<a href="?idp=7">Filmy</a>
	</div>

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
<script src="js/kolorujtlo.js" type="text/javascript"></script>
</html>
