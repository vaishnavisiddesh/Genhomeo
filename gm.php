<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Generic
        Medicines</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], button {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .delete-button {
            background-color: #d9534f;
        }
        .delete-button:hover {
            background-color: #c9302c;
        }
        .medicine-list {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .medicine-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .medicine-item:last-child {
            border-bottom: none;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Panel - Manage Generic Medicines</h2>

        <h3>Add New Generic Medicine</h3>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="disease">Disease:</label>
                <input type="text" id="disease" name="disease" required placeholder="Enter Disease">
            </div>
            <div class="form-group">
                <label for="medicine">Medicine:</label>
                <input type="text" id="medicine" name="medicine" required placeholder="Enter Medicine Name">
            </div>
            <button type="submit">Add Medicine</button>
            <?php if (isset($add_error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($add_error); ?></p>
            <?php endif; ?>
            <?php if (isset($add_success)): ?>
                <p class="success-message"><?php echo htmlspecialchars($add_success); ?></p>
            <?php endif; ?>
        </form>

        <div class="medicine-list">
            <h3>Existing Homeopathy Medicines</h3>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "homeopathy";

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['action'])) {
                $action = $_POST['action'];

                if ($action == 'add') {
                    if (isset($_POST['disease']) && !empty($_POST['disease']) && isset($_POST['medicine']) && !empty($_POST['medicine'])) {
                        $disease = $_POST['disease'];
                        $medicine = $_POST['medicine'];
                        $sql = "INSERT INTO genmed (Disease, Medicine) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $disease, $medicine);

                        if ($stmt->execute()) {
                            $add_success = 'Homeopathy medicine added successfully!';
                        } else {
                            $add_error = 'Error adding medicine to the database.';
                        }
                        $stmt->close();
                    } else {
                        $add_error = 'Please enter both Disease and Medicine.';
                    }
                } elseif ($action == 'delete') {
                    if (isset($_POST['disease_to_delete']) && !empty($_POST['disease_to_delete'])) {
                        $diseaseToDelete = $_POST['disease_to_delete'];
                        $sql = "DELETE FROM genmed WHERE Disease = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $diseaseToDelete);

                        if ($stmt->execute()) {
                            $delete_success = 'Homeopathy medicine deleted successfully!';
                        } else {
                            $delete_error = 'Error deleting medicine from the database.';
                        }
                        $stmt->close();
                    } else {
                        $delete_error = 'Invalid Disease to delete.';
                    }
                }
            }

            $sql = "SELECT Disease, Medicine FROM genmed ORDER BY Disease ASC";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="medicine-item">';
                        echo '<span>' . htmlspecialchars($row["Disease"]) . ' - ' . htmlspecialchars($row["Medicine"]) . '</span>';
                        echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" style="display: inline;">';
                        echo '<input type="hidden" name="action" value="delete">';
                        echo '<input type="hidden" name="disease_to_delete" value="' . htmlspecialchars($row["Disease"]) . '">';
                        echo '<button type="submit" class="delete-button">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No generic medicines found in the database.</p>";
                }
                $result->free();
            } else {
                echo "<p class='error-message'>Error fetching medicines: " . $conn->error . "</p>";
            }
            $conn->close();
            ?>
        </div>
        <?php if (isset($delete_error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($delete_error); ?></p>
        <?php endif; ?>
        <?php if (isset($delete_success)): ?>
            <p class="success-message"><?php echo htmlspecialchars($delete_success); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>