<?php
$bmi = null;
$category = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    if ($weight > 0 && $height > 0) {
       
        $bmi = round($weight / ($height * $height), 2);

        
        if ($bmi < 18.5) {
            $category = "Underweight";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $category = "Normal weight";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $category = "Overweight";
        } else {
            $category = "Obese";
        }
    } else {
        $category = "Please enter valid weight and height values.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to left, lightgreen, white);
            text-align: center;
            padding: 20px;
        }
        .bmi-calculator {
            background: #fff;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        input {
            padding: 10px;
            margin: 10px;
            width: 90%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background: #e8f5e9;
            color: #4caf50;
            border-radius: 5px;
            font-weight: bold;
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
    </style>
</head>
<body>
     <div class="d">
        <div class="left-text">HOMEO-GEN</div>

        <div>
            <a class="a" href="home.html">Home</a>
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
    <div class="bmi-calculator">
        
        <h1>BMI Calculator</h1>
        <h2>Healthy starts with ‘H’ but also with this BMI calculator.</h2>
        <form method="POST">
            <input type="number" step="0.1" name="weight" placeholder="Enter weight (kg)" required>
            <input type="number" step="0.01" name="height" placeholder="Enter height (m)" required>
            <button type="submit">Calculate BMI</button>
        </form>
        
        <?php if ($bmi): ?>
            <div class="result">
                Your BMI is: <strong><?php echo $bmi; ?></strong><br>
                Category: <strong><?php echo $category; ?></strong>
            </div>
        <?php endif; ?>
    </div>
   
</body>
</html>