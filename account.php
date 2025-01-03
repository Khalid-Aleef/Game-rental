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
    $user_type = "General";
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
            font-size: 50px; 
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 20px; 
            left: 20px;
        }
        nav {
            position: absolute;
            top: 100px;
            left: 20px;
        }
        nav button {
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 8px 12px; 
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; 
            font-family: 'Silkscreen', sans-serif;
            margin: 0 5px;
        }
        nav button:hover {
            background-color: rgb(5, 101, 7);
        }
        .account-container {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 10px;
            border-radius: 6px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 70%; 
            max-width: 300px; 
            text-align: center;
        }
        .account-details {
            font-family: 'Silkscreen', sans-serif;
            font-size: 16px; 
            margin: 10px 0; 
            line-height: 1.5;
        }
        .logout-button {
            background-color: rgb(255, 69, 58);
            color: white;
            border: none;
            padding: 8px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-family: 'Silkscreen', sans-serif;
            margin-top: 8px;

        }
        .edit-button, .save-button, .cancel-button {
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 8px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; 
            font-family: 'Silkscreen', sans-serif;
            margin-top: 8px;
        }
        .logout-button:hover{
            background-color: rgb(159, 17, 26);

        }
        .edit-button:hover, .save-button:hover, .cancel-button:hover {
            background-color: rgb(5, 101, 7);
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
            <p><strong>Welcome, <span id="userName"><?php echo strtoupper($user_data['Name']); ?></span></strong></p>
            <p><strong>User ID:</strong> <?php echo $user_data['User_id']; ?></p>
            <p><strong>Total Owned Games:</strong> <?php echo $user_data['total_owned_games']; ?></p>
            <p><strong>User Points:</strong> <?php echo $user_data['User Point']; ?></p>
            <p><strong>User Type:</strong> <?php echo $user_type; ?></p>
            <p style="color: yellow; font-size: 14px;"><strong>Discount Information:</strong> <?php echo $discount_message; ?></p>
        </div>
        
        <form id="editNameForm" method="POST" action="update_name.php" style="display: none; max-width: 250px; margin: 10px auto;">
            <input type="text" name="new_name" placeholder="Enter new name" required style="width: 90%; padding: 6px; font-size: 14px; border-radius: 4px; border: 1px solid #ccc;">
            <button type="submit" class="save-button" style="padding: 6px 12px; font-size: 14px;">Save</button>
            <button type="button" class="cancel-button" style="padding: 6px 12px; font-size: 14px;" onclick="cancelEdit()">Cancel</button>
        </form>
        
        <button class="edit-button" onclick="editName()">Edit Name</button>
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
        
        function editName() {
        document.getElementById('editNameForm').style.display = 'block';
        }

        function cancelEdit() {
            document.getElementById('editNameForm').style.display = 'none';
        }

    </script>
</body>
</html>
