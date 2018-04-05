<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
</head>


<?php
require('libs/idiorm.php');
ini_set('display_errors', 0);
require('include/db.php');

$id = $_POST['delete'];

$deleteRow=ORM::for_table('rejestrwizyt')->where_in('id', $id)->delete_many();

?>
<script>
document.location.href=("rejestrWizyt.php");
</script>