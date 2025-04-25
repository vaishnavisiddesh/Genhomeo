<!DOCTYPE html>
<html>
<head>
    <title>admin</title>
    <style>
        body {
            background: linear-gradient(to left, lightblue, white);
            display: flex; /* Enable flexbox for body */
            flex-direction: column; /* Arrange children vertically */
            align-items: center; /* Center items horizontally */
        }

        .container {
            width: 600px; /* Set a fixed width for the container */
            display: flex; /* Enable flexbox for the container */
            flex-direction: column; /* Arrange links vertically */
            gap: 15px; /* Add some space between the links */
            margin-top: 20px; /* Add some top margin */
        }

        a {
            text-align: center; /* Center the text within the link */
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            display: block; /* Make the anchor element a block to take full width */
            text-decoration: none; /* Remove underline from links */
            color: black; /* Set link text color */
        }

        h1 {
            text-align: center; /* Center the main heading */
        }

        h2 {
            margin: 0; /* Remove default margin for better alignment */
        }
        
    </style>
</head>
<body>
    <h1>HELLO ADMIN</h1><br>
    <div class="container">
        <a href="registeredusers.php">
            <h2>Registered Users: Click here!</h2>
        </a>
        <a href="hav.php">
            <h2>Add or delete health advice videos: Click here!</h2>
        </a>
        <a href="rp.php">
            <h2>Add or delete research papers: Click here!</h2>
        </a>
        <a href="eb.php">
            <h2>Add or delete ebooks: Click here!</h2>
        </a>
        <a href="hm.php">
            <h2>Add or delete homeopathy medicines: Click here!</h2>
        </a>
        <a href="gm.php">
            <h2>Add or delete generic medicines: Click here!</h2>
        </a>
        <a href="fb.php">
            <h2>Know customers feedback: Click here!</h2>
        </a>
    </div>
</body>
</html>