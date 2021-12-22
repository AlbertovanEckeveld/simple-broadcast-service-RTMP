<?php

	require "autoload.php";

	$Error 		= "";
	$email		= "";
	$username 	= "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$email = $_POST['email'];
		if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email))
		{
			$Error = "please enter a valid email";
		}

		$date = date("Y-m-d H:i:s");
		$url_address = get_random_string(60);

		$password = esc($_POST['password']);

		$username = trim($_POST['username']);
		$username = esc($username);
		if(!preg_match("/^[a-zA-Z0-9]+$/", $username))
		{
			$Error = "please enter a valid username";
		}

			$arr = false;
			$arr['email'] = $email;

			$query = "select * from users where email = :email limit 1";			
			$stm = $connection->prepare($query);
			$check = $stm->execute($arr);

			if($check) {

				$data = $stm->fetchAll(PDO::FETCH_OBJ);
				if(is_array($data) && count($data) > 0)
				{
					echo "That email is already used";
				}
			}

		if(!$Error = "")
		{

			$arr['url_address'] = $url_address;
			$arr['username'] = $username;
			$arr['password'] = $password;
			$arr['email'] = $email;
			$arr['date'] = $date;

			$query = "insert into users (url_address,username,password,email,date) values (:url_address,:username,:password,:email,:date)";
			$stm = $connection->prepare($query);
			$stm->execute($arr);


			header("Location: login.php");
			die;
		}

	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>signup</title>


	<style type="text/css">
		
		form {
			margin: auto;
			border: solid thin #aaa;
			padding: 6px;
			max-width: 200px;
		}

		#title {
			background-color: blue;
			padding: 1em;
			text-align: center;
			color: white;
		}

		#textbox {
			border: solid thin #aaa;
			margin-top: 4px;
			width: 98%

		}

		#error {
			color: red;
		}

	</style>


</head>
<body style="font-family: verdana">


	<form method="post">
		<div id="error">
			<?php

				if(isset($Error) && $Error != "") 
				{
					echo $Error;
				}

			?>
		</div>
		<div id="title">Signup</div>
		username
		<input id="textbox" type="text" name="username" value="<?=$username?>" required> <br><br>
		email
		<input id="textbox" type="email" name="email" value="<?=$email?>" required> <br><br>
		password
		<input id="textbox" type="password" name="password" required><br><br>

		<input type="submit" value="Signup"><br><br>
	</form>

</body>
</html>