<?php
include("dbconnect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_name'])) {
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
    $user_id = $_SESSION['user_id'];

    $update_query = "UPDATE user SET Name = '$new_name' WHERE User_id = '$user_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                alert('Name updated successfully!');
                window.location.href = 'account.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to update name. Please try again.');
                window.location.href = 'account.php';
              </script>";
    }
}
?>
