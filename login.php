<?php
//include_once('libs/idiorm.php');
require('include/db.php');



class login{
    
	
	function checkLogin(){
		$mysqli = new mysqli("serwer1873494.home.pl", "27329434_bazylia", "D7042d156!", "27329434_bazylia");
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