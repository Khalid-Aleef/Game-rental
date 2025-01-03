<?php
// Database connection
include("dbconnect.php");

// Fetch user information and the count of owned games from the database
$sql = "
    SELECT 
        user.User_id, 
        user.Name, 
        user.email, 
        user.DoB, 
        user.`User Point`,
        COUNT(`owned games`.`Game id`) AS owned_games_count
    FROM 
        user
    LEFT JOIN 
        `owned games` 
    ON 
        user.User_id = `owned games`.library_id
    GROUP BY 
        user.User_id
";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Silkscreen', sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: rgb(8, 175, 92);
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: rgb(8, 175, 92);
        }

        tr:hover {
            background-color: rgb(27, 101, 57);
        }

        h1 {
            text-align: center;
            font-family: 'Silkscreen', sans-serif;
        }

        .container {
            margin: 20px;
        }

        .table-wrapper {
            max-height: 400px; /* Adjust the height as needed */
            overflow-y: auto;
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .table-wrapper table {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>

    <div class="container">
       <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>User Points</th>
                        <th>Currently Owned Games</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['User_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['DoB']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['User Point']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['owned_games_count']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center;'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
