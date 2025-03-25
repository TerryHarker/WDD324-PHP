<?php
$language = 'en';

function hallowelt( $language='' ) {
    $hallowelt_text = '';

    if($language == 'en'){
        $hallowelt_text = "Hello world!";
    }else{
        $hallowelt_text = "Hallo Welt!";
    }

    return $hallowelt_text;
}


$resultat = hallowelt( );
$resultat = hallowelt( 'en' );

echo $resultat;
?>