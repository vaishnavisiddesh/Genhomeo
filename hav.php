<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Health Videos</title>
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
        .video-list {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .video-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .video-item:last-child {
            border-bottom: none;
        }
        .edit-button {
            background-color: #007bff;
            margin-right: 5px;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .edit-form {
            display: none; /* Initially hidden */
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Panel - Manage Health Videos</h2>

        <h3>Add New Video</h3>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="video_url">YouTube Video URL:</label>
                <input type="text" id="video_url" name="video_url" required placeholder="Enter YouTube video URL">
            </div>
            <button type="submit">Add Video</button>
        </form>

        <div class="video-list">
            <h3>Existing Videos</h3>
            <?php
            $servername = "aws-simplified.cr4ooq6sa891.eu-north-1.rds.amazonaws.com";
            $username = "admin";
            $password = "nithya2002";
            $dbname = "homeopathy";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['action'])) {
                $action = $_POST['action'];

                if ($action == 'add') {
                    if (isset($_POST['video_url']) && !empty($_POST['video_url'])) {
                        $videoUrl = $_POST['video_url'];
                        $sql = "INSERT INTO health_videos (video_url) VALUES (?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $videoUrl);

                        if ($stmt->execute()) {
                            echo '<p style="color: green;">Video added successfully!</p>';
                        } else {
                            echo '<p style="color: red;">Error adding video.</p>';
                        }
                        $stmt->close();
                    } else {
                        echo '<p style="color: red;">Please enter a video URL.</p>';
                    }
                } elseif ($action == 'delete') {
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $id = $_POST['id'];
                        $sql = "DELETE FROM health_videos WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);

                        if ($stmt->execute()) {
                            echo '<p style="color: green;">Video deleted successfully!</p>';
                        } else {
                            echo '<p style="color: red;">Error deleting video.</p>';
                        }
                        $stmt->close();
                    } else {
                        echo '<p style="color: red;">Invalid video ID.</p>';
                    }
                } elseif ($action == 'edit') {
                    if (isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['new_video_url']) && !empty($_POST['new_video_url'])) {
                        $id = $_POST['id'];
                        $newVideoUrl = $_POST['new_video_url'];
                        $sql = "UPDATE health_videos SET video_url = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("si", $newVideoUrl, $id);

                        if ($stmt->execute()) {
                            echo '<p style="color: green;">Video updated successfully!</p>';
                        } else {
                            echo '<p style="color: red;">Error updating video.</p>';
                        }
                        $stmt->close();
                    } else {
                        echo '<p style="color: red;">Invalid update data.</p>';
                    }
                }
            }

            $sql = "SELECT id, video_url FROM health_videos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="video-item">';
                    echo '<span>' . htmlspecialchars($row["video_url"]) . '</span>';
                    echo '<div>';
                    echo '<button type="button" class="edit-button" onclick="showEditForm(' . $row["id"] . ')">Edit</button>';
                    echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" style="display: inline;">';
                    echo '<input type="hidden" name="action" value="delete">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="delete-button">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '<div class="edit-form" id="editForm' . $row["id"] . '">';
                    echo '<h3>Edit Video URL</h3>';
                    echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="action" value="edit">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<div class="form-group">';
                    echo '<label for="new_video_url">New URL:</label>';
                    echo '<input type="text" id="new_video_url" name="new_video_url" value="' . htmlspecialchars($row["video_url"]) . '" required>';
                    echo '</div>';
                    echo '<button type="submit">Update Video</button>';
                    echo '<button type="button" onclick="hideEditForm(' . $row["id"] . ')">Cancel</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No videos in the database.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function showEditForm(videoId) {
            document.getElementById('editForm' + videoId).style.display = 'block';
        }

        function hideEditForm(videoId) {
            document.getElementById('editForm' + videoId).style.display = 'none';
        }
    </script>
</body>
</html>
