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