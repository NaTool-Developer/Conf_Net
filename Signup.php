<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Conf_Net"; 

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_name = $conn->real_escape_string($_POST['email']); // User_Name
    $first_name = $conn->real_escape_string($_POST['first_name']); // F_Name
    $last_name = $conn->real_escape_string($_POST['last_name']); // L_Name
    $password = $conn->real_escape_string($_POST['password']); // Pass

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the `Users` table
    $sql = "INSERT INTO Users (User_Name, F_Name, L_Name, Pass) 
            VALUES ('$user_name', '$first_name', '$last_name', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
            window.location.href = 'Login.html';
        </script>
    ";
    
    } else {
        echo "
        <script>
            window.location.href = 'Signup.html';
        </script>";
    }
}

// Close the database connection
$conn->close();
?>
