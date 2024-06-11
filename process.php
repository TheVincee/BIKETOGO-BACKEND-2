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

// Uncomment the following line for debugging (optional)
// echo "SQL Query: $sql<br>";

// Executing the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Closing the connection
$conn->close();
?>
