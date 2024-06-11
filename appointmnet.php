<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bike-to-go";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting form data
$First_name = $_POST['First_name'] ?? '';
$Last_name = $_POST['Last_name'] ?? '';
$Email = $_POST['Email'] ?? '';
$Phone_number = $_POST['Phone_number'] ?? '';
$Address = $_POST['Address'] ?? '';
$input_type = $_POST['inputType'] ?? '';
$Date_time = $_POST['dob'] ?? '';

// Sanitize input data to prevent SQL injection
$First_name = $conn->real_escape_string($First_name);
$Last_name = $conn->real_escape_string($Last_name);
$Email = $conn->real_escape_string($Email);
$Phone_number = $conn->real_escape_string($Phone_number);
$Address = $conn->real_escape_string($Address);
$input_type = $conn->real_escape_string($input_type);
$Date_time = $conn->real_escape_string($Date_time);

// Creating the SQL query
$sql = "INSERT INTO appointments (First_name, Last_name, Email, phone_number, Address, input_type, Date_time)
        VALUES ('$First_name', '$Last_name', '$Email', '$Phone_number', '$Address', '$input_type', '$Date_time')";

// Executing the query
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// Closing the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add Bootstrap CSS for styling (optional, but recommended) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div id="liveAlertPlaceholder"></div>

<form action="process.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="First_name">First Name</label>
      <input type="text" class="form-control" id="First_name" name="First_name">
    </div>
    <div class="form-group col-md-6">
      <label for="Last_name">Last Name</label>
      <input type="text" class="form-control" id="Last_name" name="Last_name">
    </div>
  </div>
  <div class="form-group">
    <label for="Email">Email</label>
    <input type="email" class="form-control" id="Email" name="Email">
  </div>
  <div class="form-group">
    <label for="Phone_number">Phone Number</label>
    <input type="text" class="form-control" id="Phone_number" name="Phone_number">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Address">Address</label>
      <input type="text" class="form-control" id="Address" name="Address">
    </div>
    <div class="form-group col-md-4">
      <label for="inputType">Type</label>
      <select id="inputType" class="form-control" name="inputType">
        <option selected>Choose...</option>
        <option>Type 1</option>
        <option>Type 2</option>
        <option>Type 3</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="dob">Date</label>
    <input type="date" class="form-control" id="dob" name="dob">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Add Bootstrap JS and dependencies (optional, for additional functionality) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</body>
</html>

