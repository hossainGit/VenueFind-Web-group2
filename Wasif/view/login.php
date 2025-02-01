<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
        <p>Enter your email and password to access your profile.</p>
    </header>
    <main>
        <form action="../control/LoginController.php" method="POST" class="form-container">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">

            <button type="submit" name="login">Login</button>
            <p><br>Click <a href="home.php">here</a> to go to the home page.</p>
        </form>
        
    </main>
</body>
</html>
