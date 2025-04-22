<?php
require_once('../configuration.php');
require_once('../functions/html.functions.php');
require_once('../functions/session.functions.php');

session_name( md5(SESSIONNAME) );
session_start(); // Session eröffnen und allenfalls session ID erstellen

$isLoggedIn = loginCheck();

/**
 * LOGIN LOGIK
 */
if( $isLoggedIn == true){
    // session noch gültig - zeit erneuern
    loginRefresh();
}else{
    // session nicht gültig - zurücksetzen
    logout();
    header('Location: login.php');
    exit;
}

$db = new PDO("mysql:host=".DBSERVER.";dbname=".DBNAME, DBUSER, DBPASSWORT);

$id = 0;
$title = '';
$subtitle = '';
$status = '';

// Erster Schritt: READ (vorbereitung des Formulars)
if( isset($_GET['id']) ){
    $id = $_GET['id'];

    // User Query mit Platzhalter für die ID erstellen - ID ist User Input 
    $query = "SELECT * FROM `project` WHERE ID=:editID"; 
    // echo 'aktuelle Abfrage: '.$query;

    // $statement = $db->query($query);
    $statement = $db->prepare($query); // Query zur Vorbereitung an den DB Server schicken
    $statement->execute( array(':editID' => $id) ); // Daten schicken

    $project = $statement->fetch(PDO::FETCH_ASSOC); // fetch für nur ein User-Array

    $title = $project['title'];
    $subtitle = $project['subtitle'];
    $status = $project['status'];
    
}


// Formular wurde abgeschickt
if( isset($_POST['id']) ){
    echo '<pre>POST ';
    echo 'POST: ';
    print_r($_POST);

    echo 'FILES: ';
    print_r($_FILES);
    echo '</pre>';
    // exit;
    
    // Bild in den Medienordner speichern
    if( !empty($_FILES['imgurl']['name']) ){
        // Bild validierung (Grösse, Dateityp etc. kann mit den Daten aus $_FILES gemacht werden)
        $temp_pfad = $_FILES['imgurl']['tmp_name'];
        $ziel_pfad = '../'.BILDERORDNER.'/'.$_FILES['imgurl']['name'];
        move_uploaded_file($temp_pfad, $ziel_pfad);
    }
    
    // Variablen überschreiben (sanitizing weggelassen, müsste aber auch gemacht werden)
    $id = (int)$_POST['id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $status = $_POST['status'];
    $imgurl = $_FILES['imgurl']['name']; // Für das hochgeladene Bild festgelegter Name
    
    // validierung: weggelassen, müsste aber auch gemacht werden
    // Files fehler für die Validierung: https://www.php.net/manual/en/features.file-upload.errors.php

    // Daten-Array vorbereiten - nur die Daten, die sowohl für INSERT als auch UPDATE gebraucht werden 
    $daten = array(
        ':title' => $title,
        ':subtitle' => $subtitle,
        ':status' => $status
    );

    if($id==0){

        // keine ID vorhanden - INSERT: Query zum Erstellen eines neuen Datensatzes erstellen
        $daten[':imgurl'] = $imgurl; // Bild immer hinzufügen (darf nicht leer sein bei neu...)
        
        $query = "INSERT INTO `project` (`imgurl`, `title`, `subtitle`, `status`) ";
        $query .= "VALUES ( :imgurl, :title, :subtitle, :status )";

    }else{
        // ID vorhanden - UPDATE: Query zum Aktualisieren mit Platzhaltern erstellen
        $query = "UPDATE `project` SET ";

        // Wurde ein eues Bild hochgeladen?
        if(!empty($_FILES['imgurl']['name'])){

            // altes Bild ermitteln
            $imgquery = "SELECT imgurl FROM `project` WHERE ID=:editID"; 
            $statement = $db->prepare($imgquery); // Query zur Vorbereitung an den DB Server schicken
            $statement->execute( array(':editID' => $id) ); // Daten schicken
            $old_img = $statement->fetchColumn(); // Nur den Wert der ersten Spalte abrufen

            // altes Bild löschen
            if(is_file('../'.BILDERORDNER.'/'.$old_img)){
                unlink('../'.BILDERORDNER.'/'.$old_img);
            }

            // neues Bild in DB
            $daten[':imgurl'] = $imgurl;
            $query .= "imgurl = :imgurl, "; 
        }

        
        $query .= "title = :title";
        $query .= ", subtitle = :subtitle";
        $query .= ", status = :status";

        // Zum schluss noch where hinzufügen bei bestehendem Datensatz: 
        $daten[':updateID'] = $id;
        $query .= " WHERE ID=:updateID"; // Nur diesen Datensatz updaten
        
    }


    echo '<pre>Speicherbefehl: '.$query.'</pre>';
    $statement = $db->prepare($query);
    $resultat = $statement->execute( $daten );
    var_dump($resultat);

    if($resultat==true){
        echo 'hat funktioniert';
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">

<?php include('partials/htmlhead.php'); ?>
<body>
    <?php include('partials/header.php'); ?>

    <section class="main-section">
		<div class="container">
                    
            <h2>User erfassen / editieren</h2>
            <form action="project-edit.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="imgurl" class="form-label">Bild</label>
                    <input type="file" id="imgurl" name="imgurl" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Titel</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Untertitel</label>
                    <input type="text" id="subtitle" name="subtitle" class="form-control" value="<?php echo $subtitle; ?>">
                </div>
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Status</label>
                    <select name="status">
                        <option value="1" <?php echo $status==1 ? 'selected':'' ?>>Veröffentlicht</option>
                        <option value="0" <?php echo $status==0 ? 'selected':'' ?>>Versteckt</option>
                        <option value="-1" <?php echo $status==-1 ? 'selected':'' ?>>Papierkorb</option>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <button type="submit" class="btn btn-primary">Speichern</button>
                <a href="project-list.php" class="btn btn-secondary">Abbrechen</a>
            </form>
        </div>
    </section>
    <?php
    include('partials/footer.php');
    ?>
</html>