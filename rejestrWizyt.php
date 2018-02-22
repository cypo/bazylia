<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php session_start(); ?>
<head>
<head>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
</head>


</head>
<script>
function sendPost(pesel, vid){
	console.log("sendPost");
	var zaswData = $('#zaswData'+vid).val();
	$.post("zaswiadczenie.php", {zaswData:zaswData, peselPacjenta:pesel}, function(){
	location.reload();
	//alert(divId);
	//window.setTimeout(function(){$('#div_'+divId).collapse("show")}, 3000); //to nie działa
								
	});
}
</script>
<script>
var divId;
var items = new Array();
function post(array) {
	if(array.length!=0){

    var form = document.createElement("form");
    form.setAttribute("method", 'POST');
    form.setAttribute("action", 'faktura.php');

    for(var key in array) {
        if(array.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", array[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
	}
}


function fakturaConfirm(){
	console.log(global);
	if(global==false){
		var con = confirm("Faktura nie została jeszcze wystawiona. Wystawić fakturę?");
	
		if(con){
			return true;
		}
		else{
			return false;
		}
	}
	
	
}



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


function showContent(id){
	
	$('.panel-collapse').collapse("hide");
	
	$('#div_'+id).collapse("toggle");
	$('#tr_'+id).removeClass("invisible");
	
}

function orzeczenieToggle(){
	$('#orzeczenie').collapse("toggle");
	
	$('#orzeczenie').on('shown.bs.modal', function () {
  $('#iii').trigger('focus')
})
	
}

function addItem(item){
	//dodac sprawdzanie czy item juz istnieje, jak tak to nie dodawac znowu
	items.push(item);

	//$('#p-'+item).html("Dodano");
	//$('#p-'+item).html("Dodano do faktury").removeClass("btn-outline-primary").addClass("btn-secondary").attr("disabled", true);
	$('#p-'+item).removeClass("btn-outline-primary").addClass("btn-secondary").attr("disabled", true);
	$('#v-'+item).removeClass("invisible").addClass("visible");
	$('#trMain_'+item).css("background-color", "#adc4ea");
}


function removeItem(item){
	var index = items.indexOf(item);

	if (index > -1) {
	    items.splice(index, 1);
	}
	$('#p-'+item).removeClass("btn-secondary").addClass("btn-outline-primary").attr("disabled", false);
	$('#v-'+item).removeClass("visible").addClass("invisible");
	$('#trMain_'+item).css("background-color", "");
}
function changeTrColor(nr, color){
	$('#trMain_'+nr).css("background-color", color);
}

</script>


<?php

require('libs/idiorm.php');
ini_set('display_errors', 0);
$faktura=Array();

ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $user=ORM::for_table('users')->where('login', $_SESSION['user'])->find_one();
    $pacjenciBezZasw=ORM::for_table('pacjenci')->where('zasw_reset', '1')->find_many();

    
	$kolumny=ORM::for_table('rejestrwizyt')
	->raw_query("SELECT 
	rejestrwizyt.id,
	pacjenci.imie, 
	pacjenci.nazwisko, 
	firmy.nazwa AS nazwaFirmy, 
	pacjenci.pesel, 
	pacjenci.nr_karty, 
	pacjenci.zaswiadczenie, 
	pacjenci.zasw_reset,
	rejestrwizyt.rodzaj_wizyty,  
	rejestrwizyt.typbadan,
    uslugi.nazwa AS nazwaUslugi,
	rejestrwizyt.data_wizyty
	
	FROM rejestrwizyt
	JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
	JOIN firmy ON firmy.id=rejestrwizyt.id_firmy
    JOIN uslugi ON uslugi.id=rejestrwizyt.id_uslugi
    
	ORDER BY rejestrwizyt.id DESC"
	)->find_many();

	$total=count($kolumny);

    // How many items to list per page
    $limit = 15;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

  

    // Prepare the paged query
    $rejestr = ORM::for_table('rejestrwizyt')
	->raw_query("SELECT 
	rejestrwizyt.id,
	pacjenci.imie, 
	pacjenci.nazwisko, 
	firmy.nazwa AS nazwaFirmy, 
	pacjenci.pesel, 
	pacjenci.nr_karty, 
	pacjenci.zaswiadczenie, 
	pacjenci.zasw_reset,
	rejestrwizyt.rodzaj_wizyty,  
	rejestrwizyt.typbadan,
    uslugi.nazwa AS nazwaUslugi,
	rejestrwizyt.data_wizyty
	
	FROM rejestrwizyt
	JOIN pacjenci ON pacjenci.id=rejestrwizyt.id_pacjenta
	JOIN firmy ON firmy.id=rejestrwizyt.id_firmy
    JOIN uslugi ON uslugi.id=rejestrwizyt.id_uslugi

    
	

	ORDER BY rejestrwizyt.id DESC
	LIMIT $limit
	OFFSET $offset
	
	"
	)

	->find_many();

?>
<center>
<div class="container">
<div class="jumbotron" style="padding-top: 10px;">
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
    <a class="nav-link active" href="rejestrWizyt.php">Zarejestrowane wizyty</a>
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
		<td width="25%" valign="top">
			<form action="search.php" method="POST"> 
			<table>
				<tr>
					<td  class="tdPadding">
					
						PESEL:<BR> <!-- to obowiazkowe -->
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="pesel"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Nr karty: <BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="numerKarty"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Imię:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="imie"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Nazwisko:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="nazwisko"/>
					</td>
					
				</tr>
				<tr>
					<td>
						Ulica:<BR>

					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="ulica"/>

					</td>
					
				</tr>
				<tr>
					<td>
						Miasto:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="miasto"/>

					</td>
					
				</tr>		
				<tr>
					<td>
						Kod-poczt.:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="kod-pocztowy"/>

					</td>
					
				</tr>
				
				<tr>
					<td>
						telefon:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="telefon"/>

					</td>
					
				</tr>
				<tr>
					<td>
						nip:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="nip"/>

					</td>
					
				</tr>		
				<tr>
					<td>
						firma:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="firma"/>

					</td>
					
				</tr>	
				<tr>
					<td>
						stanowisko:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="stanowisko"/>

					</td>
					
				</tr>	
				<!--
				<tr>
					<td>
						zaswiadczenie:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="zaswiadczenie"/>

					</td>
					
				</tr>
-->				
				<!--
				<tr>
					<td>
						lekarz orzekający:<BR>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="lekarz"/>

					</td>
					
				</tr>					
				-->
			</table>
						
				
					<input type="hidden" name="zakres" value="selected"/>
					<input type="submit" class="btn btn-success" value="Szukaj"/>
				</form>
				
				<form action="search.php" method="POST"> 
					<input type="hidden" name="zakres" value="all"/>
					<input type="submit" class="btn btn-primary" value="Wszystkie"/>
				</form>
				</div>
			
		</td>


		<td valign="top" class="tdPaddingLeft">
		

		
		
		<nav aria-label="Page navigation example">
  <ul class="pagination">
		
<?php
  // The "back" link
    $prevlink = ($page > 1) ? '<li class="page-item"><a class="page-link" href="?page=1" title="First page">&laquo;</a></li><li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a></li>' : '<li class="page-item disabled"><a class="page-link" title="First page">&laquo;</a></li> <li class="page-item disabled"><a class="page-link" title="First page">&lsaquo;</a></li>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a></li><li class="page-item"><a class="page-link" href="?page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo $prevlink, '<li class="page-item"><a class="page-link">Strona ', $page, ' z ', $pages, ', wyświetlanie ', $start, '-', $end, ' z ', $total, ' wyników </a></li>', $nextlink;

    if($pacjenciBezZasw){
        echo "Pacjenci bez zaswiadczenia: ".count($pacjenciBezZasw);
    }
    
?>
</ul>
</nav>
<BR>
<table border="0" class="table table-sm hover-hand table-striped">
			<thead class="thead-default">
			<tr>
			<th>Id</th>
			<th>Firma</th>
			<th>Nazwisko</th>			
			<th>Imię</th>
			<th>PESEL</th>
			<th>nazwa usługi</th>
			<th>Faktura</th>
		<!--	<th>orzeczenie</th> -->
			</tr>
			
			</thead>
			<tbody>

			<?php
			    
				$faktura_s=Array();
				foreach($rejestr as $array => $v){
					$fakturaExists = ORM::for_table('faktury')->raw_query('SELECT * FROM faktury WHERE id_wizyty LIKE \'%'.$v->id.'%\'')->find_one();
					
					echo '<tr id="trMain_'.$v->id.'" onClick="return showContent('.$v->id.')">';
					
					echo '<td>';
					echo $v->id;
					echo '</td>';
					echo '<td>';
					echo $v->nazwaFirmy;
					echo '</td>';					
					echo '<td>';
					echo $v->nazwisko;
					echo '</td>';					
					echo '<td>';
					echo $v->imie;
					echo '</td>';					
					echo '<td>';
					echo $v->pesel;
					echo '</td>';					
					echo '<td>';
					if($v->rodzaj_wizyty=='medycyna_pracy'){
					    echo $v->nazwaUslugi;
					}
					else{
					    echo $v->nazwaUslugi;
					}
					
					echo '</td>';
					echo '<td>';
					if($fakturaExists){
						echo "T";						
					}
					else{
						echo '<font color="red">N</font>';
						
					}
					echo '</td>';
		
	
					echo "</tr>";
					echo '<tr id="tr_'.$v->id.'" class="invisible">';
					echo '<td colspan="6" style="padding: 0px;">';
					echo '<div id="div_'.$v->id.'" class="panel-collapse collapse in hide">';
					
					echo '<table class="table">';
					echo '<tr>';
					echo '<td>';
					echo "Numer karty: ";
					echo '</td>';
					echo '<td>';
					echo $v->nr_karty;
					echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>';
					echo "Rodzaj wizyty: ";
					echo '</td>';
					echo '<td>';
					echo $v->rodzaj_wizyty;
					echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>';
					echo "Typ badań: ";
					echo '</td>';
					echo '<td>';
					echo $v->typbadan;
					echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>';
					echo "Data wizyty: ";
					echo '</td>';
					echo '<td>';
					echo $v->data_wizyty;
					echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>';
					echo "Orzeczenie ważne do: ";
					echo '</td>';
					echo '<td>';
					if($v->zaswiadczenie=='1970-01-01') {
						echo '
							<script>
							
							</script>
							';
						echo '<i id="iii" onClick="return orzeczenieToggle()" class="fa fa-ban danger-color" aria-hidden="true">orzeczenie negatywne</i>';
					}

					else {
						echo $v->zaswiadczenie;
					}
					
					
					
					if($v->zaswiadczenie=='' || $v->zasw_reset=='1'){					
						echo '
							<script>
							changeTrColor("'.$v->id.'", "#ff8060");
							divId="'.$v->id.'";
							</script>
						';
						?>
						<input id="zaswData<?php echo $v->id;?>" type="date" name="zaswData">
						
						

						<button class="btn btn-outline-success btn-sm" onClick="sendPost(<?php echo $v->pesel.','.$v->id;?>)">Ustaw</button>
						<?php
						
					}
					
?>

						



<?php
					//////miejsce na ikonkę edycji+ form do edytowania orzeczenia
					echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>';
					array_push($faktura_s, $v->id);
					$fakturaSerialized=serialize($faktura_s);
					
					//sprawdzanie czy faktura jest juz wystawiona
					//echo 'SELECT * FROM faktury WHERE id_wizyty LIKE \'%'.$v->id.'\'%';
						
						
						
						//print_r($fakturaExists);
						//echo $fakturaExists->id;
						
						

						if($fakturaExists==null){
						    if($user->role==1){
                                echo '<button id="p-'.$v->id.'" class="btn btn-outline-primary btn-sm" onClick="addItem('.$v->id.')">dodaj do faktury</button>';
                                echo '<button id="v-'.$v->id.'" class="btn btn-outline-danger btn-sm invisible" onClick="removeItem('.$v->id.')">usuń z faktury</button>';
							    //echo '<p id="p-'.$v->id.'"><p>';
						    }
						    else{
                                echo '<button class="btn btn-outline-secondary btn-sm" disabled>Brak faktury</button>';   
						    }

						}
						else{
							echo '<form action="faktura.php" method="POST" target="_blank" onSubmit="return fakturaConfirm();">';
																						//przekazuje numer faktury (String)
							echo'<input type="hidden" name="fakturaWystawiona" value='.$fakturaExists->id.'>
							<input type="submit" class="btn btn-outline-primary btn-sm" value="Wyświetl fakturę"/>';

							echo '</form>';

						}
	
	

?>

<!-- zrobic $post na rejestrWizyt.php ktory wysyla np _POST['abc']=1, a to nizej dac w include(), a include w if(_POST[123]....) -->

			<!-- Modal -->
						<div class="modal fade" id="historiaModal<?php echo $v->id?>" tabindex="-1" role="dialog" aria-labelledby="historiaModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="historiaModalLabel">Historia orzeczeń dla pacjenta</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<table>
									<thead>
										<th>#</th>
										<th>ważność zaświadczenia</th>
										<th>data zmiany</th>
									</thead>
									<tbody>
									
										<?php
										
										  $zaswiadczenia=ORM::for_table('zaswiadczenia')->where('pesel', $v->pesel)->order_by_desc('id')->find_many();
										  
										  $id=1;
										  foreach($zaswiadczenia as $zaswiadczenie){
											  echo '<tr>';
											  echo '<td>'.$id.'</td>';
											  echo '<td>'.$zaswiadczenie->data.'</td>';
											  echo '<td>'.$zaswiadczenie->dataZmiany.'</td>';
											  $id++;
										  }
										  
										?>	
									</tbody>
								</table>
							  </div>
							</div>
						  </div>
						</div>
						<!-- koniec modala -->
						<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#historiaModal<?php echo $v->id?>">
						historia orzeczeń
						</button>

<?php
					$faktura_s=Array();
					echo '</td>';
					echo '</tr>';				
					echo '</table>';

					echo "</div>";
					echo '</td>';
					echo "</tr>";					
				}
			
			
			?>


					<button class="btn btn-outline-success" onClick="return post(items);">Wystaw fakturę</button>
					<button class="btn btn-outline-danger" onClick="return remove(items);">Wyczysć</button>
			</tbody>
			</table>


		</td>
	
	</tr>


</table>

