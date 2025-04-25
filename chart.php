<?php
// Database connection details (MODIFY THESE WITH YOUR ACTUAL CREDENTIALS)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeopathy";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to UTF-8
mysqli_set_charset($conn, "utf8");

if (isset($_POST['disease'])) {
    // Sanitize and trim the input
    $disease = trim($_POST['disease']);
    $disease = mysqli_real_escape_string($conn, $disease);

    // Case-insensitive search using LOWER()
    $sql = "SELECT Medicine FROM homeo_sugg WHERE LOWER(Disease) = LOWER('$disease')";
    $result = mysqli_query($conn, $sql);

    $medicines = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $medicines[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($medicines);
    mysqli_close($conn);
    exit;
}

// Fetch distinct diseases for the dropdown
$result = mysqli_query($conn, "SELECT DISTINCT Disease FROM homeo_sugg ORDER BY Disease ASC");

// Check for database query errors
if (!$result) {
    error_log("Error fetching diseases: " . mysqli_error($conn));
    // Optionally, display an error message to the user if appropriate for your application
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeopathy Medicines</title>
    <style>
        body {
            background: linear-gradient(to left, lightgreen, white);
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero {
            border: 3px solid black;
            background-color: lightgray;
            padding: 30px;
            margin: 20px;
            border-radius: 20px;
            text-align: center;
        }

        .con {
            margin-top: 20px;
            width: 80%;
            max-width: 800px;
        }

        .con center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .con table {
            background-color: white;
            padding: 10px;
            border: 3px solid black;
            border-radius: 10px;
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .con th, .con td {
            padding: 15px;
            text-align: center;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
        }

        .con th {
            background-color: #f2f2f2;
        }

        .con tr:last-child td {
            border-bottom: none;
        }

        #diseaseSelect {
            font-size: 18px;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 300px;
        }

        #medicineTable {
            display: none;
            width: 100%;
        }

        #medicineResults td {
            font-size: 18px;
        }
        .d{
            width:100%;
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
    <div class="hero">
        <h1>DISEASES AND HOMEOPATHY MEDICINES</h1>
        <h2>These are 100% prescribed from Homeopathy doctors.</h2>
    </div>
    <div class="con">
        <center>
            <select id="diseaseSelect">
                <option value="">Select a Disease</option>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . htmlspecialchars($row["Disease"]) . '">' . htmlspecialchars(ucfirst($row["Disease"])) . '</option>';
                    }
                    mysqli_free_result($result); // Free the result set
                } else {
                    echo '<option value="">Error loading diseases</option>';
                }
                ?>
            </select>
            <br>
            <table id="medicineTable" border="1">
                <thead>
                    <tr>
                        <th>HOMEOPATHY MEDICINE</th>
                    </tr>
                </thead>
                <tbody id="medicineResults">
                    </tbody>
            </table>
        </center>
    </div>

    <script>
        const diseaseSelect = document.getElementById('diseaseSelect');
        const medicineTable = document.getElementById('medicineTable');
        const medicineResults = document.getElementById('medicineResults');

        diseaseSelect.addEventListener('change', function() {
            const selectedDisease = this.value;
            if (selectedDisease) {
                fetchMedicine(selectedDisease);
            } else {
                medicineTable.style.display = 'none';
                medicineResults.innerHTML = '';
            }
        });

        function fetchMedicine(disease) {
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'disease=' + encodeURIComponent(disease),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                medicineResults.innerHTML = '';
                if (data && data.length > 0) {
                    data.forEach(medicine => {
                        const row = document.createElement('tr');
                        const cell = document.createElement('td');
                        cell.textContent = medicine.Medicine;
                        row.appendChild(cell);
                        medicineResults.appendChild(row);
                    });
                    medicineTable.style.display = 'table';
                } else {
                    medicineResults.innerHTML = '<tr><td colspan="1">No medicine found for ' + htmlspecialchars(disease) + '.</td></tr>';
                    medicineTable.style.display = 'table';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                medicineResults.innerHTML = '<tr><td colspan="1">Error fetching data. Please try again later.</td></tr>';
                medicineTable.style.display = 'table';
            });
        }
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>