<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Tracker</title>
    <style>
        body{
            background:linear-gradient(to left,lightgreen,white);
            font-family: sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .form-group label {
            font-weight: bold;
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .report {
            margin-top: 30px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        .report h3 {
            margin-top: 0;
        }
        .report p {
            margin-bottom: 8px;
        }
        .date-selection {
            text-align: center;
            margin-bottom: 20px;
        }
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
    margin-right: auto; 
}
    .info{
       text-align: center;
        
        border-radius: 20px;
        padding: 50px;
        margin: 50px;
      }
      .i{
        background-color: antiquewhite;
        border-radius: 50px;
        padding: 50px;
        margin: 50px;
      }
 
           .ii{
        background:linear-gradient(to left, cornsilk,lightpink);
        border-radius: 20px;
        margin:30px;
        padding: 100px;
        margin: 50px;
        font-size: 20px;
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
        <h1>LIFESTYLE PRACTICES FOR YOUR BETTER HEALTH</h1>
        <h2 class="i">Self-care isn’t selfish, it’s essential. 💆‍♀</h2>
        <p class="ii">A healthy lifestyle starts with nourishing your body with whole foods, staying active, and getting enough rest. 🌱💪 Prioritizing mental well-being through mindfulness and stress management is just as important as physical health. 🧘‍♂✨ Small, consistent habits lead to long-term wellness and happiness. 😊🏃‍♀</p>
    </div>


    <div class="container">
        <h2>Daily Health Tracker</h2>
        <form method="POST">
            <div class="form-group">
                <label for="drank_water">Drank enough water?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="drank_water">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="had_breakfast">Had breakfast?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="had_breakfast">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="took_exercise">Took an exercise break?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="took_exercise">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="went_offline">Went offline for a bit?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="went_offline">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="got_sleep">Got 7-8 hours of sleep?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="got_sleep">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="spent_time_loved_ones">Spent time with loved ones?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="spent_time_loved_ones">
                    <span class="slider"></span>
                </label>
            </div>
            <button type="submit">Save Today's Data</button>
        </form>

        <div class="date-selection">
            <h3>Analyze Weekly Data</h3>
            <form method="GET">
                <label for="report_date">Select a date within the week to analyze:</label>
                <input type="date" id="report_date" name="report_date" required>
                <button type="submit">Generate Weekly Report</button>
            </form>
        </div>

        <?php
        
        // Database connection details (REPLACE WITH YOUR ACTUAL CREDENTIALS)
        $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com";
        $username = "admin";
        $password = "nithya2002";
        $dbname = "homeopathy";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entry_date = date("Y-m-d");
            $drank_water = isset($_POST['drank_water']) ? 1 : 0;
            $had_breakfast = isset($_POST['had_breakfast']) ? 1 : 0;
            $took_exercise = isset($_POST['took_exercise']) ? 1 : 0;
            $went_offline = isset($_POST['went_offline']) ? 1 : 0;
            $got_sleep = isset($_POST['got_sleep']) ? 1 : 0;
            $spent_time_loved_ones = isset($_POST['spent_time_loved_ones']) ? 1 : 0;

            $sql = "INSERT INTO health_data (entry_date, drank_water, had_breakfast, took_exercise, went_offline, got_sleep, spent_time_loved_ones)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                    drank_water = VALUES(drank_water),
                    had_breakfast = VALUES(had_breakfast),
                    took_exercise = VALUES(took_exercise),
                    went_offline = VALUES(went_offline),
                    got_sleep = VALUES(got_sleep),
                    spent_time_loved_ones = VALUES(spent_time_loved_ones)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siiiiii", $entry_date, $drank_water, $had_breakfast, $took_exercise, $went_offline, $got_sleep, $spent_time_loved_ones);

            if ($stmt->execute()) {
                echo "<div class='report'>Daily data saved successfully!</div>";
            } else {
                echo "<div class='report'>Error saving data: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }

        if (isset($_GET['report_date'])) {
            $reportDate = $_GET['report_date'];
            $dayOfWeek = date("N", strtotime($reportDate));
            $mondayOfWeek = date("Y-m-d", strtotime($reportDate . " -" . ($dayOfWeek - 1) . " days"));
            $sundayOfWeek = date("Y-m-d", strtotime($reportDate . " +" . (7 - $dayOfWeek) . " days"));

            $sqlWeekly = "SELECT
                                SUM(drank_water) AS total_water,
                                SUM(had_breakfast) AS total_breakfast,
                                SUM(took_exercise) AS total_exercise,
                                SUM(went_offline) AS total_offline,
                                SUM(got_sleep) AS total_sleep,
                                SUM(spent_time_loved_ones) AS total_loved_ones,
                                COUNT(*) AS total_entries
                            FROM health_data
                            WHERE entry_date >= ? AND entry_date <= ?";
            $stmtWeekly = $conn->prepare($sqlWeekly);
            $stmtWeekly->bind_param("ss", $mondayOfWeek, $sundayOfWeek);
            $stmtWeekly->execute();
            $resultWeekly = $stmtWeekly->get_result();

            echo "<div class='report'>";
            echo "<h3>Weekly Health Report (" . date("d M Y", strtotime($mondayOfWeek)) . " - " . date("d M Y", strtotime($sundayOfWeek)) . ")</h3>";

            if ($resultWeekly->num_rows > 0) {
                $rowWeekly = $resultWeekly->fetch_assoc();
                $totalEntries = $rowWeekly["total_entries"];

                echo "<p>Drank enough water: " . $rowWeekly["total_water"] . " days out of " . $totalEntries . "</p>";
                echo "<p>Had breakfast: " . $rowWeekly["total_breakfast"] . " days out of " . $totalEntries . "</p>";
                echo "<p>Took an exercise break: " . $rowWeekly["total_exercise"] . " days out of " . $totalEntries . "</p>";
                echo "<p>Went offline for a bit: " . $rowWeekly["total_offline"] . " days out of " . $totalEntries . "</p>";
                echo "<p>Got 7-8 hours of sleep: " . $rowWeekly["total_sleep"] . " days out of " . $totalEntries . "</p>";
                echo "<p>Spent time with loved ones: " . $rowWeekly["total_loved_ones"] . " days out of " . $totalEntries . "</p>";

                echo "<h3>Weekly Health Assessment</h3>";
                echo "<p>";
                if ($totalEntries > 0) {
                    $healthyScore = 0;
                    if ($rowWeekly["total_water"] / $totalEntries >= 0.7) $healthyScore++;
                    if ($rowWeekly["total_breakfast"] / $totalEntries >= 0.7) $healthyScore++;
                    if ($rowWeekly["total_exercise"] / $totalEntries >= 0.5) $healthyScore++;
                    if ($rowWeekly["total_offline"] / $totalEntries >= 0.5) $healthyScore++;
                    if ($rowWeekly["total_sleep"] / $totalEntries >= 0.7) $healthyScore++;
                    if ($rowWeekly["total_loved_ones"] / $totalEntries >= 0.5) $healthyScore++;

                    if ($healthyScore >= 5) {
                        echo "This was a very healthy week! Keep up the great habits.";
                    } elseif ($healthyScore >= 3) {
                        echo "This week shows some good healthy habits. Consider focusing on areas for improvement.";
                    } else {
                        echo "This week could benefit from more attention to healthy lifestyle practices.";
                    }
                } else {
                    echo "No data available for the selected week to assess healthiness.";
                }
                echo "</p>";

            } else {
                echo "<p>No data found for the week starting on " . date("d M Y", strtotime($mondayOfWeek)) . ".</p>";
            }
            echo "</div>";
            $stmtWeekly->close();
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
