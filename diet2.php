<!DOCTYPE html>
<html>
<head>
    <title>Diet Chart Generator</title>
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
        background: linear-gradient(to left, lightgreen, white);

            font-family: Arial, sans-serif; 
            text-align: center;
        }
        form {
            display: inline-block;
            text-align: left; 
            font-size:25px;
        }
        h1 { 
            color: #2c3e50;
        }
        button {
            padding: 10px;
            background-color: #3498db;
            color: white; border: none; 
            cursor: pointer;
            margin-left:70px;
            border-radius: 10px;
            padding:10px;
            font-size:20px;
        }
        .f{
            background-color: white;
            padding:20px;
            margin-left:450px;
            margin-right:450px;
            border-radius: 20px;
            border:solid black 4px;
            
        }
        input{
            padding:20px;
            font-size:15px;
           
            border-radius:10px;
          text-align: center;
        }
        select{
            padding:20px;
            font-size:15px;
           margin-left:100px;
            border-radius:10px;
          text-align: center;
        }
         .meal-container {
        background-color:lavenderblush;
        padding: 20px;
        border-radius: 10px;
        margin: 20px auto;
        width: 60%;
        border:solid black 8px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #2c3e50;
        font-size: 24px;
    }
    .meal-list {
        list-style-type: circle;
        padding: 0;
    }
    .meal-item {
        text-align: left;
        margin-left:700px;
        color: white;
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        font-size: 18px;
        color:black;
    }
    .no-results {
        color: red;
        font-size: 20px;
    }
    .error {
        color: red;
        font-weight: bold;
    }
    h1{
      background-color: black;
      color:white;
      padding:20px;
      margin:10px;
      border-radius:10px;
      margin-left:400px;
      margin-right:400px;
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
    <h1>Diet Chart Generator</h1>
    <p>Enter your details and get a personalized diet plan!</p>
    <div class="f">
    <form method="POST">
        <label>Age:</label> <input type="number" name="age" required><br><br>
        <label>Gender:</label> 
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <br><br>

        <label>Diet Preference:</label><br><br>
        <input type="radio" name="diet" value="vegetarian" required> Vegetarian<br>
        <input type="radio" name="diet" value="vegan" required> Vegan<br>
        <input type="radio" name="diet" value="pescatarian" required> Pescatarian<br>
        <input type="radio" name="diet" value="gluten-free" required> Gluten-Free<br>
        <input type="radio" name="diet" value="ketogenic" required> Ketogenic<br>
        <input type="radio" name="diet" value="paleo" required> Paleo<br>
        <br>

        <label>Choose Allergy:</label><br><br>
        <select name="allergy">
            <option value="">None</option>
            <option value="peanut">Peanut</option>
            <option value="tree-nut">Tree Nuts</option>
            <option value="milk">Milk</option>
            <option value="egg">Eggs</option>
            <option value="wheat">Wheat</option>
            <option value="soy">Soy</option>
            <option value="shellfish">Shellfish</option>
            <option value="fish">Fish</option>
            <option value="sesame">Sesame</option>
            <option value="mustard">Mustard</option>
        </select>
        <br><br>

        <button type="submit">Generate Diet Plan</button>
    </form>
    </div>
</body>
</html>
   <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diet = $_POST["diet"];
    $allergy = $_POST["allergy"];

    $apiKey = "3b0d712204c8426f87da0a86c1de181c"; // Replace with a valid Spoonacular API key
    $url = "https://api.spoonacular.com/recipes/complexSearch?diet=$diet&intolerances=$allergy&number=5&apiKey=$apiKey";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo "<p class='error'>Error: " . curl_error($ch) . "</p>";
    }

    curl_close($ch);
    
    $data = json_decode($response, true);

    echo "<div class='meal-container'>";
    echo "<h2>Suggested Diet Plan</h2><hr>";
    
    if (!empty($data['results'])) {
        echo "<ul class='meal-list'>";
        foreach ($data['results'] as $recipe) {
            echo "<li class='meal-item'><strong>" . htmlspecialchars($recipe['title']) . "</strong></li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='no-results'>No meal suggestions found for your preferences.</p>";
    }
    echo "</div>";
}
?>