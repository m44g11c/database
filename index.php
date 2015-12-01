<?php  

require_once 'cfg/database.php';
require_once 'tpl/register.php';

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
		echo "Registration succesfull";
	} else { 
		echo "Passwords dont match!";
	}	

};

// login

if (isset($_POST['enter'])) {
	$e_login = $_POST['e_login'];
	$e_pass = md5($_POST['e_pass']);

	$stmt = $db->prepare("SELECT * FROM `users` WHERE login = :e_login");
	$stmt->bindValue(':e_login', $e_login, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_LAZY);

	if ($row['pass'] == $e_pass)  {
		$logged = true;
		echo "Login succes!";
	}else{
		echo "Login or password is incorrect";
	}
	
};	




