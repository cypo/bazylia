<head>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>


</head>
<?php
ini_set('display_errors', 0);
require('libs/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));




$pacjent=ORM::for_table('pacjenci')->where('pesel', $_POST['peselPacjenta'])->find_one();
$pacjent->set('zasw_reset', 0);
if($_POST['nd']!='1') $pacjent->set('zaswiadczenie', $_POST['zaswData']);
$pacjent->save();

//tabela historia zaswiadczen
$zaswiadczenie=ORM::for_table('zaswiadczenia')->create();
$zaswiadczenie->pesel = $_POST['peselPacjenta'];
$zaswiadczenie->data = $_POST['zaswData'];
$zaswiadczenie->save();


?>
 <script language="javascript" type="text/javascript">
 $(document).ready(function() {
     $(location).attr('href','rejestrWizyt.php');
 });
 </script>

