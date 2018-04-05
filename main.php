<?php 
session_start();

//echo session_id();
//echo "<BR>";
//echo session_status();
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">	
<style>

</style>
</head>

<?php

require 'login.php';
ini_set('display_errors', 0);
//echo "LOGIN: ".$_SESSION['login'];

if($_SESSION['login']!=1){
	login::checkLogin();
	
}
if($_SESSION['login']!=1){
   // login::checkLogin();
    
}

else{
	
    //print_r($_SESSION);




include('leftMenu.php');
?>


		<td>
			<center>
			
				<img src="logo.jpg" width="40%"><br>
			<!--	<font face="verdana"><b>System rejestracji pacjentów -->
			</center>
		</td>
	
	</tr>


</table>
</div>
</div>
<?php
}
?>