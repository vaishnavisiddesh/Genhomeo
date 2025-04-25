<?php
$mealData = [
    'Salad' => ['calories' => 150, 'protein' => 5, 'carbs' => 10, 'fat' => 8],
    'Pasta' => ['calories' => 300, 'protein' => 12, 'carbs' => 40, 'fat' => 10],
    'FruitBowl' => ['calories' => 200, 'protein' => 2, 'carbs' => 50, 'fat' => 1],
    'ChickenBreast' => ['calories' => 165, 'protein' => 31, 'carbs' => 0, 'fat' => 3.6],
    'BrownRice' => ['calories' => 215, 'protein' => 5, 'carbs' => 45, 'fat' => 1.8],
    'Broccoli' => ['calories' => 55, 'protein' => 4.7, 'carbs' => 11, 'fat' => 0.6],
    'Avocado' => ['calories' => 240, 'protein' => 3, 'carbs' => 12, 'fat' => 22],
    'Eggs' => ['calories' => 78, 'protein' => 6, 'carbs' => 0.6, 'fat' => 5],
    'Almonds' => ['calories' => 576, 'protein' => 21, 'carbs' => 22, 'fat' => 49],
    'Salmon' => ['calories' => 206, 'protein' => 22, 'carbs' => 0, 'fat' => 13],
    'SweetPotato' => ['calories' => 103, 'protein' => 2, 'carbs' => 24, 'fat' => 0.2],
    'Spinach' => ['calories' => 23, 'protein' => 2.9, 'carbs' => 3.6, 'fat' => 0.4],
    'GreekYogurt' => ['calories' => 100, 'protein' => 10, 'carbs' => 4, 'fat' => 0],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scheduleString = $_POST['schedule'];
    $schedule = json_decode($scheduleString, true);

    if (is_array($schedule)) {
        $totalCalories = 0;
        $totalProtein = 0;
        $totalCarbs = 0;
        $totalFat = 0;

        echo "<div id='mealSummaryContainer' style='background: #f9f9f9; padding: 30px; margin: 30px auto; border: 1px solid #ddd; border-radius: 15px; font-family: sans-serif; max-width: 600px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
        echo "<h2 style='color: #28a745; text-align: center; margin-bottom: 20px;'>Meal Plan Summary</h2>";
        echo "<ul style='list-style: none; padding: 0;'>";

        foreach ($schedule as $mealSlot => $mealDetails) {
            if (isset($mealDetails['name']) && isset($mealDetails['weight'])) {
                $mealName = htmlspecialchars($mealDetails['name']);
                $weight = (float)$mealDetails['weight'];

                if (isset($mealData[$mealName])) {
                    $caloriesPerGram = $mealData[$mealName]['calories'] / 100;
                    $proteinPerGram = $mealData[$mealName]['protein'] / 100;
                    $carbsPerGram = $mealData[$mealName]['carbs'] / 100;
                    $fatPerGram = $mealData[$mealName]['fat'] / 100;

                    $mealCalories = $caloriesPerGram * $weight;
                    $mealProtein = $proteinPerGram * $weight;
                    $mealCarbs = $carbsPerGram * $weight;
                    $mealFat = $fatPerGram * $weight;

                    $totalCalories += $mealCalories;
                    $totalProtein += $mealProtein;
                    $totalCarbs += $mealCarbs;
                    $totalFat += $mealFat;

                    echo "<li style='margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;'>";
                    echo "<div><strong>" . htmlspecialchars(ucfirst($mealSlot)) . ":</strong> <span style='font-weight: bold; color: #333;'>$weight g of $mealName</span></div>";
                    echo "<div>";
                    echo "<span style='color: #ff5722; margin-left: 10px;'>".round($mealCalories)." kcal</span>";
                    echo "</div>";
                    echo "</li>";
                }
            }
        }

        echo "</ul>";
        echo "<div style='margin-top: 20px; padding-top: 15px; border-top: 1px solid #ddd;'>";
        echo "<h3 style='color: #333; margin-bottom: 10px; text-align: center;'>Total Nutrients</h3>";
        echo "<p style='margin-bottom: 8px;'><strong>Total Calories:</strong> <span style='color: #ff5722; font-weight: bold;'>".round($totalCalories)." kcal</span></p>";
        echo "<p style='margin-bottom: 8px;'><strong>Protein:</strong> <span style='color: #673ab7; font-weight: bold;'>".round($totalProtein)." g</span></p>";
        echo "<p style='margin-bottom: 8px;'><strong>Carbohydrates:</strong> <span style='color: #03a9f4; font-weight: bold;'>".round($totalCarbs)." g</span></p>";
        echo "<p><strong>Fat:</strong> <span style='color: #9c27b0; font-weight: bold;'>".round($totalFat)." g</span></p>";
        echo "</div>";
        echo "</div>";
        echo "<script>document.body.style.background = 'linear-gradient(to left, lightgreen, white)';</script>"; // JavaScript to change body background
        exit;
    } else {
        echo "<p>Error: Invalid schedule data received.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag-and-Drop Meal Planner with Nutrients</title>
    <style>
        body {
            margin: 0;
            background: white; /* Default background */
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .d {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 50px;
            display: flex;
            gap: 25px;
            background-color: black;
            padding: 10px;
            border-radius: 10px;
            justify-content: flex-end;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 25px;
        }

        .left-text {
            color: white;
            font-size: 30px;
            margin-right: auto;
        }

        .info {
            background-color: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            text-align: center;
        }

        .info img {
            width: 500px;
            height: 500px;
            border-radius: 20px;
            padding: 30px;
        }

        .meal-options, .meal-schedule {
            background: linear-gradient(to right, lightblue, snow);
            width: 45%;
            border: 4px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            color: black;
        }

        .meal-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #aaa;
            background-color: #fff;
            cursor: grab;
            font-size: 20px;
        }

        .schedule-slot {
            margin: 15px 0;
            padding: 20px;
            border: 2px dashed #ddd;
            background-color: #f0f0f0;
            text-align: center;
        }

        button {
            margin-top: 20px;
            padding: 30px;
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            margin-left: 700px;
            font-size: 30px;
        }

        button:hover {
            background-color: #218838;
        }

        .meal-item:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px black;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .weight-input {
            width: 80px;
            text-align: center;
            margin-left: 10px;
        }

        .content-container {
            display: flex;
            justify-content: space-around;
            padding: 30px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="d">
        <div class="left-text">HOMEO-GEN</div>
        <div><a href="home.php">Home</a></div>
        <div><a href="gridpage.html">Contents</a></div>
        <div><a href="aboutus.pdf">About Us</a></div>
        <div><a href="account.php">Profile</a></div>
    </div>

    <div class="content-container">
        <div class="info">
            <h1>Proteins, carbs, and fats—when they work together, it’s a meal magic show!</h1><br>
            <h2>Let's plan meal packed with nutrients!!!</h2>
            <img src='n.jpg'>
        </div>

        <div class="meal-options">
            <h3>Meal Options</h3>
            <?php
            foreach (array_keys($mealData) as $meal) {
                $mealId = htmlspecialchars($meal);
                $weightInputId = 'weight-' . $mealId;

                echo '<div class="meal-item" draggable="true" id="' . $mealId . '">';
                echo htmlspecialchars($meal);
                echo '<input type="number" min="1" value="100" class="weight-input" id="' . $weightInputId . '"> g';
                echo '</div>';
            }
            ?>
        </div>

        <div class="meal-schedule">
            <h3>Meal Schedule</h3>
            <div class="schedule-slot" id="Breakfast">Breakfast</div>
            <div class="schedule-slot" id="Lunch">Lunch</div>
            <div class="schedule-slot" id="Dinner">Dinner</div>
        </div>
    </div>

    <form method="POST">
        <input type="hidden" name="schedule" id="scheduleData">
        <button type="submit" onclick="saveData()">PLAN MEAL</button>
    </form>

    <script>
    const mealItems = document.querySelectorAll('.meal-item');
    const scheduleSlots = document.querySelectorAll('.schedule-slot');

    mealItems.forEach(item => {
        item.addEventListener('dragstart', (e) => {
            const mealName = e.target.id;
            const weight = document.getElementById('weight-' + mealName).value;
            e.dataTransfer.setData('text/plain', JSON.stringify({
                name: mealName,
                weight: weight
            }));
        });
    });

    scheduleSlots.forEach(slot => {
        slot.addEventListener('dragover', (e) => {
            e.preventDefault();
            slot.style.backgroundColor = '#d3f9d8';
        });

        slot.addEventListener('dragleave', () => {
            slot.style.backgroundColor = '#f0f0f0';
        });

        slot.addEventListener('drop', (e) => {
            e.preventDefault();
            const mealData = JSON.parse(e.dataTransfer.getData('text/plain'));
            slot.innerHTML = `${mealData.name} (${mealData.weight}g)`;
            slot.setAttribute('data-meal', JSON.stringify(mealData));
            slot.style.backgroundColor = '#f0f0f0';
        });
    });

    function saveData() {
        const schedule = {};
        scheduleSlots.forEach(slot => {
            const mealData = JSON.parse(slot.getAttribute('data-meal') || '{}');
            if (mealData.name && mealData.weight) {
                schedule[slot.id] = mealData;
            }
        });
        document.getElementById('scheduleData').value = JSON.stringify(schedule);
    }
</script>
</body>
</html>