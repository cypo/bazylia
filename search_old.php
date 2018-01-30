<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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

.hover-hand{
	
	cursor: pointer;
	cursor: hand;
}
</style>

<?php
require('libs/idiorm.php');
ini_set('display_errors', 0);
ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$searchArray = Array();

if($_POST['pesel']!=null) $searchArray['pesel'] = "%".$_POST['pesel']."%";
if($_POST['numerKarty']!=null) $searchArray['nr_karty'] = $_POST['numerKarty']."%";
if($_POST['imie']!=null) $searchArray['imie'] = $_POST['imie']."%";
if($_POST['nazwisko']!=null) $searchArray['nazwisko'] = $_POST['nazwisko']."%";
if($_POST['ulica']!=null) $searchArray['ulica'] = "%".$_POST['ulica']."%";
if($_POST['miasto']!=null) $searchArray['miasto'] = "%".$_POST['miasto']."%";
if($_POST['kod-pocztowy']!=null) $searchArray['kod_poczt'] = $_POST['kod-pocztowy']."%";
if($_POST['telefon']!=null) $searchArray['telefon'] = $_POST['telefon']."%";
if($_POST['nip']!=null) $searchArray['nip'] = $_POST['nip']."%";
if($_POST['firma']!=null) $searchArray['firma'] = $_POST['firma']."%";
if($_POST['stanowisko']!=null) $searchArray['stanowisko'] = "%".$_POST['stanowisko']."%";
if($_POST['zaswiadczenie']!=null) $searchArray['zaswiadczenie'] = $_POST['zaswiadczenie']."%";
if($_POST['lekarz']!=null) $searchArray['lekarz'] = "%".$_POST['lekarz']."%";


if($_POST['zakres']=='all'){
	$pacjenci=ORM::for_table('pacjenci')->find_array();	
} 
else if($_POST['zakres']=='selected'){
	///////try catch
	$pacjenci=ORM::for_table('pacjenci')
		->where_like($searchArray)
		->find_array();
	
}



//print_r($pacjenci);
?>

<center>
<table border="1">
	<tr>
		<td width="1300">
		
		
		</td>
	</tr>
	<tr>
				<td>
		<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Wyszukaj pacjenta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Zarejestrowane wizyty</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Raporty</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">Wyloguj</a>
  </li>
</ul>
		</td>
	
	</tr>
	<tr>
		<td colspan="4">
		
			<table border="1" class="table-hover hover-hand">
			<tr>
			
			<?php
			$columns = ORM::for_table('pacjenci')->raw_query('SHOW columns FROM pacjenci')->find_array();
			//print_r($columns);
			
			
			foreach($columns as $key => $value){
				//echo $key."<BR>";
				//echo $value."<BR>";
				foreach($value as $k => $v){
				//	echo "key:".$k."<BR>";
					//echo "value:".$v."<BR>";
					if($k=='Field'){
						echo "<th>";
						echo $v;
						echo "</th>";
					}
					else{
						
					}
				}
			}
			echo "</tr>";
			
				foreach($pacjenci as $array => $v){

					//echo $v['id'];
					echo '<tr onclick=document.forms[\'form'.$v['id'].'\'].submit(); return false;>';
					echo '<form action="register.php" method="post" name="form'.$v['id'].'">';
					echo "<input type=hidden name=id value=".$v['id']." />";
					
					foreach($v as $key => $value){

						echo "<td>";
						echo $value;
						echo "</td>";

					}

					echo "</form>";
					echo "</tr>";
					
				}
			
			
			?>
			
			</table>
			<BR><BR>
			
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
Dodaj pacjenta
</button>

<div class="collapse" id="collapseExample">
  <div class="card card-body">
			<table border="1">
			<form action="dodajPacjenta.php" method="POST">
		<?php
			echo "<tr>";
			foreach($columns as $key => $value){
				foreach($value as $k => $v){
					if($k=='Field' && $v!='id'){
						echo "<td>";
						echo $v;
						echo "</td>";
						echo "<td>";
						echo "<input type=\"text\" name=\"".$v."\" required/>";
						echo "</td>";
					}
				}
				echo "</tr>";
			}
			
			


		
		?>
		</table>
		<input type="submit" class="btn btn-success" value="Dodaj"/>
		</form>   
   </div>
</div>
			

		</td>
	
	</tr>


</table>