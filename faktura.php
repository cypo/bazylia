<!DOCTYPE html>
<html>
<head>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
<?php 
//print_r($_POST);

?>
<style>

body
{
    margin:50px 0px; padding:0px;
    text-align:center;
    font-family: Arial;
}
	
#Content {
min-width:800px;
	max-width:1000px;
	height:950px;
	text-align:left;
	padding:15px;
	border:1px dashed #333;
	background-color:#eee;
    
    display: inline-block;
    margin: 1em;
}


#div-1a
{
    border: 1px solid black;
    width:333px;
    background-color: #bababa;
    
    margin: 25px 0px 15px 15px;
    float:left;
    
    padding-top: 100px;
    text-align:center;
}
#div-1b
{
    border: 1px solid black;
    width:275px;
    background-color: #bababa; 
    margin: 25px 0px 15px 15px;
    padding: 10px;
    float:left;
    text-align:center;
}

#div-1d
{
    border: 1px solid black;
    width:240px;
    background-color: #bababa; 
    margin: 25px 15px 15px 15px;
    padding: 10px;
    float:left;
    text-align:center;
}
#div-1c
{
    border: 1px solid black;
    clear:both;
    background-color: #bababa;
    margin: 15px 0px 15px 15px;
    width:450px;    
    float:left;
}
#div-1e
{
    border: 1px solid black;
    background-color: #bababa;
    margin: 15px 0px 15px 15px;
    width:450px;    
    float:left;
}
#div-1f
{
    border: 1px solid black;
    clear:both;
    background-color: #bababa;
    width:900px;    
    float:left;
    
    padding: 10px;
        
    margin: 15px 0px 15px 15px;
}
#tabela
{
    margin: 0px auto;
    border: 2px solid black;
    border-collapse: collapse;
        
    display: inline-block;
    margin: 1em;
    clear:both;
/*    left: 200px;*/
}

#div-sum
{
    margin: 0px auto;
    border: 1px solid black;
    max-width:1000px;
	text-align:left;
	padding:15px;
	background-color:#bababa;
     
    float:right;
    clear:both;
    display: inline-block;
    margin: 1em;
}

#div-odb
{
    border: 1px solid black;
    width:333px;
	text-align:center;
	padding:15px;
    margin: 25px 0px 15px 15px;
	background-color:#bababa;
    float:left;
    clear:both;
    padding-top: 100px;

}
#div-wys
{
    border: 1px solid black;
    width:333px;
	text-align:center;
	padding:15px;
    margin: 25px 0px 15px 15px;
	background-color:#bababa;
        padding-top: 100px;
    float:left;
}
</style>
</head>




<?php
ini_set('display_errors', 0);

include 'libs/slownie.php';

require('libs/idiorm.php');
require('include/db.php');


$numerFaktury=$_POST['fakturaWystawiona'];

if($_POST['fakturaWystawiona']){
	$fakturaDoWyswietlenia = ORM::for_table(faktury)->where('id', $_POST['fakturaWystawiona'])->find_one();
	$idWizytString=$fakturaDoWyswietlenia->id_wizyty;
	$idWizytArray=explode(',', $idWizytString);
	array_pop($idWizytArray);
}
else{
	//jesli POST pochodzi z send.php
	if($_POST['faktura']){
		$idWizytArray=unserialize($_POST['faktura']);
	}
	//jesli POST pochodzi z rejestrWizyt.php
	else{
	    $idWizytArray=Array();
	    foreach($_POST as $key => $value){
	        if($key =="data_uslugi_h" || $key =="termin_zaplaty_h" || $key == "sposob_zaplaty_h"){
	            
	        }
	        else{
	            array_push($idWizytArray, $value);
	        }
	    }
	}
	
}





$id_wizyt = null;
$suma = null;


$uslugi=ORM::for_table('rejestrWizyt')->where_in('id', $idWizytArray)->find_array();

//sprawdzanie czy uslugi do zafakturowania dotycza jednej firmy
$firmy=Array();

foreach($uslugi as $key => $value){
    foreach($value as $k => $v){
       // echo "<BR>K: ".$k."<BR>";
       // echo "<BR>V: ".$v  ."<BR>";
        if($k == 'id_firmy') array_push($firmy, $v);
    }
}
$firmy = array_unique($firmy);

if(count($firmy)>1){
    //jesli uslugi dotycza roznych firm
    $jednaFirma = true;
    
    
    
    exit("Wybrano do zafakturowania usługi wykonane dla różnych firm!");
}
else{
    //jesli uslugi dotycza jednej firmy
    $jednaFirma = false;
}

	foreach($uslugi as $key => $value){
		foreach($value as $k => $v){
			if($k=='id') {
				$id_wizyt.=$v.",";
			}
			if($k=='cena'){
				$suma=$suma+$v;
			}
		}
	}

	
	//ustalanie daty uslugi
	$data_uslugi = null;
	
	if($_POST['data_uslugi_h'] == 'data_faktury'){
	    $data_uslugi = date('Y-m-d');
	}
	if($_POST['data_uslugi_h'] == 'miesiac'){
	    switch (date('m')){
	        case '01':
	            $data_uslugi = "styczeń ".date('Y');
	            break;
	        case '02':
	            $data_uslugi = "luty ".date('Y');
	            break;
	        case '03':
	            $data_uslugi = "marzec ".date('Y');
	            break;
	        case '04':
	            $data_uslugi = "kwiecień ".date('Y');
	            break;
	        case '05':
	            $data_uslugi = "maj ".date('Y');
	            break;
	        case '06':
	            $data_uslugi = "czerwie ".date('Y');
	            break;
	        case '07':
	            $data_uslugi = "lipiec ".date('Y');
	            break;
	        case '08':
	            $data_uslugi = "sierpień ".date('Y');
	            break;
	        case '09':
	            $data_uslugi = "wrzesień ".date('Y');
	            break;
	        case '10':
	            $data_uslugi = "październik ".date('Y');
	            break;
	        case '11':
	            $data_uslugi = "listopad ".date('Y');
	            break;
	        case '12':
	            $data_uslugi = "grudzień ".date('Y');
	            break;
	    }
	    // echo date('m');
	}
	
	//termin uslugi
	$termin_zaplaty = $_POST["termin_zaplaty_h"];
	//date('Y-m-d', strtotime($dataWystawienia[0]. ' + '.$_POST["termin_zaplaty_h"].' days'));
	
	//sposob zaplaty
	$sposob_zaplaty = null;
	if($_POST['sposob_zaplaty_h'] == 'gotowka'){
	    $sposob_zaplaty = 'Gotówka';
	}
	if($_POST['sposob_zaplaty_h'] == 'przelew'){
	    $sposob_zaplaty = "Przelew";
	}
	
	
//sprawdzanie, czy faktura już została wystawiona

$fakturaExists = ORM::for_table('faktury')
	->where('id_wizyty', $id_wizyt)
	->find_one();
	//jeśli nie to wystawiamy
	if($fakturaExists==null){
	    $faktura = ORM::for_table('faktury')->create();
	    $faktura->id_wizyty = $id_wizyt;
	    $faktura->suma = $suma;
	    $faktura->sposob = $sposob_zaplaty;
	    $faktura->termin = $termin_zaplaty;
	    $faktura->data_uslugi = $data_uslugi;
	    $faktura->save();
		//echo "faktura wystawiona";
	}
	else{
		//echo "wyświetlanie faktury";
	}

$daneFaktury=ORM::for_table('faktury')->where('id_wizyty', $id_wizyt)->find_one();
//echo "id wizyty na fakturze: ".$daneFaktury->id_wizyty;

$dataWystawienia=explode(" ",$daneFaktury->data);

$numeryWizyt=substr($daneFaktury->id_wizyty, 0, -1);

$numeryWizytArray = explode(',', $numeryWizyt); //nieuzywany juz chyba - uzyty jednak 

$idUslug=Array();
$rodzajWizyty;

$wizyty = ORM::for_table('rejestrwizyt')
->raw_query('
SELECT rejestr.rodzaj_wizyty, rejestr.data_wizyty, rejestr.id_uslugi, firmy.id as fId, firmy.ulica AS fUlica, firmy.kod, firmy.nazwa, firmy.miasto as fMiasto, firmy.kod, firmy.regon, firmy.nip, pacjenci.imie, pacjenci.nazwisko, pacjenci.firma, pacjenci.ulica AS pUlica, pacjenci.kod_poczt, pacjenci.miasto AS pMiasto FROM `rejestrwizyt` AS `rejestr`
JOIN `pacjenci` ON rejestr.id_pacjenta = pacjenci.id 
JOIN `firmy` ON rejestr.id_firmy = firmy.id
WHERE rejestr.id IN ('.$numeryWizyt.')'
)
->find_many();


foreach($wizyty as $wizyta){
	array_push($idUslug, $wizyta->id_uslugi); /////////////////////////////////////////////moze tu zrobic asocjacje z id pacjenta?
}
$uslugiPogrupowane = array_count_values($idUslug);
//echo 'Ilosc rodzajow uslug: '.count($uslugiPogrupowane).'<br><br>';
//print_r($uslugiPogrupowane);






$wizyta = ORM::for_table('rejestrwizyt')->where('id', $numeryWizytArray[0])->find_one();
$listaUslug = ORM::for_table('uslugi')->where_in('id', array_keys($uslugiPogrupowane))->find_many();



?>





    <body>
    <button id="drukuj" class="btn btn-outline-info">Drukuj fakturę</button><BR>
        <div id="Content">
            <div>
					<div style="float:left">
                    Zakład Opieki Zdrowotnej "Bazylia"<br>
					Specjalistyczne Usługi Medyczne<br>
                    ul. A. Struga 23 <br>95-100 Zgierz<br>
                    NIP: 735-151-40-46<br>


                    <p><b>Faktura Nr <?php echo $daneFaktury->id."/".date('Y'); ?></b></p>
					</div>
					<div style="float:right">
					<table>
					<tr>
					<td>
					Data wystawienia:
					</td>
					<td>
					<?php echo $dataWystawienia[0]; ?>
					</td>
					</tr>
					<tr>
					<td>
					Miejsce wystawienia:
					</td>
					<td>
					ZGIERZ
					</td>
					</tr>					
					<tr>
					<td>
					Data wykonania usługi:
					</td>
					<td>
					<?php 
					echo $daneFaktury->data_uslugi;
					
					?>
					</td>
					</tr>					
					<tr>
					<td>
					Termin zapłaty:
					</td>
					<td>
					<?php 
					echo date('Y-m-d', strtotime($dataWystawienia[0]. ' + '.$daneFaktury->termin.' days'));
					 ?>
					</td>
					</tr>						
					<tr>
					<td>
					Sposób zapłaty:
					</td>
					<td>
					<?php 
					if($daneFaktury->sposob == 'Gotówka'){
					    echo "Gotówka";
					}
					else if($daneFaktury->sposob == 'Przelew'){
					    echo "Przelew ".$daneFaktury->termin." dni";
					}
					
					?>
					
					</td>
					</tr>						
					</table>

					
					
					 
					
					</div><BR><BR><BR><BR><BR><BR><BR><BR>
<hr>
    

                <div style="float:left">
				Sprzedawca:<br>
					Zakład Opieki Zdrowotnej "Bazylia"<br>
					Specjalistyczne Usługi Medyczne<br>
                    ul. A. Struga 23<br> 95-100 Zgierz<br>
                    NIP: 735-151-40-46<br>
                </div>

                <div style="float:right; padding-right:100px">
				Nabywca:<br>
				<?php

				if($wizyty[0]->rodzaj_wizyty=="medycyna_pracy"){
					//firma

					echo $wizyty[0]->nazwa;
					echo "<BR>"; 
					echo $wizyty[0]->fUlica;
					echo "<BR>";  
					echo $wizyty[0]->kod." ".$wizyty[0]->fMiasto;
					echo "<BR>";
					echo "REGON: ";
					echo $wizyty[0]->regon;
					echo "<BR>";
					echo "NIP: ";
					echo $wizyty[0]->nip;					

					
				}
				else{
					//osoba prywatna
					echo "<B>";
					echo $wizyty[0]->imie.' '.$wizyty[0]->nazwisko;
					echo "<BR>"; 
					echo $wizyty[0]->pUlica;
					echo "<BR>";  
					echo $wizyty[0]->kod_poczt." ".$wizyty[0]->fMiasto;
					echo "</B>";
				}
				
				
				
				
				?>
				
				
				
				
				

                   
                </div>

             




            <div style="padding-top: 120px;">

                <table border="1" id="tabela" style="border-collapse: collapse;" cellpadding="5">
                    <tr >
                    <th>Lp.</th>
                        <th>Nazwa</th>
                        <th>Cena netto</th>
                        <th>Stawka VAT</th>
                        <th>Kwota VAT</th>
                        <th>Wartość brutto</th>
                    </tr>
					<?php

					$i=1;
foreach($listaUslug as $usluga){
	$discountPrice=null;
	//sprawdzanie czy dla tej usługi firma ma inną cenę
	$discounts=explode(',', $usluga->cena_rabat);
	foreach($discounts as $discount){
		
		$discountArray = explode(':', $discount);
		//echo "<BR>1: ".$discountArray[0];
		//echo "<BR>2: ".$discountArray[1];
		
		if($wizyty[0]->fId==$discountArray[0]){
			//jeśli tak, to będzie użyta ta cena
			$discountPrice=$discountArray[1];
		}
		
	}
	
	
	//sprawdzenie ile razy zostala wykonana dana usluga
	$ilosc = $uslugiPogrupowane[$usluga->id];
	
	for($x=0; $x<$ilosc; $x++){
	
		if($wizyta->rodzaj_wizyty=='specjalistyka') $cena = $usluga->cena_inne;
		if($wizyta->rodzaj_wizyty=='medycyna_pracy'){
			
			if($discountPrice==null) $cena = $usluga->cena_mp;
			else $cena = $discountPrice;
		} 
		echo "<tr>";
		echo "<td>";
		echo $i;
		echo "</td>";
		echo "<td>";
		echo $usluga->nazwa;
		echo "</td>";
		echo "<td>";
		echo sprintf('%.2f', $cena-($cena*0.23));
		echo "</td>";
		echo "<td>";
		echo "23%";
		echo "</td>";
		echo "<td>";
		echo sprintf('%.2f', ($cena*0.23));
		echo "</td>";
		echo "<td>";
		echo sprintf('%.2f', $cena);
		echo "</td>";
		echo "</tr>";
			
		$i++;
	}
}

?>
                </table>
            </div>
                <div style="float:right">
                    <p><b>Do zapłaty: <?php echo sprintf('%.2f', $daneFaktury->suma); ?>zł.</b></p>
                    <p>Słownie: <?php echo slownie($daneFaktury->suma)?></p>
                </div>
                <BR><BR><BR><BR><BR><BR><BR><BR><BR>
            <div style="float:left; padding-left:70px;">
            <center><p>Jacek Pacyna</p></center>
            <hr>
            <center><p>Podpis osoby upoważnionej<BR>
            do wystawienia dokumentu</p></center>
            </div>
            
            <div style="float:right; padding-left:100px; padding-right:70px;">
            <p>&nbsp;</p>
                        <hr>
            <center><p>Podpis osoby upoważnionej<BR>
            do odbioru dokumentu</p></center>
            </div>


        </div>
    </body>
    <script type="text/javascript">


document.getElementById('drukuj').addEventListener("click", PrintElem);

function printInvoice(){
	$('#drukuj').addClass("invisible");
	window.print();
}

function PrintElem(){
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('<style>body{font-family: Arial;}</style>');
    
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById('Content').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>
</html>
