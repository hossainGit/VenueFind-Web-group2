<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/customer_reg.css">
    <title>Initialize Admin Account</title>
</head>
<body>
    <header>
        <h1>Initialize Admin Account</h1>
        <p>Use this page to set up the initial admin accounts. Ensure it is removed or secured after setup.</p>
    </header>
    <main>
        <form action="../control/AdminController.php" method="POST" class="form-container">
            <input type="hidden" name="action" value="initialize_admin">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter admin name">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter admin email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Create a password">

            <button type="submit">Initialize Admin</button>
        </form>
    </main>
</body>
</html>
