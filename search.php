<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
</head>
<style>


</style>
<script type="text/javascript" language="JavaScript">

function showContent(id){
	
	$('.panel-collapse').collapse("hide");
	
	$('#div_'+id).collapse("toggle");
	$('#tr_'+id).removeClass("invisible");
	$("tr[name='header']").removeClass("detailedDiv");
	$('#header_'+id).addClass("detailedDiv");
	
}
function deleteUser(id){
	var con = confirm("Na pewno usunąć pacjenta?");
	
	if(con){
		console.log("deleteUser");
		$.post("deletePacjent.php", {id:id}, function(){
		location.reload();	
		});
		return true;
	}
	else{
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
echo "LOGIN: ".$_SESSION['login'];
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
    $pacjenci=ORM::for_table('pacjenci')
    ->select('firmy.nazwa', 'nazwaFirmy')
    ->select('pacjenci.id')
    ->select('pacjenci.imie')
    ->select('pacjenci.nazwisko')
    ->select('pacjenci.nr_karty')
    ->select('pacjenci.pesel')
    ->select('pacjenci.ulica')
    ->select('pacjenci.kod_poczt')
    ->select('pacjenci.miasto')
    ->select('pacjenci.telefon')
    ->select('pacjenci.nip')
    ->select('pacjenci.plec')
    ->select('pacjenci.firma')
    ->select('pacjenci.stanowisko')
    ->select('pacjenci.zaswiadczenie')
    ->select('pacjenci.lekarz')
    ->select('pacjenci.inne')
    
    
    
    
    ->join('firmy', array('pacjenci.firma', '=', 'firmy.id'))->find_array();	
  //  $pacjenci=ORM::for_table('pacjenci')->find_array();	
} 
else if($_POST['zakres']=='selected'){
	///////try catch
	$pacjenci=ORM::for_table('pacjenci')
		->where_like($searchArray)
		->find_array();
	
}
if(!empty($_GET['id'])){
	$pacjenci=ORM::for_table('pacjenci')
		->where('id', $_GET['id'])
		->find_array();
	
}


//print_r($pacjenci);
include('leftMenu.php');
?>

		<td valign="top" class="tdPaddingLeft">
		<BR>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dodajPacjentaModal">
Dodaj pacjenta
</button>


<!-- Modal -->
<div class="modal fade" id="dodajPacjentaModal" tabindex="-1" role="dialog" aria-labelledby="dodajPacjentaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajPacjentaModalLabel">Dodaj nowego pacjenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
	 <form action="dodajPacjenta.php" method="POST">
  			<table>
				<tr>
					<td>
						PESEL:<BR> <!-- to obowiazkowe -->
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="pesel"  required/>
					</td>
					
				</tr>
				<tr>
					<td>
						Numer karty: <BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="numerKarty"  required/>
					</td>
					
				</tr>
				<tr>
					<td>
						Imię:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="imie"  required/>
					</td>
					
				</tr>
				<tr>
					<td>
						Nazwisko:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="nazwisko"  required/>
					</td>
					
				</tr>
				<tr>
					<td>
						Płeć:<BR>
					</td>
					<td>
						<select name="plec" class="form-control form-control-sm"  >
							<option value=""></option>
						  <option value="M">Mężczyzna</option>
						  <option value="K">Kobieta</option>
						</select>
					</td>
					
				</tr>
				<tr>
					<td>
						Ulica:<BR>

					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="ulica"  required/>

					</td>
					
				</tr>
				<tr>
					<td>
						Miasto:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="miasto"  required/>

					</td>
					
				</tr>		
				<tr>
					<td>
						Kod-pocztowy:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="kod-pocztowy"  required/>

					</td>
					
				</tr>
				
				<tr>
					<td>
						telefon:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="telefon"  required/>

					</td>
					
				</tr>
				<tr>
					<td>
						nip:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="nip"  required/>

					</td>
					
				</tr>		
				<tr>
					<td>
						stanowisko:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="stanowisko" required/>

					</td>
					
				</tr>	
				<tr>
					<td>
						inne:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="inne"  />

					</td>
					
				</tr>	

				</tr>					
			</table>
  

		
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
        <input type="submit" class="btn btn-success" value="Dodaj"/>
		  </form>	
      </div>
    </div>
  </div>
</div>
<!-- koniec modala -->
<!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dodajPacjentaModal2">
Dodaj pacjenta 2
</button>
-->

<!-- Modal -->
<div class="modal fade" id="dodajPacjentaModal2" tabindex="-1" role="dialog" aria-labelledby="dodajPacjentaModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajPacjentaModalLabel2">Dodaj nowego pacjenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     abc
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
        <input type="submit" class="btn btn-success" value="Dodaj"/>
		  </form>	
      </div>
    </div>
  </div>
</div>



			<table border="0" class="table table-sm hover-hand table-striped" >

			<thead class="thead-default">
			<tr >
			
			<th>Imię</th>
			<th>Nazwisko</th>
			<th>PESEL</th>
			</tr>
			
			</thead>
			
			
			<?php

				foreach($pacjenci as $array => $v){

					echo '<tr id="header_'.$v["id"].'" name="header" onClick="return showContent('.$v['id'].')">';


					foreach($v as $key => $value){



						switch($key){
							case "imie":
								echo "<td>";
								echo $value;
								echo "</td>";
								break;
							
							case "nazwisko":
								echo "<td>";
								echo $value;
								echo "</td>";
								break;
							
							case "pesel":
								echo "<td>";
								echo $value;
								echo "</td>";
								break;
						}

					}
					
					echo "</tr>";
					echo '<tr id="tr_'.$v['id'].'" class="invisible">';
					echo '<td colspan="3" width="100%" style="padding: 0px;">';
					echo '<div id="div_'.$v['id'].'" class="panel-collapse collapse in hide">';
					echo '<div style="float:right;">';
					echo '<form action="register.php" method="post" name="form'.$v['id'].'">';
					echo "<input type=hidden name=id value=".$v['id']." />";
					echo '<input type="submit" class="btn btn-primary btn-sm" value="Rejestruj"/>';
					echo '<button type="button" class="btn btn-primary btn-sm disabled" onClick="deleteUser('.$v['id'].')">Usuń</button>';
					echo '</form>';
					echo '</div>';
					echo '<table class="table">';
					
					foreach($v as $key => $value){
						echo '<tr>';
						echo '<td width="30%">';
						//echo $key.": ";
						switch($key){
							case "id":
							echo "ID:";
							break;
							
							case "imie":
							echo"Imię:";
							break;
							
							case "nazwisko":
							echo "Nazwisko:";
							break;
							
							case "nr_karty":
							echo "Numer karty:";
							break;
							
							case "pesel":
							echo "PESEL:";
							break;
							
							case "ulica":
							echo "Ulica:";
							break;
							
							case "kod_poczt":
							echo "Kod pocztowy:";
							break;
							
							case "miasto":
							echo "Miasto";
							break;
							
							case "telefon":
							echo "Telefon:";
							break;
							
							case "nip":
							echo "NIP:";
							break;
							
							case "plec":
							echo "Płeć:";
							break;
							
							case "firma":
							echo "Firma:";
							break;
							
							case "stanowisko":
							echo "Stanowisko:";
							break;
							
							case "zaswiadczenie":
							echo "Zaświadczenie ważne do:";
							break;
							
							case "lekarz":
							echo "Lekarz orzekający:";
							break;
							
							case "inne":
							echo "Inne:";
							break;
							
							
						}

						
						echo '</td>';
						echo '<td>';
						if($key=='nazwaFirmy'){
						    $nazwaFirmy=$value;
						}
						
						if($key=='firma'){
						    echo $nazwaFirmy;
						}
						if($key!='nazwaFirmy'){
						    echo $value;
						}
						
						echo '</td>';
						echo '</tr>';
						
					}
					echo '</table>';
					

					
					echo "</div>";
					echo '</td>';
					echo "</tr>";					
				}
			
			
			?>
			
			</table>
			<BR><BR>
			

			

		</td>
	
	</tr>


</table>
</div>
</div>