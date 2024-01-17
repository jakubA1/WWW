<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'moja_strona';
	$login = 'admin';
	$pass = 'admin';

	$link = mysqli_connect($dbhost,$dbuser,$dbpass);
	if (!$link) echo '<b>Połączenie zostało przerwane.</b>';
	if (!mysqli_select_db($link, $db)) echo 'Nie wybrano bazy';
?>