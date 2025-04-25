<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeopathy";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT question_key, question, option1, option2, option3, option4, correct_answer FROM questions2";
$result = $conn->query($sql);

$questions = [];
$correctAnswers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[$row["question_key"]] = [
            "question" => $row["question"],
            "options" => [
                $row["option1"],
                $row["option2"],
                $row["option3"],
                $row["option4"],
            ],
        ];
        $correctAnswers[$row["question_key"]] = $row["correct_answer"];
    }
} else {
    echo "0 results";
}

if (isset($_POST["submit"])) {
    $score = 0;
    $totalQuestions = count($correctAnswers);

    foreach ($correctAnswers as $key => $correctAnswer) {
        $userAnswer = isset($_POST[$key]) ? $_POST[$key] : "";
        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }
    echo "<script>alert('You scored $score out of $totalQuestions');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generic Medicine Quiz</title>
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
    margin-right: auto;  
}

         body{
            background: linear-gradient(to left,lightgreen,white);
        }
       .info{
   
    padding: 40px;
    border-radius: 20px;
    border: dashed solid black;
}
.info h3{
    background-color:black;
    color:wheat;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    margin:70px;
    margin-left:270px;
    margin-right:270px;
    border: solid black 2px;
}
.info h1{
    background-color:lightsteelblue;
    padding: 40px;
    border-radius: 20px;
    text-align: center;
    margin-left:270px;
    margin-right:270px;
    border:  solid black 2px;
}
.g{
    background-color: rgb(208, 234, 245);
    text-align: left;
    padding: 30px;
    margin: 20px;
    border-radius: 30px;
    font-size: 20px;
    margin-left: 180px;
    margin-right: 180px;
    
}
button{
    color:white;
    background-color: blue;
    padding: 20px;
    font-size: 20px;
    border-radius: 20px;
   margin-left: 700px;
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
        <h1>GENERIC MEDICINE QUIZ SECTION</h1>
    </div>
    <form method="POST" action="">
        <div class="grid">
            <?php foreach ($questions as $key => $questionData) { ?>
                <div class="g">
                    <h3><?php echo $questionData["question"]; ?></h3>
                    <?php foreach ($questionData["options"] as $option) { ?>
                        <input type="radio" name="<?php echo $key; ?>" value="<?php echo $option; ?>"> <?php echo $option; ?><br>
                    <?php } ?>
                    <br>
                </div>
            <?php } ?>
        </div>
        <button type="submit" name="submit">Submit Quiz</button>
    </form>
</body>
</html>