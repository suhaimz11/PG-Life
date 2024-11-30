<?php
// Database configuration
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'test';

// Create a connection to the database
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to sanitize user inputs to prevent SQL injection
function sanitize_input($input) {
    global $mysqli;
    return $mysqli->real_escape_string($input);
}

// Check if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have POST data for each column in the users table
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);
    $full_name = sanitize_input($_POST["full_name"]);
    $phone = sanitize_input($_POST["phone"]);
    $gender = sanitize_input($_POST["gender"]);
    $college_name = sanitize_input($_POST["college_name"]);

    // Insert data into the users table
    $sql = "INSERT INTO users (email, password, full_name, phone, gender, college_name) 
            VALUES ('$email', '$password', '$full_name', '$phone', '$gender', '$college_name')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>
