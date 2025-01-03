<?php
// login_check.php
require_once 'dbconnect.php';
session_start(); // Always start the session at the top of the file

if (isset($_POST['Login'])) {
    // Get user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
	

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $stmt->store_result();
	if ($email === 'admin' && $password === 'admin') {
        // Redirect to admin.php
        header("Location: admin.php");
        exit;
	}	


    elseif ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, store user_id in the session
            $_SESSION['user_id'] = $user_id;

            // Redirect to the home page
            header("Location: home.php");
            exit();

        } else {
            echo "<script>
				alert('Invalid Password. Please try again.');
				window.location.href = 'index.php';
			  </script>";
            exit();
        }

		
    } else {
		
		echo "<script>
				alert('Invalid login credentials. Please try again.');
				window.location.href = 'index.php';
			  </script>";
		exit();
	}

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If accessed without form submission, redirect to the login page
    header("Location: index.php");
    exit();
}
?>
