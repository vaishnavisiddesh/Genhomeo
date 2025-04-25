<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBook</title>
    <style>
        .d{
            margin-bottom:50px;
            display: flex;
            gap:25px;
            background-color: black;
            padding: 10px;
            border-radius: 10px;
            justify-content: flex-end;
        }
        .a{
            text-decoration: none;
            color:white;
            font-size: 25px;

        }
        .left-text {
            color: white;
            font-size: 30px;
            margin-right: auto; /* Pushes everything else to the right */
        }
        body{
            background: linear-gradient(to left,lightgreen,white);

        }
        .info {
            text-align: center;
            background-color: rgba(240, 226, 122, 0.699);
            border-radius: 20px;
            padding: 50px;
            margin: 20px;
        }
        .g {
            margin: 20px auto;
            width: 80%;
            text-align: center; /* Center the link */
        }
        .ebook-link {
            display: inline-block; /* Make the link behave like a block for width/padding */
            padding: 15px 30px;
            background-color: #4CAF50; /* Green button */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .ebook-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="d">
        <div class="left-text">HOMEO-GEN</div>

        <div>
            <a class="a" href="home.php">Home</a>
        </div>
        <div>
            <a class="a" href="gridpage.html">Contents</a>
        </div>
        <div>
            <a class="a" href="aboutus.pdf">About Us</a>
        </div>
        <div>
            <a class="a" href="account.php">Profile</a>
        </div>
    </div>
    <div class="info">
        <h1>Explore our Collection of 3D E-BOOKS!</h1>
        <p>Instead of carrying multiple bulky books, one eBook reader can hold thousands of eBooks. It saves a lot of space—in your home and in your bag. One doesn't have to worry about the storage limit. A single device is enough to read any number of books you want. Due to embedding restrictions on some platforms, please click the links below to view the eBooks in a new tab.</p>
    </div>
    <?php
    $servername = "localhost"; // Replace with your database server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "homeopathy"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch ebook URLs from the database
    $sql = "SELECT ebook_url, ebook_title FROM ebooks"; // Fetch title as well
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // Loop through each ebook URL and display it as a link
        while($row = $result->fetch_assoc()) {
            $ebookUrl = $row["ebook_url"];
            $ebookTitle = $row["ebook_title"]; // Assuming you have a title column
            echo '<div class="g">
                <a href="' . $ebookUrl . '" class="ebook-link" target="_blank">Read ' . htmlspecialchars($ebookTitle) . '</a>
            </div>';
        }
    } else {
        echo "<p>No ebooks found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>