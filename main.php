<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">	
<style>

</style>
</head>
<!--

cena - niektore usługi mają rozne ceny dla roznych firm - jakos to wpisac w baze


- wyszukiwanie pacjenta - jak nie znajdzie to dodaj nowego -> formularz
ajax


- rejestracja 

--- historia uslug dla danego pacjenta - co robił, kiedy, do jakiej firmy wtedy należał


- wyszukanie pacjenta (ajax)
- rodzaj wizyty: medycyna pracy/inne
- typy badań: wstepne, kontrolne, okresowe, sanitarno-epidemiologiczne
- kontrahent - firma (+ wybór ręczny) - po wyborze ręcznym ma być dodana kolejna firma do bazy dla pacjenta - ostatnio dodana jako bieżąca
- usługi - wybór usług dla pacjenta przy rejestracji (ajax - wyszukiwarka)
- realizacja (wybór terminu - mozliwa wsteczna data)

ZAPISAC WSZYSTKIE ZMIENNE DO SESJI ZAMIAST PRZEKAZYWAC _POST!!









-->

<?php
session_start();
require 'login.php';

/*

if($_SESSION['login']!=1){
	login::checkLogin();
	
}
if($_SESSION['login']!=1){
	//login::checkLogin();
	
}
else{
	
	
?>
*/


include('leftMenu.php');
?>


		<td>
			<center>
			
				<img src="logo.jpg" width="40%"><br>
			<!--	<font face="verdana"><b>System rejestracji pacjentów -->
			</center>
		</td>
	
	</tr>


</table>
</div>
</div>
<?php
//}
?>