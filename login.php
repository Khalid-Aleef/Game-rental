<?php

require_once 'dbconnect.php';
session_start(); 

if (isset($_POST['Login'])) {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
	

    
    $stmt = $conn->prepare("SELECT user_id, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

   
    $stmt->execute();

    
    $stmt->store_result();
	if ($email === 'admin' && $password === 'admin') {
        
        header("Location: admin.php");
        exit;
	}	


    elseif ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

       
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['user_id'] = $user_id;

            
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

   
    $stmt->close();
    $conn->close();
} else {
    
    header("Location: index.php");
    exit();
}
?>
