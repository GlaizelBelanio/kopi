<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the login form
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Create a database connection (replace with your database credentials)
    $conn = new mysqli('localhost', 'root', '', 'jakesdb');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to select user with matching credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND pass = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if a row was returned (i.e., if the credentials match)
    if ($result->num_rows == 1) {
        // Redirect to kopi.html after successful login
        header("Location: main.html");
        exit;
    } else {
        
        // If no matching user is found, display an error message
        echo "<script>alert('Invalid username or password. Please try again.'); window.location='login.html';</script></script>";
     

    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
