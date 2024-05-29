<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'jakesdb');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Check if the username or email already exists
        $stmt_check = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        // If the username or email already exists, display an error message
        if ($result_check->num_rows > 0) {
            echo "<script>alert('Account already exists with this username or email'); window.location='login.html';</script></script>";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, email, pass) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $pass);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Account created successfully! Please login.'); window.location='login.html';</script></script>";
              
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
    }
}
?>
