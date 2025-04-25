<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Research Papers</title>
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
        input[type="file"], button {
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
        .paper-list {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .paper-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .paper-item:last-child {
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
        <h2>Admin Panel - Manage Research Papers</h2>

        <h3>Add New Research Paper</h3>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="research_paper">Research Paper File:</label>
                <input type="file" id="research_paper" name="research_paper" required>
                <small>Please upload PDF files only.</small>
            </div>
            <button type="submit">Add Paper</button>
            <?php if (isset($upload_error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($upload_error); ?></p>
            <?php endif; ?>
            <?php if (isset($upload_success)): ?>
                <p class="success-message"><?php echo htmlspecialchars($upload_success); ?></p>
            <?php endif; ?>
        </form>

        <div class="paper-list">
            <h3>Existing Research Papers</h3>
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
                    if (isset($_FILES['research_paper']) && $_FILES['research_paper']['error'] === UPLOAD_ERR_OK) {
                        $fileTmpPath = $_FILES['research_paper']['tmp_name'];
                        $fileName = $_FILES['research_paper']['name'];
                        $fileSize = $_FILES['research_paper']['size'];
                        $fileType = $_FILES['research_paper']['type'];
                        $allowedTypes = ['application/pdf'];
                        $uploadDirectory = 'uploads/';

                        if (!is_dir($uploadDirectory)) {
                            mkdir($uploadDirectory, 0755, true);
                        }

                        if (!in_array($fileType, $allowedTypes)) {
                            $upload_error = 'Invalid file type. Only PDF files are allowed.';
                        } elseif ($fileSize > 2097152) { // 2MB limit
                            $upload_error = 'File size exceeds the limit (2MB).';
                        } else {
                            $newFileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
                            $destinationPath = $uploadDirectory . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                                $sql = "INSERT INTO research_papers (file_name, file_path) VALUES (?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ss", $fileName, $destinationPath); // Bind both file_name and file_path

                                if ($stmt->execute()) {
                                    $upload_success = 'Research paper added successfully!';
                                } else {
                                    $upload_error = 'Error saving file information to database.';
                                }
                                $stmt->close();
                            } else {
                                $upload_error = 'Error moving the uploaded file. Please check directory permissions.';
                            }
                        }
                    } else {
                        $upload_error = 'No file was uploaded or an error occurred during upload.';
                    }
                } elseif ($action == 'delete') {
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $id = $_POST['id'];

                        $sql_select = "SELECT file_path FROM research_papers WHERE id = ?";
                        $stmt_select = $conn->prepare($sql_select);
                        $stmt_select->bind_param("i", $id);
                        $stmt_select->execute();
                        $result_select = $stmt_select->get_result();

                        if ($row = $result_select->fetch_assoc()) {
                            $filePathToDelete = $row["file_path"];

                            $sql_delete = "DELETE FROM research_papers WHERE id = ?";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bind_param("i", $id);

                            if ($stmt_delete->execute()) {
                                if (file_exists($filePathToDelete)) {
                                    if (unlink($filePathToDelete)) {
                                        $delete_success = 'Research paper deleted successfully!';
                                    } else {
                                        $delete_warning = 'Research paper record deleted, but unable to delete the file from the server. Check file permissions.';
                                    }
                                } else {
                                    $delete_success = 'Research paper deleted successfully! (File not found on server).';
                                }
                            } else {
                                $delete_error = 'Error deleting research paper record.';
                            }
                            $stmt_delete->close();
                        } else {
                            $delete_error = 'Research paper not found.';
                        }
                        $stmt_select->close();
                    } else {
                        $delete_error = 'Invalid research paper ID.';
                    }
                }
            }

            $sql = "SELECT id, file_name FROM research_papers"; // Fetch file_name for display
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="paper-item">';
                    echo '<span>' . htmlspecialchars($row["file_name"]) . '</span>'; // Display file_name
                    echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" style="display: inline;">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="delete-button">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No research papers in the database.</p>";
            }
            $conn->close();
            ?>
        </div>
        <?php if (isset($delete_error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($delete_error); ?></p>
        <?php endif; ?>
        <?php if (isset($delete_warning)): ?>
            <p class="error-message"><?php echo htmlspecialchars($delete_warning); ?></p>
        <?php endif; ?>
        <?php if (isset($delete_success)): ?>
            <p class="success-message"><?php echo htmlspecialchars($delete_success); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>