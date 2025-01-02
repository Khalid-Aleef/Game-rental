<?php
include("dbconnect.php"); // Include database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>GameNest Home</title>
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
        .search-button {
            position: absolute;
            top: 20px;
            right: 20px; /* Positioned at the top-right corner */
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
            z-index: 1000; /* Ensure the button stays on top */
        }
        .search-button:hover {
            background-color: rgb(5, 101, 7);
        }
        .games-container {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            height: 60%;
            overflow-y: auto;
            margin-top: 50px;
        }
        .game-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .game {
            background: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .game h3, .game h4 {
            font-family: 'Silkscreen', sans-serif;
            margin: 10px 0;
        }
        .game button {
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
        }
        .game button:hover {
            background-color: rgb(5, 101, 7);
        }
    </style>
</head>
<body>
    <button class="search-button" onclick="navigateToSearch()">Search</button>
    <h1>GameNest</h1>
    <nav>
        <button id="gamesButton" class="active" onclick="navigateTo('games')">Store</button>
        <button onclick="navigateTo('account')">Account</button>
        <button onclick="navigateTo('library')">Library</button>
        
        
    </nav>
    <div id="availableGames" class="games-container">
        <div class="game-list">
            <?php
            // Fetch games from the database
            $query = "SELECT * FROM game WHERE Availability = 1"; // Fetch only available games
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='game'>";
                    echo "<h3>" . $row['Name'] . "</h3>";
                    echo "<h4>Genre: " . $row['Genre'] . "</h4>";
                    echo "<h4>Platform: " . $row['Platform'] . "</h4>";
                    echo "<h4>Price/Day: BDT- " . $row['Price Per Day'] ."/- " ."</h4>";
                    echo "<button onclick='rentGame(\"" . $row['Game ID'] . "\")'>Rent Now</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No games available right now.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function navigateTo(page) {
            if (page === 'games') {
                window.location.href = "home.php";
            } else if (page === 'library') {
                window.location.href = "userlibrary.php";
            } else if (page === 'account') {
                window.location.href = "account.php"; // Replace with the correct page
            }  
        }

        function rentGame(gameId) {
            window.location.href = `rent.php?game_id=${gameId}`;
        }

        function navigateToSearch() {
            window.location.href = "search.php"; // Replace with the actual search page
        }
    </script>
</body>
</html>
