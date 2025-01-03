<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>GameNest Login</title>
    <style>
        
        body {
            background-image: url('bg_img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Silkscreen', sans-serif;
            color: white;
        }
        h1 {
            font-size: 50px;
            margin-bottom: 30px;
        }
        form {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        label {
            display: block;
            font-size: 18px;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif; /* Ensures the input text uses the 'Silkscreen' font */
        }
        button {
            background-color: rgb(28, 159, 67);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif; /* Ensures the button uses the 'Silkscreen' font */
        }
        button:hover {
            background-color: rgb(5, 101, 7);
        }
        .signup-container {
            margin-top: 20px;
            font-size: 16px;
        }

        .signup-button {
            display: inline-block;
            font-family: 'Silkscreen', sans-serif;
            background-color: rgb(28, 159, 67);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }
        .signup-button:hover {
            background-color: rgb(5, 101, 7);
        }
    </style>
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
