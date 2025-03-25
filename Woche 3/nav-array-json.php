<?php
$nav_array = array(
    array(
        'name'=>'Home',
        'url'=>'home.php'
    ),
    array(
        'name'=>'Portfolio',
        'url'=>'portfolio.php'
    ),
    array(
        'name'=>'Kontakt',
        'url'=>'contact.php'
    )
);

$resultat = json_encode((object)$nav_array);
echo $resultat; 
$resultat = json_decode($resultat,true);
print_r($resultat);
?>