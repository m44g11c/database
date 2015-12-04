<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

session_start();  

require_once getcwd().'/cfg/database.php';
require_once getcwd().'/tpl/register.php';
require_once getcwd().'/include/user.php';

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











