<h3>Registration</h3>
<form action="" method="POST">
    <div>
        <label for="username">Username*</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Passwort*</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="email">E-Mail*</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="gender">Geschlecht</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
        <input type="radio" id="neutral" name="gender" value="neutral">
        <label for="neutral">Neutral</label>
    </div>
    <div>
        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="CH">Schweiz</option>
            <option value="DE">Deutschland</option>
            <option value="AT">Österreich</option>
        </select>
    </div>
    <div>
        <label >Newsletter</label>
        <input type="checkbox" id="newsletter" name="newsletter" value="1">
        <label for="newsletter">Ja</label>
    </div>
    <br>
    <button type="submit">Registrieren</button>
</form>