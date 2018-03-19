<!DOCTYPE html>


<script>

var SUMA = 0.0;

function init()
{
    document.getElementById("txt-add").disabled = false;

    var parent = document.getElementById("div-sum");

    var elem = document.createElement("p");
    elem.appendChild(document.createTextNode("Razem do zapłaty: " + SUMA.toString() + "zł."));

    parent.appendChild(elem);
}
 
function addTextFields()
{
    var parent = document.getElementById("txt-fields");
    
    var header = ["Lp.", "Nazwa", "PKWIU", "Ilość", "Jm", "Cena netto",  "Wartość netto ",  "Stawka VAT",  "Kwota VAT",   "Wartość brutto"];

    for(var i = 0; i < 10; i++)
    {
        var elem = document.createElement("input");
        elem.setAttribute('type', 'text');
        elem.setAttribute('id', 'fd'+i.toString());

        parent.appendChild(elem);
        parent.insertBefore(document.createTextNode(header[i]), elem);
        parent.appendChild(document.createElement("br"));

    }

    var elem3 = document.createElement("input");
    elem3.setAttribute('type', 'button');
    elem3.setAttribute('value', 'Dodaj');
    elem3.setAttribute('onclick', 'showText()');
    parent.appendChild(elem3);
 
    var btn = document.getElementById("txt-add");
    btn.disabled = true;
}
 
function foo(array)
{
    var elem = document.createElement("tr");
    var elems = []
 
    for(var i = 0; i < 10; i++)
    {
        elems.push(document.createElement("td"));
        elems[i].appendChild(document.createTextNode(array[i].toString()));
        elem.appendChild(elems[i]);
    }
 
    var parent = document.getElementById("tabela");
    parent.appendChild(elem);
}

function isPositiveInteger(n) {
    return 0 === n % (!isNaN(parseFloat(n)) && 0 <= ~~n);
}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function validate(array)
{
    //lp
    if(!isPositiveInteger(array[0]))
        return false;
    //nazwa
    if(isNumeric(array[1]))
        return false;
    //pkwiu
    if(isNumeric(array[2]))
        return false;
    // //ilosc
    if(!isPositiveInteger(array[3]))
        return false;
    // //jm
    if(isNumeric(array[2]))
        return false;
    // //cena netto
    if(!(isNumeric(array[5]) && parseFloat(array[5]) > 0.0))
        return false;
    // //wartosc netto
    if(!(isNumeric(array[6]) && parseFloat(array[6]) > 0.0))
        return false;
    // //stawka vat
    if(!isPositiveInteger(array[7]))
        return false;
    // //kwota vat
    if(!(isNumeric(array[8]) && parseFloat(array[8]) > 0.0))
        return false;
    // //wartosc brutto
    if(!(isNumeric(array[9]) && parseFloat(array[9]) > 0.0))
        return false;

    return true;
}

function showText()
{
    var popup_message = "";
    var a = []
    for(var i = 0; i < 10; i++)
    {
    //     popup_message += i.toString() + ": " + document.getElementById('fd'+i.toString()).value + "\n";
        a.push(document.getElementById('fd'+i.toString()).value);
    }

    if(!validate(a))
    {
        alert("Podałeś niepoprawne dane!");

        var parent = document.getElementById("txt-fields");

        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }

        var btn = document.getElementById("txt-add");
        btn.disabled = false;
        return;
    }

    foo(a);

    SUMA += parseFloat(a[9]);

    var parent = document.getElementById("txt-fields");

    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }

    parentSum = document.getElementById("div-sum");

    while (parentSum.firstChild) {
        parentSum.removeChild(parentSum.firstChild);
    }

    var elem = document.createElement("p");
    elem.appendChild(document.createTextNode("Razem do zapłaty: " + SUMA.toString()+ "zł"));

    parentSum.appendChild(elem);

    var btn = document.getElementById("txt-add");
    btn.disabled = false;
}

</script>
<style>

body
{
    margin:50px 0px; padding:0px;
    text-align:center;
}
	
#Content {
	max-width:1000px;
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
<button onclick="window.print()">Drukuj fakturę</button><BR>
<?php
ini_set('display_errors', 0);



require('libs/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


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
		$idWizytArray=$_POST;
	}
	
}


$id_wizyt = null;
$suma = null;


$uslugi=ORM::for_table('rejestrWizyt')->where_in('id', $idWizytArray)->find_array();

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

//sprawdzanie, czy faktura już została wystawiona

$fakturaExists = ORM::for_table('faktury')
	->where('id_wizyty', $id_wizyt)
	->find_one();
	//jeśli nie to wystawiamy
	if($fakturaExists==null){
		$faktura = ORM::for_table('faktury')->create();
		$faktura->id_wizyty = $id_wizyt;
		$faktura->suma = $suma;
		$faktura->save();
		//echo "faktura wystawiona";
	}
	else{
		//echo "wyświetlanie faktury";
	}

$daneFaktury=ORM::for_table('faktury')->where('id_wizyty', $id_wizyt)->find_one();
//echo "id wizyty na fakturze: ".$daneFaktury->id_wizyty;

$numeryWizyt=substr($daneFaktury->id_wizyty, 0, -1);

$numeryWizytArray = explode(',', $numeryWizyt); //nieuzywany juz chyba - uzyty jednak 

$idUslug=Array();
$rodzajWizyty;

$wizyty = ORM::for_table('rejestrwizyt')
->raw_query('
SELECT rejestr.rodzaj_wizyty, rejestr.id_uslugi, firmy.id as fId, firmy.ulica AS fUlica, firmy.kod, firmy.nazwa, firmy.miasto as fMiasto, firmy.kod, firmy.regon, firmy.nip, pacjenci.imie, pacjenci.nazwisko, pacjenci.firma, pacjenci.ulica AS pUlica, pacjenci.kod_poczt, pacjenci.miasto AS pMiasto FROM `rejestrwizyt` AS `rejestr`
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



<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>faktura</title>
        <link rel="stylesheet" type="text/css" href="faktura.css">
        <script src="faktura.js"></script>
    </head>

    <body onload="init()">
        <div id="Content">
            <div>
                <div id="div-1a">
                    <b>Zakład Opieki Zdrowotnej "Bazylia"</b> <br>
					<b>Specjalistyczne Usługi Medyczne</b> <br>
                    <b>ul. A. Struga 23, 95-100 Zgierz</b><br>
                    NIP: <b>735-151-40-46</b><br>
                </div>

                <div id="div-1b">
                    <p><b>Faktura Nr <?php echo $daneFaktury->id; ?></b></p>
                </div>

    

                <div id="div-1c">
				Sprzedawca:<br>
                    <b>Zakład Opieki Zdrowotnej "Bazylia"</b> <br>
					<b>Specjalistyczne Usługi Medyczne</b> <br>
                    <b>ul. A. Struga 23, 95-100 Zgierz</b><br>
                    NIP: <b>735-151-40-46</b>
                </div>

                <div id="div-1d">
				Nabywca:<br>
				<?php

				if($wizyty[0]->rodzaj_wizyty=="medycyna_pracy"){
					//firma
					echo "<B>";
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
					echo "</B>";
					
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

             

            </div>


            <div>
                <br>
                <table border="1" id="tabela">
                    <tr style="background-color: #bababa;">
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
                <div id="div-sum">
                    <p><b>SUMA: <?php echo sprintf('%.2f', $daneFaktury->suma); ?>zł.</b></p>
                </div>
            <div id="div-odb">
            <p>Podpis odbiorcy</p>
            </div>
            <div id="div-wys">
            <p>Podpis wystawiającego</p>
            </div>


        </div>
    </body>
</html>
