<?php
include("dbconnect.php"); // Include database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$user_query = "SELECT Name, User_id, `User Point`,
                      (SELECT COUNT(*) FROM `owned games` WHERE library_id = (SELECT ULibrary_Id FROM user WHERE User_id = '$user_id')) AS total_owned_games 
               FROM user WHERE User_id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);

// Check if user exists
if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user_data = mysqli_fetch_assoc($user_result);

    // Determine user type based on points
    $user_type = "Regular";
    $discount_message = "No discount currently available. Keep earning points! Reach 10 points to unlock Bronze status and enjoy a 5% discount on your next purchases!";

    if ($user_data['User Point'] > 30) {
        $user_type = "Gold";
        $discount_message = "You will get a 15% discount on each game.";
    } elseif ($user_data['User Point'] > 20) {
        $user_type = "Silver";
        $discount_message = "You will get a 10% discount on each game.";
    } elseif ($user_data['User Point'] > 10) {
        $user_type = "Bronze";
        $discount_message = "You will get a 5% discount on each game.";
    }
} else {
    echo "<script>
            alert('User not found!');
            window.location.href = 'home.php';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>Account - GameNest</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('bg_img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
            padding-top: 100px;
        }
        h1 {
            font-family: 'Silkscreen', sans-serif;
            color: white;
            font-size: 70px;
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 30px;
            left: 20px;
        }
        h2 {
            font-family: 'Silkscreen', sans-serif;
            color: white;
            font-size: 20px;
            margin: 0;
            
            position: absolute;
            
            
            align-items: center;
        }
        nav {
            position: absolute;
            top: 120px;
            left: 20px;
        }
        nav button {
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
            margin: 0 5px;
        }
        nav button:hover {
            background-color: rgb(5, 101, 7);
        }
        .account-container {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 15px; /* Reduced padding */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%; /* Reduced width */
            max-width: 400px; /* Reduced maximum width */
            text-align: center;
        }
        .account-details {
            font-family: 'Silkscreen', sans-serif;
            font-size: 18px;
            margin: 20px 0;
            line-height: 1.8;
        }
        .logout-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
            margin-top: 20px;
        }
        .logout-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h1>Account</h1>
    <nav>
        <button onclick="navigateTo('games')">Store</button>
        <button onclick="navigateTo('account')">Account</button>
        <button onclick="navigateTo('library')">Library</button>
    </nav>
    <div class="account-container">
        
        <div class="account-details">
            <p><strong>Welcome, <?php echo strtoupper($user_data['Name']); ?></strong></p>
            <p><strong>User ID:</strong> <?php echo $user_data['User_id']; ?></p>
            <p><strong>Total Owned Games:</strong> <?php echo $user_data['total_owned_games']; ?></p>
            <p><strong>User Points:</strong> <?php echo $user_data['User Point']; ?></p>
            <p><strong>User Type:</strong> <?php echo $user_type; ?></p>
            <p style="color: yellow;; font-size: 14px;"><strong>Discount Information:</strong> <?php echo $discount_message; ?></p>
        </div>
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>
    <script>
        function navigateTo(page) {
        if (page === 'games') {
            window.location.href = "home.php";
        } else if (page === 'library') {
            window.location.href = "userlibrary.php";
        } else if (page === 'account') {
            window.location.href = "account.php";
        }
        }

        function logout() {
        // Clear session and redirect to index.php
        fetch('logout.php')
            .then(() => window.location.href = 'index.php');
        }
    </script>
</body>
</html>
