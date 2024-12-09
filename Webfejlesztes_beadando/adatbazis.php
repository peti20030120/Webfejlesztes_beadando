<?php
	define("DBIP","localhost");
	define("DBUSN","Peti");
	define("DBPSW","12345678");
	define("DBNM","labdarugas_adatbank");
	
	$conn = mysqli_connect(DBIP, DBUSN, DBPSW, DBNM);
	
	header('Content-Type: text/html; charset=utf-8');
	mysqli_set_charset($conn, 'utf8mb4');
	mysqli_query($conn, "set names 'utf8mb4'");
	mysqli_query($conn, "SET COLLATION_CONNECTION = 'utf8mb4_unicode_ci'");
	
	if($conn!= true) {
		print "Nincs adatbazis kapcsolat";
		exit();
	}
?>
