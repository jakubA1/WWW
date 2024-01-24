<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'moja_strona';
	$login = 'admin';
	$pass = 'admin';

	$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
	if (!$conn) echo '<b>Połączenie zostało przerwane.</b>';
	if (!mysqli_select_db($conn, $db)) echo 'Nie wybrano bazy';
?>