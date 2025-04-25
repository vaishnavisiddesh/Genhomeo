<?php
include 'navbar.html'; 
require 'config.php';
if(empty($_SESSION["id"])){
    echo
      "<script> alert('Please login or register to access this!'); document.location.href = 'login.php';</script>";
    
}



$userId = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$userId'");
$row = mysqli_fetch_assoc($result);
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>My Account</title>
    <style>
      body {
            font-family: sans-serif;
            background:linear-gradient(to right,lightgreen,white);
            margin: 0;
            padding: 20px; /* Added padding for better spacing */
           
            justify-content: center;
            align-items: flex-start; /* Align items to the top to prevent content from being pushed down by a tall navbar */
            min-height: 100vh;
        }

        .container {
            margin-left:500px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* Make container responsive */
            max-width: 400px; /* Set a maximum width */
        }

        h2 {
            text-align: center;
            margin-bottom: 25px; /* Increased margin for better spacing */
            color: #333;
        }

        .info-item {
            margin-bottom: 18px; /* Increased margin for better spacing */
            padding: 12px; /* Slightly increased padding */
            border: 1px solid #ddd;
            border-radius: 6px; /* Slightly more rounded corners */
            background-color: #f9f9f9;
        }

        .info-item strong {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 8px; /* Increased margin below the label */
        }

        .logout-link {
            background: #2691d9;
            margin-left:100px;
            margin-right:100px;
            border-radius:10px;
            display: block;
            margin-top: 25px; /* Increased margin for better separation */
            text-align: center;
            color: white;
            text-decoration: none;
            padding: 10px 0; /* Add some padding to the link */
            border-top: 1px solid #eee; /* Add a subtle top border */
        }

        .logout-link:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container"><br><br>
        <h2>My Account</h2>
        <?php if ($row): ?>
            <div class="info-item">
                <strong>Name:</strong>
                <?php echo $row["name"]; ?>
            </div>
            <div class="info-item">
                <strong>Username:</strong>
                <?php echo $row["username"]; ?>
            </div>
                    <div class="info-item">
                <strong>Password:</strong>
                <?php echo $row["password"]; ?>
            </div>
            <div class="info-item">
                <strong>Email:</strong>
                <?php echo $row["email"]; ?>
            </div>
        <a href="gridpage.html" class="logout-link">Back</a>
        <?php else: ?>
            <p>Error fetching user data.</p>
            <a href="home.html">Go to Home</a>
        <?php endif; ?>
    </div>
</body>
</html>