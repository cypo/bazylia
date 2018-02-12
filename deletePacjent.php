<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
	<link rel="stylesheet" href="libs/bootstrap-4.0.0-beta-dist/css/bootstrap.css">
	<script src="libs/bootstrap-4.0.0-beta-dist/js/bootstrap.js"></script>
</head>


<?php
require('libs/idiorm.php');
ini_set('display_errors', 0);
ORM::configure('mysql:host=localhost;dbname=bazylia');
ORM::configure('username', 'bazylia');
ORM::configure('password', 'qwerty');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$id = $_POST['id'];

$pacjent=ORM::for_table('pacjenci')->where('id', $id)->find_one();
$pacjent->delete();
?>
