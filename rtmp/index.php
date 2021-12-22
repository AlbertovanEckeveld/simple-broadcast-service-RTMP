<?php

	require "autoload.php";
	$user_data = check_login($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
</head>
<body>
	This is the home page
	<br>
<?=$_SESSION['username']; ?>
</body>
</html>