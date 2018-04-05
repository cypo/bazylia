
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
	
<style>
	.opis{
		float: left;
	
	}
	
	.form{
		float: left;
	
	}

</style>
</head>
<body>

<?php
echo "LOGIN: ".$_SESSION['login'];
if($_SESSION['login']!=1){
?>

<div class="alert alert-success" role="alert">
<center>
  <h4 class="alert-heading">Logowanie</h4>
	 <form action="main.php" method="POST">
		<fieldset>
			<div class="col-lg-2">
				<input class="form-control form-control-sm" placeholder="Login" name="login" type="text" autofocus="">
			</div>
			<div class="col-lg-2">
				<input class="form-control form-control-sm" placeholder="Hasło" name="pass" type="password">
			</div>
			<button type="submit" class="btn btn-outline-primary">Zaloguj</button>
		</fieldset>
	</form>
</center>
</div>
</body>

<?php
}
if($_SESSION['login']==1){
include 'main.php';

}

