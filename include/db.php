<?php 
require('libs/idiorm.php');

ORM::configure('mysql:host=serwer1873494.home.pl;dbname=27329434_bazylia');
ORM::configure('username', '27329434_bazylia');
ORM::configure('password', 'D7042d156!');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
?>