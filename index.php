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
    <h1>Drukkerij Teeuwen Inventory Manager</h1>
    <div class="container">
        <div class="login">
            <h2>Login</h2>
            <form action="src/authenticate.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" required>
                <input class="submit" type="submit" value="Login">
            </form>
            <a href="mailto:email@example.com">Forgot Password?</a>
        </div>
    </div>
</body>

</html>
