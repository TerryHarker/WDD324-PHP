<?php

// https://www.php.net/manual/en/datetime.format.php
$wochentag = date("l");
$tagdesmonats = date("d");
$monat = date("F");
$jahr = date("Y");


// Formatierungsobjekt für Übersetzung: 
$datumvonjetzt = new DateTime('now'); // aktuelles Datum gemäss Serverzeit
$language = 'de_DE'; // Sprachflag für Formatter
$format = IntlDateFormatter::NONE; // kein Format nötig, die Konstante wird vom Objekt bezogen

// Wochentag als deutscher wert anzeigen:
$dayFormatter = new IntlDateFormatter($language, $format, $format, null, null, 'EEEE'); // Format 'EEEE' steht für den ausgeschriebenen Wochentag
$wochentag = $dayFormatter->format($datumvonjetzt);

// Monat als deutscher wert anzeigen:
$monthFormatter = new IntlDateFormatter($language, $format, $format, null, null, 'MMMM'); // Format 'EEEE' steht für den ausgeschriebenen Wochentag
$monat = $monthFormatter->format($datumvonjetzt);

?>
<html>
<head>
	<title>MINI KALENDER</title>
</head>
<body>

<h3 style="color:#999999;">MINI KALENDER</h3>
<div style="border:1px solid black;border-top:5px solid #000000; width:200px; height:250px;text-align:center;">
	<h2><?php echo $wochentag; ?></h2>

	
	<span style="font-size:100px;font-weight:bold;"><?php echo $tagdesmonats; ?></span>
	
	<h2><?php echo $monat." ".$jahr; ?></h2>
</div>
</body>
</html>