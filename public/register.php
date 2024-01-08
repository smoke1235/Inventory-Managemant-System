<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Register</title>
    <link rel="stylesheet" href="../assets/CSS/register.css">
    <meta name="description" name="">
</head>

<body>
    <div class="container">
        <div class="register-container">
            <h1>Inventory Manager</h1>
            <h2>Sign up</h2>
            <form action="../src/insertUser.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="email">Email:</label>
                <input type="text" name="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input type="submit" name="submit" value="Sign up">
            </form>
            <a href="../index.php">Already have an account?</a>
        </div>
    </div>
</body>

</html>
