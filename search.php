<?php
include("dbconnect.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>GameNest Search</title>
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
            top: 30px;
            left: 20px;
        }
        .search-form {
            margin-top: 50px;
        }
        .search-form input {
            padding: 10px;
            width: 280px;
            border: 1px solid #ccc; 
            border-radius: 4px;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
        }
        .search-form button {
            background-color: rgb(28, 159, 67, 0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Silkscreen', sans-serif;
            margin-left: 10px;
        }
        .search-form button:hover {
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
            margin-top: 20px;
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
        h4 {
            font-family: 'Silkscreen', sans-serif;
            font-size: small;
        }
        .highlight {
            background-color: yellow;
            color: black;
            font-weight: bold;
        }
        .game h3 {
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
    <h1>GameNest Search</h1>
    <form class="search-form" method="GET" action="search.php">
        <input type="text" name="search" placeholder="Search for a game by name...">
        <button type="submit">Search</button>
    </form>

    <div id="searchResults" class="games-container">
        <div class="game-list">
            <?php
            $query = "SELECT * FROM game"; 

            if (isset($_GET['search'])){
                $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
                $query = "SELECT * FROM game WHERE Name LIKE '%$searchQuery%'";
            }

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $gameName = $row['Name'];

                    // Highlight the search term in the game name
                    if (isset($searchQuery) && !empty($searchQuery)) {
                        $highlightedName = preg_replace(
                            "/(" . preg_quote($searchQuery, '/') . ")/i",
                            "<span class='highlight'>$1</span>",
                            $gameName
                        );
                    } else {
                        $highlightedName = $gameName;
                    }

                    echo "<div class='game'>";
                    echo "<h3>" . $highlightedName . "</h3>";
                    echo "<h4>Genre: " . htmlspecialchars($row['Genre']) . "</h4>";
                    echo "<h4>Platform: " . htmlspecialchars($row['Platform']) . "</h4>";
                    echo "<h4>Price/Day:<br>BDT- " . htmlspecialchars($row['Price Per Day']) . "/- " ."</h4>";
                    echo "<button onclick='rentGame(\"" . htmlspecialchars($row['Game ID'], ENT_QUOTES) . "\")'>Rent Now</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No games found.</p>";
            }
            ?>
        </div>
    </div>

    <script>
       function rentGame(gameId) {
            window.location.href = `rent.php?game_id=${gameId}`;
       }
    </script>
</body>
</html>
