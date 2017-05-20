<?php
	$dsn = 'mysql: host=localhost; dbname=leasemanage';
	$user = 'leasemanage';
	$pass = 'Mahouka1';

	try {
		$db = new PDO($dsn, $user, $pass);
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'Connection Failed:  ' . $e->getMessage();
	}


?>