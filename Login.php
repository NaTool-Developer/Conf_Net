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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data
    $email = $conn->real_escape_string($_GET['Email']); // Email
    $password = $_GET['Password']; // Password

    // Query to fetch the user data
    $sql = "SELECT * FROM Users WHERE User_Name = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['Pass'])) {
            // Redirect to the dashboard or welcome page
            echo "
            <script>
                alert('Login successful!');
                window.location.href = 'TestLogin.html';
            </script>
            ";
        } else {
            // Incorrect password
            echo "
            <script>
                alert('Incorrect password. Please try again.');
                window.location.href = 'Login.html';
            </script>
            ";
        }
    } else {
        // User not found
        echo "
        <script>
            alert('User not found. Please sign up first.');
            window.location.href = 'signup.html';
        </script>
        ";
    }
}

// Close the database connection
$conn->close();
?>
