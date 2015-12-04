<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);


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
    public $db;
    public $e_login;
    public $e_pass;
        
    public function register(){
		if ($this->pass == $this->rpass) {
			$this->pass = md5($this->pass);
			$query = $this->db->prepare("INSERT INTO `users` (name, login, pass, email) VALUES('$this->name', '$this->login', '$this->pass', '$this->mail')");
			$result = $query->execute();
			echo "Registration succesfull";
		}else{ 
			echo "Passwords dont match!";
		}	
    }

    public function login(){
		$query = $this->db->prepare("SELECT * FROM `users` WHERE login = :e_login");
		$query->bindValue(':e_login', $this->e_login, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_LAZY);
		if ($result['pass'] == $this->e_pass)  {
			$_SESSION['name'] = $this->e_login;
		}else{
			echo "Login or password is incorrect";
		}
    }
};
// register
if (isset($_POST['submit']) && $_POST['submit'] != ''){
	$user = new User();
	$user->name = $_POST['name'];
	$user->login = $_POST['login'];
	$user->pass = $_POST['login'];
	$user->rpass = $_POST['rpass'];
	$user->mail = $_POST['mail'];
	$user->db = $db;
	$user->register();
};
// login
if (isset($_POST['enter']) && $_POST['enter'] != ''){
	$user = new User();
	$user->e_login = $_POST['e_login'];
	$user->e_pass = md5($_POST['e_pass']);
	$user->db = $db;
	$user->login();
};
// logged
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











