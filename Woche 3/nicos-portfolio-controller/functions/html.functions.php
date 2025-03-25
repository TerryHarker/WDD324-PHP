<?php
/**
 * BEISPIEL FUNKTIONS-BIBLIOTHEK (hier mit nur einer Funktion)
 * Funktionsdefinitionen werden immer ausgelagert, es macht normalerweise keinen Sinn, Funktionen nur für ein Script zu definieren
 * Hat man viele Funktionen, die nicht alle überall benötigt werden, 
 * ordnet man die Funktionen in einzelnen Dateien thematisch (z.B. alles was HTML erzeugt, alles was mit Mails oder Dateiverwaltung zu tun hat etc.)
 */

 /**
  * Kommentarblock einer Funktion - dieser soll eine kurze Beschreibung und die Parameter und den Rückgabewert enthalten
  * writeNav - gibt eine UL/LI Navigation zurück
  * @param string $navClass - CSS Klassen für den UL Tag der Navigation
  * @return string $html_output - das fertige Nav HTML
  */
function writeNav( $page, $navClass='nav' ){
    
    // Nav HTML aufbauen
    $html_output = '<ul class="'.$navClass.'">';

    $activeClass = $page=='home'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="index.php?page=home">Home</a></li>';
    
    $activeClass = $page=='portfolio'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="index.php?page=portfolio">Portfolio</a></li>';
    
    $activeClass = $page=='contact'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="index.php?page=contact">Kontakt</a></li>';

    $html_output .= '</ul>';

    return $html_output; // HTML zurückgeben
}
?>


