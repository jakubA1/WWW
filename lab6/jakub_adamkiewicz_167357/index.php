<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="pl" />
<meta name="Author" content="Jakub Adamkiewicz" />
<title>Historia lotów kosmicznych</title>
<script src="./js/kolorujtlo.js" type="text/javascript"></script>
<script src="./js/timedate.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="./css/index.css" />

</head>

<body onload="startclock()">﻿

	<a href="?idp=strona_p1.html">Loty na marsa</a>
	<a href="?idp=strona_p2.html">Loty na ksiezyc</a>
	<a href="?idp=strona_p3.html">Nieudane</a>
	<a href="?idp=strona_p4.html">Loty na orbite</a>
	<a href="?idp=strona_p5.html">Takie ooo</a>

<FORM METHOD="POST" NAME="background">
	<INPUT TYPE="button" VALUE="żółty" ONCLICK="changeBackground('#FFF000')"> 
	<INPUT TYPE="button" VALUE="czarny" ONCLICK="changeBackground('#000000')"> 
	<INPUT TYPE="button" VALUE="biały" ONCLICK="changeBackground('#FFFFFF')"> 
	<INPUT TYPE="button" VALUE="zielony" ONCLICK="changeBackground('#00FF00')"> 
	<INPUT TYPE="button" VALUE="niebieski" ONCLICK="changeBackground('#0000FF')">
	<INPUT TYPE="button" VALUE="pomarańczowy" ONCLICK="changeBackground('#FF8000')"> 
	<INPUT TYPE="button" VALUE="szary" ONCLICK="changeBackground('#c0c0c0')"> 
	<INPUT TYPE="button" VALUE="czerwony" ONCLICK="changeBackground('#FF0000')">
	<INPUT TYPE="button" VALUE="grafika" ONCLICK="changeBackgroundPicture('./obrazy/tlo_glowne.jpg')">
</FORM>

<div class="clock" id="zegarek"></div>
<div class="data" id="data"></div>

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

<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	if($_GET['idp'] == '' && file_exists('html/glowna.html'))$strona = 'html/glowna.html';
	if($_GET['idp'] == 'glowna' && file_exists('html/glowna.html'))$strona = 'html/glowna.html';
	if($_GET['idp'] == 'strona_p1' && file_exists('./html/strona_p1.html'))$strona = './html/strona_p1.html';
	if($_GET['idp'] == 'strona_p2' && file_exists('./html/strona_p2.html'))$strona = './html/strona_p2.html';
	if($_GET['idp'] == 'strona_p3' && file_exists('./html/strona_p3.html'))$strona = './html/strona_p3.html';
	if($_GET['idp'] == 'strona_p4' && file_exists('./html/strona_p4.html'))$strona = './html/strona_p4.html';
	if($_GET['idp'] == 'strona_p5' && file_exists('./html/strona_p5.html'))$strona = './html/strona_p5.html';
	
	include($strona);
?>
</body>
</html>
