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




if (isset($_POST[submit])) {
	
	$name = $_POST[name];
	$login = $_POST[login];
	$mail = $_POST[mail];
	$pass = $_POST[pass];
	$rpass = $_POST[rpass];
	if ($pass == $rpass) {
		$pass = md5($pass);
		$query = $db->prepare("INSERT INTO `users` (name, login, pass, email) VALUES('$name', '$login', '$pass', '$mail')");
	} else { 

		die("Passwords dont match!");

	};
	

};

?>



<form method="post" action="registr.php">
	<p><input type="text" name="name"  placeholder="* Name"></p>
	<p><input type="text" name="login"  placeholder="* Login"></p>
	<p><input type="text" name="mail"  placeholder="* Mail"></p>
	<p><input type="password" name="pass"  placeholder="* Password"></p>
	<p><input type="password" name="rpass"  placeholder="* Repeat password"></p>
	<p><input type="submit" value="Click" name="submit"></p>
</form>


<?php
	
	echo "$name $login $mail $pass $rpass";

?>

