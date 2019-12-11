<div class="wrapper-50 margin-auto center">
    <h2>Create an account</h2>
    <form class="form" action="index.php?ctrl=user&action=doCreate" method="POST">
        <input type="email" name="email"placeholder="Mail" required/><br>
        <input type="password" name="password"placeholder="Password" required/><br>
        <input type="text" name="lastName"placeholder="Last Name" required/><br>
        <input type="text" name="firstName"placeholder="First Name" required/><br>
        <input type="text" name="address"placeholder="Address" required/><br>
        <input type="text" name="postalCode"placeholder="Postal Code" required/><br>
        <input type="text" name="city"placeholder="City" required/><br>
        <p>
            <input type="submit" class="submit-btn" value="Create">
        </p>
    </form>
    <span></span>
</div>