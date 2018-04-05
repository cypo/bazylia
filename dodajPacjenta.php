<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
</head>
<body>
	<?php
require('libs/idiorm.php');
require('include/db.php');

$pacjent = ORM::for_table('pacjenci')->create();

$pacjent->imie = $_POST['imie'];
$pacjent->nazwisko = $_POST['nazwisko'];
$pacjent->nr_karty = $_POST['numerKarty'];
$pacjent->pesel	 = $_POST['pesel'];
$pacjent->ulica	= $_POST['ulica'];
$pacjent->kod_poczt	= $_POST['kod-pocztowy'];
$pacjent->miasto = $_POST['miasto'];
$pacjent->telefon = $_POST['telefon'];
$pacjent->nip = $_POST['nip'];
$pacjent->plec = $_POST['plec'];
$pacjent->firma	= 99998;
$pacjent->stanowisko = $_POST['stanowisko'];
$pacjent->inne = $_POST['inne'];

$pacjent->save();


$id_ostatniego=ORM::for_table('pacjenci')->select('id')->order_by_desc('id')->find_one();


?>
<script>
document.location.href="search.php?id=<?php echo $id_ostatniego->id ?>";

</script>



</body>
</html>