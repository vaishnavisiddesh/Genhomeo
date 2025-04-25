<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage eBooks</title>
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
        .ebook-list {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .ebook-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .ebook-item:last-child {
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
        <h2>Admin Panel - Manage eBooks</h2>

        <h3>Add New eBook</h3>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="ebook_title">eBook Title:</label>
                <input type="text" id="ebook_title" name="ebook_title" required placeholder="Enter eBook Title">
            </div>
            <div class="form-group">
                <label for="ebook_url">eBook URL:</label>
                <input type="text" id="ebook_url" name="ebook_url" required placeholder="Enter eBook URL">
            </div>
            <button type="submit">Add eBook</button>
            <?php if (isset($add_error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($add_error); ?></p>
            <?php endif; ?>
            <?php if (isset($add_success)): ?>
                <p class="success-message"><?php echo htmlspecialchars($add_success); ?></p>
            <?php endif; ?>
        </form>

        <div class="ebook-list">
            <h3>Existing eBooks</h3>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "homeopathy";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['action'])) {
                $action = $_POST['action'];

                if ($action == 'add') {
                    if (isset($_POST['ebook_title']) && !empty($_POST['ebook_title']) && isset($_POST['ebook_url']) && !empty($_POST['ebook_url'])) {
                        $ebookTitle = $_POST['ebook_title'];
                        $ebookUrl = $_POST['ebook_url'];
                        $sql = "INSERT INTO ebooks (ebook_title, ebook_url) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $ebookTitle, $ebookUrl);

                        if ($stmt->execute()) {
                            $add_success = 'eBook added successfully!';
                        } else {
                            $add_error = 'Error adding eBook to the database.';
                        }
                        $stmt->close();
                    } else {
                        $add_error = 'Please enter both eBook Title and URL.';
                    }
                } elseif ($action == 'delete') {
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $id = $_POST['id'];
                        $sql = "DELETE FROM ebooks WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);

                        if ($stmt->execute()) {
                            $delete_success = 'eBook deleted successfully!';
                        } else {
                            $delete_error = 'Error deleting eBook from the database.';
                        }
                        $stmt->close();
                    } else {
                        $delete_error = 'Invalid eBook ID.';
                    }
                }
            }

            $sql = "SELECT id, ebook_title, ebook_url FROM ebooks";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="ebook-item">';
                    echo '<span>' . htmlspecialchars($row["ebook_title"]) . ' - <a href="' . htmlspecialchars($row["ebook_url"]) . '" target="_blank">View</a></span>';
                    echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" style="display: inline;">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="delete-button">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No ebooks found in the database.</p>";
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