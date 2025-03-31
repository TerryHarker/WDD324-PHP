<?php
/**
 * SESSION DEMO SCRIPT
 * Mit diesem Script wird ein Wert in eine Session geschrieben, 
 * damit er später in anderen Scripts wieder abrufbar ist
 * Teste dies durch den Aufruf des Scripts demo-session-test.php
 */

// Sessionzugriff eröffnen (ohne diese Zeile stehen dem Script die Session und deren Daten nicht zuer Verfügung)
session_start(); 

// $_SESSION['username'] = 'Terry'; // Wert in Session Array speichern - den Rest übernimmt der Server

echo '<pre>';
print_r($_SESSION); // Session ist ein Array und kann mit print_r() betrachtet werden
echo '</pre>';
?>