	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
table{width:400px; padding:5px;}
table tr:first-child td{font-weight:bold;}
table tr td{border: 1px solid black; }
</style>
<input type="text" id="szukaj_osoby" placeholder="wpisz imię, nazwisko lub zawód">
<table id="tabela">
    <tr>
        <td>imie</td>
        <td>nazwisko</td>
        <td>zawod</td>
    </tr>
 
    <tr>
        <td>Marian</td>
        <td>Kononowicz</td>
        <td>polityk</td>
    </tr>
 
    <tr>
        <td>Antek</td>
        <td>Kowal</td>
        <td>programista</td>
    </tr>
     <tr>
        <td>Wiesia</td>
        <td>Komorowska</td>
        <td>programistka</td>
    </tr>
</table>

<script>
var $rows = $('#tabela tr'); //pobranie wierszy z tabeli
$('#szukaj_osoby').keyup(function() { //funkcja keyup jest wywolywana kiedy uzytkownik nacisnie klawisz
 
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text; // uzycie wyrazenia regularnego do sprawdzenia elementu
 
        $rows.show().filter(function() { // najpierw pokazujemy wszystkie wiersze, a potem stosujemy funkcje filter()
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text); //sprawdzamy czy wiersz pasuje doelementu szukanego, jeśli nie to chowamy ten wiersz 
        }).hide();
    });
</script>