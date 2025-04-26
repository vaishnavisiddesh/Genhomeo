<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Videos</title>
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
        .flex{
            display:grid;
            grid-template-columns: repeat(2,1fr);
            gap:35px;
            margin-top: 50px;
            text-align: center;
        }
        .f{
            border:black solid 3px;
            width:650px;
            height:450px;
            text-align:center;
            background-color: white;
            border-radius: 20px;
            color:rgb(85, 226, 8);
            justify-content: center;
            margin-left: 30px;
        }
        .info{
            text-align: center;
        }
        iframe{
            padding-top:70px;
        }
        h1{
            background-color: white;
            color:black;
            border-radius: 10px;
            margin-left:100px;
            margin-right: 100px;
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
        <h1>Here are our handpicked health related videos for better health practices</h1>
    </div>

    <div class="flex">
        <?php
        $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com"; // Replace with your database server name
        $username = "admin"; // Replace with your database username
        $password = "nithya2002"; // Replace with your database password
        $dbname = "homeopathy"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch video URLs from the database
        $sql = "SELECT video_url FROM health_videos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop through each video URL and display it in an iframe
            while($row = $result->fetch_assoc()) {
                $videoUrl = $row["video_url"];
                echo '<div class="f">';
                echo '<iframe width="560" height="315" src="' . $videoUrl . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                echo '</div>';
            }
        } else {
            echo "<p>No health videos found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
