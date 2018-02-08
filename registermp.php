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
	
<script type="text/javascript" language="JavaScript">
document.cookie="nowaFirma=0";



$(document).ready(function() {
    $('.tabelaUslugi tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

});
$(document).ready(function() {
	$('.tabelaInnaFirma tr').click(function(event) {
        if (event.target.type !== 'radio') {
            $(':radio', this).trigger('click');
        }
    });
});
function addAlert(){
	var con = confirm("Czy przypisać tą firmę na stałe dla pacjenta?");
	if (con) {
		 document.cookie = "confirm=1";
	}
	else{
		document.cookie = "confirm=0";
	}
}

function hideInnaFirma(){
	$('#collapseInnaFirma').collapse("hide");
}
function hideZBazy(){
	$('#collapseFirmaZBazy').collapse("hide");
}
function hideDomyslna(){
	$('#collapseDomyslna').collapse("hide");
}

var col2;
var col3;
var error=true;

function validate(collapse) {
	
	var wstepne = document.getElementById('wstepne');
	var okresowe = document.getElementById('okresowe');
	var kontrolne = document.getElementById('kontrolne');
	var sanit = document.getElementById('sanit');
	var uslugi = document.getElementsByName('uslugi');
	
	
		
    if (wstepne.checked == false && okresowe.checked== false && kontrolne.checked == false && sanit.checked == false){
        alert ('Nie wybrano żadnego typu badań!');
		
				$('#collapse1').collapse("show");
				$('#collapse2').collapse("hide");
				$('#collapse3').collapse("hide");
				$('#collapse4').collapse("hide");
				return false;
    } 
	else {    
		if(collapse=="collapse2"){
				$('#collapse1').collapse("hide");
				$('#collapse2').collapse("show");
				$('#collapse3').collapse("hide");
				$('#collapse4').collapse("hide");
				
				$('#btn-1').addClass("btn-success").removeClass("btn-info");
				$('#i-1').addClass("fa").addClass("fa-check-square");
				if(col2==true){
					$('#btn-2').addClass("btn-success").removeClass("btn-info");
				}
				if(col3==true){
					
					if ($(":checkbox[name='uslugi[]']").is(":checked")){
							$('#btn-3').addClass("btn-success").removeClass("btn-info").removeClass("btn-danger");
							error=false;
						}
						else
						{
							$('#btn-3').addClass("btn-danger").removeClass("btn-info");
							error=true;
						}
					
				}
				col2=true;
				return true;
		}
		if(collapse=="collapse3"){
				$('#collapse1').collapse("hide");
				$('#collapse2').collapse("hide");
				$('#collapse3').collapse("show");
				$('#collapse4').collapse("hide");
				
				$('#btn-1').addClass("btn-success").removeClass("btn-info");
				if(col2==true){
					$('#btn-2').addClass("btn-success").removeClass("btn-info");
				}
				if(col3==true){
					
					if ($(":checkbox[name='uslugi[]']").is(":checked")){
							$('#btn-3').addClass("btn-success").removeClass("btn-info").removeClass("btn-danger");
							error=false;
						}
						else
						{
							$('#btn-3').addClass("btn-danger").removeClass("btn-info");
							error=true;
						}
					
				}
				
				col3=true;
				return true;			
		}
		if(collapse=="collapse4"){
				$('#collapse1').collapse("hide");
				$('#collapse2').collapse("hide");
				$('#collapse3').collapse("hide");
				$('#collapse4').collapse("show");
				
				$('#btn-1').addClass("btn-success").removeClass("btn-info");
				if(col2==true){
					$('#btn-2').addClass("btn-success").removeClass("btn-info");
				}
				if(col3==true){
					
					if ($(":checkbox[name='uslugi[]']").is(":checked")){
							$('#btn-3').addClass("btn-success").removeClass("btn-info").removeClass("btn-danger");
							error=false;
						}
						else{
							$('#btn-3').addClass("btn-danger").removeClass("btn-info");
							error=true;
						}
					
				}
				
				return true;			
		}
    }
}


function verifyAll(){
	
	if ($(":checkbox[name='uslugi[]']").is(":checked")){
		$('#btn-3').addClass("btn-success").removeClass("btn-info").removeClass("btn-danger");
		error=false;
	}
	else{
		$('#btn-3').addClass("btn-danger").removeClass("btn-info");
		error=true;
	}
	
	if(error==true){
		alert('Uzupełnij wszystkie pola oznaczone na czerwono');
		return false;
	}
	else{
		return true;
	}
	
	
	
}


function changeCheckboxState(checkbox){
		document.getElementById(checkbox).checked = true;
}

function toggle(){
	$('#collapse1').collapse("show");
	$('#collapse2').collapse("hide");
	$('#collapse3').collapse("hide");
	$('#collapse4').collapse("hide");
	return true;
}

function hide4radios(){
	$('#4radios').removeClass('visible').addClass('invisible');
	document.getElementById("btn-2").disabled = true;
}
function show4radios(){
	$('#4radios').removeClass('invisible').addClass('visible');
	document.getElementById("btn-2").disabled = false;
	//$('#wybor_kontrahenta').removeClass('invisible').addClass('visible');
}


</script> 


</head>
<!-- <button onclick="document.location.href='index.php'" class="btn btn-outline-secondary">Cofnij</button> -->

<?php
ini_set('display_errors', 0);
session_start();




//id pacjenta przypisywane do sesji - potrzebne ?
if($_POST['id']){
	session_unset();
	$_POST['pacjentId']=$_POST['id'];
	
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


$pacjent=ORM::for_table('pacjenci')->where('id', $_POST['pacjentId'])->find_one();
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

<form action="send.php" method="POST" id="regForm">
  <h1>Rejestracja</h1>
  <!-- One "tab" for each step in the form: -->
    <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" class ="btn btn-danger" id="prevBtn" onClick="resetTab()">reset</button>
      <button type="button" class ="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <?php

  if($_POST['rodzajWizyty']=='mp'){
    echo '<input type="hidden" name="rodzajWizyty" value="medycyna_pracy">';
  ?>
  
  <div class="tab">
			Typ badań:<BR> 
		
			<label class="custom-control custom-radio">
			  <input id="wstepne" name="typBadan" type="radio" class="custom-control-input" value="wstepne">
			  <span class="custom-control-indicator"></span>
			  <span class="custom-control-description">wstępne</span>
			</label>
			<label class="custom-control custom-radio">
			  <input id="kontrolne" name="typBadan" type="radio" class="custom-control-input" value="kontrolne">
			  <span class="custom-control-indicator"></span>
			  <span class="custom-control-description">kontrolne</span>
			</label>
			<label class="custom-control custom-radio">
			  <input id="okresowe" name="typBadan" type="radio" class="custom-control-input" value="okresowe">
			  <span class="custom-control-indicator"></span>
			  <span class="custom-control-description">okresowe</span>
			</label>
			<label class="custom-control custom-radio">
			  <input id="sanit" name="typBadan" type="radio" class="custom-control-input" value="sanitarno-epidemiologiczne">
			  <span class="custom-control-indicator"></span>
			  <span class="custom-control-description">sanitarno-epidemiologiczne</span>
			</label>
		</div>	
		
<?php 		
  }
  else{
      echo '<input type="hidden" name="rodzajWizyty" value="specjalistyka">';
  }
?>		
<p id="typBadanError">&nbsp;</p>
  </div>
  <div class="tab">
  <div class="custom-controls-stacked" id="radioDomyslnaFirma">
			  <label class="custom-control custom-radio">
				<input id="radio-baza"  name="radio-firma" type="radio" class="custom-control-input" value="baza" onClick="hideInnaFirma();hideZBazy();setCookie(0);" checked>
				<span class="custom-control-indicator"></span>
				<span class="custom-control-description">Użyj domyślnej firmy:</span>
			  </label>
			</div>

<?php
//odczytywanie nazwy firmy przypisanej do pacjenta z bazy
$firma=ORM::for_table('pacjenci')
->join('firmy', array('pacjenci.firma', '=', 'firmy.id'))
->where('pacjenci.id', $_POST['pacjentId'])
->find_one();

if($firma==null){
?>	
	
<script>
$(document).ready(function() {
$('#radioDomyslnaFirma').removeClass('visible').addClass('invisible');
$('#tableDomyslnaFirma').removeClass('visible').addClass('invisible');
$('#radio-inna').prop("checked", true);
$('#collapseFirmaZBazy').collapse("show");
});
</script>	
	
	
<?php	
}


//odczytywanie danych firmy z bazy
$firmaDetails=ORM::for_table('firmy')
->where('nazwa', $firma->nazwa)
->find_array();

?>

<table class="table table-sm" id="tableDomyslnaFirma">
<thead class="thead-inverse">
			<tr>
<?php
			//pobiernie kolumn z bazy
			$columns = ORM::for_table('firmy')->raw_query('SHOW columns FROM firmy')->find_array();
			
	////////printowanie firmy przypisanej pacjentowi
		
			//printowanie kolumn do tabeli z bazy

				foreach($columns as $key => $value){
					foreach($value as $k => $v){
						if($k=='Field'){
							echo "<th>";
							
							switch($v){
								case "id":
								echo "ID";
								break;
								
								case "nazwa":
								echo "nazwa firmy";
								break;
								
								case "ulica":
								echo "ulica";
								break;
								
								case "miasto":
								echo "miasto";
								break;
								
								case "kod":
								echo "kod pocztowy";
								break;
								
								case "regon":
								echo "REGON";
								break;
								
								case "nip":
								echo "NIP";
								break;
								
								case "ryczalt":
								echo "ryczałt";
								break;
								
								case "inne":
								echo "inne";
								break;
								
								
							}
							
							echo "</th>";
						}
						else{
							
						}
					}
				}				

			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			echo "<tr>";

		//printowanie danych firmy
			foreach($firmaDetails as $f => $s){
				foreach($s as $q => $p){
					echo "<td>";
					//okreslanie ryczaltu (zmiana 1 na tak, 0 na nie)
					if($q=='ryczalt' && $p==1) echo 'TAK';
					else if($q=='ryczalt' && $p==0) echo 'NIE';
					else echo $p;
					echo "</td>";
					if($q=='id') {
					    //echo "przypisuje";
					    echo '<input type="hidden" name="idFirmy" value="'.$p.'">';
					    $_SESSION['idFirmy']=$p; //przypisanie id firmy do sesji - do użycia przy rejestracji (nadpisane, jeśli zostanie wybrana inna firma)
					}
				}
			}
			
			echo "</tr>";
			echo "</tbody>";
			echo "</table>";	
	?>

		<div class="custom-controls-stacked">
		  <label class="custom-control custom-radio">
			<input id="radio-inna" name="radio-firma" type="radio" value ="inna" class="custom-control-input" data-toggle="collapse" data-target="#collapseFirmaZBazy" aria-expanded="false" aria-controls="collapseExample" onClick="hideInnaFirma();hideDomyslna();setCookie(2)";>
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description">Użyj firmy z bazy danych</span>
			<p id="innaFirmaError" style="float: right;">&nbsp;</p>
		  </label>
		 
		</div>
	
		<div class="collapse" id="collapseFirmaZBazy">
			<div class="card card-body">
			<input type="text" id="szukaj_firmy" placeholder="Szukaj...">
				<table class="table table-sm hover-hand table-hover tabelaInnaFirma" >
					<thead class="thead-inverse">
						<tr>
  <?php
  
				$firmy=ORM::for_table('firmy')->find_array();
	
	
	
	
				foreach($columns as $key => $value){
					foreach($value as $k => $v){
						if($k=='Field'){
							if($v!='kod' && $v!='regon' && $v!='inne'){
								echo "<th>";
								
								switch($v){
									case "id":
									echo "ID";
									break;
									
									case "nazwa":
									echo "nazwa firmy";
									break;
									
									case "ulica":
									echo "ulica";
									break;
									
									case "miasto":
									echo "miasto";
									break;
									
								//	case "kod":
								//	echo "kod pocztowy";
								//	break;
									
								//	case "regon":
								//	echo "REGON";
								//	break;
									
									case "nip":
									echo "NIP";
									break;
									
									case "ryczalt":
									echo "ryczałt";
									break;
									
								//	case "inne":
								//	echo "inne";
								//	break;
									
									
								}
							}
							echo "</th>";

						}
						else{
							
						}
					}
				}
			echo "<th>";
			echo "</th>";
			echo "</tr>";
			echo "</thead>";
			echo '<tbody id="innaZbazy">';
							
	
			foreach($firmy as $key => $value){
				
				echo '<tr id="'.$value['id'].'" name="innaFirmaTr">';
				foreach($value as $k => $v){
					if($k!='kod' && $k!='regon' && $k!='inne'){
						echo "<td>";
						//okreslanie ryczaltu (zmiana 1 na tak, 0 na nie)
						if($k=='ryczalt' && $v==1) echo 'TAK';
						else if($k=='ryczalt' && $v==0) echo 'NIE';
						else echo $v;
						echo "</td>";
						if($k=='id') {
						//	$_SESSION['idFirmy']=$v; //przypisanie id firmy do sesji - do użycia przy rejestracji (nadpisane, jeśli zostanie wybrana inna firma)						
							$radioName=$v;
						}
					}

				}
										echo "<td>";
						echo '<input type="radio" onClick="changeTrColor('.$radioName.')" id="'.$radioName.'" name="innaFirma" value="'.$radioName.'"/>';
						echo "</td>";
			  		echo "</tr>";
			}

			echo "</tbody>";
			echo "</table>";
  
  
  ?>
  <script>
  
function changeTrColor(id){
	
	var notSelected = document.getElementsByName("innaFirmaTr");
	
	for(i=0; i<notSelected.length; i++){
		
		notSelected[i].style.backgroundColor = "#FFFFFF";
		
	}
	
	var tr = document.getElementById(id);
	tr.style.backgroundColor = "#bac5d6";
	
}  
  
  
  
  
  
  
var rows = $('#innaZbazy tr'); //pobranie wierszy z tabeli

$('#szukaj_firmy').keyup(function() { //funkcja keyup jest wywolywana kiedy uzytkownik nacisnie klawisz
 
        //var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
		var val = $(this).val(),
		reg = RegExp(val, 'i'),
            text; // uzycie wyrazenia regularnego do sprawdzenia elementu
		
        rows.show().filter(function() { // najpierw pokazujemy wszystkie wiersze, a potem stosujemy funkcje filter()
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text); //sprawdzamy czy wiersz pasuje doelementu szukanego, jeśli nie to chowamy ten wiersz 
        }).hide();
    });
</script>

			</div>
		</div>

		<div class="custom-controls-stacked">
		  <label class="custom-control custom-radio">
			<input id="radio-inna" name="radio-firma" type="radio" value ="inna" class="custom-control-input" data-toggle="collapse" data-target="#collapseInnaFirma" aria-expanded="false" aria-controls="collapseExample" onClick="hideZBazy();hideDomyslna();setCookie(1)";>
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description">Dodaj nową firmę</span>
		  </label>
		</div>
<script>
function setCookie(x){
	document.cookie = "nowaFirma="+x;
	//alert(document.cookie);
}

</script>
<div class="collapse" id="collapseInnaFirma">
  <div class="card card-body">
	Podaj dane firmy:<BR><BR>
	
		<table border="0" class="table table-sm">
		<?php
		//pobieranie z bazy i printowanie kolumn dla nowej firmy
			$columns = ORM::for_table('firmy')->raw_query('SHOW columns FROM firmy')->find_array();
			echo "<tr>";
			foreach($columns as $key => $value){
				foreach($value as $k => $v){
					if($k=='Field' && $v!='id'){
						echo "<td>";
						switch($v){
							case "id":
							echo "ID";
							break;
							
							case "nazwa":
							echo "nazwa firmy";
							break;
							
							case "ulica":
							echo "ulica";
							break;
							
							case "miasto":
							echo "miasto";
							break;
							
							case "kod":
							echo "kod pocztowy";
							break;
							
							case "regon":
							echo "REGON";
							break;
							
							case "nip":
							echo "NIP";
							break;
							
							case "ryczalt":
							echo "ryczałt";
							break;
							
							case "inne":
							echo "inne";
							break;
						}
						echo "<td>";
						
						if($v=="ryczalt"){
							echo '
							<select name="_'.$v.'" class="form-control form-control-sm">
								<option value="">--wybierz--</option>
								<option value="1">TAK</option>
								<option value="0">NIE</option>
							
							
							</select>
							';
						}
						else{
							echo "<input type=\"text\" class=\"form-control form-control-sm\" name=\"_".$v."\" />";
							echo "</td>";
						}
					}
				}
				echo "</tr>";
			}
		?>
		</table>       
		</div>
	</div>
</div>
		<!-- sprawdzic te divy tutaj, bo cos chyba za duzo [chyba jest już ok] -->
		</div>

  
 
  <div class="tab">
  <?php
//dodawanie firmy do tabeli firmy
/////////////////////////////////////////////////////////////dodac ifa ze jak sie nie wpisuje nowej firmy to zeby to olac


//zmapowac jakos wartosc z radio do zmiennej php, zeby obsluzyc tego ifa ponizej (jakis JS onClick moze?) albo wywalic to do kolejnego posta, bo to nie musi byc tutaj
if($_COOKIE['nowaFirma']==1){
	

	
		$nowaFirma=ORM::for_table('firmy')->create();
		
		$nowaFirma->nazwa = $_POST['nazwa'];
		$nowaFirma->ulica = $_POST['ulica'];
		$nowaFirma->miasto = $_POST['miasto'];
		$nowaFirma->kod = $_POST['kod'];
		$nowaFirma->regon = $_POST['regon'];
		$nowaFirma->nip = $_POST['nip'];
		$nowaFirma->ryczalt = $_POST['ryczalt'];
		$nowaFirma->inne = $_POST['inne'];
		
		$nowaFirma->save();
		
		$nowaFirma='';
		
		$nowaFirma=ORM::for_table('firmy')->order_by_desc('id')->find_one();
		echo "ID nowej firmy: ".$nowaFirma->id;
		echo "<BR>";
		
		$_SESSION['idFirmy'] = $nowaFirma->id;
	
	if($_COOKIE['confirm']==1){
		//zmiana firmy w tabeli pacjenci
		
		$nowaFirma='';
		
		$nowaFirma=ORM::for_table('pacjenci')->where('id', $_POST['pacjentId'])->find_one();
		$nowaFirma->set('firma', $_POST['nazwa']);
		$nowaFirma->save();
		
	}
	
}
else{

}
	if($_POST['rodzajWizyty']=='mp') $uslugi=ORM::for_table('uslugi')->where('mp', '1')->find_array();
	else $uslugi=ORM::for_table('uslugi')->where('mp', '0')->find_array();
	
	
	
	
	//echo $_SESSION['spec'];
echo <<<END
<p id="uslugiError">&nbsp;</p>
<table border="0" class="tabelaUslugi table table-sm hover-hand table-hover">
<thead class="thead-inverse">
			<tr>
END;
			
			$columns = ORM::for_table('uslugi')->raw_query('SHOW columns FROM uslugi')->find_array();

			
			foreach($columns as $key => $value){
				//echo $key."<BR>";
				//echo $value."<BR>";
				foreach($value as $k => $v){
				//	echo "key:".$k."<BR>";
					//echo "value:".$v."<BR>";
					if($k=='Field'){
						echo "<th>";
						switch($v){
							case "id":
							echo "ID";
							break;
							
							case "nazwa":
							echo "Nazwa usługi";
							break;

							case "cena_mp":
							echo "Cena MP";
							break;
							
							case "cena_inne":
							echo "Cena S";
							break;
							
							case "icd":
							echo "ICD";
							break;
							
							case "inne":
							echo "Inne";
							break;					
							
						}
						echo "</th>";
					}
					else{
						
					}
				}
			}
						echo "<th>";
						echo "Wybierz";
						echo "</th>";
			echo "</tr>";
			echo "</thead>";
		//	print_r($uslugi);
				foreach($uslugi as $array => $v){

					echo $v['id'];
					echo "<tbody>";
					echo "<tr>";
					//$checkBoxName='';
					foreach($v as $key => $value){
						
						echo "<td>";
						echo $value;
						echo "</td>";
						if($key=='id')$checkBoxName=$value;
						
					}
						echo "<td>";
						echo '<input type="checkbox" id="checkbox" name="uslugi[]" value="'.$checkBoxName.'"/>';
						echo "</td>";
					echo "</tr>";
					echo "</tbody>";
				}
			echo "</table>";
?>
  
  
  </div>
  <div class="tab">Wybierz datę wizyty:
	<input type="date" id="dataWizyty" name="dataWizyty" required />
	<input type="hidden" name="finished" value="true" />
					
  </div>

  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab





function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Zarejestruj";
	
  } else {
    document.getElementById("nextBtn").innerHTML = "Dalej";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}
specFlag = false;


function nextPrev(n) {
	spec = document.getElementById("specjalistyka");



  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:

	currentTab = currentTab + n;	  


  // if you have reached the end of the form...

  if (currentTab >= x.length) {
    // ... the form gets submitted:
		var c = confirm("Zarejestrować pacjenta?");
		var dataWizyty = document.getElementById("dataWizyty");
		console.log(dataWizyty.value);
		if (c == true) {
			if(dataWizyty.value!=''){
    			document.getElementById("regForm").submit();
    			return false;
			}
			else{
				alert('Podaj datę wizyty!');
				currentTab--;
				showTab(currentTab);
				console.log(currentTab);
				return false;
			}

		} else {
			currentTab--; 
		}

    
  }
  
  // Otherwise, display the correct tab:
  showTab(currentTab);
  console.log(currentTab);
}




function validateForm() {
  // This function deals with validation of the form fields
  var result=false;
  var x, y, i, valid = true;
  var innaFirmaFlag=false;
  var flag = false;
  var medFlag = false;
  var x = document.getElementsByClassName("tab");
  var y = x[currentTab].getElementsByTagName("input");
  var z = document.getElementById("radio-inna");
  var med = document.getElementById("medycyna_pracy");
	var radioInna = document.getElementById("radio-inna");
	var innaFirmaRadios = document.getElementsByName("innaFirma");
  	var radios = document.getElementsByName("typBadan");
  	var typBadanError = document.getElementById("typBadanError");
  	var innaFirmaError = document.getElementById("innaFirmaError");
  	

	if(radioInna.checked){
		console.log('checked');
		for(i=0; i<innaFirmaRadios.length; i++){
			if(innaFirmaRadios[i].checked != true && innaFirmaFlag == false){
				console.log('false');
				innaFirmaError.innerHTML='<font color="red">Wybierz firmę!</font>';
				result=false;
			}
			if(innaFirmaRadios[i].checked == true){
				console.log('checkedradio');
				console.log(innaFirmaRadios[i].id);
				innaFirmaFlag=true;
				result=true;
			}

		}
		return result;
	}

  	
  //console.log(radios);

 // z = x[currentTab].getElementsByName("uslugi");
  // A loop that checks every input field in the current tab:

  
 // if(med.checked == true){
	  for(i=0; i<radios.length; i++){
		if (radios[i].checked != true && medFlag == false) {
		  // add an "invalid" class to the field:
		  radios[i].className += " invalid";
		  // and set the current valid status to false
		  valid = false;
		  typBadanError.innerHTML="Wybierz typ badań!";
		}
		if (radios[i].checked == true) {
		  // add an "invalid" class to the field:
		  radios[i].className == " valid";
		  // and set the current valid status to false
		  valid = true;
		  medFlag = true;
		}		
	  }	  
 // }

	var re = new RegExp("^_.*");

		
	/*
  for (i = 0; i < y.length; i++) {
	  
    // If a field is empty...
	if(y[i].name!="typBadan" && y[i].name!="rodzajWizyty" && y[i].id!="szukaj_firmy" && !re.test(y[i].name)){
	if(y[i].type!="checkbox" && z.checked == true){
		if (y[i].value == "") {
		  // add an "invalid" class to the field:
		  y[i].className += " invalid";
		  // and set the current valid status to false
		  valid = false;
		}
	}
	else{
			if (y[i].checked == false && flag == false && y[i].type!="date" && y[i].type!="hidden") {
			  // add an "invalid" class to the field:
			  y[i].className += " invalid";
			  console.log("tu");
			  // and set the current valid status to false
			  valid = false;
			}
			if (y[i].checked == true) {
			  // add an "invalid" class to the field:
			  y[i].className == "";
			  // and set the current valid status to false
			  valid = true;
			  flag = true;
			}			
		}	
	}
  }
  */
  
  

  // If the valid status is true, mark the step as finished and valid:
  if(valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
	typBadanError.innerHTML="";
  }

  
  
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
function resetTab(){
	  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  // Hide the current tab:
  x[currentTab].style.display = "none";
	currentTab = 0;
	showTab(currentTab);
	location.reload();
	
}
</script>


</td>
</tr>
</table>
</div>
</div>