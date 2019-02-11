<?php 
	include '../classes/query.php';
	$con = new Query();
	$con->setHost('localhost');
	$con->setUser('root');
	$con->setPassword('');
	$con->setDataBase('zohooauth');
	//Configuración en el hosting
	
	// $con->setHost('db773063056.hosting-data.io');
	// $con->setUser('dbo773063056');
	// $con->setPassword('VTZoho135*');
	// $con->setDataBase('db773063056');

 ?>