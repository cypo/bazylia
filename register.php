<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<style>
#regForm {
  background-color: #f1f1f1;
  margin: 50px auto;
  
  padding: 40px;
  width: 85%;
  min-width: 300px;
}
	
	</style>
	



</head>

<?php
ini_set('display_errors', 0);
session_start();


echo "LOGIN: ".$_SESSION['login'];

//id pacjenta przypisywane do sesji - potrzebne ?
if($_POST['id']){
	//session_unset();
	$_SESSION['id']=$_POST['id'];
	
}
require('libs/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

?>
<center>
<div class="container">
<div class="jumbotron"  style="padding-top: 10px;">
<center>
<table border="0" width="1000">
	<tr>
		<td width="1000" colspan="2">
		
		
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="main.php">Wyszukaj pacjenta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="rejestrWizyt.php">Zarejestrowane wizyty</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Raporty</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="logout.php">Wyloguj</a>
  </li>
</ul>
		</td>

	
	</tr>
	<tr height="500">
		<td width="20%" valign="top">

<?php 


$pacjent=ORM::for_table('pacjenci')->where('id', $_SESSION['id'])->find_one();
$zaswExpired=false;
if(strtotime($pacjent->zaswiadczenie)<time()){
	$zaswExpired=true;
	$fontColor="red";
}
else{
	$fontColor="#000000";
}

echo "<h4>Rejestracja pacjenta:</h4><BR>
Imię: ".$pacjent->imie."<BR>
Nazwisko: ".$pacjent->nazwisko."<BR>
ul: ".$pacjent->ulica."<BR>
Miasto: ".$pacjent->miasto."<BR>
PESEL: ".$pacjent->pesel."<BR>
Zaświadczenie: <font color=".$fontColor.">".$pacjent->zaswiadczenie."</font>";
echo "<BR>";
?>
</td>
<td valign="top">




  <div>
<center>
	<h1>Rodzaj wizyty</h1><BR>


<form action="registermp.php" method="POST" id="regForm">
	<input type="submit" class="btn btn-outline-primary" value="Medycyna pracy">
	<input type="hidden" name="pacjentId" value="<?php echo $pacjent->id; ?>">
	<input type="hidden" name="rodzajWizyty" value="mp">
</form>
<form action="registermp.php" method="POST" id="regForm">
	<input type="submit" class="btn btn-outline-secondary" value="Specjalistyka">
	<input type="hidden" name="pacjentId" value="<?php echo $pacjent->id; ?>">
</form>








		
  </div>
 
  
 
</form>




</td>
</tr>
</table>
</div>
</div>