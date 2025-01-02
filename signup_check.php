<?php
if (isset($_POST['signup'])) {
    // Database connection
    require_once "dbconnect.php";

    // Sanitize user input
    $user_id = mysqli_real_escape_string($conn, trim($_POST['user_id']));
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $dob = mysqli_real_escape_string($conn, trim($_POST['dob']));
    $password = trim($_POST['password']);
    $re_password = trim($_POST['re_password']);
    $upayment_id = isset($_POST['upayment_id']) ? mysqli_real_escape_string($conn, trim($_POST['upayment_id'])) : NULL;
    $ulibrary_id = isset($_POST['user_id']) ? mysqli_real_escape_string($conn, trim($_POST['user_id'])) : NULL;

    // Validate passwords
    if ($password !== $re_password) {
        echo "<script>
                alert('Passwords do not match! Please try again.');
                window.location.href='signup.php';
              </script>";
        exit();
    }

    // Check if User ID already exists
    $check_query = "SELECT User_id FROM user WHERE User_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>
                alert('User ID already exists! Please choose a different one.');
                window.location.href='signup.php';
              </script>";
        exit();
    }

    $check_stmt->close();

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the `user` table
    $insert_user_query = "
        INSERT INTO user (User_id, Name, email, DoB, `Join Date`, `User Point`, password, Upayment_id, ULibrary_Id) 
        VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP(), 0, ?, ?, ?)
    ";

    $user_stmt = $conn->prepare($insert_user_query);

    if (!$user_stmt) {
        echo "<script>
                alert('Database error. Please try again later.');
                window.location.href='signup.php';
              </script>";
        exit();
    }

    // Bind parameters
    $user_stmt->bind_param(
        "sssssss",
        $user_id,
        $name,
        $email,
        $dob,
        $hashed_password,
        $upayment_id,
        $ulibrary_id
    );

    // Execute the statement
    if ($user_stmt->execute()) {
        // Automatically assign the user to the Regular class
        $regular_class_query = "
            INSERT INTO general (User_id, `General Discount Amount`) 
            VALUES (?, 0)"; // Default discount amount is set to 0
        $class_stmt = $conn->prepare($regular_class_query);

        if ($class_stmt) {
            $class_stmt->bind_param("s", $user_id);
            $class_stmt->execute();
            $class_stmt->close();
        }

        echo "<script>
                alert('User successfully registered. You are now a Regular user!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Registration failed. Please try again.');
                window.location.href='signup.php';
              </script>";
    }

    // Close statement and connection
    $user_stmt->close();
    $conn->close();
} else {
    echo "<script>
            window.location.href='signup.php';
          </script>";
}
?>
