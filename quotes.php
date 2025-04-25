<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
background: linear-gradient(to left,lightgreen,white);
            color: #333;
        }
        h1{
            background-color: white;
            color:black;
            margin-left:900px; 
             margin-right: 900px;
             padding:10px;
             margin:10px;
             border-radius: 10px;
        }
        .quote-box {
            padding: 40px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 700px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .quote {
            font-size: 25px;
            font-style:normal;
            margin-bottom: 30px;
        }
        .author {
            font-size: 25px;
            font-weight: bold;
            color: #555;
        }
        button {
            margin-top: 30px;
            padding: 20px;
            font-size: 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
              .d{
      margin-bottom:50px;
    display: flex;
    gap:25px;
    background-color: black;
    padding: 5px;
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
    <h1>Health Tips and Remainders</h1><br>
    <h2>"Your health is like WiFi—keep it strong, and you'll always stay connected! 💪 Fuel up with good vibes, recharge with sleep, and hydrate like you're the main character in a wellness movie!" 😆✨
</h2>
    <div class="quote-box">
        <?php
        // Array of health-related quotes
        $quotes = [
            ["text" => "Take care of your body. It’s the only place you have to live.", "author" => "Jim Rohn"],
            ["text" => "Self-care is not selfish. You cannot serve from an empty vessel.", "author" => "Eleanor Brown "],
            ["text" => "He who has health has hope and he who has hope has everything.", "author" => "Arabian Proverb
"],
            ["text" => "Your health is an investment, not an expense.", "author" => "Robert Urich"],
            ["text" => "Fitness is not a destination, it's a journey", "author" => "Dalai Lama"],
            ["text" => "Happiness is the highest form of health.", "author" => "Dalai lama"],
            ["text" => "The food you eat can either be the safest and most powerful medicine or the slowest form of poison.", "author" => "Ann Wigmore"],
            ["text" => "Happiness is the highest form of health.", "author" => "Dalai Lama"],
            ["text" => "It is health that is real wealth and not pieces of gold and silver.", "author" => "Mahatma Gandhi"],
            ["text" => "To enjoy the glow of good health, you must exercise.", "author" => "Gene Tunney"],
            ["text" => "Medicine heals doubts as well as diseases.", "author" => "Karl Marx"],
            ["text"=>"Early to bed and early to rise makes a man healthy, wealthy, and wise.","author"=>"Benjamin Franklin
"],
            ["text"=>"If you want a relaxed body, you can do it by relaxing your mind. If you want a relaxed mind, relax your body.","author"=>" Jay Winner"],
            ["text"=>"ದೇಹ ಆರೋಗ್ಯ, ಜೀವನ ಗರ್ವ","author"=>""],
            ["text"=>"ದೇಹ ಆರೋಗ್ಯ, ಜೀವನ ಸಮೃದ್ಧಿ","author"=>""],
            ["text"=>"ಆರೋಗ್ಯ ಲಭ್ಯವಾದರೆ, ಜೀವನ ಸಾಗಲು ಸಿದ್ಧ!","author"=>""],
            ["text"=>"स्वस्थ जीवन जीने का मार्ग, स्वस्थ आहार और व्यायाम!","author"=>""],
            ["text"=>"स्वस्थ जीवन, सुखमय जीवन!","author"=>""],
            ["text"=>"स्वस्थ जीवन, सबसे बड़ा धन!","author"=>""],
            ["text"=>"स्वास्थ्य के लिए रहस्य को अनलॉक करें","author"=>""],
            ["text"=>"स्वस्थ जीवन, सबसे बड़ा धन!","author"=>""],
            ["text"=>"आपका स्वास्थ्य, आपका तरीका","author"=>""],
            


        ];

        // Pick a random quote
        $randomIndex = array_rand($quotes);
        $randomQuote = $quotes[$randomIndex];

        // Display the quote
        echo "<p class='quote'>\"{$randomQuote['text']}\"</p>";
        echo "<p class='author'>– {$randomQuote['author']}</p>";
        ?>
    </div>

    <form method="POST">
        <button type="submit">Get New Tip!</button>
    </form>
</body>
</html>
