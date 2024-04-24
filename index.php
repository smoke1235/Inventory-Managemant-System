<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: ./public/dashboard.php');
}

?>

<!DOCTYPE <html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/CSS/login2.css" type="text/css">
    <title>Inventory Manager | Login Page</title>
    <meta name="description" content="">
</head>

<body>
    <div class="form-structor">
        <form action="src/authenticate.php" method="post">
            <div class="login">
		        <h2 class="form-title" id="login"><span>or</span>Log in</h2>
                <div class="form-holder">
				    <input type="text" name="username" class="input" placeholder="Username" />
				    <input type="password" name="password" class="input" placeholder="Password" />
			    </div>
                <button class="login-btn">Log in</button>
                <a id="forgotPassword" href="public/forgot-password.php">Forgot password?</a>
            </div>
        </form>
	    
        <form action="src/register.php" method="post">
            <div class="submit slide-up">
	    	    <div class="center">
		    	    <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
    			    <div class="form-holder">
                        <input type="text" name="username" class="input" maxlength="50" required placeholder="Username">
                        <input type="text" name="email" class="input" maxlength="80" required placeholder="email">
                        <input type="password" name="password" class="input" maxlength="90" required placeholder="Password">
                    </div>
		            <button class="submit-btn">Sign up</button>
		        </div>
	        </div>
        </form>
    </div>

    <script src="assets/js/login.js"></script>

</body>

</html>
