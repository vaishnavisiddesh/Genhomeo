<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background: linear-gradient(to left, lightgray, lightseagreen);
        }
        form {
            margin: 20px auto;
            width: 300px;
            background: #eaf2f8;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        #chart-container {
            width: 300px;
            height: 300px;
            margin: 30px auto;
        }
        h1 {
            background-color: white;
            color: black;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            margin-left:500px;
            margin-right:500px;
        }
        .f {
            display: inline-block;
            background-color: black;
            color: white;
            padding: 20px;
            margin: 5px;
            border: 1px solid black;
            border-radius: 10px;
        }
        .info {
            background-color: white;
            color: black;
            padding: 20px;
            margin: 5px;
            border-radius: 10px;
            width: 500px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            font-size: 20px;
        }
        #recommendation {
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            text-align: center;
        }
        #daily-reports {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        #daily-reports h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .report-item {
            border-bottom: 1px solid #eee;
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .report-item:last-child {
            border-bottom: none;
        }
        .report-date {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="d">
        <div class="left-text">HOMEO-GEN</div>
        <div><a class="a" href="home.php">Home</a></div>
        <div><a class="a" href="gridpage.html">Contents</a></div>
        <div><a class="a" href="aboutus.pdf">About Us</a></div>
        <div><a class="a" href="account.php">Profile</a></div>
    </div>
    <h1>Sleep Tracker</h1>
   <br>
        <div class="info">
            Sleep needs differ across age groups:<br><br>
            1.Children (5-12 years): 9-11 hours<br>
            2.Teenagers (13-17 years): 8-10 hours<br>
            3.Adults (18-64 years): 7-9 hours<br>
            4.Older Adults (65+): 7-8 hours<br>
        </div>

    <form id="sleepForm" method="POST" action="">
        <h3>Log Your Sleep</h3>
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br>
        <label for="sleepTime">Sleep Time:</label><br>
        <input type="time" id="sleepTime" name="sleepTime" required><br>
        <label for="wakeTime">Wake Time:</label><br>
        <input type="time" id="wakeTime" name="wakeTime" required><br>
        <button type="submit" name="submit">Submit</button>
    </form>

    <div id="chart-container">
        <canvas id="sleepChart"></canvas>
    </div>

    <div id="recommendation"></div>

    <div id="daily-reports">
        <h2>Daily Sleep Reports</h2>
        <div id="reports-list">
            <?php
            // Database connection
            $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com"; // Replace with your server name
            $username = "admin";         // Replace with your database username
            $password = "nithya2002";             // Replace with your database password
            $dbname = "homeopathy";     // Replace with your database name

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo "<p>Error connecting to the database: " . $conn->connect_error . "</p>";
            } else {
                // Handle form submission
                if (isset($_POST['submit'])) {
                    $date = $_POST['date'];
                    $sleepTime = $_POST['sleepTime'];
                    $wakeTime = $_POST['wakeTime'];

                    $sleep = new DateTime($sleepTime);
                    $wake = new DateTime($wakeTime);
                    $interval = $sleep->diff($wake);
                    $duration = ($interval->h + ($interval->i / 60));
                    if ($duration < 0) {
                        $duration += 24;
                    }

                    $sql = "INSERT INTO sleep_data (date, sleep_time, wake_time, duration) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssd", $date, $sleepTime, $wakeTime, $duration);

                    if ($stmt->execute()) {
                        echo "<p>Sleep data saved successfully.</p>";
                    } else {
                        echo "<p>Error saving sleep data: " . $stmt->error . "</p>";
                    }
                    $stmt->close();
                }

                // Fetch and display daily reports and prepare chart data
                $sql = "SELECT date, duration FROM sleep_data ORDER BY date DESC LIMIT 7"; // Limit to last 7 days for the chart
                $result = $conn->query($sql);

                $chartLabels = [];
                $chartData = [];

                if ($result->num_rows > 0) {
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='report-item'><span class='report-date'>" . $row["date"] . "</span> <span>" . number_format($row["duration"], 2) . " hours</span></li>";
                        $chartLabels[] = $row["date"];
                        $chartData[] = $row["duration"];
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No sleep data recorded yet.</p>";
                }
                $conn->close();
            }
            ?>
        </div>
    </div>

    <script>
        const sleepForm = document.getElementById('sleepForm');
        const recommendationDiv = document.getElementById('recommendation');
        const reportsListDiv = document.getElementById('reports-list');
        const chartContainer = document.getElementById('chart-container');
        const sleepChartCanvas = document.getElementById('sleepChart');
        let sleepChart;

        const chartLabels = <?php echo json_encode($chartLabels); ?>;
        const chartData = <?php echo json_encode($chartData); ?>;

        // Function to generate random RGBA color
        function getRandomRGBA(alpha = 0.7) {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
        }

        function updateRecommendation(duration) {
            let recommendation = '';
            if (duration < 6) {
                recommendation = 'Recommendation: You had less than 6 hours of sleep. Try to get more rest tonight.';
            } else if (duration >= 6 && duration < 7) {
                recommendation = 'Recommendation: You had a good sleep. Consider aiming for a bit more sleep for better rest.';
            } else {
                recommendation = 'Recommendation: You had a great sleep! Keep up the good work.';
            }
            recommendationDiv.textContent = recommendation;
        }

        function renderPieChart() {
            if (!chartData || chartData.length === 0) {
                if (sleepChart) {
                    sleepChart.destroy();
                    sleepChart = null;
                }
                return;
            }

            const backgroundColors = chartData.map(() => getRandomRGBA());
            const borderColors = backgroundColors.map(color => color.replace('0.7', '1')); // Make border slightly darker

            if (sleepChart) {
                sleepChart.data.labels = chartLabels;
                sleepChart.data.datasets[0].data = chartData;
                sleepChart.data.datasets[0].backgroundColor = backgroundColors;
                sleepChart.data.datasets[0].borderColor = borderColors;
                sleepChart.update();
            } else {
                sleepChart = new Chart(sleepChartCanvas, {
                    type: 'pie',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Sleep Duration (hours)',
                            data: chartData,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'Sleep Duration (Last 7 Days)'
                            }
                        }
                    }
                });
            }

            if (chartData.length > 0) {
                updateRecommendation(chartData[0]);
            }
        }

        // Render the initial chart
        renderPieChart();
    </script>
</body>
</html>
