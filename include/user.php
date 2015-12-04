<?php

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