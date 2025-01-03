<?php
include("dbconnect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $game_id = $_SESSION['Game ID']; // Matches `Game id` in  table
    $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']); // Matches `Time Limit` in table
    $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']); 
    $user_id = $_SESSION['user_id'];

    // Validate session data
    if (!$game_id || !$user_id) {
        echo "<p>Game ID or User ID is missing from the session. Please try again.</p>";
        exit();
    }

    //Checking if the user has a library
    $library_query = "SELECT ULibrary_Id FROM user WHERE user_id = '$user_id'";
    $library_result = mysqli_query($conn, $library_query);


    if ($library_result && $library_row = mysqli_fetch_assoc($library_result)) {
        $library_id = $library_row['ULibrary_Id'];

        // Check if the game already exists
        $check_query = "SELECT * FROM `owned games` WHERE library_id = '$library_id' AND `Game id` = '$game_id'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // if already exists
            echo "<script>
                    alert('This game already exists in your library.');
                    window.location.href = 'home.php';
                </script>";
        } else {
            //Inserting the game 
            $insert_query = "INSERT INTO `owned games` (library_id, `Game name`, `Game id`, `Time Limit`)
                             VALUES (
                                 '$library_id', 
                                 (SELECT Name FROM game WHERE `Game ID` = '$game_id'), 
                                 '$game_id', 
                                 '$expire_date'
                             )";
            if (mysqli_query($conn, $insert_query)) {
                // Increment user points 
                $update_points_query = "UPDATE user SET `User Point` = `User Point` + 1 WHERE user_id = '$user_id'";
                mysqli_query($conn, $update_points_query);

                // update their table accordingly to user points
                $points_query = "SELECT `User Point` FROM user WHERE user_id = '$user_id'";
                $points_result = mysqli_query($conn, $points_query);

                if ($points_result && $points_row = mysqli_fetch_assoc($points_result)) {
                    $user_points = $points_row['User Point'];

                    // Remove the user from current class
                    mysqli_query($conn, "DELETE FROM general WHERE User_Id = '$user_id'");
                    mysqli_query($conn, "DELETE FROM bronze WHERE User_id = '$user_id'");
                    mysqli_query($conn, "DELETE FROM silver WHERE User_id = '$user_id'");
                    mysqli_query($conn, "DELETE FROM gold WHERE User_id = '$user_id'");

                    // Inserting the user into class table according to user point 
                    if ($user_points > 30) {
                        // Gold class
                        mysqli_query($conn, "INSERT INTO gold (User_id, `gold discount amount`) VALUES ('$user_id', 0.15)");
                    } elseif ($user_points > 20) {
                        // Silver class
                        mysqli_query($conn, "INSERT INTO silver (User_id, `silver discount amount`) VALUES ('$user_id', 0.10)");
                    } elseif ($user_points > 10) {
                        // Bronze class
                        mysqli_query($conn, "INSERT INTO bronze (User_id, `bronze discount amount`) VALUES ('$user_id', 0.05)");
                    } else {
                        // General class
                        mysqli_query($conn, "INSERT INTO general (User_Id, `General Discount Amount`) VALUES ('$user_id', 0)");
                    }
                }

               
                
                echo "<script>
                        alert('Game successfully added to your library! Your points and status have been updated.');
                        window.location.href = 'userlibrary.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Error adding game to your library. Please try again.');
                        window.location.href = 'home.php';
                    </script>";
            }
        }
    } else {
        echo "<p>User library not found.</p>";
    }
} else {
    echo "<p>Invalid request. Please submit the form properly.</p>";
}
?>
