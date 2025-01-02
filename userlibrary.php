<?php
include("dbconnect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>User Library - GameNest</title>
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
            font-size: 50px;
            margin-bottom: 20px;
        }
        nav {
            position: absolute;
            top: 30px;
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
        .library-container {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-family: 'Silkscreen', sans-serif;
            margin-bottom: 10px;
        }
        .game-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .game-info {
            max-width: 80%;
        }
        .delete-btn {
            background-color: rgb(255, 69, 58);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Silkscreen', sans-serif;
        }
        .delete-btn:hover {
            background-color: rgb(200, 40, 40);
        }
    </style>
</head>
<body>
    <h1>User Library</h1>
    <nav>
        <button onclick="navigateTo('games')">Store</button>
        <button onclick="navigateTo('account')">Account</button>
        <button onclick="navigateTo('library')" class="active">Library</button>
    </nav>
    <div class="library-container">
        <?php
        // Get user ID from session
        $user_id = $_SESSION['user_id'];

        // Fetch library ID
        $library_query = "SELECT ULibrary_Id FROM user WHERE User_id = '$user_id'";
        $library_result = mysqli_query($conn, $library_query);

        if ($library_row = mysqli_fetch_assoc($library_result)) {
            $library_id = $library_row['ULibrary_Id'];
            echo "<div class='section'><h2>Library ID: $library_id</h2></div>";

            // Delete expired games
            $delete_query = "DELETE FROM `owned games` WHERE `library_id` = '$library_id' AND `Time Limit` < NOW()";
            mysqli_query($conn, $delete_query);

            // Owned Games
            echo "<div class='section'><h2>Owned Games</h2>";
            $owned_query = "SELECT `Game name`, `Game id`, `Time Limit` 
                            FROM `owned games`
                            WHERE library_id = '$library_id'";
            $owned_result = mysqli_query($conn, $owned_query);

            if (mysqli_num_rows($owned_result) > 0) {
                while ($owned_row = mysqli_fetch_assoc($owned_result)) {
                    $game_name = $owned_row['Game name'];
                    $game_id = $owned_row['Game id'];
                    $time_limit = $owned_row['Time Limit'];

                    echo "<div class='game-item'>
                            <div class='game-info'>
                                <strong>Game Name:</strong> $game_name<br>
                                <strong>Game ID:</strong> $game_id<br>
                                <strong>Expires On:</strong> $time_limit
                            </div>
                            <button class='delete-btn' onclick=\"confirmDelete('$game_id')\">Delete</button>
                          </div>";
                }
            } else {
                echo "<p>No games owned.</p>";
            }
            echo "</div>";
        } else {
            echo "<p>User library not found.</p>";
        }
        ?>
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

        function confirmDelete(gameId) {
            if (confirm("Are you sure you want to delete this game?")) {
                window.location.href = `delete_game.php?game_id=${gameId}`;
            }
        }
    </script>
</body>
</html>
