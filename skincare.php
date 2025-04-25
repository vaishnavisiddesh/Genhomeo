<?php
include 'navbar2.html';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin Analysis & Recommendation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
              background:linear-gradient(to left,lightgreen,white);
        }
        h1 {
            background-color: white;
            border-radius:  10px;
            color: black;
            padding:10px;
            margin-left:100px;
            margin-right: 100px;
        }
        .info, .sel {
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
        }
        input, select, button {
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
        }
        canvas {
            margin: 20px auto;
            border: 1px solid #ccc;
            display: block;
        }
        .result {
            font-size: 18px;
            font-weight: bold;
            color: #007BFF;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Skin Analysis & Recommendation Tool</h1>

    <!-- Information Section -->
    <div class="info">
        <h2>Slay the day, but don't forget the SPF—your skin's BFF!</h2>
        <img src="v_1.jpg" alt="Skincare image" style="width: 50%; height: 50%; border-radius: 20px;">
    </div>

    <!-- Form Section -->
    <div class="sel">
        <form id="skinForm">
            <label>Choose Age:</label>
            <select id="age">
                <option>10-30</option>
                <option>31-60</option>
                <option>61-100</option>
            </select>
            <br>
            <label>Choose Gender:</label>
            <select id="gender">
                <option>Male</option>
                <option>Female</option>
                <option>Not to specify</option>
            </select>
            <br>
            <label>Choose Skin-Type:</label>
            <select id="skinType">
                <option>Oily</option>
                <option>Dry</option>
                <option>Combination</option>
                <option>Sensitive</option>
                <option>Normal</option>
            </select>
            <br>
            <label>Upload Your Photo:</label>
            <input type="file" id="uploadImage" accept="image/*">
        </form>
    </div>

    <canvas id="imageCanvas"></canvas>

    
    <div class="result" id="result"></div>
    <div class="result" id="recommendation"></div>

    <script>
        const form = document.getElementById("skinForm");
        const uploadImage = document.getElementById("uploadImage");
        const canvas = document.getElementById("imageCanvas");
        const ctx = canvas.getContext("2d");

  
        uploadImage.addEventListener("change", (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;
                img.onload = () => {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);
                    analyzeSkin(); // Perform basic analysis
                };
            };
            reader.readAsDataURL(file);
        });

        // Skin Condition Analysis (Mock Example)
        function analyzeSkin() {
            // Example classification logic (mock analysis)
            const conditions = ["Acne", "Dryness", "Pigmentation"];
            const randomCondition = conditions[Math.floor(Math.random() * conditions.length)];

            document.getElementById("result").textContent = `Skin Condition Detected: ${randomCondition}`;
            getRecommendation(randomCondition);
        }

        // Recommendations Mapping
        const recommendations = {
            Acne: "Use Kali Bromatum and avoid oily foods.",
            Dryness: "Apply Petroleum and hydrate often.",
            Pigmentation: "Use Berberis Aquifolium and sunscreen."
        };

        function getRecommendation(condition) {
            const age = document.getElementById("age").value;
            const gender = document.getElementById("gender").value;
            const skinType = document.getElementById("skinType").value;

            const recommendation = recommendations[condition] || "No specific recommendation available.";
            document.getElementById("recommendation").textContent = `Recommendation for ${age} (${gender}): ${recommendation}. Tailored for ${skinType} skin.`;
        }
    </script>
</body>
</html>