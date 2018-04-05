<?php
require('libs/idiorm.php');
require('include/db.php');



//$zaswiadczenia=ORM::for_table('zaswiadczenia')->where('pesel', $_POST['pesel'])->find_many();

    // Find out how many items are in the table
    $rejestr=ORM::for_table('rejestrwizyt')
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
	
	$total=count($rejestr);
	echo $total;

    // How many items to list per page
    $limit = 20;

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

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = ORM::for_table('rejestrwizyt')
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
	
	
	foreach($stmt as $s){
		echo $s->id;
		echo '<br>';
	}





?>