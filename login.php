<?php
require('libs/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));	



class login{
    
	
	function checkLogin(){
		$mysqli = new mysqli("localhost", "bazylia", "qwerty", "bazylia");
		$login = htmlspecialchars($mysqli->real_escape_string($_POST['login']));
		$pass = $mysqli->real_escape_string($_POST['pass']);
		$pass = md5($pass);
		$_SESSION['user']=$_SESSION['login'];

		$user = ORM::for_table('users')->where(array(
                'login' => $login,
                'pass' => $pass
            ))
			->find_one();
			
		$pass='';	
		
		if(!empty($user)){
			$_SESSION['user'] = $user->login;
			$_SESSION['role'] = $user->role;
			$_SESSION['login'] = 1;
			return true;
		}
		else{
			$_SESSION['login'] = 0;
			echo "Nieprawidłowy login i/lub hasło!";
			header("Location: index.php");
			return false;
		}
	}
	
	
	
	
	
}


?>