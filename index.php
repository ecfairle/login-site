<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<TITLE>Main</TITLE>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<h1>
	Lots of stuff
	</h1>
	</body>
</html>