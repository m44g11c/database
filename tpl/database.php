<?php

	$host = 'localhost'; // хост
	$dbname = 'database'; // название базы
	$user = "root"; // логин пользователя
	$password = ""; // пароль


	try {
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		} catch (PDOException $e) {
	  	var_dump($e);
	};

?>
