<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/customer_reg.css">
    <script src="../js/JavaScript.js"></script>
    <title>Register as Customer</title>
</head>
<body>
    <header>
        <h1>Register as Customer</h1>
        <p>Fill in your details below to create your account.</p>
    </header>
    <main>
    <form action="../control/UserController.php" method="POST" class="form-container" id="customerForm" onsubmit="return validation('customerForm')">
    <input type="hidden" name="action" value="register_customer">
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

    <label for="address">Address:</label>
    <textarea id="address" name="address" placeholder="Enter your address" rows="4"></textarea>
    <span id="addressError" style="color:red;"></span>

    <button type="submit">Register</button>
</form>
</main>
</body>
</html>
