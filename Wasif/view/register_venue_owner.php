<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/venueOwner_reg.css">
    <script src="../js/JavaScript.js" defer></script>
    <title>Register as Venue Owner</title>
</head>
<body>
    <header>
        <h1>Register as Venue Owner</h1>
        <p>Join VenueFind to list and manage your venues effortlessly.</p>
    </header>
    <main>
    <form action="../control/UserController.php" method="POST" class="form-container" id="venueOwnerForm" onsubmit="return validation('venueOwnerForm')">
    <input type="hidden" name="action" value="register_venue_owner">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name">
    <span id="nameError" style="color:red;"></span>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email">
    <span id="emailError" style="color:red;"></span>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Create a password">
    <span id="passwordError" style="color:red;"></span>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" placeholder="Enter your phone number">
    <span id="phoneError" style="color:red;"></span>

    <label for="business_name">Business Name:</label>
    <input type="text" id="business_name" name="business_name" placeholder="Enter your business name">
    <span id="businessNameError" style="color:red;"></span>

    <button type="submit">Register</button>
</form>

    </main>
</body>
</html>
