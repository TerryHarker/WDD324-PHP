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
function writeNav( $navClass='nav', $sef=false ){
    
    // SEF URL einschalten/ausschalten - dieser Teil setzt eine .HTACCESS Datei voraus, in welcher die entsprechenden rewrite Regeln definiert sind
    $suffix = '.php';
    if($sef == true || SEF_URLS == true){ // entweder über den parameter in writeNav() oder in der Config definieren 
      $suffix = ''; // .php wird weggelassen in den NAV URLs
    }


    // zuerst den Dateinamen für den Aktivstatus der Nav ermitteln
    $aktueller_url = $_SERVER['PHP_SELF']; // $_SERVER ist ein Super Global, global = auf allen Ebenen gültig, daher kann es hier im Function Scope verwendet werden
    $letzter_slash = strrpos($aktueller_url, '/');
    $dateiname = substr($aktueller_url, $letzter_slash+1);
    // echo 'dateiname: '.$dateiname;


    // Nav HTML aufbauen
    $html_output = '<ul class="'.$navClass.'">';

    $activeClass = $dateiname=='index.php'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="./">Home</a></li>';
    
    $activeClass = $dateiname=='portfolio.php'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="portfolio'.$suffix.'">Portfolio</a></li>';
    
    $activeClass = $dateiname=='contact.php'?'active':'';
    $html_output .= '<li class="nav-item col-6 col-md-auto"><a class="nav-link p-2 '.$activeClass.'" href="contact'.$suffix.'">Kontakt</a></li>';

    $html_output .= '</ul>';

    return $html_output; // HTML zurückgeben
}
?>


