<!DOCTYPE <html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/CSS/login.css" type="text/css">
    <title>Inventory Manager | Login Page</title>
    <meta name="description" content="">
</head>

<body>
    <div class="container">
        <div class="login">
            <h1>Inventory Manager</h1>
            <h2>Sign in</h2>
            <form action="src/authenticate.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input class="submit" type="submit" value="Login">
            </form>
            <a href="public/register.php">Sign up</a>
            <a href="mailto:email@example.com">Forgot Password?</a>
        </div>
    </div>
</body>

</html>
