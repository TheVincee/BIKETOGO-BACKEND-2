<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bike-to-go";

$data = mysqli_connect($host, $user, $password, $db);
if ($data == false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $usertype = $_POST["usertype"]; // Added to retrieve user type from form

    // Check if username already exists
    $stmt = $data->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another one.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $data->prepare("INSERT INTO users (username, password, usertype) VALUES (?, ?, ?)"); // Removed extra comma
        $stmt->bind_param("sss", $username, $hashed_password, $usertype);

        if ($stmt->execute()) {
            echo "New record created successfully";
            // Redirect to login page or other page
            // header("Location: login.php");
            // exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="Sign-up.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="username" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter Username" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
  </div>
  <input type="hidden" name="usertype" value="user">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
