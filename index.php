<?php

session_start();  

require_once getcwd().'/cfg/database.php';
require_once getcwd().'/tpl/register.php';
// register

if (isset($_POST['submit']) && $_POST['submit'] != ''){
	
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
	}else{ 
		echo "Passwords dont match!";
	}	

};

// login

if (isset($_POST['enter']) && $_POST['enter'] != ''){
	$e_login = $_POST['e_login'];
	$e_pass = md5($_POST['e_pass']);	

	$stmt = $db->prepare("SELECT * FROM `users` WHERE login = :e_login");
	$stmt->bindValue(':e_login', $e_login, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_LAZY);

	if ($row['pass'] == $e_pass)  {
		$logged = true;
		$_SESSION['name'] = $e_login;
	}else{
		echo "Login or password is incorrect";
	}
	
};

if (isset($_SESSION['name'])) {
	$username = $_SESSION['name'];
	echo "Logged as: ";
	echo $username;

	require_once getcwd().'/tpl/logout.php';
}else{
	require_once getcwd().'/tpl/login.php';
};

// logout

if (isset($_POST['logout'])) {
	unset($_SESSION['name']);
	session_destroy();
	header('Location: /');
};

// class User

class User {
    
    public $name;
    public $login;
    public $mail;
    
    
    public function __construct($name, $login, $mail) {
      $this->name = $name;
      $this->login = $login;
      $this->mail = $mail;
    }
    

    public function() register{

    }

    public function() login{
    	
    }
};












