<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
        }
        body{
            font-family: 'Open Sans',sans-serif;
        }
        a{
            text-decoration: none;
            color: inherit;
        }
        .navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            padding-bottom: 15px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: black;
            color:white;
            margin-bottom: 10px;
        }
        .navbar-links{
            list-style: none;
            display: flex;
            gap:20px;
            font-size: 20px;
        }
        .hero{
            height: 450px ;
            background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('B.PNG');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            color:white;
            text-align:center;
            padding-top:100px;
            border-radius: 20px;
        }
        .hero-title{
            font-size: 50px;
        }
        .hero-lead{
            font-size: 25px;
        }
        .hero-btn{
            background: white;
            color:black;
            padding: 10px;
            display: inline-block;
            margin-top:10px;
            border-radius:10px;
            font-weight: bold;
        }
        .about{
            padding:20px 20px 20px 20px;
        }
        .section-title{
            font-size:35px;
            text-align:center;
            margin-bottom: 10px;
        }
        .about-layout{
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap:20px;
            align-items: center;
            padding:40px 40px 40px 40px;
        }
        .about-layout img{
            margin-left: 130px;
        }
        .about-text{
            line-height: 1.8;
        }
        .contact{
            background: lightgreen;
            padding: 35px;
        }
        .contact-card{
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            width: 650px;
            margin: auto;
        }
        label{
            display: block;
        }
        input,textarea{
            width: 480px;
            font-size: 15px;
            padding: 5px;
            margin-bottom: 10px;
            border-radius:10px;
            margin-left:60px;
        }
        .text-center{
            text-align: center;
        }
        .btn-pri{
            background: blue;
            border: none;
            color: white;
            padding: 10px;
            font-weight: bold;
            border-radius: 10px;
            text-align:center;
            margin-left:270px;
        }
        footer{
            background:black;
            padding: 30px;
            color:white;
            text-align:center;
        }
        a{
            margin-bottom:10px;
            padding-top:10px;
        }
        .form-item{
            margin-bottom: 15px;
        }
    </style>
    <script>
        function checkLogin() {
            const isLoggedIn = false;

            if (!isLoggedIn) {
                alert("Please register or login to access your account.");
                return false;
            }
            return true;
        }
    </script>
    
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-links">
            <li><a href="account" onclick="return checkLogin();">My Account</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="bro.png">About us</a></li>
            <li><a href="feedback.html">Feedback</a></li>
        </ul>
    </nav>
    <section class="hero">
        <h1 class="hero-title">HOMEO-GEN</h1>
        <h1 class="hero-title">HEALTH IS WEALTH MAKE IT HEALTHY!</h1><br>
        <h3 class="hero-lead">What it really do?</h3>
        <p>One stop for complete HOMEO health</p><br>
        <a href="registration.php"><button class="hero-btn" >
                REGISTER HERE
            </button></a>
        <a href="login.php"><button class="hero-btn" >
                ALREADY HAVE AN ACCOUNT, LOGIN HERE
               </button></a>
        </h3>
    </section>

    <section class="aboutus">
       <h2 class="section-title">
            About us
       </h2>
       <div class="about-layout">
            <div class="about-text">
                <p><strong>Homeopathy </strong> is a system of alternative medicine that originated in the late 18th century. It was developed by Samuel Hahnemann, a German physician. The fundamental principle of homeopathy is "like cures like," which suggests that a substance that causes symptoms in a healthy person can be used to treat similar symptoms in a sick person.</p><br>
                <p><strong>Generic medicines </strong>are bioequivalent to brand-name drugs, containing the same active ingredients but often at a lower cost. They undergo rigorous testing to ensure safety and quality. Generic medicines provide a cost-effective alternative to branded medications, making essential treatments more accessible to a broader population.
                </p>
            </div>
            <div class="about-img">
                <img src="bg3.jpeg" width="320px">
            </div>
       </div>
    </section>
    <section class="contact">
        <h2 class="section-title">Contact us</h2>
        <div class="contact-card">
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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get form data
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $age = $_POST['age'];
                $diseases = $_POST['diseases'];

                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone_number, age, diseases) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $name, $email, $phone, $age, $diseases);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<p style='text-align:center; color: green;'>Thank you for contacting us! We will get back to you soon.</p>";
                } else {
                    echo "<p style='text-align:center; color: red;'>Error: " . $stmt->error . "</p>";
                }

                // Close the statement
                $stmt->close();
            }

            // Close the connection
            $conn->close();
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-item">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your name"/>
                </div>
                <div class="form-item">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email"/>
                </div>
                <div class="form-item">
                    <label>Phone number</label>
                    <input type="number" name="phone" placeholder="Enter your phone number"/>
                </div>
                <div class="form-item">
                    <label>Age</label>
                    <input type="number" name="age" placeholder="Enter your age"/>
                </div>
                <div class="form-item">
                    <label>Diseases</label>
                    <textarea name="diseases" placeholder="Describe about your diseases"></textarea>
                </div>
                <div>
                   <button type="submit" class="btn-pri" >
                        Call us!
                    </button>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <p>
            Copyright Homeocare and generic medicine. All rights reserved.
        </p>
    </footer>
    <script>
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDotpGklaTaXzKjIOcTjBStaVXEjSmLYLE",
    authDomain: "homeogens.firebaseapp.com",
    projectId: "homeogens",
    storageBucket: "homeogens.firebasestorage.app",
    messagingSenderId: "883123212466",
    appId: "1:883123212466:web:1002dc26343803845f79ab",
    measurementId: "G-RQBDSDSYP0"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
</body>
</html>
