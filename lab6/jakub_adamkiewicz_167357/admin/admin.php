<?php

session_start();

if(isset($_SESSION['user_id'])){
	header("index.php");
	exit();
}

?>