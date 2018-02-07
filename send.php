<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css">
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

</script> 


</head>

<?php
ini_set('display_errors', 1);
session_start();
//print_r($_SESSION);


$faktura = Array();

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
<table border="0">
	<tr>
		<td width="1000" colspan="2">
		
		
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="main.php">Wyszukaj pacjenta</a>
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
		<td width="20%">


<form action="send.php" method="POST" onSubmit="return verifyAll()">

<div class="container">
<?php 

if($_COOKIE['nowaFirma']==1){
	
		?>
		<script>
		addAlert();
		</script>
		<?php
	
		$nowaFirma=ORM::for_table('firmy')->create();
		
		$nowaFirma->nazwa = $_POST['_nazwa'];
		$nowaFirma->ulica = $_POST['_ulica'];
		$nowaFirma->miasto = $_POST['_miasto'];
		$nowaFirma->kod = $_POST['_kod'];
		$nowaFirma->regon = $_POST['_regon'];
		$nowaFirma->nip = $_POST['_nip'];
		$nowaFirma->ryczalt = $_POST['_ryczalt'];
		$nowaFirma->inne = $_POST['_inne'];
		
		$nowaFirma->save();
		echo "Dodano firmę: ".$_POST['_nazwa'];
		$nowaFirma='';
		
		$nowaFirma=ORM::for_table('firmy')->order_by_desc('id')->find_one();

		echo "<BR><BR><BR>";
		
		$_POST['idFirmy'] = $nowaFirma->id;
	
	if($_COOKIE['confirm']==1){
		//zmiana firmy w tabeli pacjenci
		
		$nowaFirma='';
		
		$nowaFirma=ORM::for_table('pacjenci')->where('id', $_SESSION['id'])->find_one();

		$nowaFirma->set('firma', $_POST['_nazwa']);
		$nowaFirma->save();
		
	}
	
}
else if($_COOKIE['nowaFirma']==2){
	$_POST['idFirmy'] = $_POST['innaFirma'];
}
else{
	
}





$pacjent=ORM::for_table('pacjenci')->where('id', $_SESSION['id'])->find_one();
$zaswExpired=false;
if(strtotime($pacjent->zaswiadczenie)<time()){
	$zaswExpired=true;
	$fontColor="red";
}
else{
	$fontColor="#000000";
}

echo "Rejestracja pacjenta:<BR>
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

<?php

//rejestracja i printout
$uslugiDB='';

$pacjent->set('zasw_reset', 1);
$pacjent->save();

	print_r($_POST['uslugi']);
	
foreach($_POST['uslugi'] as $usluga){
	
    $discountPrice=null;
    $wizyta = ORM::for_table('rejestrWizyt')->create();
    
    $wizyta->id_pacjenta = $_SESSION['id'];
    $wizyta->id_uslugi = $usluga;
    $wizyta->rodzaj_wizyty = $_POST['rodzajWizyty'];
    
    
    
    if($_POST['rodzajWizyty']=='medycyna_pracy'){
        $uslugaDB=ORM::for_table('uslugi_mp')->where('id', $usluga)->find_one();
        echo "uslugi_mp";
        $wizyta->id_firmy = $_POST['idFirmy'];
        $wizyta->typBadan = $_POST['typBadan'];
    
    }else{
        $uslugaDB=ORM::for_table('uslugi')->where('id', $usluga)->find_one();
        echo "uslugi zwykle";
        $wizyta->id_firmy = 99999;
    }
    
    
    

	
	


	//sprawdzanie czy jest umowa
	$firma=ORM::for_table('firmy')->where('id', $_POST['idFirmy'])->find_one();
	$umowa = $firma->umowa;
	
	echo "qqqqqqqqq".$uslugaDB->cena_rabat;
	
	
	//sprawdzanie czy dla tej usługi firma ma inną cenę
	$discounts=explode(',', $uslugaDB->cena_rabat);    
	foreach($discounts as $discount){
		
		$discountArray = explode(':', $discount);
		echo "<BR>1: ".$discountArray[0]; //id firmy
		echo "<BR>2: ".$discountArray[1]; //cena
		print_r($_SESSION);
		if($_POST['idFirmy']==$discountArray[0]){
			//jeśli tak, to będzie użyta ta cena
			$discountPrice=$discountArray[1];
		}
		
	}

	
	if($umowa==1){
		if($discountPrice==null) $wizyta->cena = $uslugaDB->cena_mp;
		else $wizyta->cena = $discountPrice;
	} 
	else{
		//$wizyta->id_firmy = 1;
		//$wizyta->typBadan = "n/a";
		$wizyta->cena = $uslugaDB->cena_inne;
	} 
	
	$wizyta->data_wizyty = $_POST['dataWizyty'];
	$wizyta->save();





	$id_ostatniej=ORM::for_table('rejestrwizyt')->select('id')->order_by_desc('id')->find_one();

	array_push($faktura, $id_ostatniej->id);
	
	if($_POST['rodzajWizyty']=='medycyna_pracy'){

		$zarejestrowana=ORM::for_table('rejestrwizyt')
		->raw_query("SELECT pacjenci.imie, 
		pacjenci.nazwisko, 
		firmy.nazwa AS nazwaFirmy, 
		pacjenci.pesel, 
		pacjenci.nr_karty, 
		pacjenci.zaswiadczenie, 
		rejestrwizyt.rodzaj_wizyty,  
		rejestrwizyt.typBadan,
		uslugi_mp.nazwa AS nazwaUslugi,
		rejestrwizyt.data_wizyty,
		rejestrwizyt.id_uslugi,
		rejestrwizyt.cena
		FROM rejestrwizyt
		JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
		JOIN firmy ON firmy.id=rejestrwizyt.id_firmy
		JOIN uslugi_mp ON uslugi_mp.id=rejestrwizyt.id_uslugi
		WHERE rejestrwizyt.id=$id_ostatniej->id")
		->find_one();
		
	}
	else{
				$zarejestrowana=ORM::for_table('rejestrwizyt')
		->raw_query("SELECT pacjenci.imie, 
		pacjenci.nazwisko, 
		pacjenci.pesel, 
		pacjenci.nr_karty, 
		pacjenci.zaswiadczenie, 
		rejestrwizyt.rodzaj_wizyty,  
		uslugi.nazwa AS nazwaUslugi,
		rejestrwizyt.data_wizyty,
		rejestrwizyt.id_uslugi,
		rejestrwizyt.cena
		FROM rejestrwizyt
		JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
		JOIN uslugi ON uslugi.id=rejestrwizyt.id_uslugi
		WHERE rejestrwizyt.id=$id_ostatniej->id")
		->find_one();
	}

	echo'
	
	<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Zarejestrowano wizytę!</h4>
  <hr>
  <p class="mb-0">ID zarejestrowanej wizyty: '.$id_ostatniej->id.'</p>
';


	echo "<BR>Szczegóły wizyty:<BR><BR>";
	//print_r($zarejestrowana);
	echo "Imię: ".$zarejestrowana->imie."<BR>";
	echo "Nazwisko: ".$zarejestrowana->nazwisko."<BR>";
	echo "Firma: ".$zarejestrowana->nazwaFirmy."<BR>";
	echo "Pesel: ".$zarejestrowana->pesel."<BR>";
	echo "Numer karty: ".$zarejestrowana->nr_karty."<BR>";
	echo "Ważność zaświadczenia: ".$zarejestrowana->zaswiadczenie."<BR>";
	echo "Rodzaj wizyty: ".$zarejestrowana->rodzaj_wizyty."<BR>";
	echo "Typ badań: ".$zarejestrowana->typBadan."<BR>";
	echo "Usługa: ".$uslugaDB->nazwa."<BR>";
	echo "Cena: ".$zarejestrowana->cena."<BR>";
	echo "Data wizyty: ".$zarejestrowana->data_wizyty."<BR>";
}



$fakturaSerialized=serialize($faktura);
print_r($faktura);
?>
<script>
function fakturaConfirm(){
	var con = confirm("Wystawić fakturę?");
	
	if(con){
		return true;
	}
	else{
		return false;
	}
}

</script>

</div> <!-- zielony -->
</form>

<form action="faktura.php" method="POST" target="_blank" onSubmit="return fakturaConfirm();">
<input type="hidden" name="faktura" value='<?php echo $fakturaSerialized ?>'/>
<input type="submit" value="Faktura"/>

</form>

</td>
</tr>
</table>
</div>
</div>