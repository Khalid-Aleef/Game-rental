<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>GameNest Login</title>
    
</head>
<body>
    <h1>GameNest</h1>
    <form action="login.php" method="post">
        <label>Email:</label>
        <input type="text" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="Login" value="Log in">LOG IN</button>

        <div class="signup-container">
            <p>Don't have an account?</p>
            <a href="signup.php" class="signup-button">Sign Up</a>
        </div>
    </form>
</body>
</html>
