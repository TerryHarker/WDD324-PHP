<?php
// Daten-Array (assoziatives array = keys sind strings)
$projekt = array(
    'bild' => '',
    'titel' => '',
    'jahr' => ''
);

$projekt['bild'] = 'media/Business-20.png'; // einzelne Position hinzufügen
echo $projekt['bild'];

// Mehrdimensionales Array: 
$projekte = array(
    array(
        'bild' => 'media/Business-20.png',
        'titel' => 'Business 20',
        'jahr' => '2025'
    ),
    array(
        'bild' => 'media/eaef_Blurr-402x.jpg',
        'titel' => 'BLurr',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'media/Pompeo.jpg',
        'titel' => 'Pompeo',
        'jahr' => '2024'
    ),
    array(
        'bild' => 'media/biznus.jpg',
        'titel' => 'BizNus',
        'jahr' => '2023'
    )
);

// ganzes Array anzeigen lassen:
echo '<pre>';
print_r($projekte);
echo '</pre>';

// Einzelner Wert auslesen 
echo $projekte[0]['bild'];

// for Loop
for($i=0; $i<count($projekte); $i++){
    echo '<br>'.$projekte[$i]['bild'];
}

echo '<br>';

// foreach Loop
foreach($projekte as $key => $projekt){
    echo '<br>'.$key.': '.$projekt['bild'];
}

?>