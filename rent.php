<?php
include("dbconnect.php");
session_start();

// Get game details based on the passed game ID
$gameId = isset($_GET['game_id']) ? mysqli_real_escape_string($conn, $_GET['game_id']) : null;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id']; // User ID from session
$userQuery = "SELECT `User Point` FROM user WHERE `User_id` = '$userId'";
$userResult = mysqli_query($conn, $userQuery);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
    $userPoints = $userData['User Point'];

    // Determine discount based on user type
    if ($userPoints > 30) {
        $discountQuery = "SELECT `gold discount amount` FROM gold WHERE `User_id` = '$userId'";
        $discountResult = mysqli_query($conn, $discountQuery);
        if (mysqli_num_rows($discountResult) > 0) {
            $discountData = mysqli_fetch_assoc($discountResult);
            $discountAmount = $discountData['gold discount amount'];
        } 
    } elseif ($userPoints > 20) {
        $discountQuery = "SELECT `silver discount amount` FROM silver WHERE `User_id` = '$userId'";
        $discountResult = mysqli_query($conn, $discountQuery);
        if (mysqli_num_rows($discountResult) > 0) {
            $discountData = mysqli_fetch_assoc($discountResult);
            $discountAmount = $discountData['silver discount amount'];
        } 
    } elseif ($userPoints > 10) {  
        $discountQuery = "SELECT `bronze discount amount` FROM bronze WHERE `User_id` = '$userId'";
        $discountResult = mysqli_query($conn, $discountQuery);
        if (mysqli_num_rows($discountResult) > 0) {
            $discountData = mysqli_fetch_assoc($discountResult);
            $discountAmount = $discountData['bronze discount amount'];
        } 
    } else {
        $discountQuery = "SELECT `General Discount Amount` FROM general WHERE `User_id` = '$userId'";
        $discountResult = mysqli_query($conn, $discountQuery);
        if (mysqli_num_rows($discountResult) > 0) {
            $discountData = mysqli_fetch_assoc($discountResult);
            $discountAmount = $discountData['General Discount Amount'];
        } 
    }
    
} 

if ($gameId) {
    $query = "SELECT * FROM game WHERE `Game ID` = '$gameId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $game = mysqli_fetch_assoc($result);
        $_SESSION['Game ID'] = $game['Game ID'];
        $_SESSION['Game Name'] = $game['Name'];
    } else {
        $game = null; 
    }
} else {
    $game = null; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <title>Rent Game</title>
    <style>
        body {
            background-image: url('bg_img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: white;
            font-family: 'Silkscreen', sans-serif;
        }
        h1 {
            margin-top: 50px;
            text-align: center;
            font-size: 30px;
        }
        .game-details {
            background: rgba(0, 0, 0, 0.8);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        h2, h3, label {
            margin-bottom: 10px;
        }
        input[type="date"], input[type="text"], button {
            width: 97%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            background-color: rgb(28, 159, 67);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
        }
        button:hover {
            background-color: rgb(5, 101, 7);
        }
        .total-price {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Rent Game</h1>
    <div class="game-details">
        <?php if ($game): ?>
            <h2><?php echo htmlspecialchars($game['Name']); ?></h2>
            <h3>Genre: <?php echo htmlspecialchars($game['Genre']); ?></h3>
            <h3>Platform: <?php echo htmlspecialchars($game['Platform']); ?></h3>
            <h3>Price/Day: BDT- <?php echo htmlspecialchars($game['Price Per Day']); ?>/-</h3>
            
            
            <form method="POST" action="process_rent.php">
                <input type="hidden" name="game_name" value="<?php echo $game['Name']; ?>">
                <input type="hidden" id="discountAmount" value="<?php echo $discountAmount; ?>">
                <input type="hidden" id="pricePerDay" value="<?php echo $game['Price Per Day']; ?>">
                

                <label for="expireDate">Select Expire Date:</label>
                <input type="date" id="expireDate" name="expire_date" required onchange="calculateDays()">

                <input type="hidden" id="totalDaysInput" name="total_days">

                <label for="paymentId">Enter Payment ID:</label>
                <input type="text" id="paymentId" name="payment_id" required>

                <h3 class="total-price">Total Days: <span id="totalDays">0</span></h3>
                <h3 class="total-price">Regular Price: BDT-<span id="regularPrice">0</span></h3>
                <h3 class="total-price">Discounted Price: BDT-<span id="discountedPrice">0</span></h3>

                <button onclick="confirmRent('<?php echo $game['Game ID']; ?>')">Make Payment</button>
            </form>
        <?php else: ?>
            <p>Game not found. Please check your game ID.</p>
        <?php endif; ?>
    </div>
    <script>

      
    function calculateDays() {
        const expireDateInput = document.getElementById('expireDate').value;
        const pricePerDay = parseFloat(document.getElementById('pricePerDay').value) || 0; // Default to 0 if undefined
        const discountAmount = parseFloat(document.getElementById('discountAmount').value) || 0; // Default to 0 if undefined

        if (expireDateInput) {
            const expireDate = new Date(expireDateInput);
            const currentDate = new Date();

            const timeDifference = expireDate - currentDate;
            const totalDays = Math.ceil(timeDifference / (1000 * 3600 * 24));
            const validDays = totalDays > 0 ? totalDays : 0;

            const regularPrice = validDays * pricePerDay;
            const discountedPrice = Math.max(regularPrice - regularPrice*discountAmount, 0); // Ensure no negative price

            document.getElementById('totalDays').textContent = validDays;
            document.getElementById('regularPrice').textContent = regularPrice.toFixed(2);
            document.getElementById('discountedPrice').textContent = discountedPrice.toFixed(2);
        }
    }
    function confirmRent(gameId) {
        if (confirm("Are you sure you want to rent this game?")) {
            
            window.location.href = `process_rent.php?game_id=${gameId}`;
        }
    } 
</script>
</body>
</html>
