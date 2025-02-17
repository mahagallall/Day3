<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $room = $_POST['room'];
        $ext = trim($_POST['ext']);
        
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>Invalid email format</p>";
        }

        
        if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
            echo "<p style='color:red;'>Password must be exactly 8 characters, contain only lowercase letters, numbers, and underscores.</p>";
        }

        
        if ($password !== $confirm_password) {
            echo "<p style='color:red;'>Passwords do not match</p>";
        }

        
        if (isset($_FILES['profile_picture'])) {
            $file_type = mime_content_type($_FILES['profile_picture']['tmp_name']);
            if (!str_starts_with($file_type, 'images\photo.jpg')) {
                echo "<p style='color:red;'>Uploaded file must be an image</p>";
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add User</h2>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <label for="room">Room No:</label>
            <select id="room" name="room">
                <option value="Application1">Application1</option>
                <option value="Application2">Application2</option>
                <option value="Cloud">Cloud</option>
            </select>
            
            <label for="ext">Extension:</label>
            <input type="text" id="ext" name="ext">
            
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="images\photo.jpg" required>
            
            <button type="submit">Save</button>
            <button type="reset">Reset</button>
        </form>
    </div>

    
</body>
</html>
