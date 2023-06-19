<!DOCTYPE html>
<html>
<head>
	<title>Apoteka</title>
</head>
<body>
	<h1>Online apoteka</h1>
	<h2>Kupljena roba</h2>

	<?php 

		$fajl = fopen("racun.txt", "r");
		flock($fajl, LOCK_SH);

		if(!$fajl)
		{
			echo "<p>Ne moze se izvrsiti!!</p>";
		}

		while (!feof($fajl)) 
		{
			$ispis = fgets($fajl,999);
			echo $ispis . "<br>";
		}

		fclose($fajl);

	 ?>


</body>
</html>