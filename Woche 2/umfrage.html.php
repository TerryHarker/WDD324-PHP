<!-- Diese Datei enthält ein Formular, das Daten an ergebnis.php sendet -->
<h3>Umfrage</h3>
<h4>Form GET</h4>
<form action="ergebnis.php" method="GET">
    <div>
        <label for="name">Dein Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label>Interessen</label><br>
        <div>
            <input type="checkbox" id="frontend" name="interests[]" value="frontend">
            <label for="frontend">Frontent (JavaScript)</label>
        </div>
        <div>
            <input type="checkbox" id="backend" name="interests[]" value="backend">
            <label for="backend">Backend (PHP / MySQL)</label>
        </div>
    </div>
    <button type="submit">Absenden</button>
</form>
<h4>Form POST</h4>
<form action="ergebnis.php" method="POST">
    <div>
        <label for="name">Dein Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label>Interessen</label><br>
        <div>
            <input type="checkbox" id="frontend" name="interests[]" value="frontend">
            <label for="frontend">Frontent (JavaScript)</label>
        </div>
        <div>
            <input type="checkbox" id="backend" name="interests[]" value="backend">
            <label for="backend">Backend (PHP / MySQL)</label>
        </div>
    </div>
    <button type="submit">Absenden</button>
</form>