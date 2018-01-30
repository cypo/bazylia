<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
</head>
<style>
	.opis{
		float: left;
	
	}
	
	.form{
		float: left;
	
	}
.btn-link{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color:#0000EE;
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
</style>
<script>

function tdClick(name){
	alert(name);
	
}
function confirmDelete(){
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
	
	if(checkedOne){
		var x = confirm("Na pewno usunąć wybrane wizyty?");
	
	if(x){
		return true;
	}
	else{
		return false;
	}
	}
	else{
		alert('nie zaznaczono żadnej pozycji');
		return false;
	}
	
	
}
</script>

<?php
session_start();
require('libs/idiorm.php');
ini_set('display_errors', 0);
ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
?>
<button onclick="document.location.href='main.php'" class="btn btn-outline-secondary">Cofnij</button>
<table class="table table-hover">
			<tr>
<form action="delete.php" method="POST">
<input type="submit" class="btn btn-outline-danger" value="Usuń zaznaczone" onClick="return confirmDelete();"/>			
<?php		

			//$columns = ORM::for_table('rejestrwizyt')->raw_query('SHOW columns FROM rejestrwizyt')->find_array();
			//print_r($columns);
			$columns = array('id', 'imie', 'nazwisko', 'nazwa firmy', 'pesel', 'numer karty', 'zaświadczenie', 'rodzaj usługi', 'typ badan', 'nazwa badania','data wizyty');
			
			foreach($columns as $col){

						echo "<th>";
						echo $col;
						echo "</th>";
				
				
			}
						echo "<th>";
						echo "usuń";
						echo "</th>";
			echo "</tr>";
			
	$rejestr=ORM::for_table('rejestrwizyt')
	->raw_query("SELECT 
	rejestrwizyt.id,
	pacjenci.imie, 
	pacjenci.nazwisko, 
	firmy.nazwa AS nazwaFirmy, 
	pacjenci.pesel, 
	pacjenci.nr_karty, 
	pacjenci.zaswiadczenie, 
	rejestrwizyt.rodzaj_wizyty,  
	rejestrwizyt.typbadan,
	uslugi.nazwa AS nazwaUslugi,
	rejestrwizyt.data_wizyty
	
	FROM rejestrwizyt
	JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
	JOIN firmy ON firmy.id=rejestrwizyt.id_firmy
	JOIN uslugi ON uslugi.id=rejestrwizyt.id_uslugi
	ORDER BY rejestrwizyt.id DESC"
	)->find_array();

	
foreach($rejestr as $array => $v){

				//	echo $v['id'];
					echo "<tr>";
				//	echo "<form action=register.php method=post name=pacjenci>";  ///po co to ?
				//	echo "<input type=hidden name=id value=".$v['id']." />";
					foreach($v as $key => $value){
						if($key=='id') $delete = $value;
						echo "<td onclick=tdClick(\"$value\");>";
						echo $value;
						echo "</td>";

					}
					echo "<td>";
					echo '<input type="checkbox" name="delete[]" value="'.$delete.'"/>';
					echo "</td>";
					echo "</tr>";
				//	echo "</form>";
				}

echo '</table>';

echo '</form>';



?>