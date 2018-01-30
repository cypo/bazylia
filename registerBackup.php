<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
	<style>
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

#innaFirmaSubmit{
	width:50px;	
}
</style>
<script type="text/javascript" language="JavaScript">

function addAlert(){

	
	var con = confirm("Czy przypisać tą firmę na stałe dla pacjenta?");
if (con) {
     document.cookie = "confirm=1";
}
else{
	document.cookie = "confirm=0";
}
	
	
}


function checkCheckBoxes(theForm) {
	
	var wstepne = document.getElementById('wstepne');
	var okresowe = document.getElementById('okresowe');
	var kontrolne = document.getElementById('kontrolne');
	var sanit = document.getElementById('sanit');
		
    if (wstepne.checked == false && okresowe.checked== false && kontrolne.checked == false && sanit.checked == false){
        alert ('Nie wybrano żadnego typu badań!');
        return false;
    } 
	else {    
        return true;
    }
}

</script> 
<script type="text/javascript">
  $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').each(function(){
        $(this).collapse('hide');
    });
  });
</script>

</head>

<?php
ini_set('display_errors', 0);
session_start();
//print_r($_SESSION);



//id pacjenta przypisywane do sesji
if($_POST['id']){
	session_unset();
	$_SESSION['id']=$_POST['id'];
	echo $_POST['id'];
}
require('libs/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


//TYPY BADAŃ
if(!$_SESSION['rodzajBool']){

echo <<<END

<div class="container">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Wybierz typ badań</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
		
		<form action="register.php" method="POST" onsubmit="return checkCheckBoxes();">

	<input type="hidden" name="rodzajBool" value="true" />
	Rodzaj wizyty:<BR>
	<input type="radio" name="rodzajWizyty" value="medycyna_pracy" checked />medycyna pracy<br>
	<input type="radio" name="rodzajWizyty" value="prywatna" /> prywatna<br>
	<BR>
	Typ badań:<BR>
	<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="wstepne" value="wstepne"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">wstępne</span>
	</label><BR>
	<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="kontrolne" value="kontrolne"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">kontrolne</span>
	</label><BR>
		<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="okresowe" value="okresowe"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">okresowe</span>
	</label><BR>
		<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="sanit" value="sanit"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">sanitarno-epidemiologiczne</span>
	</label><BR>

<!--	<input type="submit" value="dalej" / class="btn btn-primary"> -->

</form>
		
		
		</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Collapsible Group 2</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Collapsible Group 3</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
  </div> 
</div>

<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 20%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<form action="register.php" method="POST" onsubmit="return checkCheckBoxes();">

	<input type="hidden" name="rodzajBool" value="true" />
	Rodzaj wizyty:<BR>
	<input type="radio" name="rodzajWizyty" value="medycyna_pracy" checked />medycyna pracy<br>
	<input type="radio" name="rodzajWizyty" value="prywatna" /> prywatna<br>
	<BR>
	Typ badań:<BR>
	<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="wstepne" value="wstepne"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">wstępne</span>
	</label><BR>
	<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="kontrolne" value="kontrolne"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">kontrolne</span>
	</label><BR>
		<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="okresowe" value="okresowe"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">okresowe</span>
	</label><BR>
		<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="typyBadan[]" id="sanit" value="sanit"/>
		<span class="custom-control-indicator"></span>
		<span class="custom-control-description">sanitarno-epidemiologiczne</span>
	</label><BR>

	<input type="submit" value="dalej" / class="btn btn-primary">

</form>
END;
$_SESSION['rodzajBool'] = true;

}

//WYBÓR KONTRAHENTA
?>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#kontrahent" aria-expanded="false" aria-controls="collapseExample">
Dalej
 </button>
<div class="collapse" id="kontrahent">
  <div class="card card-body">

<?php
//if($_POST['rodzajBool']==true){
	echo'
	<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>';
setcookie("confirm", 0);
echo $_COOKIE['confirm'];
$firma=ORM::for_table('pacjenci')
->join('firmy', array('pacjenci.firma', '=', 'firmy.nazwa'))
->where('pacjenci.id', $_SESSION['id'])
->find_one();

$firmaDetails=ORM::for_table('firmy')
->where('nazwa', $firma->nazwa)
->find_array();

$_SESSION['typyBadan'] = $_POST['typyBadan'];
$_SESSION['rodzajWizyty'] = $_POST['rodzajWizyty'];


echo <<<END
<table border="1">
			<tr>
END;
			//pobiernie kolumn z bazy
			$columns = ORM::for_table('firmy')->raw_query('SHOW columns FROM firmy')->find_array();
			
	////////printowanie firmy przypisanej pacjentowi
		
			//printowanie kolumn do tabeli z bazy
			foreach($columns as $key => $value){
				foreach($value as $k => $v){
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
			echo "<tr>";
			echo "<form action=register.php method=post name=firmy>";
			echo "<input type=hidden name=idFirmy value=".$firmaDetails[0]['id']." />";
			echo "<input type=hidden name=kontrahentBool value=true />";

		//printowanie danych firmy
			foreach($firmaDetails as $f => $s){
				foreach($s as $q => $p){
					echo "<td>";
					//okreslanie ryczaltu (zmiana 1 na tak, 0 na nie)
					if($q=='ryczalt' && $p==1) echo '<input type=submit class="btn btn-light" value=TAK>';
					else if($q=='ryczalt' && $p==0) echo '<input type=submit class="btn btn-light" value=NIE>';
					else echo '<input type=submit class="btn btn-light" value='.$p.'>';
					echo "</td>";
					if($q=='id') $_SESSION['idFirmy']=$p; //przypisanie id firmy do sesji - do użycia przy rejestracji (nadpisane, jeśli zostanie wybrana inna firma)
				}
			}
			
			echo "</tr>";
			echo "</table>";
			echo "</form>";
		
	?>

	<BR>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
Użyj innej firmy
  </button>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
Inna firma:<BR><BR>
			<table border="1">
			<form action="register.php" method="POST">
		<?php
		//pobieranie z bazy i printowanie kolumn dla nowej firmy
			$columns = ORM::for_table('firmy')->raw_query('SHOW columns FROM firmy')->find_array();
			echo "<tr>";
			foreach($columns as $key => $value){
				foreach($value as $k => $v){
					if($k=='Field' && $v!='id'){
						echo "<td>";
						echo $v;
						echo "</td>";
						echo "<td>";
						echo "<input type=\"text\" class=\"form-control form-control-sm\" name=\"".$v."\" required/>";
						echo "</td>";
					}
				}
				echo "</tr>";
			}
			
			


		
		?>
		<INPUT type="hidden" name="kontrahentBool" value="true"/>
		<input type="hidden" name="innaFirmaBool" value="true"/>
		<input type="submit" value="ok" class="btn btn-warning" id="innaFirmaSubmit" onclick="addAlert()"/>
	</form>
	</table>       
	</div>
</div>
		</div>
	</div>
	<?php
			//potrzebne to?
			$_SESSION['kontrahentBool'] = true;
			
//}
			
	/*		
if($_POST['kontrahentBool']==true){
	echo "ID Pacjenta: ".$_SESSION['id']."<BR>";
	echo "ID firmy ".$_POST['idFirmy']."<BR>";
	echo "Rodzaj wizyty: ".$_SESSION['rodzajWizyty']."<BR>";
	echo "Typy badań: <BR>";
	

	foreach($_SESSION['typyBadan'] as $typ){
		echo $typ."<br>";
		
	}
}

*/


//WYBÓR USŁUGI




if($_POST['kontrahentBool']==true){
	echo '
	<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>';
	echo "cookie:";
	echo $_COOKIE['confirm']."<br>";

//dodawanie firmy do tabeli firmy
/////////////////////////////////////////////////////////////dodac ifa ze jak sie nie wpisuje nowej firmy to zeby to olac

if($_POST['innaFirmaBool']==true){
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
		
		$nowaFirma=ORM::for_table('pacjenci')->where('id', $_SESSION['id'])->find_one();
		$nowaFirma->set('firma', $_POST['nazwa']);
		$nowaFirma->save();
		
	}
	
}
else{
	
}


	
	
	
	$uslugi=ORM::for_table('uslugi')->find_array();
	
echo <<<END
<table border="1">
			<tr>
END;
			
			$columns = ORM::for_table('uslugi')->raw_query('SHOW columns FROM uslugi')->find_array();
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
			print_r($uslugi);
				foreach($uslugi as $array => $v){

					echo $v['id'];
					echo "<tr>";
					echo "<form action=register.php method=post name=firmy>";
					echo "<input type=hidden name=idUslugi value=".$v['id']." />";
					echo "<input type=hidden name=uslugiBool value=true />";

					foreach($v as $key => $value){
						
						echo "<td>";
						echo '<input type=submit class="btn btn-light btn-sm" value="'.$value.'">';
						echo "</td>";
					}
					
					echo "</tr>";
					echo "</form>";
				}
			echo "</table>";
}

// Wybór daty i zatwierdzenie



if($_POST['uslugiBool']==true){
	echo '
	<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 80%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>';
	$_SESSION['idUslugi'] = $_POST['idUslugi'];
echo <<<END
	<form action="register.php" method="POST">
		<input type="date" name="dataWizyty" required/>
		<input type="hidden" name="finished" value="true" />
		<input type="submit" value="Zarejestruj wizytę" />
	
	
	</form>

END;
	
	
}

//rejestracja i printout



if($_POST['finished']==true){
	echo '
	<div class="progress">
		<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	<button onclick="document.location.href=\'index.php\'" class="btn btn-outline-secondary">Cofnij</button>


	
	
	
	';

	
	
	
	$_SESSION['dataWizyty'] = $_POST['dataWizyty'];
echo "<BR>";
	echo "ID Pacjenta: ".$_SESSION['id']."<BR>";
	echo "ID firmy ".$_SESSION['idFirmy']."<BR>";
	echo "Rodzaj wizyty: ".$_SESSION['rodzajWizyty']."<BR>";
	echo "Typy badań: <BR>";
	
	foreach($_SESSION['typyBadan'] as $typ){
		echo $typ."<br>";
		
	}
	echo "ID uslugi: ".$_SESSION['idUslugi']."<BR>";
	
	
	echo "--- tworzenie wpisu ---<BR>";
	$wizyta = ORM::for_table('rejestrWizyt')->create();

	$wizyta->id_pacjenta = $_SESSION['id'];
	$wizyta->id_firmy = $_SESSION['idFirmy'];
	$wizyta->id_uslugi = $_SESSION['idUslugi'];
	$wizyta->rodzaj_wizyty = $_SESSION['rodzajWizyty'];
	foreach($_SESSION['typyBadan'] as $typ){
		//echo $typ."<BR>";
		switch($typ){
			case "wstepne":
			$wizyta->wstepne = 1;
			break;
			
			case "kontrolne":
			$wizyta->kontrolne = 1;
			break;
			
			case "okresowe":
			$wizyta->okresowe = 1;
			break;
			
			case "sanit":
			$wizyta->sanit = 1;
			break;
		}
	}
	$wizyta->data_wizyty = $_SESSION['dataWizyty'];
	$wizyta->save();

echo "<BR><BR>Zarejestrowano wizytę!";	

	$id_ostatniej=ORM::for_table('rejestrwizyt')->select('id')->order_by_desc('id')->find_one();
	//$idZarejestrowanej = $id_ostatniej->id + 1;
	
	
	$zarejestrowana=ORM::for_table('rejestrwizyt')
	->raw_query("SELECT pacjenci.imie, 
	pacjenci.nazwisko, 
	firmy.nazwa AS nazwaFirmy, 
	pacjenci.pesel, 
	pacjenci.nr_karty, 
	pacjenci.zaswiadczenie, 
	rejestrwizyt.rodzaj_wizyty,  
	rejestrwizyt.wstepne,
	rejestrwizyt.kontrolne,
	rejestrwizyt.okresowe,
	rejestrwizyt.sanit,
	uslugi.nazwa AS nazwaUslugi,
	rejestrwizyt.data_wizyty
	
	FROM rejestrwizyt
	JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
	JOIN firmy ON firmy.id=rejestrwizyt.id_firmy
	JOIN uslugi ON uslugi.id=rejestrwizyt.id_uslugi
	WHERE rejestrwizyt.id=$id_ostatniej->id")
->find_one();


	echo "<BR>";
	echo "ID zarejestrowanej wizyty: ".$id_ostatniej->id;

	echo "<BR><BR><BR>";
	//print_r($zarejestrowana);
	echo "Imię: ".$zarejestrowana->imie."<BR>";
	echo "Nazwisko: ".$zarejestrowana->nazwisko."<BR>";
	echo "Firma: ".$zarejestrowana->nazwaFirmy."<BR>";
	echo "Pesel: ".$zarejestrowana->pesel."<BR>";
	echo "Numer karty: ".$zarejestrowana->nr_karty."<BR>";

	echo "Ważność zaświadczenia: ".$zarejestrowana->zaswiadczenie."<BR>";
	echo "Rodzaj wizyty: ".$zarejestrowana->rodzaj_wizyty."<BR>";
	
	echo "Typ badań:<BR>";
	if($zarejestrowana->wstepne == 1) echo "- wstępne<BR>";
	if($zarejestrowana->kontrolne == 1) echo "- kontrolne<BR>";
	if($zarejestrowana->okresowe == 1) echo "- okresowe<BR>";
	if($zarejestrowana->sanit == 1) echo "- sanitarno-epidemiologiczne<BR>";
	echo "Nazwa badania: ".$zarejestrowana->nazwaUslugi."<BR>";
	echo "Data wizyty: ".$zarejestrowana->data_wizyty."<BR>";
}
?>
