<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        label, textarea, input, select {
            display: block;
            margin-bottom: 10px;
            width: 100%;
        }
        textarea {
            height: 150px;
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .info{
            background-color: bisque;
            padding: 40px;
            border-radius: 20px;
            border: dashed solid black;
        }
        .info h1{
            background-color: rgb(223, 240, 155);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin-left:270px;
            margin-right:270px;
            border: dashed solid black;
        }
        input,textarea{
            padding:10px;
            font-size: 30px;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <div class="info">
        <h1>Feedback Form</h1>
    </div>

    <?php
    // Database credentials (replace with your actual details)
    $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com";
    $username = "admin"; // Default XAMPP username
    $password = "nithya2002";     // Default XAMPP password (usually empty)
    $dbname = "homeopathy"; // Assuming you want to use the same database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $rating = $_POST['rating'];
        $comments = $_POST['comments'];

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments, submission_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssis", $name, $email, $rating, $comments);

        if ($stmt->execute()) {
            echo "<p style='color: green; text-align: center; font-size: 1.2em; margin-top: 20px;'>Thank you for your feedback!</p>";
        } else {
            echo "<p style='color: red; text-align: center; font-size: 1.2em; margin-top: 20px;'>Error submitting feedback: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="rating">Rating (1-5, 5 being best):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" required></textarea>

        <input type="submit" value="Submit Feedback">
    </form>
</body>
</html>
