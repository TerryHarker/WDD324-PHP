<h3>Registration</h3>

<form action="" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="email">E-Mail</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="gender">Gender</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
    </div>
    <div>
        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="usa">USA</option>
            <option value="canada">Canada</option>
            <option value="uk">UK</option>
        </select>
    </div>
    <div>
        <label for="newsletter">Subscribe to newsletter</label>
        <input type="checkbox" id="newsletter" name="newsletter" value="1">
    </div>
    <button type="submit">Register</button>
</form>