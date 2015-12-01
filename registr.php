<?php  

	$host = 'localhost'; // хост
	$dbname = 'database'; // название базы
	$user = "root"; // логин пользователя
	$password = ""; // пароль


try {
   
	$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
	
} catch (PDOException $e) {

  	var_dump($e);
    return false;

};


// register

if (isset($_POST['submit'])) {
	
	$name = $_POST['name'];
	$login = $_POST['login'];
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];
	$rpass = $_POST['rpass'];
	if ($pass == $rpass) {
		$pass = md5($pass);
		$query = $db->prepare("INSERT INTO `users` (name, login, pass, email) VALUES('$name', '$login', '$pass', '$mail')");
		$res = $query->execute();

	} else { 

		die("Passwords dont match!");

	};

// login

if (isset($_POST['enter'])) {
	$e_login = $_POST['e_login'];
	$e_pass = md5($_POST['e_pass']);

	$query = $db->prepare("SELECT * FROM `users` WHERE login = $e_login");
	$res = $query->execute();
	// $result = $res->fetchAll();
	// print_r($result);
}


	

};


// SELECT * FROM users WHERE pass = $e_pass

?>



<form method="post" action="registr.php">
	<p><input type="text" name="name"  placeholder="* Name"></p>
	<p><input type="text" name="login"  placeholder="* Login"></p>
	<p><input type="text" name="mail"  placeholder="* Mail"></p>
	<p><input type="password" name="pass"  placeholder="* Password"></p>
	<p><input type="password" name="rpass"  placeholder="* Repeat password"></p>
	<p><input type="submit" value="Registration" name="submit"></p>
</form>


<form method="post" action="registr.php">
	
	<p><input type="text" name="e_login"  placeholder="* Login"></p>
	<p><input type="password" name="e_pass"  placeholder="* Password"></p>
	<p><input type="submit" value="Login" name="enter"></p>
	
</form>

<?php

print_r($res);

?>
