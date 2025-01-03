<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>GameNest Sign Up</title>
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
            padding: 10px;
            height: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
            width: 90%;
            max-width: 250px;
            text-align: center;
        }
        label {
            display: block;
            font-size: 16px; 
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 8px;
            margin-bottom: 15px; 
            border-radius: 5px;
            border: none;
            font-size: 14px; 
            font-family: 'Silkscreen', sans-serif;
        }
        button {
            background-color: rgb(28, 159, 67);
            color: white;
            border: none;
            padding: 8px 15px; 
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; 
            font-family: 'Silkscreen', sans-serif;
        }
        button:hover {
            background-color: rgb(5, 101, 7);
        }
        .signup-container {
            margin-top: 15px; 
            font-size: 14px; 
        }
        .signup-button {
            display: inline-block;
            background-color: rgb(28, 159, 67);
            color: white;
            padding: 6px 12px; 
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px; 
            margin-top: 10px;
        }
        .signup-button:hover {
            background-color: rgb(5, 101, 7);
        }
    </style>

</head>
<body>
    <h1>Sign Up</h1>
    <form action="signup_check.php" method="post">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="password">Re-enter Password:</label>
        <input type="password" id="password" name="re_password" required>
        
        
        <button type="submit" name="signup" >Sign UP</button>

    </form>
</body>
</html>