<?php

session_start();  

require_once getcwd().'/cfg/database.php';
require_once getcwd().'/tpl/register.php';

// class User
class User {

	
    public $name;
    public $login;
    public $pass;
    public $rpass;
    public $mail;
    
    public function __construct($name, $login, $mail, $pass, $rpass, $db){

	   	$this->name = $name;
		$this->login = $login;
		$this->mail = $mail;
		$this->pass = $pass;
		$this->rpass = $rpass;
		$this->db = $db;
    }
    
    public function register(){
		if ($this->pass == $this->rpass) {
			$this->pass = md5($this->pass);
			$query = $this->db->prepare("INSERT INTO `users` (name, login, pass, email) VALUES('$this->name', '$this->login', '$this->pass', '$this->mail')");
			$res = $query->execute();
			echo "Registration succesfull";
		}else{ 
			echo "Passwords dont match!";
		}	
    }

    public function login(){
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
    }

};

// register
if (isset($_POST['submit']) && $_POST['submit'] != ''){
	$man = new User($_POST['name'], $_POST['login'], $_POST['mail'], $_POST['pass'], $_POST['rpass'], $db);
	$man->register();
};
// login
if (isset($_POST['enter']) && $_POST['enter'] != ''){
	$man = new User();
	print_r($man);
	
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













