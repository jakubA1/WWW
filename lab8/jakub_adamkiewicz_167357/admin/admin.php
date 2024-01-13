<?php

session_start();

if(isset($_SESSION['user_id'])){
	header("index.php");
	exit();
}

function FormularzLogowania($login, $haslo)
{
	$wynik = '
		<div class = "logowanie">
		<h1 = class = "heading">Panel CMS:</h1>
		<div class = "logowanie">
		<form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
			<table class="logowanie">
				<tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie" /></td></tr>
				<tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie" /></td></tr>
				<tr><td>&nbsp; </td><td><input type="submit" name="x1_submit" class="logowanie" value="zaloguj" /></td></tr>
			</table>
		</form>
		</div>
		</div>
	';
	return $wynik;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$_SESSION['user.id'] = $user_id;
	header("index.php");
	exit();
}
	

echo FormularzLogowania($login, $haslo);
?>