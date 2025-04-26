<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Feedback</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin - Submitted Feedback</h1>

    <?php
    // Database credentials (replace with your actual details)
    $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com";
    $username = "admin"; // Default XAMPP username
    $password = "nithya2002";     // Default XAMPP password (usually empty)
    $dbname = "homeopathy";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select all feedback
    $sql = "SELECT id, name, email, rating, comments, submission_date FROM feedback ORDER BY submission_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Rating</th><th>Comments</th><th>Submitted On</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . $row["rating"] . "</td>";
            echo "<td>" . htmlspecialchars($row["comments"]) . "</td>";
            echo "<td>" . $row["submission_date"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No feedback has been submitted yet.</p>";
    }

    $conn->close();
    ?>

</body>
</html>
