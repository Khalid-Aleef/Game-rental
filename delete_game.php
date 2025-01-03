<?php
include("dbconnect.php");
session_start();

if (isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];
    $user_id = $_SESSION['user_id'];

    
    $library_query = "SELECT ULibrary_Id FROM user WHERE User_id = '$user_id'";
    $library_result = mysqli_query($conn, $library_query);

    if ($library_row = mysqli_fetch_assoc($library_result)) {
        $library_id = $library_row['ULibrary_Id'];

        // Delete the game
        $delete_query = "DELETE FROM `owned games` WHERE `Game id` = '$game_id' AND `library_id` = '$library_id'";
        if (mysqli_query($conn, $delete_query)) {
            header("Location: userlibrary.php?message=Game+deleted");
        } else {
            echo "Error deleting game: " . mysqli_error($conn);
        }
    }
}
?>
