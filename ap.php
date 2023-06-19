<?php 

$kolicina1 = $_POST["kolicina1"];
$kolicina2 = $_POST["kolicina2"];
$kolicina3 = $_POST["kolicina3"];
$nadji = $_POST["nadji"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Apoteka online</title>
</head>
<body>
	<h1>Apoteka</h1>
	<h2>Fiskalni racun</h2>

	<?php 

	$date = date(DATE_RFC2822);
	echo "<p>Roba narucena u: " . $date . "</p>";

	echo "<p>Porucili ste: </p>";
	$ukupno = $kolicina1 + $kolicina2 + $kolicina3;
	echo "<p>Ukupna kolicina: " . $ukupno . "<br>"
	. $kolicina1 . " andol<br>" . 
	$kolicina2 . " aspirin<br>" . 
	$kolicina3 . " vitamin C<br></p>";

	$ukupnaCena = 0.00;
	define("PRVI", 10);
	define('DRUGI', 20);
	define('TRECI', 30);

	$ukupnaCena = $kolicina1 * PRVI +
					$kolicina2 * DRUGI +
					$kolicina3 * TRECI;

	echo "<p>Ukupna cena bez poreza: " . $ukupnaCena . "</p>";
	
	$porez = 1.10;
	$ukupnaCena = $ukupnaCena * $porez;
	echo "<p>Ukupna cena sa porezom: " . $ukupnaCena . "</p>";

	if ($nadji == "a") 
	{
		echo "<p>Hvala!</p>";
	}
	else
	{
		echo "<p>Ddjite opet!</p>";
	}

	$ispis = $date . "\t - " . $kolicina1 . " andol, " .
							   $kolicina2 . " aspirin, " .
							   $kolicina3 . " vit C. Ukupna cena: " .
							   $ukupnaCena . " dinara. \n";

	$f = fopen("racun.txt", "a");
	flock($f, LOCK_EX);

	if(!$f)
	{
		echo "<p>Nemoguce je izvrsiti porudzbinu!!</p>";
		exit;
	}

	fwrite($f, $ispis, strlen($ispis));

	flock($f, LOCK_UN);
	fclose($f); 

	echo "<p>Racun je istampan!</p>";

	?>

</body>
</html>