<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$baza = 'moja_strona';
	global $login;
	global $pass;

	$link = mysqli_connect($dbhost,$dbuser,$dbpass) or die("Connect failed: $s\n". $link -> error);
	if (!$link) echo '<b>Połączenie zostało przerwane.</b>';
	if (!mysqli_select_db($link, $baza)) echo 'Nie wybrano bazy';
?>